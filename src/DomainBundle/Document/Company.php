<?php

namespace DomainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Company
{

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @MongoDB\ReferenceMany(targetDocument="Fact", cascade={"persist", "remove"})
     */
    protected $facts;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Fact", cascade={"persist", "remove"})
     */
    protected $numbers;

    /**
     * @return mixed
     */
    public function getFacts()
    {
        return $this->facts;
    }

    /**
     * @param mixed $facts
     */
    public function setFacts($facts)
    {
        $this->facts = $facts;
    }

    /**
     * @return mixed
     */
    public function getNumbers()
    {
        return $this->numbers;
    }

    /**
     * @param mixed $numbers
     */
    public function setNumbers($numbers)
    {
        $this->numbers = $numbers;
    }

    /**
     * @MongoDB\Field(type="string")
     */
    protected $icon;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

        $facts = [];
        foreach ($this->getFacts() as $fact){
            $facts[]=$fact->jsonSerialize();
        }

        $numbers = [];
        foreach ($this->getNumbers() as $number){
            $numbers[]=$number->jsonSerialize();
        }

        return [
            "name" => $this->getName(),
            "icon" => $this->getIcon(),
            "numbers" => $numbers,
            "facts" => $facts
        ];
    }

}
