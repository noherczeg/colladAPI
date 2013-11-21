<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.10.23.
 * Time: 23:17
 */

namespace ColladAPI\Auth;

/**
 * Authorizaciohoz szukseges adatokat szolgaltato funkciok gyujtemenye
 *
 * Interface AuthorizationInterface
 * @package ColladAPI\Auth
 */
interface AuthorizationInterface {

    /**
     * Felhasznalo csoportjai/szerepkoreit adja vissza

     * @return array
     */
    public function roles();

    /**
     * Felhasznalo csoportjain belul/melletti jogosultsagokat adja vissza
     *
     * @return array
     */
    public function permisisons();

} 