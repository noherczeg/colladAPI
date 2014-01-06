<?php namespace ColladAPI\Core\Alkotas;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;

class AlkotasokController extends RestExtController
{

    /**
     * @var AlkotasService
     */
    private $alkotasok;

    public function __construct (AlkotasService $alkotasService)
    {
        parent::__construct();
        $this->alkotasok = $alkotasService;
    }

    public function index()
    {
        $this->setPaginationFor($this->alkotasok);

        $filterFrom = $this->request->query('from');
        $filterTo = $this->request->query('to');

        if (!is_null($filterFrom) && !is_null($filterTo))
            $alkotasok = $this->alkotasok->allBetweenDates(new \DateTime($filterFrom), new \DateTime($filterTo));
        else
            $alkotasok = $this->alkotasok->all();

        $resource = $this->restExt->from($alkotasok)->links()->create();

        $resource->addLink($this->linker->createParentLink());

        return $this->restResponse->sendResource($resource);
    }

    public function store()
    {
        $this->consume([MediaType::APPLICATION_JSON]);
        $this->alkotasok->save($this->request->json()->all());

        return $this->restResponse->plainResponse(null, HttpStatus::CREATED);
    }

    public function show($id)
    {
        $alkotas = $this->alkotasok->findByIdWithAll($id);

        $resource = $this->restExt->from($alkotas)->links()->create(true);
        $resource->addLink($this->linker->createParentLink());
        $resource->addLinks($this->linker->linksToEntityRelations($alkotas));

        return $this->restResponse->sendResource($resource);
    }

    public function update($id)
    {
        $updated = $this->alkotasok->update($id, $this->request->json()->all());

        return $this->restResponse->plainResponse($updated);
    }

    public function destroy($id)
    {
        $this->alkotasok->delete($id);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }
}