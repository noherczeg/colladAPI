<?php namespace ColladAPI\Core\Publikacio;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class PublikacioTipus extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "publikacio_tipus";

    protected $rootRelName = 'publikaciotipusok';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function publikaciok() {
        return $this->hasMany('ColladAPI\\Core\\Publikacio\\Publikacio', 'tipus_id');
    }

}