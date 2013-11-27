<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/27/13
 * Time: 1:17 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Auth\AuthorizationInterface;
use ColladAPI\Entities\Szemely;
use ColladAPI\Repositories\SzemelyRepository;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Repositories\TanszekRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class SzemelyServiceImpl extends CRUDServiceImpl implements SzemelyService {

    protected $mailService;

    protected $tanszekRepository;

    public function __construct(SzemelyRepository $szemelyRepository, TanszekRepository $tanszekRepository, MailService $mailService)
    {
        $this->repository = $szemelyRepository;
        $this->tanszekRepository = $tanszekRepository;
        $this->mailService = $mailService;
    }

    /**
     * @param array $entityData
     * @return bool|Szemely
     * @throws \ColladAPI\Exceptions\ErrorMessageException
     */
    public function register(array $entityData)
    {
        $szemely = new Szemely();
        $szemely->fill($entityData);
        $szemely->validate();

        if (!$szemely->save()) {
            throw new ErrorMessageException('Személy mentése közben hiba lépett fel');
            return false;
        }

        $this->mailService->sendRegistered($szemely);
        return $szemely;
    }

    /**
     * @param $id
     * @throws ModelNotFoundException
     * @return Szemely
     */
    public function findByIdWithDijak($id)
    {
        return $this->repository->findByIdWithDijak($id);
    }

    /**
     * Visszaadja a kert Szemelyt es az osszes hozzatartozo adatot
     *
     * @param $szemelyId
     * @return mixed
     */
    public function findByIdWithAll($szemelyId)
    {
        return $this->repository->findByIdWithAll($szemelyId);
    }

    public function findTanarByIdWithAll($id, \DateTime $atTime)
    {
        return $this->repository->findTanarByIdWithAll($id, $atTime);
    }

    public function findHallgatoByIdWithAll($id, \DateTime $atTime)
    {
        return $this->repository->findHallgatoByIdWithAll($id, $atTime);
    }

    public function findTanarokAtTime(\DateTime $atTime)
    {
        return $this->repository->findTanarokAtTime($atTime);
    }

    public function findHallgatokAtTime(\DateTime $atTime)
    {
        return $this->repository->findHallgatokAtTime($atTime);
    }

    public function findTanarokBetweenTimes(\DateTime $fromTime, \DateTime $toTime)
    {
        return $this->repository->findTanarokBetweenTimes($fromTime, $toTime);
    }

    public function findHallgatokBetweenTimes(\DateTime $fromTime, \DateTime $toTime)
    {
        return $this->repository->findHallgatokBetweenTimes($fromTime, $toTime);
    }

    public function tanarok()
    {
        return $this->repository->tanarok();
    }

    public function hallgatok()
    {
        return $this->repository->hallgatok();
    }

    public function fokozatokForSzemely($id)
    {
        return $this->repository->fokozatokForSzemely($id)->first()->getRelation('fokozatok');
    }

    public function tanszekekForSzemely($id)
    {
        return $this->repository->tanszekekForSzemely($id)->first()->getRelation('tanszekek');
    }
}