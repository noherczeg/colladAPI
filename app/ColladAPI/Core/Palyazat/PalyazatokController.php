<?php namespace ColladAPI\Core\Palyazat;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Exceptions\ErrorMessageException;
use Noherczeg\RestExt\Exceptions\ValidationException;

class PalyazatokController extends RestExtController {

    protected $palyazatService;

    public function __construct(PalyazatService $palyazatService)
    {
        $this->palyazatService = $palyazatService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json($this->palyazatService->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            $palyazat = $this->palyazatService->save(Input::json()->all());
            return Response::json($palyazat->toArray(), 201);
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
        $palyazat = $this->palyazatService->findById($id);

        if ($palyazat == null)
            return Response::json(['reason' => 'not found'], 404);

        return Response::json($palyazat, 200);
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
            $updated = $this->palyazatService->update($id, Input::json()->all());
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