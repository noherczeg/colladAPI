<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 11:09 PM
 */

namespace ColladAPI\Repositories;

use ColladAPI\Repositories\CRUDRepository;

interface AlkotasRepository extends CRUDRepository {

    /**
     * Visszaadja az osszes Alkotast a megadott datumok kozott
     *
     * @param \DateTime $from
     * @param \DateTime $to
     * @return mixed
     */
    public function allBetweenDates(\DateTime $from, \DateTime $to);

}