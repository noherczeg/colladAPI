<?php namespace ColladAPI\Core\Dij;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestResponse;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;
use Noherczeg\RestExt\Services\Linker;

class DijakController extends RestExtController {

    private $linker;
    
    public function __construct(DijRepository $repo, AuthorizationService $auth, Linker $linker)
    {
        parent::__construct();
        $this->repository = $repo;
        $this->authorizationService = $auth;
        $this->linker = $linker;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->repository->enablePagination(10);

        $resource = RestExt::from($this->repository->all())->links()->create(true);

        $resource->addLink($this->linker->createParentLink());

        return RestResponse::sendResource($resource);
    }

    public function show($id)
    {
        $dij = $this->repository->findByIdWithAll($id);

        $resource = RestExt::from($dij)->links()->create(true);
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($dij));

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