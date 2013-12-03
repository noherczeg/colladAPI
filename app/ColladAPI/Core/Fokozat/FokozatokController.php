<?php namespace ColladAPI\Core\Fokozat;

use Noherczeg\RestExt\Controllers\RestExtController;

class FokozatokController extends RestExtController {

    public function __construct(FokozatService $fokozatService)
    {
        parent::__construct();
        $this->service = $fokozatService;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->setPagination(2);
        $this->enableLinks(true);

        $fokozatok = $this->service->all();

        $resource = $this->createResource($fokozatok, true);

        $resource->addLink($this->createParentLink());

        return $this->sendResource($resource);
    }

    public function show($id)
    {
        $this->enableLinks(true);
        $fokozat = $this->service->findById($id);

        $resource = $this->createResource($fokozat);
        $resource->addLink($this->createParentLink());

        return $this->sendResource($resource);
    }
} 