<?php namespace ColladAPI\Core\Nyelv;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class NyelvtudasFok extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "nyelvtudas_fok";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function nyelvtudasok() {
        return $this->hasMany('ColladAPI\\Core\\Nyelv\\Nyelvtudas', 'nyelvtudas_fok_id');
    }
}