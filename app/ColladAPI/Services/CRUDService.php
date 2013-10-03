<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 10:34 PM
 */

namespace ColladAPI\Services;


interface CRUDService {

    public function findById($id);

    public function update($id, array $entityData);

    public function delete($id);

    public function all();

}