<?php namespace ColladAPI\Core\Szervezet;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class SzervezetekController extends RestExtController {

    private $szervezetek;

    public function __construct(SzervezetService $service, AuthorizationService $auth)
    {
        parent::__construct();
        $this->szervezetek = $service;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->szervezetek->enablePagination(10);

        $resource = $this->restExt->from($this->szervezetek->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $szak = $this->szervezetek->findByIdWithAll($id);

        $resource = $this->restExt->from($szak)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($szak));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->szervezetek->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->szervezetek->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->szervezetek->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 