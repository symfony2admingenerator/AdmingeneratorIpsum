<?php

namespace Admingenerator\PropelDemoBundle\Model\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use Admingenerator\PropelDemoBundle\Model\Movie;
use Admingenerator\PropelDemoBundle\Model\ProducerPeer;
use Admingenerator\PropelDemoBundle\Model\ProducerQuery;

/**
 * Base class that represents a query for the 'propel_producers' table.
 *
 * 
 *
 * @method     ProducerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ProducerQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ProducerQuery orderByIsPublished($order = Criteria::ASC) Order by the is_published column
 *
 * @method     ProducerQuery groupById() Group by the id column
 * @method     ProducerQuery groupByName() Group by the name column
 * @method     ProducerQuery groupByIsPublished() Group by the is_published column
 *
 * @method     ProducerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ProducerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ProducerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ProducerQuery leftJoinMovie($relationAlias = null) Adds a LEFT JOIN clause to the query using the Movie relation
 * @method     ProducerQuery rightJoinMovie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Movie relation
 * @method     ProducerQuery innerJoinMovie($relationAlias = null) Adds a INNER JOIN clause to the query using the Movie relation
 *
 * @method     Producer findOne(PropelPDO $con = null) Return the first Producer matching the query
 * @method     Producer findOneOrCreate(PropelPDO $con = null) Return the first Producer matching the query, or a new Producer object populated from the query conditions when no match is found
 *
 * @method     Producer findOneById(int $id) Return the first Producer filtered by the id column
 * @method     Producer findOneByName(string $name) Return the first Producer filtered by the name column
 * @method     Producer findOneByIsPublished(boolean $is_published) Return the first Producer filtered by the is_published column
 *
 * @method     array findById(int $id) Return Producer objects filtered by the id column
 * @method     array findByName(string $name) Return Producer objects filtered by the name column
 * @method     array findByIsPublished(boolean $is_published) Return Producer objects filtered by the is_published column
 *
 * @package    propel.generator.host/admingen/src/Admingenerator/PropelDemoBundle/Model.om
 */
abstract class BaseProducerQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseProducerQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Admingenerator\\PropelDemoBundle\\Model\\Producer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ProducerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return    ProducerQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ProducerQuery) {
            return $criteria;
        }
        $query = new ProducerQuery();
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
     * @return    Producer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ((null !== ($obj = ProducerPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
     * @return    ProducerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        return $this->addUsingAlias(ProducerPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return    ProducerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        return $this->addUsingAlias(ProducerPeer::ID, $keys, Criteria::IN);
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
     * @return    ProducerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }
        return $this->addUsingAlias(ProducerPeer::ID, $id, $comparison);
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
     * @return    ProducerQuery The current query, for fluid interface
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
        return $this->addUsingAlias(ProducerPeer::NAME, $name, $comparison);
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
     * @return    ProducerQuery The current query, for fluid interface
     */
    public function filterByIsPublished($isPublished = null, $comparison = null)
    {
        if (is_string($isPublished)) {
            $is_published = in_array(strtolower($isPublished), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }
        return $this->addUsingAlias(ProducerPeer::IS_PUBLISHED, $isPublished, $comparison);
    }

    /**
     * Filter the query by a related Movie object
     *
     * @param     Movie $movie  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    ProducerQuery The current query, for fluid interface
     */
    public function filterByMovie($movie, $comparison = null)
    {
        if ($movie instanceof Movie) {
            return $this
                ->addUsingAlias(ProducerPeer::ID, $movie->getProducerId(), $comparison);
        } elseif ($movie instanceof PropelCollection) {
            return $this
                ->useMovieQuery()
                ->filterByPrimaryKeys($movie->getPrimaryKeys())
                ->endUse();
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
     * @return    ProducerQuery The current query, for fluid interface
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
     * @param     Producer $producer Object to remove from the list of results
     *
     * @return    ProducerQuery The current query, for fluid interface
     */
    public function prune($producer = null)
    {
        if ($producer) {
            $this->addUsingAlias(ProducerPeer::ID, $producer->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BaseProducerQuery