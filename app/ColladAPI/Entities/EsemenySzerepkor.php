<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:23 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class EsemenySzerepkor extends ColladEntity
{

    protected $table = "esemeny_szerepkor";

    protected $fillable = [
        'nev'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function szemelyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'esemeny_has_szemely', 'esemeny_szerepkor_id', 'szemely_id');
    }

    public function esemenyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Esemeny', 'esemeny_has_szemely', 'esemeny_szerepkor_id', 'esemeny_id');
    }
}