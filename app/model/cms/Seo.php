<?php
require_once(dirname(__FILE__) . '/../Model.php');


class Seo extends Model
{
    private $id;
    private $defaultMetaTitle;

    public function getSeoSettings() {
        $result = $this->fetch('seo');

        $this->setDefaultMetaTitle($result[0]['default_meta_title']);
    }

    public function replaceSeoVariables($pageName) {
        $pageNameVar = '{pageName}';

        $defTitle = str_replace($pageNameVar ,$pageName, $this->getDefaultMetaTitle());

        $this->setDefaultMetaTitle($defTitle);
    }

    public function updateDefaultMetaTitle() {
        $this->update('seo', [], [
            'default_meta_title' => $this->getDefaultMetaTitle()
        ]);
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

    public function getDefaultMetaTitle()
    {
        return $this->defaultMetaTitle;
    }

    public function setDefaultMetaTitle($defaultMetaTitle)
    {
        $this->defaultMetaTitle = $defaultMetaTitle;
        return $this;
    }

}