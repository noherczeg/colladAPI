<?php namespace ColladAPI\Core\Rest;

interface CRUDService {

    public function findById($id);

    public function update(array $entityData);

    public function save(array $entityData);

    public function delete($id);

    public function all();

    public function enablePagination($boolValue);

}