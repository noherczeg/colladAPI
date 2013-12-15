<?php namespace ColladAPI\Core\Tanulmanyut;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Tanulmanyut extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "tanulmanyut";

    protected $rootRelName = 'tanulmanyutak';

    protected $fillable = ['tipus_id', 'orszag_id', 'kezdo_datum', 'vege_datum', 'intezmeny', 'leiras'];

    protected $rules = [
        'intezmeny' => 'alpha_num|between:2,256',
        'kezdo_datum' => 'required|date',
        'vege_datum' => 'date',
        'leiras' => 'max:512'
    ];

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Core\\Tanulmanyut\\TanulmanyutTipus');
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'tanulmanyut_has_szemely', 'tanulmanyut_id', 'szemely_id');
    }

    public function orszag() {
        return $this->belongsTo('ColladAPI\\Core\\Orszag\\Orszag');
    }

    public function scopeWithAll($query)
    {
        return $query->with('orszag', 'szemelyek', 'tipus');
    }

}