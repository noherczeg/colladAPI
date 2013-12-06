<?php namespace ColladAPI\Core\Nyelv;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
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

        $resource = RestExt::from($nyelv)->links()->create();
        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->nyelvRepository->save(Input::json()->all());

        return Response::make(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        $nyelv = $this->nyelvRepository->findById($id);
        $nyelv->fill(Input::json());
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return Response::make(null, HttpStatus::OK);
    }

} 