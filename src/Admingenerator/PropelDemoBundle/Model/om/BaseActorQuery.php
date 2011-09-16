<?php

namespace Admingenerator\PropelDemoBundle\Model\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use Admingenerator\PropelDemoBundle\Model\ActorHasMovie;
use Admingenerator\PropelDemoBundle\Model\ActorPeer;
use Admingenerator\PropelDemoBundle\Model\ActorQuery;

/**
 * Base class that represents a query for the 'propel_actors' table.
 *
 * 
 *
 * @method     ActorQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ActorQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ActorQuery groupById() Group by the id column
 * @method     ActorQuery groupByName() Group by the name column
 *
 * @method     ActorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ActorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ActorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ActorQuery leftJoinActorHasMovieRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActorHasMovieRelatedById relation
 * @method     ActorQuery rightJoinActorHasMovieRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActorHasMovieRelatedById relation
 * @method     ActorQuery innerJoinActorHasMovieRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the ActorHasMovieRelatedById relation
 *
 * @method     ActorQuery leftJoinActorHasMovieRelatedByActorId($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActorHasMovieRelatedByActorId relation
 * @method     ActorQuery rightJoinActorHasMovieRelatedByActorId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActorHasMovieRelatedByActorId relation
 * @method     ActorQuery innerJoinActorHasMovieRelatedByActorId($relationAlias = null) Adds a INNER JOIN clause to the query using the ActorHasMovieRelatedByActorId relation
 *
 * @method     Actor findOne(PropelPDO $con = null) Return the first Actor matching the query
 * @method     Actor findOneOrCreate(PropelPDO $con = null) Return the first Actor matching the query, or a new Actor object populated from the query conditions when no match is found
 *
 * @method     Actor findOneById(int $id) Return the first Actor filtered by the id column
 * @method     Actor findOneByName(string $name) Return the first Actor filtered by the name column
 *
 * @method     array findById(int $id) Return Actor objects filtered by the id column
 * @method     array findByName(string $name) Return Actor objects filtered by the name column
 *
 * @package    propel.generator.host/admingen/src/Admingenerator/PropelDemoBundle/Model.om
 */
abstract class BaseActorQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseActorQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Admingenerator\\PropelDemoBundle\\Model\\Actor', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ActorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return    ActorQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ActorQuery) {
            return $criteria;
        }
        $query = new ActorQuery();
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
     * @return    Actor|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ((null !== ($obj = ActorPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
     * @return    ActorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        return $this->addUsingAlias(ActorPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return    ActorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        return $this->addUsingAlias(ActorPeer::ID, $keys, Criteria::IN);
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
     * @see       filterByActorHasMovieRelatedById()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    ActorQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }
        return $this->addUsingAlias(ActorPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    ActorQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }
        return $this->addUsingAlias(ActorPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related ActorHasMovie object
     *
     * @param     ActorHasMovie|PropelCollection $actorHasMovie The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    ActorQuery The current query, for fluid interface
     */
    public function filterByActorHasMovieRelatedById($actorHasMovie, $comparison = null)
    {
        if ($actorHasMovie instanceof ActorHasMovie) {
            return $this
                ->addUsingAlias(ActorPeer::ID, $actorHasMovie->getActorId(), $comparison);
        } elseif ($actorHasMovie instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
            return $this
                ->addUsingAlias(ActorPeer::ID, $actorHasMovie->toKeyValue('PrimaryKey', 'ActorId'), $comparison);
        } else {
            throw new PropelException('filterByActorHasMovieRelatedById() only accepts arguments of type ActorHasMovie or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ActorHasMovieRelatedById relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    ActorQuery The current query, for fluid interface
     */
    public function joinActorHasMovieRelatedById($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ActorHasMovieRelatedById');

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
            $this->addJoinObject($join, 'ActorHasMovieRelatedById');
        }

        return $this;
    }

    /**
     * Use the ActorHasMovieRelatedById relation ActorHasMovie object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    \Admingenerator\PropelDemoBundle\Model\ActorHasMovieQuery A secondary query class using the current class as primary query
     */
    public function useActorHasMovieRelatedByIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinActorHasMovieRelatedById($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ActorHasMovieRelatedById', '\Admingenerator\PropelDemoBundle\Model\ActorHasMovieQuery');
    }

    /**
     * Filter the query by a related ActorHasMovie object
     *
     * @param     ActorHasMovie $actorHasMovie  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    ActorQuery The current query, for fluid interface
     */
    public function filterByActorHasMovieRelatedByActorId($actorHasMovie, $comparison = null)
    {
        if ($actorHasMovie instanceof ActorHasMovie) {
            return $this
                ->addUsingAlias(ActorPeer::ID, $actorHasMovie->getActorId(), $comparison);
        } elseif ($actorHasMovie instanceof PropelCollection) {
            return $this
                ->useActorHasMovieRelatedByActorIdQuery()
                ->filterByPrimaryKeys($actorHasMovie->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByActorHasMovieRelatedByActorId() only accepts arguments of type ActorHasMovie or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ActorHasMovieRelatedByActorId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    ActorQuery The current query, for fluid interface
     */
    public function joinActorHasMovieRelatedByActorId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ActorHasMovieRelatedByActorId');

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
            $this->addJoinObject($join, 'ActorHasMovieRelatedByActorId');
        }

        return $this;
    }

    /**
     * Use the ActorHasMovieRelatedByActorId relation ActorHasMovie object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    \Admingenerator\PropelDemoBundle\Model\ActorHasMovieQuery A secondary query class using the current class as primary query
     */
    public function useActorHasMovieRelatedByActorIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinActorHasMovieRelatedByActorId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ActorHasMovieRelatedByActorId', '\Admingenerator\PropelDemoBundle\Model\ActorHasMovieQuery');
    }

    /**
     * Filter the query by a related Movie object
     * using the propel_actors_movies table as cross reference
     *
     * @param     Movie $movie the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    ActorQuery The current query, for fluid interface
     */
    public function filterByMovieRelatedByMovieId($movie, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useActorHasMovieRelatedByActorIdQuery()
            ->filterByMovieRelatedByMovieId($movie, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param     Actor $actor Object to remove from the list of results
     *
     * @return    ActorQuery The current query, for fluid interface
     */
    public function prune($actor = null)
    {
        if ($actor) {
            $this->addUsingAlias(ActorPeer::ID, $actor->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BaseActorQuery