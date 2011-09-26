<?php

namespace Admingenerator\PropelDemoBundle\Model\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use Admingenerator\PropelDemoBundle\Model\ActorHasMovie;
use Admingenerator\PropelDemoBundle\Model\MoviePeer;
use Admingenerator\PropelDemoBundle\Model\MovieQuery;
use Admingenerator\PropelDemoBundle\Model\Producer;

/**
 * Base class that represents a query for the 'propel_movies' table.
 *
 * 
 *
 * @method     MovieQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     MovieQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     MovieQuery orderByIsPublished($order = Criteria::ASC) Order by the is_published column
 * @method     MovieQuery orderByReleaseDate($order = Criteria::ASC) Order by the release_date column
 * @method     MovieQuery orderByProducerId($order = Criteria::ASC) Order by the producer_id column
 *
 * @method     MovieQuery groupById() Group by the id column
 * @method     MovieQuery groupByTitle() Group by the title column
 * @method     MovieQuery groupByIsPublished() Group by the is_published column
 * @method     MovieQuery groupByReleaseDate() Group by the release_date column
 * @method     MovieQuery groupByProducerId() Group by the producer_id column
 *
 * @method     MovieQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MovieQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MovieQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MovieQuery leftJoinProducer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Producer relation
 * @method     MovieQuery rightJoinProducer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Producer relation
 * @method     MovieQuery innerJoinProducer($relationAlias = null) Adds a INNER JOIN clause to the query using the Producer relation
 *
 * @method     MovieQuery leftJoinActorHasMovie($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActorHasMovie relation
 * @method     MovieQuery rightJoinActorHasMovie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActorHasMovie relation
 * @method     MovieQuery innerJoinActorHasMovie($relationAlias = null) Adds a INNER JOIN clause to the query using the ActorHasMovie relation
 *
 * @method     Movie findOne(PropelPDO $con = null) Return the first Movie matching the query
 * @method     Movie findOneOrCreate(PropelPDO $con = null) Return the first Movie matching the query, or a new Movie object populated from the query conditions when no match is found
 *
 * @method     Movie findOneById(int $id) Return the first Movie filtered by the id column
 * @method     Movie findOneByTitle(string $title) Return the first Movie filtered by the title column
 * @method     Movie findOneByIsPublished(boolean $is_published) Return the first Movie filtered by the is_published column
 * @method     Movie findOneByReleaseDate(string $release_date) Return the first Movie filtered by the release_date column
 * @method     Movie findOneByProducerId(int $producer_id) Return the first Movie filtered by the producer_id column
 *
 * @method     array findById(int $id) Return Movie objects filtered by the id column
 * @method     array findByTitle(string $title) Return Movie objects filtered by the title column
 * @method     array findByIsPublished(boolean $is_published) Return Movie objects filtered by the is_published column
 * @method     array findByReleaseDate(string $release_date) Return Movie objects filtered by the release_date column
 * @method     array findByProducerId(int $producer_id) Return Movie objects filtered by the producer_id column
 *
 * @package    propel.generator.host/admingen/src/Admingenerator/PropelDemoBundle/Model.om
 */
abstract class BaseMovieQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseMovieQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Admingenerator\\PropelDemoBundle\\Model\\Movie', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MovieQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return    MovieQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MovieQuery) {
            return $criteria;
        }
        $query = new MovieQuery();
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
     * Use instance pooling to avoid a database query if the object exists
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Movie|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ((null !== ($obj = MoviePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
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
     * @return    MovieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        return $this->addUsingAlias(MoviePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        return $this->addUsingAlias(MoviePeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }
        return $this->addUsingAlias(MoviePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }
        return $this->addUsingAlias(MoviePeer::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the is_published column
     *
     * Example usage:
     * <code>
     * $query->filterByIsPublished(true); // WHERE is_published = true
     * $query->filterByIsPublished('yes'); // WHERE is_published = true
     * </code>
     *
     * @param     boolean|string $isPublished The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function filterByIsPublished($isPublished = null, $comparison = null)
    {
        if (is_string($isPublished)) {
            $is_published = in_array(strtolower($isPublished), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }
        return $this->addUsingAlias(MoviePeer::IS_PUBLISHED, $isPublished, $comparison);
    }

    /**
     * Filter the query on the release_date column
     *
     * Example usage:
     * <code>
     * $query->filterByReleaseDate('2011-03-14'); // WHERE release_date = '2011-03-14'
     * $query->filterByReleaseDate('now'); // WHERE release_date = '2011-03-14'
     * $query->filterByReleaseDate(array('max' => 'yesterday')); // WHERE release_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $releaseDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function filterByReleaseDate($releaseDate = null, $comparison = null)
    {
        if (is_array($releaseDate)) {
            $useMinMax = false;
            if (isset($releaseDate['min'])) {
                $this->addUsingAlias(MoviePeer::RELEASE_DATE, $releaseDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($releaseDate['max'])) {
                $this->addUsingAlias(MoviePeer::RELEASE_DATE, $releaseDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(MoviePeer::RELEASE_DATE, $releaseDate, $comparison);
    }

    /**
     * Filter the query on the producer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProducerId(1234); // WHERE producer_id = 1234
     * $query->filterByProducerId(array(12, 34)); // WHERE producer_id IN (12, 34)
     * $query->filterByProducerId(array('min' => 12)); // WHERE producer_id > 12
     * </code>
     *
     * @see       filterByProducer()
     *
     * @param     mixed $producerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function filterByProducerId($producerId = null, $comparison = null)
    {
        if (is_array($producerId)) {
            $useMinMax = false;
            if (isset($producerId['min'])) {
                $this->addUsingAlias(MoviePeer::PRODUCER_ID, $producerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($producerId['max'])) {
                $this->addUsingAlias(MoviePeer::PRODUCER_ID, $producerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(MoviePeer::PRODUCER_ID, $producerId, $comparison);
    }

    /**
     * Filter the query by a related Producer object
     *
     * @param     Producer|PropelCollection $producer The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function filterByProducer($producer, $comparison = null)
    {
        if ($producer instanceof Producer) {
            return $this
                ->addUsingAlias(MoviePeer::PRODUCER_ID, $producer->getId(), $comparison);
        } elseif ($producer instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
            return $this
                ->addUsingAlias(MoviePeer::PRODUCER_ID, $producer->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProducer() only accepts arguments of type Producer or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Producer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function joinProducer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Producer');

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
            $this->addJoinObject($join, 'Producer');
        }

        return $this;
    }

    /**
     * Use the Producer relation Producer object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    \Admingenerator\PropelDemoBundle\Model\ProducerQuery A secondary query class using the current class as primary query
     */
    public function useProducerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProducer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Producer', '\Admingenerator\PropelDemoBundle\Model\ProducerQuery');
    }

    /**
     * Filter the query by a related ActorHasMovie object
     *
     * @param     ActorHasMovie $actorHasMovie  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function filterByActorHasMovie($actorHasMovie, $comparison = null)
    {
        if ($actorHasMovie instanceof ActorHasMovie) {
            return $this
                ->addUsingAlias(MoviePeer::ID, $actorHasMovie->getMovieId(), $comparison);
        } elseif ($actorHasMovie instanceof PropelCollection) {
            return $this
                ->useActorHasMovieQuery()
                ->filterByPrimaryKeys($actorHasMovie->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByActorHasMovie() only accepts arguments of type ActorHasMovie or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ActorHasMovie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function joinActorHasMovie($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ActorHasMovie');

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
            $this->addJoinObject($join, 'ActorHasMovie');
        }

        return $this;
    }

    /**
     * Use the ActorHasMovie relation ActorHasMovie object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    \Admingenerator\PropelDemoBundle\Model\ActorHasMovieQuery A secondary query class using the current class as primary query
     */
    public function useActorHasMovieQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinActorHasMovie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ActorHasMovie', '\Admingenerator\PropelDemoBundle\Model\ActorHasMovieQuery');
    }

    /**
     * Filter the query by a related Actor object
     * using the propel_actors_movies table as cross reference
     *
     * @param     Actor $actor the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function filterByActor($actor, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useActorHasMovieQuery()
            ->filterByActor($actor, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param     Movie $movie Object to remove from the list of results
     *
     * @return    MovieQuery The current query, for fluid interface
     */
    public function prune($movie = null)
    {
        if ($movie) {
            $this->addUsingAlias(MoviePeer::ID, $movie->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BaseMovieQuery