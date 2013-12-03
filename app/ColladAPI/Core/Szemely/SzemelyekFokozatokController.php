<?php namespace ColladAPI\Core\Szemely;

use ColladAPI\Core\Fokozat\FokozatService;
use Noherczeg\RestExt\Controllers\RestExtController;

class SzemelyekFokozatokController extends RestExtController {

    protected $tanszekService;

    public function __construct(SzemelyService $szemelyService, FokozatService $fokozatService)
    {
        parent::__construct();
        $this->service = $szemelyService;
        $this->fokozatService = $fokozatService;
    }

    public function listFokozatokForSzemely($id) {
        if ($this->pageParam())
            $this->setPagination(10);

        $this->enableLinks(true);

        $resource = $this->createResource($this->service->fokozatokForSzemely($id));
        $resource->addLink($this->createParentLink());
        return $this->sendResource($resource);
    }

} 