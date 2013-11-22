<?php
/**
 * Created by PhpStorm.
 * User: noherczeg
 * Date: 2013.11.22.
 * Time: 4:18
 */

namespace ColladAPI;


class Resource {

    private $links = [];
    private $content = null;
    private $pagesMeta = [];

    public function __construct(array $links = [], $content = null, array $pagesMeta = [])
    {
        $this->links = $links;
        $this->content = $content;
        $this->pagesMeta = $pagesMeta;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param array $links
     */
    public function setLinks($links)
    {
        $this->links = $links;
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param array $pages
     */
    public function setPagesMeta(array $pages)
    {
        $this->pagesMeta = $pages;
    }

    /**
     * @return array
     */
    public function getPagesMeta()
    {
        return $this->pagesMeta;
    }

    /**
     * @param array $link
     */
    public function addLink($link)
    {
        $this->links[] = $link;
    }

    /**
     * Append an array of Links
     *
     * @param array $links
     */
    public function addLinks( array $links)
    {
        foreach ($links as $link) {
            $this->links[] = $link;
        }
    }
} 