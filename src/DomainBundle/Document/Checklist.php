<?php 

namespace DomainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @MongoDB\Document
 */
class Checklist
{
    /**
     * @MongoDB\Id
     * @GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @MongoDB\Field(type="string")
     */
    protected $question;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $segment;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $pain;

    /**
     * @return mixed
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * @param mixed $segment
     */
    public function setSegment($segment)
    {
        $this->segment = $segment;
    }

    /**
     * @return mixed
     */
    public function getPain()
    {
        return $this->pain;
    }

    /**
     * @param mixed $pain
     */
    public function setPain($pain)
    {
        $this->pain = $pain;
    }

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

    public function toList(){

        return [
            "id" => $this->getId(),
            "question" => $this->getQuestion(),
            "segment" => $this->getSegment(),
            "pain" => $this->getPain()
        ];
    }
}
