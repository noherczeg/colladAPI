<?php namespace ColladAPI\Core\Tanulmanyut;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class TanulmanyutakController extends RestExtController
{

    public function __construct(TanulmanyutService $service, AuthorizationService $auth)
    {
        parent::__construct();
        $this->service = $service;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->service->enablePagination(10);

        $resource = RestExt::from($this->service->all())->links()->create(true);

        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
    }

    public function show($id)
    {
        $szak = $this->service->findByIdWithAll($id);

        $resource = RestExt::from($szak)->links()->create(true);
        $resource->addLink(RestLinker::createParentLink());
        $resource->addLinks(RestLinker::linksToEntityRelations($szak));

        return RestResponse::sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->service->save(Input::json()->all());

        return Response::make(null, HttpStatus::CREATED);
    }

    public function update()
    {
        return $this->service->update(Input::json()->all());
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return Response::make(null, HttpStatus::OK);
    }

}