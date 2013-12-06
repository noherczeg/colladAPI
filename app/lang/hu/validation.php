<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "A(z) :attribute elfogadása kötelező.",
	"active_url"       => "A(z) :attribute nem érvényes URL.",
	"after"            => "A(z) :attribute egy :date utáni dátum kell legyen.",
	"alpha"            => "A(z) :attribute betűkből állhat csak.",
	"alpha_dash"       => "A(z) :attribute betűkből, számokból és kötőjelekből állhat csak.",
	"alpha_num"        => "A(z) :attribute betűkből és számokból állhat csak.",
	"array"            => "A(z) :attribute tömb kell hogy legyen.",
	"before"           => "A(z) :attribute egy :date előtti dátum kell legyen.",
	"between"          => array(
		"numeric" => "A(z) :attribute értéke :min - :max kell legyen.",
		"file"    => "A(z) :attribute értéke :min - :max kilobyte kell legyen.",
		"string"  => "A(z) :attribute értéke :min - :max karakter kell legyen.",
		"array"   => "A(z) :attribute -nek tartalmaznia kell :min - :max elemet.",
	),
	"confirmed"        => "A(z) :attribute megerősítése sikertelen.",
	"date"             => "A(z) :attribute nem érvényes dátum.",
	"date_format"      => "A(z) :attribute nem felel meg a(z) :format formátumnak.",
	"different"        => "A(z) :attribute és a(z) :other különbözőek kell hogy legyenek.",
	"digits"           => "A(z) :attribute :digits jegyű kell legyen.",
	"digits_between"   => "A(z) :attribute :min és :max jegy között kell legyen.",
	"email"            => "A(z) :attribute formátuma érvénytelen.",
	"exists"           => "A(z) választott :attribute már létezik.",
	"image"            => "A(z) :attribute kép kell legyen.",
	"in"               => "A választott :attribute érvénytelen.",
	"integer"          => "A(z) :attribute szám kell legyen",
	"ip"               => "A(z) :attribute valós IP cím kell legyen.",
	"max"              => array(
		"numeric" => "A(z) :attribute nem lehet nagyobb, mint :max.",
		"file"    => "A(z) :attribute nem lehet nagyobb, mint :max kilobyte.",
		"string"  => "A(z) :attribute nem lehet hosszabb, mint :max karakter.",
		"array"   => "A(z) :attribute nem tartalmazhat :max -nál több elemet.",
	),
	"mimes"            => "A(z) :attribute :values tipusu kell legyen.",
	"min"              => array(
		"numeric" => "A(z) :attribute legalább :min kell legyen.",
		"file"    => "A(z) :attribute legalább :min kilobyte kell legyen.",
		"string"  => "A(z) :attribute legalább :min karakter hosszú kell legyen.",
		"array"   => "A(z) :attribute -nak legalább :min eleme kell legyen.",
	),
	"not_in"           => "A(z) választott :attribute nem megfelelő.",
	"numeric"          => "A(z) :attribute szám kell legyen.",
	"regex"            => "A(z) :attribute formátuma nem megfelelő.",
	"required"         => "A(z) :attribute mező kitöltése kötelező.",
	"required_if"      => "A(z) :attribute mező kitöltése kötelező, ha a(z) :other értéke: :value.",
	"required_with"    => "A(z) :attribute mező kitöltése kötelező, ha a(z) :values jelen van.",
	"required_without" => "A(z) :attribute mező kitöltése kötelező, ha a(z) :values értéke nincs beállítva.",
	"same"             => "A(z) :attribute és a(z) :other meg kell egyezzenek.",
	"size"             => array(
		"numeric" => "A(z) :attribute mérete :size kell legyen.",
		"file"    => "A(z) :attribute mérete :size kilobyte kell legyen.",
		"string"  => "A(z) :attribute mérete :size karakter kell legyen.",
		"array"   => "A(z) :attribute -nak tartalmaznia kell :size elemet.",
	),
	"unique"           => "A(z) :attribute már foglalt.",
	"url"              => "A(z) :attribute formátuma nem megfelelő.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
        "cim"   => "cím",
        "datum"   => "dátum",
        "lektoralt"   => "lektorált",
    ),

);
