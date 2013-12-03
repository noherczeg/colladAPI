<?php namespace ColladAPI\Core\Tanulmanyut;

use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Exceptions\ValidationException;

class TanulmanyutakController extends RestExtController
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

    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function show($id)
    {
        $szemely = $this->tanulmanyutService->findById($id);
        
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
            $updated = $this->tanulmanyutService->update($id, Input::json()->all());
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