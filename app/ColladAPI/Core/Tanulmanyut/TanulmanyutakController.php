<?php namespace ColladAPI\Core\Tanulmanyut;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class TanulmanyutakController extends RestExtController
{

    private $tanulmanyutak;

    public function __construct(TanulmanyutService $service, AuthorizationService $auth)
    {
        parent::__construct();
        $this->tanulmanyutak = $service;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->tanulmanyutak->enablePagination(10);

        $resource = $this->restExt->from($this->tanulmanyutak->all())->links()->create(true);

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $szak = $this->tanulmanyutak->findByIdWithAll($id);

        $resource = $this->restExt->from($szak)->links()->create(true);
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($szak));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->tanulmanyutak->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->tanulmanyutak->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->tanulmanyutak->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

}