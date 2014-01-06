<?php namespace ColladAPI\Core\Bevetel;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class BevetelekController extends RestExtController {

    /**
     * @var BevetelRepository
     */
    private $bevetelek;

    public function __construct(BevetelRepository $repo, AuthorizationService $auth)
    {
        parent::__construct();
        $this->bevetelek = $repo;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        $this->setPaginationFor($this->bevetelek);

        $resource = $this->restExt->from($this->bevetelek->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $beruhazas = $this->bevetelek->findByIdWithAll($id);

        $resource = $this->restExt->from($beruhazas)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($beruhazas));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->bevetelek->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->bevetelek->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->bevetelek->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 