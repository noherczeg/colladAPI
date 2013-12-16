<?php namespace ColladAPI\Core\Publikacio;

use ColladAPI\Core\Nyelv\NyelvRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Services\AuthorizationService;

class PublikaciokNyelvekController extends RestExtController {

    private $repository;

    private $nyelvRepository;

    public function __construct(PublikacioRepository $repo, NyelvRepository $nyelvRepository, AuthorizationService $auth)
    {
        parent::__construct();
        $this->repository = $repo;
        $this->nyelvRepository = $nyelvRepository;
        $this->authorizationService = $auth;
    }

    public function show($pubId, $nyelvId)
    {
        $nyelv = $this->repository->findNyelvForPublikacio($pubId, $nyelvId);

        $resource = RestExt::from($nyelv)->links()->create(true);
        $resource->addLink(RestLinker::createLinkUp('parent', 2));

        return RestResponse::sendResource($resource);
    }

    public function store($pubId)
    {
        // nem letezo nyelvet nem lehet hozzaadni, ezert a postolt adatokbol nekunk csak az id kell
        $nyelv = $this->nyelvRepository->findById(Input::get('id'));
        $this->repository->addNyelvForPublikacio($pubId, $nyelv);

        return Response::make(null, HttpStatus::OK);
    }

}