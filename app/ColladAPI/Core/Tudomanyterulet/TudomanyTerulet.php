<?php namespace ColladAPI\Core\TudomanyTerulet;

use ColladAPI\Entities\ColladEntity;
use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class TudomanyTerulet extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "tudomanyterulet";

    protected $rootRelName = 'tudomanyteruletek';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function fokozatok() {
        return $this->hasMany('ColladAPI\\Entities\\Fokozat', 'tudomanyterulet_id');
    }

    public function palyazatok() {
        return $this->belongsTo('ColladAPI\\Entities\\Palyazat', 'palyazat_has_tudomanyterulet', 'tudomanyterulet_id', 'palyazat_id');
    }

    public function scopeWithAll($query)
    {
        return $query->with('palyazatok', 'fokozatok');
    }

}