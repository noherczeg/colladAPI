<?php namespace ColladAPI\Core\Nyelv;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;
use Noherczeg\RestExt\Services\AuthorizationService;

class NyelvekController extends RestExtController {

    private $nyelvRepository;

    public function __construct(NyelvRepository $nyelvRepository, AuthorizationService $auth)
    {
        parent::__construct();
        $this->nyelvRepository = $nyelvRepository;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->nyelvRepository->enablePagination(10);

        $this->allowForRoles('only', ['ADMIN']);

        $resource = RestExt::from($this->nyelvRepository->all())->links()->create('nyelvek');

        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
    }

    public function show($id)
    {
        $nyelv = $this->nyelvRepository->findById($id);

        $resource = RestExt::from($nyelv)->create();
        $resource->addLink($this->createParentLink());

        return RestResponse::sendResource($resource);
    }
} 