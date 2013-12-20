<?php namespace ColladAPI\Core\Rest;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Http\Resource;
use Noherczeg\RestExt\Services\AuthorizationService;

class RootController extends RestExtController {

    protected $authorizationService;

    public function __construct(AuthorizationService $auth)
    {
        parent::__construct();
        $this->authorizationService = $auth;
    }

    public function discover()
    {
        $resource = new Resource();

        $resource->addLink($this->linker->createLinkToFirstPage('beruhazasok'));
        $resource->addLink($this->linker->createLinkToFirstPage('palyazatok'));
        $resource->addLink($this->linker->createLinkToFirstPage('dijak'));
        $resource->addLink($this->linker->createLinkToFirstPage('esemenyek'));
        $resource->addLink($this->linker->createLinkToFirstPage('intezetek'));
        $resource->addLink($this->linker->createLinkToFirstPage('intezmenyek'));
        $resource->addLink($this->linker->createLink('kepzesszintek'));
        $resource->addLink($this->linker->createLinkToFirstPage('bevetelek'));
        $resource->addLink($this->linker->createLinkToFirstPage('szemelyek'));
        $resource->addLink($this->linker->createLink('tanszekek'));
        $resource->addLink($this->linker->createLink('szakok'));
        $resource->addLink($this->linker->createLinkToFirstPage('tanulmanyutak'));
        $resource->addLink($this->linker->createLinkToFirstPage('tdkdolgozatok'));
        if ($this->authorizationService->hasRole('ADMIN')) $resource->addLink($this->linker->createLink('szerepkorok'));
        $resource->addLink($this->linker->createLink('tudomanyteruletek'));
        $resource->addLink($this->linker->createLink('nyelvek'));
        $resource->addLink($this->linker->createLink('nyelvtudasok'));
        $resource->addLink($this->linker->createLink('fokozatok'));
        $resource->addLink($this->linker->createLinkToFirstPage('szervezetek'));
        $resource->addLink($this->linker->createLink('orszagok'));
        $resource->addLink($this->linker->createLinkToFirstPage('alkotasok'));
        $resource->addLink($this->linker->createLinkToFirstPage('publikaciok'));

        return $this->restResponse->sendResource($resource);
    }
} 