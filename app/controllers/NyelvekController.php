<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.26.
 * Time: 17:28
 */

use ColladAPI\Services\NyelvService;

class NyelvekController extends BaseController {

    public function __construct(NyelvService $nyelvService)
    {
        parent::__construct();
        $this->service = $nyelvService;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->setPagination(2);
        $this->enableLinks(true);

        $nyelvek = $this->service->all();
        $resource = $this->createResource($nyelvek, true);

        $resource->addLink($this->createParentLink());

        return $this->sendResource($resource);
    }

    public function show($id)
    {
        $this->enableLinks(true);
        //$this->allowForRoles('only', ['Admin']);
        $nyelv = $this->service->findById($id);

        $resource = $this->createResource($nyelv);
        $resource->addLink($this->createParentLink());

        return $this->sendResource($resource);
    }
} 