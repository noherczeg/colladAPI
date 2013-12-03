<?php namespace ColladAPI\Core\Fokozat;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class FokozatServiceImpl extends CRUDServiceImpl implements FokozatService {

    public function __construct(FokozatRepository $fokozatRepository)
    {
        $this->repository = $fokozatRepository;
    }

    public function allForSzemely($id)
    {
        return $this->repository->allForSzemely($id);
    }

} 