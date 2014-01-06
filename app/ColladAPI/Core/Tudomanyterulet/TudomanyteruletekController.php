<?php namespace ColladAPI\Core\TudomanyTerulet;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class TudomanyteruletekController extends RestExtController {

    private $tudomanyteruletek;

    public function __construct(TudomanyteruletRepository $repo, AuthorizationService $auth)
    {
        parent::__construct();
        $this->tudomanyteruletek = $repo;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->tudomanyteruletek->enablePagination(10);

        $resource = $this->restExt->from($this->tudomanyteruletek->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $szak = $this->tudomanyteruletek->findByIdWithAll($id);

        $resource = $this->restExt->from($szak)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($szak));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->tudomanyteruletek->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->tudomanyteruletek->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->tudomanyteruletek->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 