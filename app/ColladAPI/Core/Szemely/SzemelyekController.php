<?php namespace ColladAPI\Core\Szemely;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Http\Resource;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;

class SzemelyekController extends RestExtController {

    /**
     * @var SzemelyRepository
     */
    protected $szemelyek;

    protected $cacheTimeMinutes = 5;

    protected $media_type = MediaType::APPLICATION_JSON;

    //protected $charset = Charset::ISO_8859_2;

    public function __construct(SzemelyRepository $szemelyRepository)
    {
        parent::__construct();
        $this->szemelyek = $szemelyRepository;
        //$this->setPagination(2);
        //$this->allowForRoles('only', ['ADMIN']);
    }

	public function index()
    {
        //Cache::forget('osszesSzemely');
        //dd(Cache::get('osszesSzemely'));
        //dd(Request::getAcceptableContentTypes());
        //dd(Request::getLanguages());
        //dd(Request::getCharsets());

        //$this->consume([\Noherczeg\RestExt\Providers\MediaType::TEXT_HTML, \Noherczeg\RestExt\Providers\MediaType::TEXT_PLAIN]);
        //$this->produce([\Noherczeg\RestExt\Providers\MediaType::APPLICATION_JSON]);

        //$this->allowForRoles('only', ['Admin']);
        $this->setPaginationFor($this->szemelyek);
        //$this->setMediaType(MediaType::APPLICATION_XML);


        /*$resource = Cache::remember('osszesSzemely', $this->cacheTimeMinutes, function()
        {
            return $this->createResource($this->service->all());
        });*/

        $resource = new Resource();
        $atTime = new \DateTime($this->request->query('in'));
        if ($atTime === null) {
            $atTime = new \DateTime();
        }

        if ($this->request->query('type') == 'tanar') {
            $resource = $this->restExt->from($this->szemelyek->findTanarokAtTime($atTime))->links()->create('szemelyek');
        } elseif ($this->request->query('type') == 'hallgato') {
            $resource = $this->restExt->from($this->szemelyek->findHallgatokAtTime($atTime))->links()->create('szemelyek');
        } else {
            $resource = $this->restExt->from($this->szemelyek->all(), true)->links()->create('szemelyek');
        }

        $resource->addLink($this->linker->createParentLink());

        //Log::info("test logolas", array('context' => 'Other helpful information'));

        return $this->restResponse->sendResource($resource);
	}

	public function store()
    {
        $szemely = $this->szemelyek->register(Input::json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
	}

	public function show($id)
    {
        $szemely = $this->szemelyek->findByIdWithAll($id);
        $resource = $this->restExt->from($szemely)->links()->create();

        $resource->addLinks($this->linker->linksToEntityRelations($szemely));
        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
	}

	public function update($id)
    {
        $updated = $this->szemelyek->update($id, Input::json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
	}

	public function destroy($id)
    {
		$this->szemelyek->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
	}

}