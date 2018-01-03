<?php 

namespace DomainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @MongoDB\Document
 */
class Material
{
    /**
     * @MongoDB\Id
     * @GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $type;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $complete;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $grouper;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $product;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $title;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $complementary_title;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $complementary_link;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fileHighlightLink;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fileBenefitsLink1;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fileBenefitsLink2;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fileBenefitsLink3;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fileBenefitsLink4;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $contentBenefits1;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $contentBenefits2;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $contentBenefits3;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $contentBenefits4;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fileCustomerMediaLink1;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fileCustomerMediaLink2;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $subtitle;

    /**
     * @return mixed
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }
    /**
     * @return mixed
     */
    public function getFileBenefitsLink1()
    {
        return $this->fileBenefitsLink1;
    }

    /**
     * @param mixed $fileBenefitsLink1
     */
    public function setFileBenefitsLink1($fileBenefitsLink1)
    {
        $this->fileBenefitsLink1 = $fileBenefitsLink1;
    }

    /**
     * @return mixed
     */
    public function getFileBenefitsLink2()
    {
        return $this->fileBenefitsLink2;
    }

    /**
     * @param mixed $fileBenefitsLink2
     */
    public function setFileBenefitsLink2($fileBenefitsLink2)
    {
        $this->fileBenefitsLink2 = $fileBenefitsLink2;
    }

    /**
     * @return mixed
     */
    public function getFileBenefitsLink3()
    {
        return $this->fileBenefitsLink3;
    }

    /**
     * @param mixed $fileBenefitsLink3
     */
    public function setFileBenefitsLink3($fileBenefitsLink3)
    {
        $this->fileBenefitsLink3 = $fileBenefitsLink3;
    }

    /**
     * @return mixed
     */
    public function getFileBenefitsLink4()
    {
        return $this->fileBenefitsLink4;
    }

    /**
     * @param mixed $fileBenefitsLink4
     */
    public function setFileBenefitsLink4($fileBenefitsLink4)
    {
        $this->fileBenefitsLink4 = $fileBenefitsLink4;
    }

    /**
     * @return mixed
     */
    public function getContentBenefits1()
    {
        return $this->contentBenefits1;
    }

    /**
     * @param mixed $contentBenefits1
     */
    public function setContentBenefits1($contentBenefits1)
    {
        $this->contentBenefits1 = $contentBenefits1;
    }

    /**
     * @return mixed
     */
    public function getContentBenefits2()
    {
        return $this->contentBenefits2;
    }

    /**
     * @param mixed $contentBenefits2
     */
    public function setContentBenefits2($contentBenefits2)
    {
        $this->contentBenefits2 = $contentBenefits2;
    }

    /**
     * @return mixed
     */
    public function getContentBenefits3()
    {
        return $this->contentBenefits3;
    }

    /**
     * @param mixed $contentBenefits3
     */
    public function setContentBenefits3($contentBenefits3)
    {
        $this->contentBenefits3 = $contentBenefits3;
    }

    /**
     * @return mixed
     */
    public function getContentBenefits4()
    {
        return $this->contentBenefits4;
    }

    /**
     * @param mixed $contentBenefits4
     */
    public function setContentBenefits4($contentBenefits4)
    {
        $this->contentBenefits4 = $contentBenefits4;
    }

    /**
     * @return mixed
     */
    public function getFileCustomerMediaLink1()
    {
        return $this->fileCustomerMediaLink1;
    }

    /**
     * @param mixed $fileCustomerMediaLink1
     */
    public function setFileCustomerMediaLink1($fileCustomerMediaLink1)
    {
        $this->fileCustomerMediaLink1 = $fileCustomerMediaLink1;
    }

    /**
     * @return mixed
     */
    public function getFileCustomerMediaLink2()
    {
        return $this->fileCustomerMediaLink2;
    }

    /**
     * @param mixed $fileCustomerMediaLink2
     */
    public function setFileCustomerMediaLink2($fileCustomerMediaLink2)
    {
        $this->fileCustomerMediaLink2 = $fileCustomerMediaLink2;
    }

    /**
     * @return mixed
     */
    public function getFileCustomerMediaLink3()
    {
        return $this->fileCustomerMediaLink3;
    }

    /**
     * @param mixed $fileCustomerMediaLink3
     */
    public function setFileCustomerMediaLink3($fileCustomerMediaLink3)
    {
        $this->fileCustomerMediaLink3 = $fileCustomerMediaLink3;
    }

    /**
     * @return mixed
     */
    public function getFileCustomerMediaLink4()
    {
        return $this->fileCustomerMediaLink4;
    }

    /**
     * @param mixed $fileCustomerMediaLink4
     */
    public function setFileCustomerMediaLink4($fileCustomerMediaLink4)
    {
        $this->fileCustomerMediaLink4 = $fileCustomerMediaLink4;
    }

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fileCustomerMediaLink3;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fileCustomerMediaLink4;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $content;

    /**
     * @MongoDB\Collection
     */
    protected $segments;

    /**
     * @MongoDB\Collection
     */
    protected $pains;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $createdAt;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="User"
     * )
     */
    protected $owner;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set complementaryTitle
     *
     * @param string $complementaryTitle
     * @return self
     */
    public function setComplementaryTitle($complementaryTitle)
    {
        $this->complementary_title = $complementaryTitle;
        return $this;
    }

    /**
     * Get complementaryTitle
     *
     * @return string $complementaryTitle
     */
    public function getComplementaryTitle()
    {
        return $this->complementary_title;
    }

    /**
     * Set complementaryLink
     *
     * @param string $complementaryLink
     * @return self
     */
    public function setComplementaryLink($complementaryLink)
    {
        $this->complementary_link = $complementaryLink;
        return $this;
    }

    /**
     * Get complementaryLink
     *
     * @return string $complementaryLink
     */
    public function getComplementaryLink()
    {
        return $this->complementary_link;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
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
     * Set owner
     *
     * @param User $owner
     * @return self
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Get owner
     *
     * @return User $owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set product
     *
     * @param string $product
     * @return self
     */
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get product
     *
     * @return string $product
     */
    public function getProduct()
    {
        return $this->product;
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
     * Set complete
     *
     * @param boolean $complete
     * @return self
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;
        return $this;
    }


    /**
     * Is complete
     *
     * @return boolean $complete
     */
    public function isComplete()
    {
        return $this->complete;
    }

    /**
     * @return mixed
     */
    public function getFileHighlightLink()
    {
        return $this->fileHighlightLink;
    }

    /**
     * @param mixed $fileHighlightLink
     */
    public function setFileHighlightLink($fileHighlightLink)
    {
        $this->fileHighlightLink = $fileHighlightLink;
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
            "title" => $this->getTitle(),
            "subtitle" => $this->getSubtitle(),
            "content" => $this->getContent(),
            "type" => $this->getType(),
            "grouper" => $this->getGrouper(),
            "product" => $this->getProduct(),
            "segments" => $this->getSegments(),
            "pains" => $this->getPains(),
            "createdAt" => $this->getCreatedAt(),
            'fileHighlightLink' =>$this->getFileHighlightLink(),
            'fileBenefitsLink1' =>$this->getFileBenefitsLink1(),
            'fileBenefitsLink2' =>$this->getFileBenefitsLink2(),
            'fileBenefitsLink3' =>$this->getFileBenefitsLink3(),
            'contentBenefits1' =>$this->getContentBenefits1(),
            'contentBenefits2' =>$this->getContentBenefits2(),
            'contentBenefits3' =>$this->getContentBenefits3(),
            'contentBenefits4' =>$this->getContentBenefits4(),
            'fileCustomerMediaLink1' =>$this->getFileCustomerMediaLink1(),
            'fileCustomerMediaLink2' =>$this->getFileCustomerMediaLink2(),
            'fileCustomerMediaLink3' =>$this->getFileCustomerMediaLink3(),
            'fileCustomerMediaLink4' =>$this->getFileCustomerMediaLink4()
        ];
    }
}
