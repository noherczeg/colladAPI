<?php namespace ColladAPI\Core\Tanszek;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Exceptions\ErrorMessageException;
use Noherczeg\RestExt\Exceptions\ValidationException;

class TanszekekController extends RestExtController {

    protected $tanszekService;

    public function __construct(TanszekService $tanszekService)
    {
        parent::__construct();
        $this->tanszekService = $tanszekService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->enableLinks(true);

        $resource = $this->createResource($this->tanszekService->all());

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
            $tanszek = $this->tanszekService->save(Input::json()->all());
            return Response::json($tanszek->toArray(), 201);
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

        $resource = null;

        if (!is_null(Request::query('date'))) {
            $resource = $this->createResource($this->tanszekService->szemelyekByDate($id, new DateTime(Request::query('date'))));
        } else {
            $resource = $this->createResource($this->tanszekService->findById($id));
        }


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
            $updated = $this->tanszekService->update($id, Input::json()->all());
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
        $this->tanszekService->delete($id);
    }

}