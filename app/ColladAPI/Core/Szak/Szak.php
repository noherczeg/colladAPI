<?php namespace ColladAPI\Core\Szak;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Szak extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = 'szak';

    protected $rootRelName = 'szakok';

    protected $fillable = ['nev', 'kepzesszint_id'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    protected $hidden  = ['pivot'];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'szemely_has_szak', 'szak_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function kepzesSzint() {
        return $this->belongsTo('ColladAPI\\Core\\Kepzes\\KepzesSzint');
    }
}