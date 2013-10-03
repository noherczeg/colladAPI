<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:39 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Services\CRUDService;
use ColladAPI\Repositories\CRUDRepository;

class CRUDServiceImpl implements CRUDService {

    protected $crudRepository;

    public function __construct(CRUDRepository $crudRepository)
    {
        $this->crudRepository = $crudRepository;
    }

    public function findById($id)
    {
        return $this->crudRepository->findById($id);
    }

    public function update($id, array $entityData)
    {
        $entity = $this->crudRepository->findById($id);
        $entity->fill($entityData);
        $entity->validate();

        if (!$entity->save()) {
            throw new ErrorMessageException('Hiba az adatok frissítése során');
            return false;
        }

        return $entity;
    }

    public function delete($id)
    {
        return $this->crudRepository->delete($id);
    }

    public function all()
    {
        return $this->crudRepository->all();
    }
}