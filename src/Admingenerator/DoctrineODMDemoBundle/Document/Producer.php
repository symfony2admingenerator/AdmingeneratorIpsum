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
     */
    protected $name;
    
    
    /**
     * @MongoDB\Field(type="boolean", nullable="true")
     */
    protected $is_published;
    
    /**
     * @MongoDB\ReferenceMany(targetDocument="Admingenerator\DoctrineODMDemoBundle\Document\Movie", mappedBy="producer", cascade={"all"})
     */
    protected $movies;
    
    
    public function __construct()
    {
        $this->movies = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set is_published
     *
     * @param boolean $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->is_published = $isPublished;
    }

    /**
     * Get is_published
     *
     * @return boolean $isPublished
     */
    public function getIsPublished()
    {
        return $this->is_published;
    }

    /**
     * Add movies
     *
     * @param Admingenerator\DoctrineODMDemoBundle\Document\Movie $movies
     */
    public function addMovies(\Admingenerator\DoctrineODMDemoBundle\Document\Movie $movies)
    {
        $this->movies[] = $movies;
    }

    /**
     * Get movies
     *
     * @return Doctrine\Common\Collections\Collection $movies
     */
    public function getMovies()
    {
        return $this->movies;
    }
}