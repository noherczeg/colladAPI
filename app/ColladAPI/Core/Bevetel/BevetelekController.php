<?php namespace ColladAPI\Core\Bevetel;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class BevetelekController extends RestExtController {

    public function __construct(BevetelRepository $repo, AuthorizationService $auth)
    {
        parent::__construct();
        $this->repository = $repo;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->repository->enablePagination(10);

        $resource = RestExt::from($this->repository->all())->links()->create(true);

        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
    }

    public function show($id)
    {
        $beruhazas = $this->repository->findByIdWithAll($id);

        $resource = RestExt::from($beruhazas)->links()->create(true);
        $resource->addLink(RestLinker::createParentLink());
        $resource->addLinks(RestLinker::linksToEntityRelations($beruhazas));

        return RestResponse::sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->repository->save(Input::json()->all());

        return Response::make(null, HttpStatus::CREATED);
    }

    public function update()
    {
        return $this->repository->update(Input::json()->all());
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return Response::make(null, HttpStatus::OK);
    }

} 