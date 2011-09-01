<?php

namespace Admingenerator\DoctrineODMDemoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="producers")
 */
class Producer
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
     * @MongoDB\Field(type="boolean", nullable="true")
     */
    protected $is_published;
    
    /**
     * @MongoDB\ReferenceMany(targetDocument="Admingenerator\DoctrineODMDemoBundle\Document\Movie", mappedBy="producer", cascade={"all"}, orphanRemoval=true)
     */
    protected $movies;
    
    
}