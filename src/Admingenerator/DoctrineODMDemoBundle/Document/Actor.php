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