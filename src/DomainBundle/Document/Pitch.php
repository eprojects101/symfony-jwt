<?php 

namespace DomainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Pitch  implements \JsonSerializable
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
     * @MongoDB\ReferenceMany(targetDocument="Product", cascade={"persist", "remove"})
     */
    protected $products;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="User"
     * )
     */
    protected $owner;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Company", cascade={"persist", "remove"})
     */
    protected $company;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Product", cascade={"persist", "remove"})
     */
    protected $companySegment;

    /**
     * @return mixed
     */
    public function getCompanySegment()
    {
        return $this->companySegment;
    }

    /**
     * @param mixed $companySegment
     */
    public function setCompanySegment($companySegment)
    {
        $this->companySegment = $companySegment;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @MongoDB\Field(type="string")
     */
    protected $createdAt;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $segment;

    /**
     * @MongoDB\Collection
     */
    protected $pains;

    /**
     * Get id
     *
     * @return int_id $id
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set owner
     *
     * @param DomainBundle\Document\User $owner
     * @return self
     */
    public function setOwner(\DomainBundle\Document\User $owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Get owner
     *
     * @return DomainBundle\Document\User $owner
     */
    public function getOwner()
    {
        return $this->owner;
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
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get segment
     *
     * @return string $segment
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * Set segment
     *
     * @param string $segment
     * @return self
     */
    public function setSegment($segment)
    {
        $this->segment = $segment;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
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
     * Set products
     *
     * @return self
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    /**
     * Get products
     *
     */
    public function getProducts()
    {
        return $this->products;
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

        $products = [];

        if($this->getProducts() != null) {
            foreach ($this->getProducts() as $product) {
                $products[] = $product->jsonSerialize();
            }
        }

        return [
          "id" => $this->getId(),
          "name" => $this->getName(),
          "segment" => $this->getSegment(),
          "pains" => $this->getPains(),
          "company" => $this->getCompany()!=null ? $this->getCompany()->jsonSerialize():null,
          "companySegment" => $this->getCompanySegment()->jsonSerialize(),
          "products" => $products,
          "createdAt" => $this->getCreatedAt()
        ];
    }

    public function toList(){

        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "segment" => $this->getSegment(),
            "createdAt" => $this->getCreatedAt()
        ];
    }
}
