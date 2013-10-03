<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/4/13
 * Time: 12:05 AM
 */

namespace ColladAPI\Services;


interface TanulmanyutService extends CRUDService {

    public function save(array $tanulmanyutData);

}