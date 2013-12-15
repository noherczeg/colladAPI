<?php namespace ColladAPI\Core\TDKDolgozat;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class TDKDolgozatTagozat extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "tdkdolgozat_tagozat";

    protected $rootRelName = 'tdkdolgozattagozatok';

    protected $fillable = ['nev', 'megjegyzes'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256',
        'megjegyzes' => 'max:512'
    ];

    public function oTDKDolgozatok() {
        return $this->hasMany('ColladAPI\\Entities\\TDKDolgozat', 'otdk_tagozat_id');
    }

    public function scopeWithAll($query)
    {
        return $query->with('oTDKDolgozatok');
    }

}