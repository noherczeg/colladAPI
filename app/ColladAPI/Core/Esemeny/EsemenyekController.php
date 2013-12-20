<?php namespace ColladAPI\Core\Esemeny;

use Illuminate\Support\Facades\Input;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class EsemenyekController extends RestExtController {

    /**
     * @var EsemenyRepository
     */
    private $esemenyek;

    public function __construct(EsemenyRepository $repo, AuthorizationService $auth)
    {
        parent::__construct();
        $this->esemenyek = $repo;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        $this->setPaginationFor($this->esemenyek);

        $resource = $this->restExt->from($this->esemenyek->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $esemeny = $this->esemenyek->findByIdWithAll($id);

        $resource = $this->restExt->from($esemeny)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($esemeny));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->esemenyek->save(Input::json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->esemenyek->update($id, Input::json()->all());
    }

    public function destroy($id)
    {
        $this->esemenyek->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 