<?php namespace ColladAPI\Core\TDKDolgozat;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class TDKDolgozatSzekcio extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "tdkdolgozat_szekcio";

    protected $rootRelName = 'tdkdolgozatszekciok';

    protected $fillable = ['nev', 'megjegyzes'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256',
        'megjegyzes' => 'max:512'
    ];

    public function kariTDKDolgozatok() {
        return $this->hasMany('ColladAPI\\Entities\\TDKDolgozat', 'kari_tdk_szekcio_id');
    }

    public function oTDKDolgozatok() {
        return $this->hasMany('ColladAPI\\Entities\\TDKDolgozat', 'otdk_szekcio_id');
    }

    public function scopeWithAll($query)
    {
        return $query->with('kariTDKDolgozatok', 'oTDKDolgozatok');
    }

}