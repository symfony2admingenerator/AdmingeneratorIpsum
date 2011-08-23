<?php

namespace Admingenerator\DemoBundle\DataFixtures\ORM;

use Admingenerator\DemoBundle\Entity\Actor;

use Symfony\Component\Form\Extension\Core\Type\RadioType;

use Admingenerator\DemoBundle\Entity\Producer;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Admingenerator\DemoBundle\Entity\Movie;

class LoadMovieData implements FixtureInterface
{
    public function load($manager)
    {
        $movies = array(
            //Title, Year, Producer
	    	'City of God, 2002, Katia Lund,' => 
                array('actors' => array('Alexandre Rodrigues', 'Matheus Nachtergaele', 'Leandro Firmino', 'Phellipe Haagensen', 'Douglas Silva')),
	    	'Rain, 2001, Christine Jeffs' => 
                array('actors' => array()),
	    	'2001: A Space Odyssey, 1968, Stanley Kubrick' => 
                array('actors' => array('Keir Dullea','Gary Lockwood','William Sylvester','Daniel Richter','Leonard Rossiter','Douglas Rain')),
	    	'This is a "fake" movie title, 1957, Sidney Lumet'=> 
                array('actors' => array('Alexandre Rodrigues', 'Gary Lockwood')),
	    	'Alien, 1979, Ridley Scott'=> 
                array('actors' => array('Sigourney Weaver')),
	    	'The Sequel to "Dances With Wolves.", 1982, Ridley Scott'=> 
                array('actors' => array()),
	    	'Caine Mutiny, 1954, Dymtryk "the King", Edward"'=> 
                array('actors' => array('Humphrey Bogart','José Ferrer')),
        );
         
        foreach ($movies as $movie => $properties) {
            	
            list($title, $year, $producer) = explode(',', $movie);

            $myMovie = new Movie();
            $myMovie->setTitle($title);
            $myMovie->setIsPublished(true);
            $myMovie->setProducer($this->getOrCreateProducer($producer, $manager));
            $manager->persist($myMovie);
            $manager->flush();
            
            $this->setActors($properties['actors'], $myMovie, $manager);
        }
        
    }
    
    protected function setActors(array $actors, Movie $movie, $manager)
    {
        foreach ($actors as $actor) {
            $actorObject = $manager->getRepository('Admingenerator\DemoBundle\Entity\Actor')
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
        $producerObject = $manager->getRepository('Admingenerator\DemoBundle\Entity\Producer')
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