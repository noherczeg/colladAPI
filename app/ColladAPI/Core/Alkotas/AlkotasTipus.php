<?php namespace ColladAPI\Core\Alkotas;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class AlkotasTipus extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "alkotas_tipus";

    protected $rootRelName = 'alkotastipusok';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function alkotasok() {
        return $this->hasMany('ColladAPI\\Entities\\Alkotas', 'tipus_id');
    }
}