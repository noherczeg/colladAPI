<?php namespace ColladAPI\Core\Szemely;

use ColladAPI\Core\Tanszek\TanszekService;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestExt;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Facades\RestResponse;

class SzemelyekTanszekekController extends RestExtController {

    protected $tanszekService;

    public function __construct(SzemelyService $szemelyService, TanszekService $tanszekService)
    {
        parent::__construct();
        $this->service = $szemelyService;
        $this->tanszekService = $tanszekService;
    }

    public function listTanszekekForSzemely($id) {
        $resource = RestExt::from($this->service->tanszekekForSzemely($id))->links()->create('tanszekek');

        $resource->addLink(RestLinker::createParentLink());

        return RestResponse::sendResource($resource);
    }

} 