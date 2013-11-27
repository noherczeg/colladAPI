<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.27.
 * Time: 16:58
 */

namespace ColladAPI\Services;


use ColladAPI\Repositories\FokozatRepository;

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