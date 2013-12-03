<?php namespace ColladAPI\Core\Beruhazas;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Beruhazas extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "beruhazas";

    protected $rootRelName = 'beruhazasok';

    protected $fillable = ['bevetel_id', 'tipus_id', 'osszeg', 'datum', 'leiras'];

    protected $rules = [
        'osszeg' => 'required|numeric',
        'datum' => 'required|date',
        'leiras' => 'alpha_num|max:512'
    ];

    public function bevetel() {
        return $this->belongsTo('ColladAPI\\Core\\Bevetel\\Bevetel');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Core\\Beruhazas\\BeruhazasTipus');
    }

}