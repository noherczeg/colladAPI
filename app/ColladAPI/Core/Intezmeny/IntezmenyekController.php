<?php namespace ColladAPI\Core\Intezmeny;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;

class IntezmenyekController extends RestExtController {

    public function __construct(IntezmenyRepository $repo)
    {
        parent::__construct();
        $this->repository = $repo;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->repository->enablePagination(10);

        $resource = $this->restExt->from($this->repository->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $intezmeny = $this->repository->findByIdWithAll($id);

        $resource = $this->restExt->from($intezmeny)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($intezmeny));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->repository->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->repository->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 