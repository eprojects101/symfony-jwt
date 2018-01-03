<?php

namespace DomainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Product
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
     * @MongoDB\Field(type="string")
     */
    protected $grouper;

    /**
     * @MongoDB\Collection
     */
    protected $segments;

    /**
     * @MongoDB\Collection
     */
    protected $pains;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Material", cascade={"persist", "remove"})
     */
    protected $highlight;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Material", cascade={"persist", "remove"})
     */
    protected $otherCustomers;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Material", cascade={"persist", "remove"})
     */
    protected $benefits;
    /**
     * @MongoDB\ReferenceOne(targetDocument="Material", cascade={"persist", "remove"})
     */
    protected $cases;
    /**
     * @MongoDB\ReferenceOne(targetDocument="Material", cascade={"persist", "remove"})
     */
    protected $medias;
    /**
     * @MongoDB\ReferenceOne(targetDocument="Material", cascade={"persist", "remove"})
     */
    protected $solutions;
    /**
     * @MongoDB\ReferenceOne(targetDocument="Material", cascade={"persist", "remove"})
     */
    protected $moreInformation;
    /**
     * @MongoDB\ReferenceOne(targetDocument="Material", cascade={"persist", "remove"})
     */
    protected $customersSegment;

    /**
     * @return mixed
     */
    public function getSolutions()
    {
        return $this->solutions;
    }

    /**
     * @param mixed $solutions
     */
    public function setSolutions($solutions)
    {
        $this->solutions = $solutions;
    }

    /**
     * @return mixed
     */
    public function getMoreInformation()
    {
        return $this->moreInformation;
    }

    /**
     * @param mixed $moreInformation
     */
    public function setMoreInformation($moreInformation)
    {
        $this->moreInformation = $moreInformation;
    }

    /**
     * @return mixed
     */
    public function getCustomersSegment()
    {
        return $this->customersSegment;
    }

    /**
     * @param mixed $customersSegment
     */
    public function setCustomersSegment($customersSegment)
    {
        $this->customersSegment = $customersSegment;
    }

    /**
     * @MongoDB\Field(type="string")
     */
    protected $createdAt;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $cloned;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }


    public function getName()
    {
        return $this->name;
    }

    /**
     * Set grouper
     *
     * @param string $grouper
     * @return self
     */
    public function setGrouper($grouper)
    {
        $this->grouper = $grouper;
        return $this;
    }

    /**
     * Get grouper
     *
     * @return string $grouper
     */
    public function getGrouper()
    {
        return $this->grouper;
    }

    /**
     * Set segments
     *
     * @param collection $segments
     * @return self
     */
    public function setSegments($segments)
    {
        $this->segments = $segments;
        return $this;
    }

    /**
     * Get segments
     *
     * @return collection $segments
     */
    public function getSegments()
    {
        return $this->segments;
    }

    /**
     * Set pains
     *
     * @param collection $pains
     * @return self
     */
    public function setPains($pains)
    {
        $this->pains = $pains;
        return $this;
    }

    /**
     * Get pains
     *
     * @return collection $pains
     */
    public function getPains()
    {
        return $this->pains;
    }

    /**
     * Set createdAt
     *
     * @param string $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return string $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * @return mixed
     */
    public function getOtherCustomers()
    {
        return $this->otherCustomers;
    }

    /**
     * @param mixed $otherCustomers
     */
    public function setOtherCustomers($otherCustomers)
    {
        $this->otherCustomers = $otherCustomers;
    }

    /**
     * @return mixed
     */
    public function getBenefits()
    {
        return $this->benefits;
    }

    /**
     * @param mixed $benefits
     */
    public function setBenefits($benefits)
    {
        $this->benefits = $benefits;
    }

    /**
     * @return mixed
     */
    public function getCases()
    {
        return $this->cases;
    }

    /**
     * @param mixed $cases
     */
    public function setCases($cases)
    {
        $this->cases = $cases;
    }

    /**
     * @return mixed
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * @param mixed $medias
     */
    public function setMedias($medias)
    {
        $this->medias = $medias;
    }

    /**
     * @return mixed
     */
    public function getHighlight()
    {
        return $this->highlight;
    }

    /**
     * @param mixed $highlight
     */
    public function setHighlight($highlight)
    {
        $this->highlight = $highlight;
    }

    /**
     * @return mixed
     */
    public function getCloned()
    {
        return $this->cloned;
    }

    /**
     * @param mixed $cloned
     */
    public function setCloned($cloned)
    {
        $this->cloned = $cloned;
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
            "id" => $this->getId(),
            "name" => $this->getName(),
            "grouper" => $this->getGrouper(),
            "segments" => $this->getSegments(),
            "pains" => $this->getPains(),
            "createdAt" => $this->getCreatedAt(),
            'highlight' => $this->getHighlight()!=null ? $this->getHighlight()->jsonSerialize():null,
            'otherCustomers' => $this->getOtherCustomers()!=null ? $this->getOtherCustomers()->jsonSerialize():null,
            'benefits' => $this->getBenefits()!=null ? $this->getBenefits()->jsonSerialize():null,
            'cases' => $this->getCases()!=null ? $this->getCases()->jsonSerialize():null,
            'medias' => $this->getMedias()!=null ? $this->getMedias()->jsonSerialize():null,
            'moreInformation' => $this->getMoreInformation()!=null ? $this->getMoreInformation()->jsonSerialize():null,
            'customersSegment' => $this->getCustomersSegment()!=null ? $this->getCustomersSegment()->jsonSerialize():null,
            'solutions' => $this->getSolutions()!=null ? $this->getSolutions()->jsonSerialize():null,
        ];
    }

    public function toList(){

        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "grouper" => $this->getGrouper(),
            "segments" => $this->getSegments(),
            "pains" => $this->getPains()
        ];
    }

}
