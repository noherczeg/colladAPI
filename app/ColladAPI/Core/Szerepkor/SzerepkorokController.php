<?php namespace ColladAPI\Core\Szerepkor;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class SzerepkorokController extends RestExtController {

    private $szerepkorok;

    public function __construct(SzerepkorService $service, AuthorizationService $auth)
    {
        parent::__construct();
        $this->szerepkorok = $service;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->szerepkorok->enablePagination(10);

        $resource = $this->restExt->from($this->szerepkorok->all())->links()->create(true);

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $szak = $this->szerepkorok->findByIdWithAll($id);

        $resource = $this->restExt->from($szak)->links()->create(true);
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($szak));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->szerepkorok->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->szerepkorok->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->szerepkorok->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 