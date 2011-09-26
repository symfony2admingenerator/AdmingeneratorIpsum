<?php

namespace Admingenerator\PropelDemoBundle\Model\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use Admingenerator\PropelDemoBundle\Model\Actor;
use Admingenerator\PropelDemoBundle\Model\ActorHasMoviePeer;
use Admingenerator\PropelDemoBundle\Model\ActorHasMovieQuery;
use Admingenerator\PropelDemoBundle\Model\Movie;

/**
 * Base class that represents a query for the 'propel_actors_movies' table.
 *
 * 
 *
 * @method     ActorHasMovieQuery orderByActorId($order = Criteria::ASC) Order by the actor_id column
 * @method     ActorHasMovieQuery orderByMovieId($order = Criteria::ASC) Order by the movie_id column
 *
 * @method     ActorHasMovieQuery groupByActorId() Group by the actor_id column
 * @method     ActorHasMovieQuery groupByMovieId() Group by the movie_id column
 *
 * @method     ActorHasMovieQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ActorHasMovieQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ActorHasMovieQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ActorHasMovieQuery leftJoinActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Actor relation
 * @method     ActorHasMovieQuery rightJoinActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Actor relation
 * @method     ActorHasMovieQuery innerJoinActor($relationAlias = null) Adds a INNER JOIN clause to the query using the Actor relation
 *
 * @method     ActorHasMovieQuery leftJoinMovie($relationAlias = null) Adds a LEFT JOIN clause to the query using the Movie relation
 * @method     ActorHasMovieQuery rightJoinMovie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Movie relation
 * @method     ActorHasMovieQuery innerJoinMovie($relationAlias = null) Adds a INNER JOIN clause to the query using the Movie relation
 *
 * @method     ActorHasMovie findOne(PropelPDO $con = null) Return the first ActorHasMovie matching the query
 * @method     ActorHasMovie findOneOrCreate(PropelPDO $con = null) Return the first ActorHasMovie matching the query, or a new ActorHasMovie object populated from the query conditions when no match is found
 *
 * @method     ActorHasMovie findOneByActorId(int $actor_id) Return the first ActorHasMovie filtered by the actor_id column
 * @method     ActorHasMovie findOneByMovieId(int $movie_id) Return the first ActorHasMovie filtered by the movie_id column
 *
 * @method     array findByActorId(int $actor_id) Return ActorHasMovie objects filtered by the actor_id column
 * @method     array findByMovieId(int $movie_id) Return ActorHasMovie objects filtered by the movie_id column
 *
 * @package    propel.generator.host/admingen/src/Admingenerator/PropelDemoBundle/Model.om
 */
abstract class BaseActorHasMovieQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseActorHasMovieQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Admingenerator\\PropelDemoBundle\\Model\\ActorHasMovie', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ActorHasMovieQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return    ActorHasMovieQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ActorHasMovieQuery) {
            return $criteria;
        }
        $query = new ActorHasMovieQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }
        return $query;
    }

    /**
     * Find object by primary key
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     * @param     array[$actor_id, $movie_id] $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return    ActorHasMovie|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ((null !== ($obj = ActorHasMoviePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
            // the object is alredy in the instance pool
            return $obj;
        } else {
            // the object has not been requested yet, or the formatter is not an object formatter
            $criteria = $this->isKeepQuery() ? clone $this : $this;
            $stmt = $criteria
                ->filterByPrimaryKey($key)
                ->getSelectStatement($con);
            return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
        }
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        return $this
            ->filterByPrimaryKeys($keys)
            ->find($con);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return    ActorHasMovieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ActorHasMoviePeer::ACTOR_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ActorHasMoviePeer::MOVIE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return    ActorHasMovieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ActorHasMoviePeer::ACTOR_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ActorHasMoviePeer::MOVIE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the actor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByActorId(1234); // WHERE actor_id = 1234
     * $query->filterByActorId(array(12, 34)); // WHERE actor_id IN (12, 34)
     * $query->filterByActorId(array('min' => 12)); // WHERE actor_id > 12
     * </code>
     *
     * @see       filterByActor()
     *
     * @param     mixed $actorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    ActorHasMovieQuery The current query, for fluid interface
     */
    public function filterByActorId($actorId = null, $comparison = null)
    {
        if (is_array($actorId) && null === $comparison) {
            $comparison = Criteria::IN;
        }
        return $this->addUsingAlias(ActorHasMoviePeer::ACTOR_ID, $actorId, $comparison);
    }

    /**
     * Filter the query on the movie_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMovieId(1234); // WHERE movie_id = 1234
     * $query->filterByMovieId(array(12, 34)); // WHERE movie_id IN (12, 34)
     * $query->filterByMovieId(array('min' => 12)); // WHERE movie_id > 12
     * </code>
     *
     * @see       filterByMovie()
     *
     * @param     mixed $movieId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    ActorHasMovieQuery The current query, for fluid interface
     */
    public function filterByMovieId($movieId = null, $comparison = null)
    {
        if (is_array($movieId) && null === $comparison) {
            $comparison = Criteria::IN;
        }
        return $this->addUsingAlias(ActorHasMoviePeer::MOVIE_ID, $movieId, $comparison);
    }

    /**
     * Filter the query by a related Actor object
     *
     * @param     Actor|PropelCollection $actor The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    ActorHasMovieQuery The current query, for fluid interface
     */
    public function filterByActor($actor, $comparison = null)
    {
        if ($actor instanceof Actor) {
            return $this
                ->addUsingAlias(ActorHasMoviePeer::ACTOR_ID, $actor->getId(), $comparison);
        } elseif ($actor instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
            return $this
                ->addUsingAlias(ActorHasMoviePeer::ACTOR_ID, $actor->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByActor() only accepts arguments of type Actor or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Actor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    ActorHasMovieQuery The current query, for fluid interface
     */
    public function joinActor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Actor');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Actor');
        }

        return $this;
    }

    /**
     * Use the Actor relation Actor object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    \Admingenerator\PropelDemoBundle\Model\ActorQuery A secondary query class using the current class as primary query
     */
    public function useActorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinActor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Actor', '\Admingenerator\PropelDemoBundle\Model\ActorQuery');
    }

    /**
     * Filter the query by a related Movie object
     *
     * @param     Movie|PropelCollection $movie The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    ActorHasMovieQuery The current query, for fluid interface
     */
    public function filterByMovie($movie, $comparison = null)
    {
        if ($movie instanceof Movie) {
            return $this
                ->addUsingAlias(ActorHasMoviePeer::MOVIE_ID, $movie->getId(), $comparison);
        } elseif ($movie instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
            return $this
                ->addUsingAlias(ActorHasMoviePeer::MOVIE_ID, $movie->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMovie() only accepts arguments of type Movie or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Movie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    ActorHasMovieQuery The current query, for fluid interface
     */
    public function joinMovie($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Movie');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Movie');
        }

        return $this;
    }

    /**
     * Use the Movie relation Movie object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    \Admingenerator\PropelDemoBundle\Model\MovieQuery A secondary query class using the current class as primary query
     */
    public function useMovieQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMovie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Movie', '\Admingenerator\PropelDemoBundle\Model\MovieQuery');
    }

    /**
     * Exclude object from result
     *
     * @param     ActorHasMovie $actorHasMovie Object to remove from the list of results
     *
     * @return    ActorHasMovieQuery The current query, for fluid interface
     */
    public function prune($actorHasMovie = null)
    {
        if ($actorHasMovie) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ActorHasMoviePeer::ACTOR_ID), $actorHasMovie->getActorId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ActorHasMoviePeer::MOVIE_ID), $actorHasMovie->getMovieId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

} // BaseActorHasMovieQuery