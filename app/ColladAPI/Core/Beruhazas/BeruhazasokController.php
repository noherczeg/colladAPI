<?php namespace ColladAPI\Core\Beruhazas;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class BeruhazasokController extends RestExtController {

    /**
     * @var BeruhazasRepository
     */
    private $beruhazasok;

    public function __construct(BeruhazasRepository $repo, AuthorizationService $auth)
    {
        parent::__construct();
        $this->beruhazasok = $repo;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        $this->setPaginationFor($this->beruhazasok, 10);

        $resource = $this->restExt->from($this->beruhazasok->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $beruhazas = $this->beruhazasok->findByIdWithAll($id);

        $resource = $this->restExt->from($beruhazas)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($beruhazas));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->beruhazasok->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->beruhazasok->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->beruhazasok->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 