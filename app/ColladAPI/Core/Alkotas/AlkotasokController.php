<?php namespace ColladAPI\Core\Alkotas;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Exceptions\ErrorMessageException;
use Noherczeg\RestExt\Exceptions\ValidationException;

class AlkotasokController extends RestExtController
{

    protected $alkotasService;

    public function __construct(AlkotasService $alkotasService)
    {
        $this->alkotasService = $alkotasService;
    }

    public function index()
    {
        $alkotasok = [];
        
        if (!is_null(Request::query('from')) && !is_null(Request::query('to'))) {
            $alkotasok = $this->alkotasService->allBetweenDates(new \DateTime(Request::query('from')), new \DateTime(Request::query('to')));
        } else {
            $alkotasok = $this->alkotasService->all();
        }
        
        return Response::json($alkotasok, 200);
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
     * Update the specified resource in storage.
     *
     * @param int $id            
     * @return Response
     */
    public function update($id)
    {
        try {
            $updated = $this->alkotasService->update($id, Input::json()->all());
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