<?php namespace ColladAPI\Core\Szerepkor;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Szerepkor extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = 'szerepkor';

    protected $rootRelName = 'szerepkorok';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,255|unique:szerepkor'
    ];

    protected $hidden  = ['pivot'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'szemely_has_szerepkor', 'szerepkor_id', 'szemely_id');
    }
}