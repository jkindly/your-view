<?php
require_once (dirname(__FILE__).'/../Model.php');

class Page extends Model
{
    private $id;
    private $name;
    private $uri;
    private $metaTitle;
    private $metaDesc;
    private $metaRobots;
    private $content;

    public function uriExists(): bool {
        $query = $this->fetchWithWhere('page', 'uri', $this->getUri());
        if (!empty($query)) return true;

        return false;
    }

    public function uriExistsOnEdit($id): bool {
        $query = $this->fetchWithAndWhere('page', [
            'id' => $id,
            'uri' => $this->getUri()
        ]);
        if (!empty($query)) return true;

        return false;
    }

    public function create() {
        $this->insert('page', [
            'name' => $this->getName(),
            'uri' => $this->getUri(),
            'meta_title' => $this->getMetaTitle(),
            'meta_desc' => $this->getMetaDesc(),
            'meta_robots' => $this->getMetaRobots(),
            'content' => htmlentities($this->getContent())
        ]);
    }

    public function edit($id) {
        $this->update('page', [
            'id' => $id
        ], [
            'name' => $this->getName(),
            'uri' => $this->getUri(),
            'meta_title' => $this->getMetaTitle(),
            'meta_desc' => $this->getMetaDesc(),
            'meta_robots' => $this->getMetaRobots(),
            'content' => htmlentities($this->getContent())
        ]);
    }

    public function remove($id) {
        $this->delete('page', 'id', $id);
    }

    public function getAllPages() {
        $arrayOfPages = array();

        $pages = $this->fetch('page');



        foreach ($pages as $page) {
            $newPage = new Page();
            $newPage->setId($page['id'])
                ->setName($page['name'])
                ->setUri($page['uri'])
                ->setMetaTitle($page['meta_title'])
                ->setMetaDesc($page['meta_desc'])
                ->setMetaRobots($page['meta_robots'])
                ->setContent($page['content']);
            array_push($arrayOfPages, $newPage);
        }

        return $arrayOfPages;
    }

    public function getPageById($id) {
        $array = $this->fetchWithWhere('page', 'id', $id);
        $this->setId($array[0]['id'])
             ->setName($array[0]['name'])
             ->setUri($array[0]['uri'])
             ->setMetaTitle($array[0]['meta_title'])
             ->setMetaDesc($array[0]['meta_desc'])
             ->setMetaRobots($array[0]['meta_robots'])
             ->setContent($array[0]['content']);
        return $this;
    }

    public function getPageByUri($uri) {
        $array = $this->fetchWithWhere('page', 'uri', $uri);
        if (!empty($array)) {
            $this->setId($array[0]['id'])
                ->setName($array[0]['name'])
                ->setUri($array[0]['uri'])
                ->setMetaTitle($array[0]['meta_title'])
                ->setMetaDesc($array[0]['meta_desc'])
                ->setMetaRobots($array[0]['meta_robots'])
                ->setContent($array[0]['content']);
            return $this;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    public function getMetaDesc()
    {
        return $this->metaDesc;
    }

    public function setMetaDesc($metaDesc)
    {
        $this->metaDesc = $metaDesc;
        return $this;
    }

    public function getMetaRobots()
    {
        return $this->metaRobots;
    }

    public function setMetaRobots($metaRobots)
    {
        $this->metaRobots = $metaRobots;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
}