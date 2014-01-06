<?php namespace ColladAPI\Core\Orszag;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class OrszagokController extends RestExtController{

    private $orszagok;

    public function __construct(OrszagRepository $repo, AuthorizationService $auth)
    {
        parent::__construct();
        $this->orszagok = $repo;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->orszagok->enablePagination(10);

        $resource = $this->restExt->from($this->orszagok->all())->links()->create(true);

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $orszag = $this->orszagok->findByIdWithAll($id);

        $resource = $this->restExt->from($orszag)->links()->create(true);
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($orszag));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->orszagok->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->orszagok->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->orszagok->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }
} 