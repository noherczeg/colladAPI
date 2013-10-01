<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 10:23 PM
 */

namespace ColladAPI\Entities;


use ColladAPI\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\Model;

class PalyazatTipus extends Model {

    protected $table = "palyazat_tipus";

    public function palyazatok() {
        return $this->hasMany('ColladAPI\\Entities\\Palyazat', 'tipus_id');
    }

    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'cime' => 'required|alpha_num|between:2,256'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}