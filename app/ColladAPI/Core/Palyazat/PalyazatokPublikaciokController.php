<?php namespace ColladAPI\Core\Palyazat;

use ColladAPI\Core\Publikacio\PublikacioRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Services\AuthorizationService;

class PalyazatokPublikaciokController extends RestExtController {

    private $repository;

    private $publikaciokRepository;

    public function __construct(PalyazatRepository $repo, PublikacioRepository $publikaciokRepository, AuthorizationService $auth)
    {
        parent::__construct();
        $this->repository = $repo;
        $this->publikaciokRepository = $publikaciokRepository;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->repository->enablePagination(10);

        $resource = RestExt::from($this->repository->getRelatedCollection(Request::segment(3), 'publikaciok'))->links()->create(true);

        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
    }

    public function show($palyazatId, $pubId)
    {
        $pub = $this->repository->getRelatedCollectionElement($palyazatId, 'publikaciok', $pubId);

        $resource = RestExt::from($pub)->links()->create();
        $resource->addLink(RestLinker::createLinkUp('parent', 2));

        return RestResponse::sendResource($resource);
    }

    public function store($palyazatId)
    {
        $this->repository->attach($palyazatId, 'ColladAPI\Core\Publikacio\Publikacio', Input::get('id'));

        return Response::make(null, HttpStatus::OK);
    }

    public function destroy($palyazatId, $pubId)
    {
        $this->repository->detach($palyazatId, 'ColladAPI\Core\Publikacio\Publikacio', $pubId);

        return Response::make(null, HttpStatus::OK);
    }

}