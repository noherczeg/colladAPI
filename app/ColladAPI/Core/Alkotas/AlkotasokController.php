<?php namespace ColladAPI\Core\Alkotas;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Exceptions\ErrorMessageException;
use Noherczeg\RestExt\Exceptions\ValidationException;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;

class AlkotasokController extends RestExtController
{

    protected $alkotasService;

    public function __construct(AlkotasService $alkotasService)
    {
        $this->alkotasService = $alkotasService;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->alkotasService->enablePagination(10);
        
        if (!is_null(Request::query('from')) && !is_null(Request::query('to'))) {
            $alkotasok = $this->alkotasService->allBetweenDates(new \DateTime(Request::query('from')), new \DateTime(Request::query('to')));
        } else {
            $alkotasok = $this->alkotasService->all();
        }

        $resource = RestExt::from($alkotasok)->links()->create(true);

        $resource->addLink(RestLinker::createParentLink());

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
        $alkotas = $this->alkotasService->findByIdWithAll($id);

        $resource = RestExt::from($alkotas)->links()->create(true);
        $resource->addLink(RestLinker::createParentLink());
        $resource->addLinks(RestLinker::linksToEntityRelations($alkotas));

        return RestResponse::sendResource($resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id            
     * @return Response
     */
    public function update($id)
    {
        $updated = $this->alkotasService->update(Input::json()->all());
        return Response::json($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return Response
     */
    public function destroy($id)
    {
        $this->alkotasService->delete($id);

        return Response::make(null, HttpStatus::OK);
    }
}