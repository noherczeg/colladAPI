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

class ColladEntity extends Model
{

    protected $rules = [];

    /**
     *
     * @throws ValidationException
     */
    public function validate()
    {
        $validator = Validator::make($this->attributes, $this->rules);
        
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}