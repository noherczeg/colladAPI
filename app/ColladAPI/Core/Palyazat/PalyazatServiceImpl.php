<?php namespace ColladAPI\Core\Palyazat;

use ColladAPI\Core\Rest\CRUDServiceImpl;

class PalyazatServiceImpl extends CRUDServiceImpl implements PalyazatService {

    public function __construct(PalyazatRepository $palyazatRepository)
    {
        $this->repository = $palyazatRepository;
    }

    public function findByIdWithAll($id)
    {
        return $this->repository->findByIdWithAll($id);
    }

    public function findPublikacioForPalyazat($palyazatId, $pubId)
    {
        return $this->repository->findPublikacioForPalyazat($palyazatId, $pubId);
    }

    public function findPublikaciokForPalyazat($palyazatId)
    {
        return $this->repository->findPublikaciokForPalyazat($palyazatId);
    }
}