<?php

use ColladAPI\Exceptions\PermissionException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use ColladAPI\MediaType;
use ColladAPI\Providers\Serializer;
use Noherczeg\RestExt\Providers\HttpStatus;
use ColladAPI\Resource;

class BaseController extends Controller
{

    protected $service = null;

    private $mediaTypeWildcard = '*/*';

    protected $links = false;

    protected $pagination = false;

    protected $resource = null;

    protected $media_type = null;

    protected $charset = null;

    protected $route = null;

    private $supportedMediaTypes = [MediaType::APPLICATION_JSON, MediaType::APPLICATION_XML];

    private $ACCEPT_WILDCARD = '*/*';

    public function __construct()
    {

        $this->route = Request::path();

        if ($this->media_type === null)
            $this->media_type = Config::get('rest.media_type');

        if ($this->charset == null)
            $this->charset = Config::get('rest.charset');

    }

    public function getSupportedMediaTypes()
    {
        return $this->supportedMediaTypes;
    }

    /**
     * Adott Controller (Eroforras) eleresenek korlatozasa adott szerepkorok szamara.
     *
     * only: csak a listaban szereplo szerepkorok szamara ad hozzaferest (whitelist)
     * except: csak azoknak enged hozzaferest, akik nem tagjai a listaban szereplo szerepkoroknek (blacklist)
     *
     * @param string $filter only|except
     * @param array $roles
     * @throws ColladAPI\Exceptions\PermissionException
     * @throws MissingMandatoryParametersException
     * @throws \InvalidArgumentException
     */
    protected function allowForRoles($filter = null, array $roles = [])
    {
        if ($filter == null || count($roles) == 0)
            throw new MissingMandatoryParametersException();

        if (!in_array($filter, ['only', 'except']))
            throw new \InvalidArgumentException('Expecting: "only" or "except"');

        if (strtolower($filter) == 'only' && !$this->hasRoles($roles)) {
            throw new PermissionException();
        } elseif (strtolower($filter) == 'except' && $this->hasRoles($roles)) {
            throw new PermissionException();
        }
    }

    /**
     * Aktualis felhasznalo rendelkezik-e a listaban szereplo jogok egyikvele legalabb
     *
     * @param array $roles
     * @return bool
     */
    private function hasRoles(array $roles)
    {
        foreach ($roles as $role) {
            if (!Entrust::hasRole($role))
                return false;
        }

        return true;
    }

    /**
     * Eroforras lapozas ki/be kapcsolasa.
     *
     * Amennyiben szam van megadva, a szamnak megfelelo darab elem kerul megjelenitesre.
     *
     * @param bool|int $boolOrInt
     */
    protected function setPagination($boolOrInt = false)
    {
        $this->pagination = $boolOrInt;
        $this->service->enablePagination($boolOrInt);
    }

    /**
     * Enables linking for a returned Resource.
     *
     * Can be called anywhere (constructor, method)
     *
     * @param boolean $boolValue
     * @throws InvalidArgumentException
     */
    protected function enableLinks($boolValue)
    {
        if(!is_bool($boolValue))
            throw new \InvalidArgumentException('Expecting boolean value!');
        $this->links = $boolValue;
    }

    /**
     * Overrides the returned MediaType of our Resource
     *
     * @param string $mt
     */
    protected function setMediaType($mt)
    {
        $this->media_type = $mt;
    }

    /**
     * Overrides the default character set of our responses
     *
     * @param string $cs
     */
    protected function setCharset($cs)
    {
        $this->charset = $cs;
    }

    /**
     * Helper method to assemble an easily processable link array.
     *
     * @param string $rel
     * @param string $href
     * @return array
     */
    protected function createLink($rel, $href = null) {
        $url = ($href === null) ? URL::to(Request::url() . '/' . strtolower($rel)) : $href;
        return ['rel' => $rel, 'href' => $url];
    }

    protected function createLinkToFirstPage($rel) {
        $url = URL::to(Request::url() . '/' . strtolower($rel) . '?page=1');
        return ['rel' => $rel, 'href' => $url];
    }

    /**
     * Creates an array of meta information for pagination
     *
     * @param $paginationObject
     * @return array
     */
    private function generatePaginationMetaInfo($paginationObject)
    {
        return [
            'total' => $paginationObject->getTotal(), 'perPage' => $paginationObject->getPerPage(),
            'isFirstPage' => ($paginationObject->getCurrentPage() == 1) ? true : false,
            'isLastPage' => ($paginationObject->getCurrentPage() == $paginationObject->getLastPage()) ? true : false
        ];
    }

    /**
     * Intelligently creates pagination links for our Resource from the raw Pagination object
     *
     * @param $paginationObject
     * @return array
     */
    private function generatePaginationLinks($paginationObject)
    {
        $links = [];
        // legelso oldalra mutato link
        $links[] = $this->createLink('first', URL::to($this->route . '?page=1'));

        // elozo oldalra mutato link, ha van
        if ($paginationObject->getCurrentPage() > 1)
            $links[] = $this->createLink('previous', URL::to($this->route . '?page=' . ($paginationObject->getCurrentPage() - 1)));

        // kovetkezo oldalra mutato link, ha van
        if ($paginationObject->getCurrentPage() < $paginationObject->getLastPage())
            $links[] = $this->createLink('next', URL::to($this->route . '?page=' . ($paginationObject->getCurrentPage() + 1)));

        // utolso elemre mutato link
        $links[] = $this->createLink('last', URL::to($this->route . '?page=' . $paginationObject->getLastPage()));

        return $links;
    }

    /**
     * Creates a Response object filled with the content and meta info of the Resource which is returned
     *
     * @param ColladAPI\Resource $fromResource
     * @return \Illuminate\Http\Response
     */
    public function sendResource(Resource $fromResource)
    {
        $response = Response::make($this->createResponseBody($fromResource), $this->createResponseCode());
        $response->setCharset($this->charset);
        $response->header('Content-Type', $this->createContentType($this->media_type, $this->charset));

        return $response;
    }

    /**
     * Wrapper function to create a complete Content Type Header
     *
     * @param string $media_type
     * @param string $charset
     * @return string
     */
    private function createContentType($media_type, $charset)
    {
        return $this->assembleMediaType($media_type) . '; ' . 'charset=' . $charset;
    }

    /**
     * Returns a MediaType after evaluating the context's settings
     *
     * @param $media_type
     * @return string
     */
    private function assembleMediaType($media_type)
    {
        $finalType = $media_type;

        if (Config::get('rest.prefer_accept') && count(Request::getAcceptableContentTypes()) > 0 && !in_array($this->ACCEPT_WILDCARD, Request::getAcceptableContentTypes())) {
            foreach(Request::getAcceptableContentTypes() as $acceptType) {
                if (in_array($acceptType, $this->getSupportedMediaTypes())) {
                    $finalType = Request::getAcceptableContentTypes()[0];
                    break;
                }
            }
        }

        return $finalType;
    }

    /**
     * Creates a Response code when working with a Resource which is aware of the Request's method type so this can
     * be used to replace some boilerplate code when trying to decide what to set at what scenario.
     *
     * @return int
     */
    private function createResponseCode()
    {
        $code = HttpStatus::OK;
        $method = strtolower(Request::getMethod());

        if ($method == 'post')
            $code = HttpStatus::CREATED;
        elseif ($method == 'put' || $method == 'patch' || $method == 'delete')
            $code == HttpStatus::NO_CONTENT;

        return $code;
    }

    /**
     * Creates MediaType-aware content from raw data
     *
     * @param mixed $data
     * @return string
     */
    private function createResponseBody($data)
    {
        $mediaType = $this->assembleMediaType($this->media_type);

        if($mediaType == MediaType::APPLICATION_JSON) {
            return Serializer::serialize($data, 'json');
        } elseif ($mediaType == MediaType::APPLICATION_XML) {
            return Serializer::serialize($data, 'xml');
        }

        return serialize($data);
    }

    protected function produce(array $mediaTypes)
    {
        if (in_array($this->mediaTypeWildcard, $mediaTypes))
            return true;

        foreach(Request::getAcceptableContentTypes() as $contentType) {
            if (!in_array($contentType, $mediaTypes) && Config::get('rest.restrict_accept'))
                App::abort(HttpStatus::UNSUPPORTED_MEDIA_TYPE, 'UNSUPPORTED_MEDIA_TYPE');
        }
    }

    protected function consume(array $mediaTypes)
    {
        if ($this->requestContentType() == null || in_array($this->requestContentType(), $mediaTypes)) {
            return true;
        }

        App::abort(406, 'NOT_ACCEPTABLE');
    }

    public function requestContentType()
    {
        $full = Request::header('Content-Type');

        if (strpos($full, ';'))
            return trim(explode(';', $full)[0]);
        return $full;
    }

    public function pageParam()
    {
        if (Request::query('page') !== null)
            return Request::query('page');
        else
            return false;
    }

    /**
     * @param mixed $rawResource
     * @param bool $withContentSelfLink
     * @return Resource
     */
    public function createResource($rawResource, $withContentSelfLink = false)
    {
        $resource = new Resource();
        $data  = $rawResource->toArray();
        $contentCollection = null;

        if ($this->links) {

            // onmagara mutato link
            $resource->addLink($this->createSelfLink());

            if ($this->pagination) {
                $rawResource->links();

                $contentCollection = $data['data'];

                // lapozashoz linkek
                $resource->addLinks($this->generatePaginationLinks($rawResource));

                // page metainfo
                $resource->setPagesMeta($this->generatePaginationMetaInfo($rawResource));
            } else {
                // maga a tartalom mely visszakuldesre kerul
                $contentCollection = $data;
            }

            // ha van engedelyezve a tartalmi reszehez a Resourcenak self link generalas
            if ($withContentSelfLink) {
                foreach ($contentCollection as $key => $resourceCandidate) {
                    $contentCollection[$key]['links'][] = ['self' => Request::url() . '/' . $resourceCandidate['id']];
                }
            }

            $resource->setContent($contentCollection);
        } else {
            $resource->setContent($data);
        }

        return $resource;
    }

    /**
     * Creates Links to all of the provided Model's relations
     *
     * Keep in mind that relations may only be scanned after they are attached to a certain Model, which means "join"
     * operation(s) where triggered. For example: with() method was called on the Model with params!
     *
     * @param $ent
     * @return array
     */
    protected function linksToEntityRelations($ent)
    {
        $rels = array_keys($ent->getRelations());
        $links = [];

        foreach ($rels as $rel) {
            $links[] = $this->createLink(ucfirst($rel), Request::url() . '/' . $rel);
        }

        return $links;
    }

    /**
     * Creates a parent Link to a Resource or Resource Collection
     *
     * @param $parentResource      The name of the parent Resource
     * @return array
     */
    protected function createParentLink($parentResource = null)
    {
        $original = Request::url();
        $parentName = ($parentResource === null) ? 'parent' : $parentResource;
        return $this->createLink($parentName, substr($original, 0, strrpos($original, '/')));
    }

    /**
     * Created self links to the currently called Resource with, or without the provided Query Strings.
     *
     * @param bool $withQueryStrings    Decides if Query Strings should be attached as well, or not
     * @return array
     */
    public function createSelfLink($withQueryStrings = false)
    {
        return $this->createLink('self', ($withQueryStrings) ? URL::full() : Request::url());
    }
}