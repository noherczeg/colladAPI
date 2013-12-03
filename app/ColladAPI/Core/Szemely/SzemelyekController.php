<?php namespace ColladAPI\Core\Szemely;

use Illuminate\Support\Facades\Request;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Http\Resource;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Facades\RestResponse;

class SzemelyekController extends RestExtController {

    protected $szemelyService;

    protected $cacheTimeMinutes = 5;

    protected $media_type = MediaType::APPLICATION_JSON;

    //protected $charset = Charset::ISO_8859_2;

    public function __construct(SzemelyService $szemelyService)
    {
        parent::__construct();
        $this->service = $szemelyService;
        //$this->setPagination(2);
        //$this->allowForRoles('only', ['ADMIN']);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
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
        if ($this->pageParam())
            $this->service->enablePagination(2);
        //$this->setMediaType(MediaType::APPLICATION_XML);


        /*$resource = Cache::remember('osszesSzemely', $this->cacheTimeMinutes, function()
        {
            return $this->createResource($this->service->all());
        });*/

        $resource = new Resource();
        $atTime = new \DateTime(Request::query('in'));
        if ($atTime === null) {
            $atTime = new \DateTime();
        }

        if (Request::query('type') == 'tanar') {
            $resource = RestExt::from($this->service->findTanarokAtTime($atTime))->links()->create('szemelyek');
        } elseif (Request::query('type') == 'hallgato') {
            $resource = RestExt::from($this->service->findHallgatokAtTime($atTime))->links()->create('szemelyek');
        } else {
            $resource = RestExt::from($this->service->all(), true)->links()->create('szemelyek');
        }

        $resource->addLink(RestLinker::createParentLink());

        //Log::info("test logolas", array('context' => 'Other helpful information'));

        return RestResponse::sendResource($resource);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
    {
        try {
            $szemely = $this->service->register(Input::json()->all());
            return Response::json($szemely->toArray(), 201);
        } catch(ValidationException $ex) {
            App::abort(500, $ex->getMessage());
        } catch(ErrorMessageException $exy) {
            App::abort(500, $exy->getMessage());
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
    {
        $szemely = $this->service->findByIdWithAll($id);
        $resource = RestExt::from($szemely)->links()->create();

        $resource->addLinks(RestLinker::linksToEntityRelations($szemely));
        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
    {
        try {
            $updated = $this->service->update($id, Input::json()->all());
            return Response::json($updated->toArray());
        } catch(ValidationException $ex) {
            App::abort(500, $ex->getMessage());
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
    {
		$this->service->delete($id);
	}

}