<?php

use ColladAPI\Services\SzemelyService;
use ColladAPI\Exceptions\ErrorMessageException;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use ColladAPI\MediaType;
use ColladAPI\Charset;
use ColladAPI\Resource;

class SzemelyekController extends BaseController {

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
            $this->setPagination(2);
        //$this->setMediaType(MediaType::APPLICATION_XML);
        $this->enableLinks(true);

        /*$resource = Cache::remember('osszesSzemely', $this->cacheTimeMinutes, function()
        {
            return $this->createResource($this->service->all());
        });*/
        $resource = $this->createResource($this->service->all());
        Log::info("test logolas", array('context' => 'Other helpful information'));

        return $this->sendResource($resource);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
    {
		//
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
        $this->enableLinks(true);
        $this->allowForRoles('only', ['Admin']);

        $resource = $this->createResource($this->service->findById($id));

        return $this->sendResource($resource);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
    {
		//
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
		//
	}

}