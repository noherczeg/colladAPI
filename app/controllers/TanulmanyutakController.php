<?php
use ColladAPI\Services\TanulmanyutService;
use ColladAPI\Exceptions\ErrorMessageException;

class TanulmanyutakController extends BaseController
{

    protected $tanulmanyutService;

    public function __construct(TanulmanyutService $tanulmanyutService)
    {
        $this->tanulmanyutService = $tanulmanyutService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json($this->tanulmanyutService->all());
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
            $szemely = $this->szemelyService->register(Input::json()->all());
            return Response::json($szemely->toArray(), 201);
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
        $szemely = $this->szemelyService->findById($id);
        
        if ($szemely == null)
            return Response::json([
                'reason' => 'not found'
            ], 404);
        
        return Response::json($szemely, 200);
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
            $updated = $this->szemelyService->update($id, Input::json()->all());
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
        //
    }
}