<?php namespace ColladAPI\Core\Intezet;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;

class IntezetekController extends RestExtController {

    private $intezetek;

    public function __construct(IntezetRepository $repo)
    {
        parent::__construct();
        $this->intezetek = $repo;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->intezetek->enablePagination(10);

        $resource = $this->restExt->from($this->intezetek->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $intezet = $this->intezetek->findByIdWithAll($id);

        $resource = $this->restExt->from($intezet)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($intezet));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->intezetek->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->intezetek->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->intezetek->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 