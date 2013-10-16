<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 11:30 PM
 */
use ColladAPI\Services\TanszekService;
use Illuminate\Support\Facades\Request;

class TanszekekController extends BaseController
{

    protected $tanszekService;

    public function __construct(TanszekService $tanszekService)
    {
        $this->tanszekService = $tanszekService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json($this->tanszekService->all());
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
        } catch (ValidationException $ex) {
            App::abort(500, $ex->getMessage());
        } catch (ErrorMessageException $exy) {
            App::abort(500, $exy->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function show($id)
    {
        $tanszek = null;
        
        if (! is_null(Request::query('date'))) {
            $tanszek = $this->tanszekService->szemelyekByDate($id, new DateTime(Request::query('date')));
        } else {
            $tanszek = $this->tanszekService->findById($id);
        }
        
        if ($tanszek == null)
            return Response::json([
                'reason' => 'not found'
            ], 404);
        
        return Response::json($tanszek, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id            
     * @return Response
     */
    public function update($id)
    {
        try {
            $updated = $this->tanszekService->update($id, Input::json()->all());
            return Response::json($updated->toArray());
        } catch (ValidationException $ex) {
            App::abort(500, $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return Response
     */
    public function destroy($id)
    {
        $this->tanszekService->delete($id);
    }
}