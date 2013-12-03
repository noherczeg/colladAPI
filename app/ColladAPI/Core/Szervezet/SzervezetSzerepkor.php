<?php namespace ColladAPI\Core\Szervezet;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class SzervezetSzerepkor extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "szervezet_szerepkor";

    protected $rootRelName = 'szerepkorok';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function szervezetek() {
        return $this->hasMany('ColladAPI\\Core\\Szervezet\\Szervezet', 'szerepkor_id');
    }
}