<?php
namespace Admingenerator\DoctrineODMDemoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="movies", repositoryClass="Admingenerator\DoctrineODMDemoBundle\Document\MovieRepository")
 */
class Movie
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $title;

    /**
     * @MongoDB\Field(type="boolean", nullable="true")
     */
    protected $is_published;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Admingenerator\DoctrineODMDemoBundle\Document\Producer", cascade={"all"})
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

    /**
     * @MongoDB\Field(type="hash")
     */
    protected $hashField;


    public function __construct()
    {
        $this->actors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setActors(\Doctrine\Common\Collections\ArrayCollection $actors)
    {
         $this->actors = $actors;
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
     * @return string $title
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
     * @return boolean $isPublished
     */
    public function getIsPublished()
    {
        return $this->is_published;
    }

    /**
     * Set producer
     *
     * @param Admingenerator\DoctrineODMDemoBundle\Document\Producer $producer
     */
    public function setProducer(\Admingenerator\DoctrineODMDemoBundle\Document\Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * Get producer
     *
     * @return Admingenerator\DoctrineODMDemoBundle\Document\Producer $producer
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * Set release_date
     *
     * @param date $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->release_date = $releaseDate;
    }

    /**
     * Get release_date
     *
     * @return date $releaseDate
     */
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * Add actors
     *
     * @param Admingenerator\DoctrineODMDemoBundle\Document\Actor $actors
     */
    public function addActors(\Admingenerator\DoctrineODMDemoBundle\Document\Actor $actors)
    {
        $this->actors[] = $actors;
    }

    /**
     * Get actors
     *
     * @return Doctrine\Common\Collections\Collection $actors
     */
    public function getActors()
    {
        return $this->actors;
    }


    /**
     * Set hashField
     *
     * @param hash $hashField
     */
    public function setHashField($hashField)
    {
        $this->hashField = $hashField;
    }

    /**
     * Get hashField
     *
     * @return hash $hashField
     */
    public function getHashField()
    {
        return $this->hashField;
    }
}
