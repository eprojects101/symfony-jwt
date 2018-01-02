<?php

namespace DomainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Grouper
{

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $label;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $icon;

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }


    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon(string $icon)
    {
        $this->icon = $icon;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    private function toArray(){

        return [
            "label" => $this->getLabel(),
            "icon" => $this->getIcon(),
            "id" => $this->getId()
        ];
    }

}
