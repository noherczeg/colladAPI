<?php namespace ColladAPI\Core\Dij;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Dij extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "dij";

    protected $rootRelName = 'dijak';

    protected $fillable = ['szemely_id', 'orszag_id', 'megnevezes', 'datum', 'adomanyozo', 'leiras'];

    protected $rules = [
        'megnevezes' => 'required|alpha_num|between:2,256',
        'datum' => 'required|date',
        'leiras' => 'max:512',
        'adomanyozo' => 'alpha_num|max:256'
    ];

    public function szemely() {
        return $this->belongsTo('ColladAPI\\Core\\Szemely\\Szemely');
    }

    public function orszag() {
        return $this->belongsTo('ColladAPI\\Core\\Orszag\\Orszag');
    }

    public function scopeWithAll($query)
    {
        return $query->with('orszag', 'szemely');
    }

}