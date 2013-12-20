<?php namespace ColladAPI\Core\Palyazat;

use ColladAPI\Core\Publikacio\PublikacioRepository;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\RestExt;
use Noherczeg\RestExt\RestLinker;
use Noherczeg\RestExt\RestResponse;
use Noherczeg\RestExt\Services\AuthorizationService;

class PalyazatokPublikaciokController extends RestExtController {

    private $repository;

    private $publikaciokRepository;

    private $restExt;

    private $restLinker;

    private $response;

    public function __construct(
        Response $response, RestLinker $restLinker, RestExt $restExt, Request $request, Repository $config,
        RestResponse $restResponse, Application $app, PalyazatRepository $repo,
        PublikacioRepository $publikaciokRepository, AuthorizationService $auth
    )
    {
        parent::__construct($request, $config, $restResponse, $app);
        $this->repository = $repo;
        $this->publikaciokRepository = $publikaciokRepository;
        $this->authorizationService = $auth;
        $this->restExt = $restExt;
        $this->restLinker = $restLinker;
        $this->response = $response;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->repository->enablePagination(10);

        $resource = $this->restExt->from($this->repository->getRelatedCollection($this->request->segment(3), 'publikaciok'))->links()->create(true);

        $resource->addLink($this->restLinker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($palyazatId, $pubId)
    {
        $pub = $this->repository->getRelatedCollectionElement($palyazatId, 'publikaciok', $pubId);

        $resource = $this->restExt->from($pub)->links()->create();
        $resource->addLink($this->restLinker->createLinkUp('parent', 2));

        return $this->restResponse->sendResource($resource);
    }

    public function store($palyazatId)
    {
        $this->repository->attach($palyazatId, 'ColladAPI\Core\Publikacio\Publikacio', Input::get('id'));

        return $this->response->make(null, HttpStatus::OK);
    }

    public function destroy($palyazatId, $pubId)
    {
        $this->repository->detach($palyazatId, 'ColladAPI\Core\Publikacio\Publikacio', $pubId);

        return $this->response->make(null, HttpStatus::OK);
    }

}