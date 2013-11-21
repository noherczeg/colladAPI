<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 9:16 PM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class ColladEntity extends Model {

    protected $rules = [];
    
    protected $fromDateFieldName = 'kezdo_datum';
    
    protected $toDateFieldName = 'vege_datum';

    protected $pagination = false;

    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $validator = Validator::make($this->attributes, $this->rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
    
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

    /**
     * Annak a fuggvenyeben allit elo resource-okat, hogy kerunk-e lapozast, vagy sem
     *
     * @param $query
     * @return mixed
     */
    public function scopeRestCollection($query)
    {
        return ($this->pagination == false) ? $query->get() : $query->paginate($this->pagination);
    }

    public function enablePagination($boolValue)
    {
        $this->pagination = $boolValue;
    }

}