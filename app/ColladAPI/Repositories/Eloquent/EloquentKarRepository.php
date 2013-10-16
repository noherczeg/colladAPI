<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 6:17 PM
 */
namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\Kar;
use ColladAPI\Repositories\KarRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentKarRepository implements KarRepository
{

    private $kar;

    public function __construct(Kar $kar)
    {
        $this->kar = $kar;
    }

    public function all()
    {
        return $this->kar->with('szemelyek')->get();
    }

    public function findById($entityId)
    {
        return $this->kar->findOrFail($entityId);
    }

    public function delete($entityId)
    {
        return $this->kar->destroy($entityId);
    }

    public function saveOrUpdate(Kar $entity)
    {
        return $entity->save();
    }

    public function szemelyekByIdAndDate($karId,\DateTime $idopont)
    {
        $karok = $this->kar->with([
            'szemelyek' => function ($query) use($idopont)
            {
                $query->where('kezdo_datum', '<=', $idopont->format('Y-m-d'))
                    ->where('vege_datum', '>=', $idopont->format('Y-m-d'));
            },
            'szemelyek.szervezetek',
            'szemelyek.nyelvtudasok',
            'szemelyek.nyelvtudasok.nyelv',
            'szemelyek.nyelvtudasok.nyelvtudasfok',
            'szemelyek.dijak',
            'szemelyek.dijak.orszag',
            'szemelyek.fokozatok',
            'szemelyek.fokozatok.tipus',
            'szemelyek.fokozatok.tudomanyterulet'
        ])
            ->where('id', '=', $karId)
            ->firstOrFail();
        
        $szemelyek = $karok->szemelyek;
        if ($szemelyek->isEmpty())
            throw new ModelNotFoundException();
        
        return $karok->szemelyek;
    }

    public function intezetekAndTanszekekByIdAndDate($karId,\DateTime $idopont)
    {
        $karok = $this->kar->with([
            'intezetek' => function ($query) use($idopont)
            {
                $query->where('kezdo_datum', '<=', $idopont->format('Y-m-d'))
                    ->where('vege_datum', '>=', $idopont->format('Y-m-d'));
            },
            'tanszekek' => function ($query) use($idopont)
            {
                $query->where('kezdo_datum', '<=', $idopont->format('Y-m-d'))
                    ->where('vege_datum', '>=', $idopont->format('Y-m-d'));
            }
        ])
            ->firstOrFail();
        
        $szemelyek = $karok->szemelyek;
        if ($szemelyek->isEmpty())
            throw new ModelNotFoundException();
        
        return $karok->szemelyek;
    }
}