<?php namespace ColladAPI\Core\Alkotas;

use Noherczeg\RestExt\Repository\CRUDRepository;

interface AlkotasRepository extends CRUDRepository {

    /**
     * Visszaadja az osszes Alkotast a megadott datumok kozott
     *
     * @param \DateTime $from
     * @param \DateTime $to
     * @return mixed
     */
    public function allBetweenDates(\DateTime $from, \DateTime $to);

    public function findByIdWithAll($id);

}