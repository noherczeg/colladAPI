<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.27.
 * Time: 1:17
 */

namespace ColladAPI\Entities;


class Szerepkor extends ColladEntity {

    protected $table = 'szerepkor';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,255|unique:szerepkor'
    ];

    protected $hidden  = ['pivot'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_has_szerepkor', 'szerepkor_id', 'szemely_id');
    }
}