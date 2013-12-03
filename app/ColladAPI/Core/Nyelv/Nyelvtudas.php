<?php namespace ColladAPI\Core\Nyelv;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Nyelvtudas extends ResourceEloquentEntity implements ResourceEntity {

    protected $rules = [
        'bizonyitvany' => 'between:2,256',
        'datum' => 'date',
        'megjegyzes' => 'max:512'
    ];

    protected $table = "nyelvtudas";

    protected $fillable = ['szemely_id', 'nyelv_id', 'nyelvtudas_fok_id', 'bizonyitvany', 'datum', 'megjegyzes'];

    public function szemely() {
        return $this->belongsTo('ColladAPI\\Core\\Szemely\\Szemely', 'szemely_id');
    }

    public function nyelv() {
        return $this->belongsTo('ColladAPI\\Core\\Nyelv\\Nyelv', 'nyelv_id');
    }

    public function nyelvtudasFok() {
        return $this->belongsTo('ColladAPI\\Core\\Nyelv\\NyelvtudasFok', 'nyelvtudas_fok_id');
    }

}