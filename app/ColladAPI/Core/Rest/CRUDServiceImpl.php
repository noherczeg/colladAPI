<?php namespace ColladAPI\Core\Rest;

use Noherczeg\RestExt\Repository\CRUDRepository;

class CRUDServiceImpl implements CRUDService {

    protected $repository;

    protected $pagination = false;

    public function __construct(CRUDRepository $crudRepository)
    {
        $this->repository = $crudRepository;
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function update($id, array $entityData)
    {
        return $this->repository->update($id, $entityData);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function save(array $entityData)
    {
        return $this->repository->save($entityData);
    }

    public function enablePagination($boolValue)
    {
        $this->pagination = $boolValue;
        $this->repository->enablePagination($boolValue);
    }

    public function restCollection()
    {
        return $this->repository->restCollection();
    }
}