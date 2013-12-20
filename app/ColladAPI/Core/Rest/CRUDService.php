<?php namespace ColladAPI\Core\Rest;

use Noherczeg\RestExt\Services\Pageable;

interface CRUDService extends Pageable {

    public function findById($id);

    public function update($id, array $entityData);

    public function save(array $entityData);

    public function delete($id);

    public function all();

}