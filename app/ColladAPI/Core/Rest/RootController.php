<?php namespace ColladAPI\Core\Rest;

use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Facades\RestLinker;
use Noherczeg\RestExt\Http\Resource;
use Noherczeg\RestExt\Facades\RestResponse;

class RootController extends RestExtController {

    public function __construct()
    {
        parent::__construct();
    }

    public function discover()
    {

        $resource = new Resource();

        $resource->addLink(RestLinker::createLinkToFirstPage('szemelyek'));
        $resource->addLink(RestLinker::createLinkToFirstPage('szervezetek'));
        if (\Entrust::hasRole('ADMIN')) $resource->addLink(RestLinker::createLink('szerepkorok'));
        $resource->addLink(RestLinker::createLink('fokozatok'));
        $resource->addLink(RestLinker::createLinkToFirstPage('publikaciok'));
        $resource->addLink(RestLinker::createLink('szakok'));
        $resource->addLink(RestLinker::createLinkToFirstPage('esemenyek'));
        $resource->addLink(RestLinker::createLink('nyelvek'));
        $resource->addLink(RestLinker::createLinkToFirstPage('tanulmanyutak'));
        $resource->addLink(RestLinker::createLinkToFirstPage('tdkdolgozatok'));
        $resource->addLink(RestLinker::createLink('orszagok'));
        $resource->addLink(RestLinker::createLinkToFirstPage('intezmenyek'));
        $resource->addLink(RestLinker::createLinkToFirstPage('intezetek'));
        $resource->addLink(RestLinker::createLinkToFirstPage('beruhazasok'));
        $resource->addLink(RestLinker::createLinkToFirstPage('alkotasok'));

        return RestResponse::sendResource($resource);
    }
} 