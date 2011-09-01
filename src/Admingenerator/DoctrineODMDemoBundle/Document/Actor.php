<?php
namespace Admingenerator\DoctrineODMDemoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="actors")
 */
class Actor
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     * @MongoDB\Index
     */
    protected $name;
    
    /**
     * @MongoDB\ReferenceMany(targetDocument="Admingenerator\DoctrineODMDemoBundle\Document\Movie", inversedBy="actors")
     */
    protected $movies;

    public function __toString()
    {
        return $this->name;
    }
  
}