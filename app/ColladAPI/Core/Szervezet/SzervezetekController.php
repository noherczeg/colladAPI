<?php namespace ColladAPI\Core\Szervezet;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;
use Noherczeg\RestExt\Services\AuthorizationService;

class SzervezetekController extends RestExtController {

    private $szervezetService;

    public function __construct(SzervezetService $service, AuthorizationService $auth)
    {
        parent::__construct();
        $this->szervezetService = $service;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->szervezetService->enablePagination(10);

        $resource = RestExt::from($this->szervezetService->all())->links()->create('szervezetek');

        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
    }

    public function show($id)
    {
        $szervezet = $this->szervezetService->findByIdWithAll($id);

        $resource = RestExt::from($szervezet)->links()->create(true);
        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
    }

} 