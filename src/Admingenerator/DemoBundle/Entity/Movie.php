<?php
namespace Admingenerator\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Admingenerator\DemoBundle\Entity\MovieRepository")
 * @ORM\Table(name="movies")
 */
class Movie
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
    protected $title;
    
    /**
     * @ORM\Column(type="boolean", nullable="true")
     */
    protected $is_published;
    
    /**
     * @ORM\ManyToOne(targetEntity="Admingenerator\DemoBundle\Entity\Producer", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="producer_id", referencedColumnName="id")
     */
    protected $producer;

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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
     * Set producer
     *
     * @param \Admingenerator\DemoBundle\Entity\Producer $producer
     */
    public function setProducer(\Admingenerator\DemoBundle\Entity\Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * Get producer
     *
     * @return \Admingenerator\DemoBundle\Entity\Producer 
     */
    public function getProducer()
    {
        return $this->producer;
    }
}