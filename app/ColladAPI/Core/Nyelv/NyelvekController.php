<?php namespace ColladAPI\Core\Nyelv;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class NyelvekController extends RestExtController {

    private $nyelvek;

    public function __construct(NyelvRepository $nyelvRepository, AuthorizationService $auth)
    {
        parent::__construct();
        $this->nyelvek = $nyelvRepository;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->nyelvek->enablePagination(10);

        $this->allowForRoles('only', ['ADMIN']);

        $resource = $this->restExt->from($this->nyelvek->all())->links()->create('nyelvek');

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $nyelv = $this->nyelvek->findByIdWithAll($id);

        $resource = $this->restExt->from($nyelv)->links()->create();
        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->nyelvek->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->nyelvek->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->nyelvek->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 