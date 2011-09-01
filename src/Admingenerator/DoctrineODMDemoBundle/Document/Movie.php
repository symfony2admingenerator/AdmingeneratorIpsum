<?php
namespace Admingenerator\DoctrineODMDemoBundle\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="movies")
 */
class Movie
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     * @MongoDB\Index
     */
    protected $title;
    
    /**
     * @MongoDB\Field(type="boolean", nullable="true")
     */
    protected $is_published;
    
    /**
     * @MongoDB\ReferenceOne(targetDocument="Admingenerator\DoctrineODMDemoBundle\Document\Producer", cascade={"all"}, fetch="EAGER")
     */
    protected $producer;
    
    /**
     * @MongoDB\Field(type="date", nullable="true")
     */
    protected $release_date;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Admingenerator\DoctrineODMDemoBundle\Document\Actor", inversedBy="movies")
     */
    protected $actors;
    
   
}