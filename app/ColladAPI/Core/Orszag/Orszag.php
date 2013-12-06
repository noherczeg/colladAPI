<?php namespace ColladAPI\Core\Orszag;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Orszag extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "orszag";

    protected $rootRelName = 'orszagok';

    protected $fillable = ['nev', 'kod'];

    protected $rules = [
        'nev' => 'required|alpha|between:2,64',
        'kod' => 'required|size:2|alpha'
    ];

    public function intezmenyek() {
        return $this->hasMany('ColladAPI\\Core\\Intezmeny\\Intezmeny', 'orszag_id');
    }

    /**
     * Scope metodus az entitas osszes relaciojanak "felcsatolasara"
     *
     * @param $query
     * @return Builder
     */
    public function scopeWithAll($query)
    {
        return $query->with('intezmenyek');
    }

}