<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/25/13
 * Time: 9:10 PM
 */

namespace ColladAPI\Entities;

use ColladAPI\Auth\AuthorizationInterface;
use ColladAPI\Entities\ColladEntity;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\UserInterface;
use Illuminate\Support\Facades\Hash;
use Zizaco\Entrust\HasRole;

class Szemely extends ColladEntity implements UserInterface, RemindableInterface {

    /** Entrust Hozzaferesekhez */
    use HasRole;

    protected $table = "szemely";

    /** mass assignelheto ertekek */
    protected $fillable = array('titulus', 'csaladnev', 'keresztnev', 'eha_kod', 'om_id', 'email', 'jelszo');

    /** kifele lathatatlan mezok (van whitelist megfelelo is!) */
    protected $hidden = ['jelszo'];

    /** "al" torles be/ki kapcsolasa */
    protected $softDelete = false;

    protected $rules = [
        'titulus' => 'alpha|between:2,50',
        'csaladnev' => 'required|alpha|between:2,100',
        'keresztnev' => 'required|alpha|between:2,100',
        'email' => 'required|email|unique:szemely',
        'jelszo' => 'required|between:6,32',
        'megjegyzes' => 'max:512',
        'eha_kod' => 'unique:szemely|alpha',
        'api_kulcs' => 'unique:szemely'
    ];

    /**
     * Szemely egyedi azonositoja
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Szemely jelszava
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->jelszo;
    }

    public function getTeljesNev()
    {
        return $this->getTitulus() . ' ' . $this->getCsaladnev() . ' ' . $this->getKeresztnev();
    }

    /**
     * Automata jelszo hasheles.
     *
     * @param string $jelszo
     * @return void
     */
    public function setJelszoAttribute($jelszo) {
        $this->attributes['jelszo'] = Hash::make($jelszo);
    }

    /**
     * EHA kodok mindig full upper caseltek
     * @param $ehaKod
     */
    public function setEhaKodAttribute($ehaKod) {
        $this->attributes['eha_kod'] = strtoupper($ehaKod);
    }

    /**
     * Letrehoz egy random, unique API kulcsot.
     *
     * @return string
     */
    public static function createApiKey()
    {
        return Str::random(32);
    }

    public function szakok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szak', 'szemely_has_szak', 'szemely_id', 'szak_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function alkotasok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Alkotas', 'alkotas_has_szemely', 'szemely_id', 'alkotas_id');
    }

    public function esemenyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Esemeny', 'esemeny_has_szemely', 'szemely_id', 'esemeny_id');
    }

    public function szerepkorok() {
        return $this->belongsTo('ColladAPI\\Entities\\Szerepkor', 'esemeny_has_szemely', 'szerepkor_id')->withPivot('megjegyzes');
    }

    public function nyelvtudasok()
    {
        return $this->hasMany('ColladAPI\\Entities\\Nyelvtudas', 'szemely_id');
    }

    public function dijak()
    {
        return $this->hasMany('ColladAPI\\Entities\\Dij', 'szemely_id');
    }

    public function fokozatok()
    {
        return $this->hasMany('ColladAPI\\Entities\\Fokozat', 'szemely_id');
    }

    public function intezmenyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Intezmeny', 'szemely_has_intezmeny', 'szemely_id', 'intezmeny_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function szervezetek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szervezet', 'szemely_has_szervezet', 'szemely_id', 'szervezet_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function tanszekek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Tanszek', 'szemely_has_tanszek', 'szemely_id', 'tanszek_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function superviseFokozat()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Fokozat', 'szemely_supervise_fokozat', 'szemely_id', 'fokozat_id')->withPivot('sorrend', 'kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function superviseTDKDolgozat()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\TDKDolgozat', 'szemely_supervise_tdkdolgozat', 'szemely_id', 'tdkdolgozat_id')->withPivot('megjegyzes');
    }

    public function publikaciok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Publikacio', 'publikacio_has_szemely', 'szemely_id', 'publikacio_id');
    }

    public function biralTDKDolgozat()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\TDKDolgozat', 'szemely_biral_tdkdolgozat', 'szemely_id', 'tdkdolgozat_id')->withPivot('megjegyzes');
    }

    public function tanulmanyutak()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Tanulmanyut', 'tanulmanyut_has_szemely', 'szemely_id', 'tanulmanyut_id');
    }

    public function palyazatok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Palyazat', 'palyazat_has_szemely', 'szemely_id', 'palyazat_id');
    }

    public function palyazatSzerepkorok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\PalyazatSzerepkor', 'palyazat_has_szemely', 'szemely_id', 'szerepkor_id');
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->getAttribute('email');
    }

    /**
     * Felhasznalo csoportjai/szerepkoreit adja vissza
     * @return array
     */
    public function roles()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Role', 'szemely_has_szerepkor', 'szemely_id', 'szerepkor_id');
    }
}