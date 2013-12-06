<?php namespace ColladAPI\Core\Beruhazas;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class BeruhazasTipus extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "beruhazas_tipus";

    protected $rootRelName = 'beruhazastipusok';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function beruhazasok() {
        return $this->hasMany('ColladAPI\\Core\\Beruhazas\\Beruhazas', 'tipus_id');
    }

}