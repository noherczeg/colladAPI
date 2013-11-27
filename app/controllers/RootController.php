<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.26.
 * Time: 16:48
 */

class RootController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

    public function discover()
    {
        $resource = new \ColladAPI\Resource();

        $resource->addLink($this->createLinkToFirstPage('szemelyek'));
        $resource->addLink($this->createLinkToFirstPage('szervezetek'));
        /*if (Entrust::hasRole('ADMIN')) */$resource->addLink($this->createLink('szerepkorok'));
        $resource->addLink($this->createLink('fokozatok'));
        $resource->addLink($this->createLinkToFirstPage('publikaciok'));
        $resource->addLink($this->createLink('szakok'));
        $resource->addLink($this->createLinkToFirstPage('esemenyek'));
        $resource->addLink($this->createLink('nyelvek'));
        $resource->addLink($this->createLinkToFirstPage('tanulmanyutak'));
        $resource->addLink($this->createLinkToFirstPage('tdkdolgozatok'));
        $resource->addLink($this->createLink('orszagok'));
        $resource->addLink($this->createLinkToFirstPage('intezmenyek'));
        $resource->addLink($this->createLinkToFirstPage('intezetek'));
        $resource->addLink($this->createLinkToFirstPage('beruhazasok'));
        $resource->addLink($this->createLinkToFirstPage('alkotasok'));

        return $this->sendResource($resource);
    }
} 