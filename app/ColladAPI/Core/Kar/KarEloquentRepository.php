<?php namespace ColladAPI\Core\Kar;

use Noherczeg\RestExt\Repository\RestExtRepository;

class KarEloquentRepository extends RestExtRepository implements KarRepository {

    public function __construct(Kar $kar)
    {
        $this->entity = $kar;
    }

    public function szemelyekByIdAndDate($karId, \DateTime $idopont)
    {
        $karok =  $this->entity->with([
            'szemelyek' => function($query) use ($idopont) {
                $query->where('kezdo_datum', '<=', $idopont->format('Y-m-d'))->where('vege_datum', '>=', $idopont->format('Y-m-d'));
            },
            'szemelyek.szervezetek', 'szemelyek.nyelvtudasok', 'szemelyek.nyelvtudasok.nyelv', 'szemelyek.nyelvtudasok.nyelvtudasfok',
            'szemelyek.dijak', 'szemelyek.dijak.orszag', 'szemelyek.fokozatok', 'szemelyek.fokozatok.tipus',
            'szemelyek.fokozatok.tudomanyterulet'
        ])->where('id', '=', $karId)->firstOrFail();

        $szemelyek = $karok->szemelyek;
        if($szemelyek->isEmpty())
            throw new ModelNotFoundException;

        return $karok->szemelyek;
    }

    public function intezetekAndTanszekekByIdAndDate($karId, \DateTime $idopont)
    {
        $karok =  $this->entity->with(['intezetek' => function($query) use ($idopont) {
            $query->where('kezdo_datum', '<=', $idopont->format('Y-m-d'))->where('vege_datum', '>=', $idopont->format('Y-m-d'));
        }, 'tanszekek' => function($query) use ($idopont) {
            $query->where('kezdo_datum', '<=', $idopont->format('Y-m-d'))->where('vege_datum', '>=', $idopont->format('Y-m-d'));
        }])->firstOrFail();

        $szemelyek = $karok->szemelyek;
        if($szemelyek->isEmpty())
            throw new ModelNotFoundException;

        return $karok->szemelyek;
    }
}