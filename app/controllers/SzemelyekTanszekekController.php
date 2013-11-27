<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.26.
 * Time: 14:44
 */

use ColladAPI\Services\SzemelyService;
use ColladAPI\Services\TanszekService;

class SzemelyekTanszekekController extends BaseController {

    protected $tanszekService;

    public function __construct(SzemelyService $szemelyService, TanszekService $tanszekService)
    {
        parent::__construct();
        $this->service = $szemelyService;
        $this->tanszekService = $tanszekService;
    }

    public function listTanszekekForSzemely($id) {
        if ($this->pageParam())
            $this->setPagination(10);

        $this->enableLinks(true);

        $resource = $this->createResource($this->service->tanszekekForSzemely($id));
        $resource->addLink($this->createParentLink());
        return $this->sendResource($resource);
    }

} 