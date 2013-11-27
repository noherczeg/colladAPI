<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.27.
 * Time: 18:33
 */

use ColladAPI\Services\FokozatService;
use ColladAPI\Services\SzemelyService;

class SzemelyekFokozatokController extends BaseController {

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