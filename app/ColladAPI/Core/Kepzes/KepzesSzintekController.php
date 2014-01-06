<?php namespace ColladAPI\Core\Kepzes;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;

class KepzesSzintekController extends RestExtController {

    private $kepzesSzintek;

    public function __construct(KepzesSzintRepository $repo)
    {
        parent::__construct();
        $this->kepzesSzintek = $repo;
    }

    public function index()
    {
        if ($this->pageParam())
            $this->kepzesSzintek->enablePagination(10);

        $resource = $this->restExt->from($this->kepzesSzintek->all())->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function show($id)
    {
        $intezmeny = $this->kepzesSzintek->findByIdWithAll($id);

        $resource = $this->restExt->from($intezmeny)->links()->create();
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($intezmeny));

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->kepzesSzintek->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function update($id)
    {
        return $this->kepzesSzintek->update($id, $this->request->json()->all());
    }

    public function destroy($id)
    {
        $this->kepzesSzintek->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

} 