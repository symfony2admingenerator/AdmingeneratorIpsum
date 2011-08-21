<?php

namespace Admingenerator\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Admingenerator\DemoBundle\Entity\ProducerRepository")
 * @ORM\Table(name="producers")
 */
class Producer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(length="255")
     * @ORM\Index
     */
    protected $name;
    
    
    /**
     * @ORM\Column(type="boolean", nullable="true")
     */
    protected $is_published;
    
    /**
     * @ORM\OneToMany(targetEntity="Admingenerator\DemoBundle\Entity\Movie", mappedBy="producer", cascade={"all"}, orphanRemoval=true)
     */
    protected $movies;
    
    
    public function __construct()
    {
        $this->movies = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
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
     * @return string 
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
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->is_published;
    }

    /**
     * Add movies
     *
     * @param Admingenerator\DemoBundle\Entity\Movie $movies
     */
    public function addMovies(\Admingenerator\DemoBundle\Entity\Movie $movies)
    {
        $this->movies[] = $movies;
    }

    /**
     * Get movies
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMovies()
    {
        return $this->movies;
    }
}