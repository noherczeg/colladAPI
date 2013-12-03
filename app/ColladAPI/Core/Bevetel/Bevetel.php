<?php namespace ColladAPI\Core\Bevetel;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Bevetel extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "bevetel";

    protected $rootRelName = 'bevetelek';

    protected $fillable = ['osszeg', 'datum', 'tipus_id', 'leiras', 'palyazat_id', 'tanszek_id', 'intezet_id'];

    protected $rules = [
        'osszeg' => 'required|numeric',
        'datum' => 'required|date',
        'leiras' => 'required|max:512'
    ];

    public function beruhazasok() {
        return $this->hasMany('ColladAPI\\Core\\Beruhazas\\Beruhazas', 'bevetel_id');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Core\\Bevetel\\BevetelTipus');
    }

    public function palyazat() {
        return $this->belongsTo('ColladAPI\\Core\\Palyazat\\Palyazat');
    }

    public function tanszek() {
        return $this->belongsTo('ColladAPI\\Core\\Tanszek\\Tanszek');
    }

    public function intezet() {
        return $this->belongsTo('ColladAPI\\Core\\Intezet\\Intezet');
    }

}