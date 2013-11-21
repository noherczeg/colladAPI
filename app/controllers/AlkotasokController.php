<?php
use ColladAPI\Services\AlkotasService;

class AlkotasokController extends BaseController
{

    protected $alkotasService;

    public function __construct(AlkotasService $alkotasService)
    {
        $this->alkotasService = $alkotasService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $alkotasok = [];
        
        if (!is_null(Request::query('from')) && !is_null(Request::query('to'))) {
            $alkotasok = $this->alkotasService->allBetweenDates(new DateTime(Request::query('from')), new DateTime(Request::query('to')));
        } else {
            $alkotasok = $this->alkotasService->all();
        }
        
        return Response::json($alkotasok, 200);
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
            $szemely = $this->alkotasService->register(Input::json()->all());
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
        $alkotas = $this->alkotasService->findById($id);
        
        if ($alkotas == null)
            return Response::json([
                'reason' => 'not found'
            ], 404);
        
        return Response::json($alkotas, 200);
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