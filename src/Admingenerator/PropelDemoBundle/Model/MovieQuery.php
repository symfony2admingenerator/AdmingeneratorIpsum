<?php

namespace Admingenerator\PropelDemoBundle\Model;

use Doctrine\ORM\Query\Expr\GroupBy;

use Admingenerator\PropelDemoBundle\Model\om\BaseMovieQuery;


/**
 * Skeleton subclass for performing query and update operations on the 'propel_movies' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.host/admingen/src/Admingenerator/PropelDemoBundle/Model
 */
class MovieQuery extends BaseMovieQuery {

    public function withoutActors()
    {
        //@todo
        
        return $this;
    }
    
    public function withActors()
    {
        $this->innerJoinActorHasMovieRelatedByMovieId()
             ->groupById();
        
        return $this;
    }
} // MovieQuery
