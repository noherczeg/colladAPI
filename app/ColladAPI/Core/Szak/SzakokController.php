<?php namespace ColladAPI\Core\Szak;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class SzakokController extends RestExtController {

    private $szakok;

    public function __construct(SzakRepository $repo, AuthorizationService $auth)
    {
        parent::__construct();
        $this->szakok = $repo;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->szakok->enablePagination(10);

        $resource = $this->restExt->from($this->szakok->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $szak = $this->szakok->findByIdWithAll($id);

        $resource = $this->restExt->from($szak)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($szak));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $szak = $this->szakok->save($this->request->json()->all());

        return $this->restResponse->plainResponse($szak->toArray(), HttpStatus::CREATED);
    }

    public function update($id)
    {
        $szak = $this->szakok->update($id, $this->request->json()->all());

        return $this->restResponse->plainResponse($szak->toArray(), HttpStatus::OK);
    }

    public function destroy($id)
    {
        $this->szakok->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 