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

class BaseController extends Controller
{

    protected $service = null;

    private $mediaTypeWildcard = '*/*';

    protected $links = false;

    protected $pagination = false;

    protected $resource = null;

    protected $media_type = null;

    protected $charset = null;

    private $response = null;

    protected $route = null;

    private $supportedMediaTypes = [MediaType::APPLICATION_JSON, MediaType::APPLICATION_XML];

    public function __construct()
    {

        $this->route = Request::path();

        if ($this->media_type === null)
            $this->media_type = Config::get('rest.media_type');

        if ($this->charset == null)
            $this->charset = Config::get('rest.charset');

        $this->afterFilter(function()
        {
            $data  = $this->resource->toArray();

            if ($this->links) {

                // onmagara mutato link
                $this->createLink('self', URL::full());

                if ($this->pagination) {
                    $this->resource->links();

                    $this->response['content'] = $data['data'];

                    // lapozashoz linkek
                    $this->generatePaginationLinks();

                    // page metainfo
                    $this->generatePaginationMetaInfo();
                } else {
                    // maga a tartalom mely visszakuldesre kerul
                    $this->response['content'] = $data;
                }
            } else {
                $this->response = $data;
            }

            // send response with appropriate headers depending on request, content type from settings, media type from settings
            return $this->sendResponse()->send();
        });
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

    protected function enableLinks($boolValue)
    {
        if(!is_bool($boolValue))
            // TODO nyelvesites..
            throw new \InvalidArgumentException('Expecting boolean value!');
        $this->links = $boolValue;
    }

    protected function setMediaType($mt)
    {
        $this->media_type = $mt;
    }

    protected function setCharset($cs)
    {
        $this->charset = $cs;
    }

    protected function createLink($rel, $href) {
        $this->response['links'][] = ['rel' => $rel, 'href' => $href];
    }

    private function generatePaginationMetaInfo()
    {
        $this->response['pages'] = [
            'total' => $this->resource->getTotal(), 'perPage' => $this->resource->getPerPage(),
            'isFirstPage' => ($this->resource->getCurrentPage() == 1) ? true : false,
            'isLastPage' => ($this->resource->getCurrentPage() == $this->resource->getLastPage()) ? true : false
        ];
    }

    private function generatePaginationLinks()
    {
        // legelso oldalra mutato link
        $this->createLink('first', URL::to($this->route . '?page=1'));

        // elozo oldalra mutato link, ha van
        if ($this->resource->getCurrentPage() > 1)
            $this->createLink('previous', URL::to($this->route . '?page=' . ($this->resource->getCurrentPage() - 1)));

        // kovetkezo oldalra mutato link, ha van
        if ($this->resource->getCurrentPage() < $this->resource->getLastPage())
            $this->createLink('next', URL::to($this->route . '?page=' . ($this->resource->getCurrentPage() + 1)));

        // utolso elemre mutato link
        $this->createLink('last', URL::to($this->route . '?page=' . $this->resource->getLastPage()));
    }

    public function sendResponse()
    {
        $response = Response::make($this->createResponseBody($this->response), $this->createResponseCode());
        $response->setCharset($this->charset);
        $response->header('Content-Type', $this->createContentType($this->media_type, $this->charset));

        return $response;
    }

    private function createContentType($media_type, $charset)
    {
        return $this->assembleMediaType($media_type) . '; ' . 'charset=' . $charset;
    }

    private function assembleMediaType($media_type)
    {
        $finalType = $media_type;

        if (Config::get('rest.prefer_accept') && count(Request::getAcceptableContentTypes()) > 0) {
            foreach(Request::getAcceptableContentTypes() as $acceptType) {
                if (in_array($acceptType, $this->getSupportedMediaTypes())) {
                    $finalType = Request::getAcceptableContentTypes()[0];
                    break;
                }
            }
        }

        return $finalType;
    }

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

}