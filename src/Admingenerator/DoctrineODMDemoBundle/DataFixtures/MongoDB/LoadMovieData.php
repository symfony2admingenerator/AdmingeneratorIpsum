<?php

namespace Admingenerator\DemoBundle\DataFixtures\MongoDB;

use Admingenerator\DoctrineODMDemoBundle\Document\Actor;

use Symfony\Component\Form\Extension\Core\Type\RadioType;

use Admingenerator\DoctrineODMDemoBundle\Document\Producer;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Admingenerator\DoctrineODMDemoBundle\Document\Movie;

class LoadMovieData implements FixtureInterface
{
    public function load($manager)
    {
        $movies = array(
            //Title, Year, Release date, Producer
	    	'City of God, 2002, 2003-03-12, Katia Lund,' => 
                array('actors' => array('Alexandre Rodrigues', 'Matheus Nachtergaele', 'Leandro Firmino', 'Phellipe Haagensen', 'Douglas Silva')),
	    	'Rain, 2001, 2004-07-21, Christine Jeffs' => 
                array('actors' => array()),
	    	'2001: A Space Odyssey, 1968, 1968-09-27, Stanley Kubrick' => 
                array('actors' => array('Keir Dullea','Gary Lockwood','William Sylvester','Daniel Richter','Leonard Rossiter','Douglas Rain')),
	    	'This is a "fake" movie title, 1957, 1957-09-27, Sidney Lumet'=> 
                array('actors' => array('Alexandre Rodrigues', 'Gary Lockwood')),
	    	'Alien, 1979, 1979-09-12, Ridley Scott'=> 
                array('actors' => array('Sigourney Weaver')),
	    	'The Sequel to "Dances With Wolves.", 1982, 1990-11-21, Ridley Scott'=> 
                array('actors' => array()),
	    	'Caine Mutiny, 1954, 1954-09-15, Dymtryk "the King", Edward"'=> 
                array('actors' => array('Humphrey Bogart','José Ferrer')),
        );
         
        foreach ($movies as $movie => $properties) {
            	
            list($title, $year, $release_date, $producer) = explode(',', $movie);

            echo ">> Insert $title \n";
            
            $myMovie = new Movie();
            $myMovie->setTitle($title);
            $myMovie->setIsPublished(true);
            $myMovie->setReleaseDate(new \DateTime($release_date));
            $myMovie->setProducer($this->getOrCreateProducer($producer, $manager));
            $manager->persist($myMovie);
            $manager->flush();
            
            $this->setActors($properties['actors'], $myMovie, $manager);
        }
        
    }
    
    protected function setActors(array $actors, Movie $movie, $manager)
    {
        foreach ($actors as $actor) {
            $actorObject = $manager->getRepository('Admingenerator\DoctrineODMDemoBundle\Document\Actor')
                            ->findOneByName($actor); 
                            
            if (!$actorObject) {
                $actorObject = new Actor();
                $actorObject->setName($actor);
            }
            
            $actorObject->addMovies($movie);
            $movie->addActors($actorObject);
            $manager->persist($actorObject);
            $manager->persist($movie);
            $manager->flush();
        }
    }
    
    protected function getOrCreateProducer($producer, $manager)
    {
        $producerObject = $manager->getRepository('Admingenerator\DoctrineODMDemoBundle\Document\Producer')
                ->findOneByName($producer); 
        
        if (!$producerObject) {
            $producerObject = new Producer();
            $producerObject->setName($producer);
            $producerObject->setIsPublished(true);
            
            $manager->persist($producerObject);
            $manager->flush();
        }
        
        return $producerObject;
    }
}