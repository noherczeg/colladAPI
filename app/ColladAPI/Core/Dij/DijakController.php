<?php namespace ColladAPI\Core\Dij;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class DijakController extends RestExtController {

    private $dijak;

    public function __construct(DijRepository $repo, AuthorizationService $auth)
    {
        parent::__construct();
        $this->dijak = $repo;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->dijak->enablePagination(10);

        $resource = $this->restExt->from($this->dijak->all())->links()->create(true);

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $dij = $this->dijak->findByIdWithAll($id);

        $resource = $this->restExt->from($dij)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($dij));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->dijak->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->dijak->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->dijak->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 