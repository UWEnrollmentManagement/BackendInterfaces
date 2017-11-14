<?php

namespace FormsAPI\Base;

use \Exception;
use \PDO;
use FormsAPI\DashboardElement as ChildDashboardElement;
use FormsAPI\DashboardElementQuery as ChildDashboardElementQuery;
use FormsAPI\Map\DashboardElementTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'dashboard_element' table.
 *
 *
 *
 * @method     ChildDashboardElementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDashboardElementQuery orderByDashboardId($order = Criteria::ASC) Order by the dashboard_id column
 * @method     ChildDashboardElementQuery orderByElementId($order = Criteria::ASC) Order by the element_id column
 *
 * @method     ChildDashboardElementQuery groupById() Group by the id column
 * @method     ChildDashboardElementQuery groupByDashboardId() Group by the dashboard_id column
 * @method     ChildDashboardElementQuery groupByElementId() Group by the element_id column
 *
 * @method     ChildDashboardElementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDashboardElementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDashboardElementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDashboardElementQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDashboardElementQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDashboardElementQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDashboardElementQuery leftJoinDashboard($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dashboard relation
 * @method     ChildDashboardElementQuery rightJoinDashboard($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dashboard relation
 * @method     ChildDashboardElementQuery innerJoinDashboard($relationAlias = null) Adds a INNER JOIN clause to the query using the Dashboard relation
 *
 * @method     ChildDashboardElementQuery joinWithDashboard($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dashboard relation
 *
 * @method     ChildDashboardElementQuery leftJoinWithDashboard() Adds a LEFT JOIN clause and with to the query using the Dashboard relation
 * @method     ChildDashboardElementQuery rightJoinWithDashboard() Adds a RIGHT JOIN clause and with to the query using the Dashboard relation
 * @method     ChildDashboardElementQuery innerJoinWithDashboard() Adds a INNER JOIN clause and with to the query using the Dashboard relation
 *
 * @method     ChildDashboardElementQuery leftJoinElement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Element relation
 * @method     ChildDashboardElementQuery rightJoinElement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Element relation
 * @method     ChildDashboardElementQuery innerJoinElement($relationAlias = null) Adds a INNER JOIN clause to the query using the Element relation
 *
 * @method     ChildDashboardElementQuery joinWithElement($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Element relation
 *
 * @method     ChildDashboardElementQuery leftJoinWithElement() Adds a LEFT JOIN clause and with to the query using the Element relation
 * @method     ChildDashboardElementQuery rightJoinWithElement() Adds a RIGHT JOIN clause and with to the query using the Element relation
 * @method     ChildDashboardElementQuery innerJoinWithElement() Adds a INNER JOIN clause and with to the query using the Element relation
 *
 * @method     \FormsAPI\DashboardQuery|\FormsAPI\ElementQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDashboardElement findOne(ConnectionInterface $con = null) Return the first ChildDashboardElement matching the query
 * @method     ChildDashboardElement findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDashboardElement matching the query, or a new ChildDashboardElement object populated from the query conditions when no match is found
 *
 * @method     ChildDashboardElement findOneById(int $id) Return the first ChildDashboardElement filtered by the id column
 * @method     ChildDashboardElement findOneByDashboardId(int $dashboard_id) Return the first ChildDashboardElement filtered by the dashboard_id column
 * @method     ChildDashboardElement findOneByElementId(int $element_id) Return the first ChildDashboardElement filtered by the element_id column *

 * @method     ChildDashboardElement requirePk($key, ConnectionInterface $con = null) Return the ChildDashboardElement by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDashboardElement requireOne(ConnectionInterface $con = null) Return the first ChildDashboardElement matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDashboardElement requireOneById(int $id) Return the first ChildDashboardElement filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDashboardElement requireOneByDashboardId(int $dashboard_id) Return the first ChildDashboardElement filtered by the dashboard_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDashboardElement requireOneByElementId(int $element_id) Return the first ChildDashboardElement filtered by the element_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDashboardElement[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDashboardElement objects based on current ModelCriteria
 * @method     ChildDashboardElement[]|ObjectCollection findById(int $id) Return ChildDashboardElement objects filtered by the id column
 * @method     ChildDashboardElement[]|ObjectCollection findByDashboardId(int $dashboard_id) Return ChildDashboardElement objects filtered by the dashboard_id column
 * @method     ChildDashboardElement[]|ObjectCollection findByElementId(int $element_id) Return ChildDashboardElement objects filtered by the element_id column
 * @method     ChildDashboardElement[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DashboardElementQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \FormsAPI\Base\DashboardElementQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\FormsAPI\\DashboardElement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDashboardElementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDashboardElementQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDashboardElementQuery) {
            return $criteria;
        }
        $query = new ChildDashboardElementQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildDashboardElement|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DashboardElementTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DashboardElementTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDashboardElement A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, dashboard_id, element_id FROM dashboard_element WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildDashboardElement $obj */
            $obj = new ChildDashboardElement();
            $obj->hydrate($row);
            DashboardElementTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildDashboardElement|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildDashboardElementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DashboardElementTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDashboardElementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DashboardElementTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildDashboardElementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DashboardElementTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DashboardElementTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DashboardElementTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the dashboard_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDashboardId(1234); // WHERE dashboard_id = 1234
     * $query->filterByDashboardId(array(12, 34)); // WHERE dashboard_id IN (12, 34)
     * $query->filterByDashboardId(array('min' => 12)); // WHERE dashboard_id > 12
     * </code>
     *
     * @see       filterByDashboard()
     *
     * @param     mixed $dashboardId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDashboardElementQuery The current query, for fluid interface
     */
    public function filterByDashboardId($dashboardId = null, $comparison = null)
    {
        if (is_array($dashboardId)) {
            $useMinMax = false;
            if (isset($dashboardId['min'])) {
                $this->addUsingAlias(DashboardElementTableMap::COL_DASHBOARD_ID, $dashboardId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dashboardId['max'])) {
                $this->addUsingAlias(DashboardElementTableMap::COL_DASHBOARD_ID, $dashboardId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DashboardElementTableMap::COL_DASHBOARD_ID, $dashboardId, $comparison);
    }

    /**
     * Filter the query on the element_id column
     *
     * Example usage:
     * <code>
     * $query->filterByElementId(1234); // WHERE element_id = 1234
     * $query->filterByElementId(array(12, 34)); // WHERE element_id IN (12, 34)
     * $query->filterByElementId(array('min' => 12)); // WHERE element_id > 12
     * </code>
     *
     * @see       filterByElement()
     *
     * @param     mixed $elementId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDashboardElementQuery The current query, for fluid interface
     */
    public function filterByElementId($elementId = null, $comparison = null)
    {
        if (is_array($elementId)) {
            $useMinMax = false;
            if (isset($elementId['min'])) {
                $this->addUsingAlias(DashboardElementTableMap::COL_ELEMENT_ID, $elementId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($elementId['max'])) {
                $this->addUsingAlias(DashboardElementTableMap::COL_ELEMENT_ID, $elementId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DashboardElementTableMap::COL_ELEMENT_ID, $elementId, $comparison);
    }

    /**
     * Filter the query by a related \FormsAPI\Dashboard object
     *
     * @param \FormsAPI\Dashboard|ObjectCollection $dashboard The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDashboardElementQuery The current query, for fluid interface
     */
    public function filterByDashboard($dashboard, $comparison = null)
    {
        if ($dashboard instanceof \FormsAPI\Dashboard) {
            return $this
                ->addUsingAlias(DashboardElementTableMap::COL_DASHBOARD_ID, $dashboard->getId(), $comparison);
        } elseif ($dashboard instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DashboardElementTableMap::COL_DASHBOARD_ID, $dashboard->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDashboard() only accepts arguments of type \FormsAPI\Dashboard or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dashboard relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDashboardElementQuery The current query, for fluid interface
     */
    public function joinDashboard($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dashboard');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Dashboard');
        }

        return $this;
    }

    /**
     * Use the Dashboard relation Dashboard object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FormsAPI\DashboardQuery A secondary query class using the current class as primary query
     */
    public function useDashboardQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDashboard($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dashboard', '\FormsAPI\DashboardQuery');
    }

    /**
     * Filter the query by a related \FormsAPI\Element object
     *
     * @param \FormsAPI\Element|ObjectCollection $element The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDashboardElementQuery The current query, for fluid interface
     */
    public function filterByElement($element, $comparison = null)
    {
        if ($element instanceof \FormsAPI\Element) {
            return $this
                ->addUsingAlias(DashboardElementTableMap::COL_ELEMENT_ID, $element->getId(), $comparison);
        } elseif ($element instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DashboardElementTableMap::COL_ELEMENT_ID, $element->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByElement() only accepts arguments of type \FormsAPI\Element or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Element relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDashboardElementQuery The current query, for fluid interface
     */
    public function joinElement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Element');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Element');
        }

        return $this;
    }

    /**
     * Use the Element relation Element object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FormsAPI\ElementQuery A secondary query class using the current class as primary query
     */
    public function useElementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinElement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Element', '\FormsAPI\ElementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDashboardElement $dashboardElement Object to remove from the list of results
     *
     * @return $this|ChildDashboardElementQuery The current query, for fluid interface
     */
    public function prune($dashboardElement = null)
    {
        if ($dashboardElement) {
            $this->addUsingAlias(DashboardElementTableMap::COL_ID, $dashboardElement->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dashboard_element table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DashboardElementTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DashboardElementTableMap::clearInstancePool();
            DashboardElementTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DashboardElementTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DashboardElementTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DashboardElementTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DashboardElementTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DashboardElementQuery
