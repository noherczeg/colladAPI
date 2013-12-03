<?php namespace ColladAPI\Core\Rest;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;

class ColladEloquentEntity extends ResourceEloquentEntity implements ColladEntity {
    
    protected $fromDateFieldName = 'kezdo_datum';
    
    protected $toDateFieldName = 'vege_datum';
    
    public function scopeFromDate($query, \DateTime $date)
    {
        return $query->where($this->fromDateFieldName, '<=', $date->format('Y-m-d'));
    }
    
    public function scopeToDate($query, \DateTime $date)
    {
        return $query->where($this->toDateFieldName, '>=', $date->format('Y-m-d'));
    }
    
    public function scopeBetweenDates($query, \DateTime $from, \DateTime $to)
    {
        return $query->where($this->fromDateFieldName, '<=', $from->format('Y-m-d'))->where($this->toDateFieldName, '>=', $to->format('Y-m-d'));
    }

}