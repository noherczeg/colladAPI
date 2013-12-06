<?php namespace ColladAPI\Core\Publikacio;

use ColladAPI\Core\Nyelv\NyelvRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class PublikaciokController extends RestExtController {

    private $repository;

    private $nyelvRepository;

    public function __construct(PublikacioRepository $repo, NyelvRepository $nyelvRepository, AuthorizationService $auth)
    {
        parent::__construct();
        $this->repository = $repo;
        $this->nyelvRepository = $nyelvRepository;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->repository->enablePagination(10);

        $all = $this->repository->all();

        // ha CSV-t kernek, akkor azt adunk
        if ($this->requestAccepts() == MediaType::TEXT_CSV) {
            return RestResponse::sendFile(RestExt::collectionToCSVString($all), 'csvtest.csv');
        }

        $resource = RestExt::from($this->repository->all())->links()->create(true);

        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
    }

    public function show($id)
    {
        $publikacio = $this->repository->findByIdWithAll($id);

        $resource = RestExt::from($publikacio)->links()->create(true);
        $resource->addLink(RestLinker::createParentLink());
        $resource->addLinks(RestLinker::linksToEntityRelations($publikacio));

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

    public function showNyelv($pubId, $nyelvId)
    {
        $nyelv = $this->repository->findNyelvForPublikacio($pubId, $nyelvId);

        $resource = RestExt::from($nyelv)->links()->create(true);
        $resource->addLink(RestLinker::createLinkUp('parent', 2));

        return RestResponse::sendResource($resource);
    }

    public function addNyelv($pubId)
    {
        // nem letezo nyelvet nem lehet hozzaadni, ezert a postolt adatokbol nekunk csak az id kell
        $nyelv = $this->nyelvRepository->findById(Input::get('id'));
        $this->repository->addNyelvForPublikacio($pubId, $nyelv);

        return Response::make(null, HttpStatus::OK);
    }

} 