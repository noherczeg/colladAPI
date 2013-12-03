<?php namespace ColladAPI\Core\Rest;

use Noherczeg\RestExt\Entities\ResourceEntity;

interface ColladEntity extends ResourceEntity {

    public function scopeFromDate($query, \DateTime $date);

    public function scopeToDate($query, \DateTime $date);

    public function scopeBetweenDates($query, \DateTime $from, \DateTime $to);

} 