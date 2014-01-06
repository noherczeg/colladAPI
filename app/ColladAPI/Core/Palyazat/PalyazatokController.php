<?php namespace ColladAPI\Core\Palyazat;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class PalyazatokController extends RestExtController {

    private $palyazatok;

    public function __construct(PalyazatService $service, AuthorizationService $auth)
    {
        parent::__construct();
        $this->palyazatok = $service;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->palyazatok->enablePagination(10);

        $resource = $this->restExt->from($this->palyazatok->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $publikacio = $this->palyazatok->findByIdWithAll($id);

        $resource = $this->restExt->from($publikacio)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($publikacio));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->palyazatok->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->palyazatok->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->palyazatok->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

}