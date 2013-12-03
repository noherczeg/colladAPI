<?php namespace ColladAPI\Core\Esemeny;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class EsemenyTipus extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "esemeny_tipus";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function alkotasok() {
        return $this->hasMany('ColladAPI\\Core\\Alkotas\\Alkotas', 'tipus_id');
    }

}