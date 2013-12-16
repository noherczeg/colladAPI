<?php namespace ColladAPI\Core\Palyazat;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class PalyazatokController extends RestExtController {

    protected $palyazatService;

    public function __construct(PalyazatService $service, AuthorizationService $auth)
    {
        parent::__construct();
        $this->palyazatService = $service;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->palyazatService->enablePagination(10);

        $resource = RestExt::from($this->palyazatService->all())->links()->create(true);

        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
    }

    public function show($id)
    {
        $publikacio = $this->palyazatService->findByIdWithAll($id);

        $resource = RestExt::from($publikacio)->links()->create(true);
        $resource->addLink(RestLinker::createParentLink());
        $resource->addLinks(RestLinker::linksToEntityRelations($publikacio));

        return RestResponse::sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->palyazatService->save(Input::json()->all());

        return Response::make(null, HttpStatus::CREATED);
    }

    public function update()
    {
        return $this->palyazatService->update(Input::json()->all());
    }

    public function destroy($id)
    {
        $this->palyazatService->delete($id);

        return Response::make(null, HttpStatus::OK);
    }

}