<?php
namespace Admingenerator\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Admingenerator\DemoBundle\Entity\ActorRepository")
 * @ORM\Table(name="actors")
 */
class Actor
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
     * @ORM\ManyToMany(targetEntity="Admingenerator\DemoBundle\Entity\Movie", inversedBy="actors")
     * @ORM\JoinTable(name="actor_movies",
     *      joinColumns={@ORM\JoinColumn(name="actor_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="movie_id", referencedColumnName="id")}
     *      )
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