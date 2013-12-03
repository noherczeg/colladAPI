<?php namespace ColladAPI\Core\Szerepkor;

use Noherczeg\RestExt\Controllers\RestExtController;

class SzerepkorokController extends RestExtController {

    public function __construct(SzerepkorService $szerepkorService)
    {
        parent::__construct();
        $this->service = $szerepkorService;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->setPagination(2);
        $this->enableLinks(true);

        $szerepkorok = $this->service->all();
        $resource = $this->createResource($szerepkorok, true);

        $resource->addLink($this->createParentLink());

        return $this->sendResource($resource);
    }

    public function show($id)
    {
        $this->enableLinks(true);
        $szerepkor = $this->service->findById($id);

        $resource = $this->createResource($szerepkor);
        $resource->addLink($this->createParentLink());

        return $this->sendResource($resource);
    }
} 