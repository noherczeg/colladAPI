<?php namespace ColladAPI\Core\Nyelv;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;

class NyelvtudasokController extends RestExtController {

    private $nyelvtudasok;

    public function __construct(NyelvtudasRepository $repo)
    {
        parent::__construct();
        $this->nyelvtudasok = $repo;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->nyelvtudasok->enablePagination(10);

        $resource = $this->restExt->from($this->nyelvtudasok->all())->links()->create(true);

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $intezmeny = $this->nyelvtudasok->findByIdWithAll($id);

        $resource = $this->restExt->from($intezmeny)->links()->create(true);
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($intezmeny));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->nyelvtudasok->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->nyelvtudasok->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->nyelvtudasok->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 