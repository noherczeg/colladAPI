<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/27/13
 * Time: 1:20 AM
 */

namespace ColladAPI\Services;


interface SzemelyService extends CRUDService {

    public function register(array $userData);

}