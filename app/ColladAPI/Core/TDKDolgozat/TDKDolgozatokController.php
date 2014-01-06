<?php namespace ColladAPI\Core\TDKDolgozat;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class TDKDolgozatokController extends RestExtController {

    private $tdkDolgozatok;

    public function __construct(TDKDolgozatService $service, AuthorizationService $auth)
    {
        parent::__construct();
        $this->tdkDolgozatok = $service;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->tdkDolgozatok->enablePagination(10);

        $resource = $this->restExt->from($this->tdkDolgozatok->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $szak = $this->tdkDolgozatok->findByIdWithAll($id);

        $resource = $this->restExt->from($szak)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($szak));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->tdkDolgozatok->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->tdkDolgozatok->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->tdkDolgozatok->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 