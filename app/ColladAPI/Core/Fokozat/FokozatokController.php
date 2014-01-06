<?php namespace ColladAPI\Core\Fokozat;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;

class FokozatokController extends RestExtController {

    private $fokozatok;

    public function __construct(FokozatRepository $repo)
    {
        parent::__construct();
        $this->fokozatok = $repo;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->fokozatok->enablePagination(10);

        $resource = $this->restExt->from($this->fokozatok->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $fokozat = $this->fokozatok->findByIdWithAll($id);

        $resource = $this->restExt->from($fokozat)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($fokozat));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->fokozatok->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->fokozatok->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->fokozatok->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }
} 