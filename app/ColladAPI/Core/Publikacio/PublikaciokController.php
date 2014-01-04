<?php namespace ColladAPI\Core\Publikacio;

use ColladAPI\Core\Nyelv\NyelvRepository;
use Illuminate\Support\Facades\Input;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Noherczeg\RestExt\Services\AuthorizationService;

class PublikaciokController extends RestExtController {

    private $publikaciok;

    private $nyelvek;

    public function __construct(PublikacioRepository $repo, NyelvRepository $nyelvRepository, AuthorizationService $auth)
    {
        parent::__construct();
        $this->publikaciok = $repo;
        $this->nyelvek = $nyelvRepository;
        $this->authorizationService = $auth;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->publikaciok->enablePagination(10);

        $all = $this->publikaciok->all();

        // ha CSV-t kernek, akkor azt adunk
        if ($this->requestAccepts() == MediaType::TEXT_CSV) {
            return $this->restResponse->sendFile($this->restExt->collectionToCSVString($all), 'csvtest.csv');
        }

        $resource = $this->restExt->from($this->publikaciok->all())->links()->create(true);

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $publikacio = $this->publikaciok->findByIdWithAll($id);

        $resource = $this->restExt->from($publikacio)->links()->create(true);
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($publikacio));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->publikaciok->save(Input::json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->publikaciok->update($id, Input::json()->all());
    }

    public function destroy($id)
    {
        $this->publikaciok->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

    public function showNyelv($pubId, $nyelvId)
    {
        $nyelv = $this->publikaciok->findNyelvForPublikacio($pubId, $nyelvId);

        $resource = $this->restExt->from($nyelv)->links()->create(true);
        $resource->addLink($this->linker->createLinkUp('parent', 2));

        return $this->restResponse->sendResource($resource);
    }

    public function addNyelv($pubId)
    {
        // nem letezo nyelvet nem lehet hozzaadni, ezert a postolt adatokbol nekunk csak az id kell
        $nyelv = $this->nyelvek->findById(Input::get('id'));
        $this->publikaciok->addNyelvForPublikacio($pubId, $nyelv);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 