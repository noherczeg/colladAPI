<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/27/13
 * Time: 12:24 AM
 */

namespace ColladAPI\Repositories;

interface CRUDRepository {

    public function all();

    public function save(array $entity);

    public function update(array $entity);

    public function findById($entityId);

    public function delete($entityId);

    public function enablePagination($boolValue);

}