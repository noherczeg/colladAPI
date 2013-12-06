<?php namespace ColladAPI\Core\Kepzes;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class KepzesSzint extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "kepzesszint";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function szakok() {
        return $this->hasMany('ColladAPI\\Core\\Szak\\Szak', 'kepzesszint_id');
    }

    public function scopeWithAll($query)
    {
        return $query->with('szakok');
    }

}