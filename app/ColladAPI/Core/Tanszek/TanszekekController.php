<?php namespace ColladAPI\Core\Tanszek;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class TanszekekController extends RestExtController {

    private $tanszekek;

    public function __construct(TanszekService $service, AuthorizationService $auth)
    {
        parent::__construct();
        $this->tanszekek = $service;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->tanszekek->enablePagination(10);

        $resource = $this->restExt->from($this->tanszekek->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $szak = $this->tanszekek->findByIdWithAll($id);

        $resource = $this->restExt->from($szak)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($szak));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->tanszekek->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->tanszekek->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->tanszekek->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

}