<?php

namespace FormsAPI\Base;

use \Exception;
use \PDO;
use FormsAPI\Element as ChildElement;
use FormsAPI\ElementQuery as ChildElementQuery;
use FormsAPI\Map\ElementTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'element' table.
 *
 *
 *
 * @method     ChildElementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildElementQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildElementQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method     ChildElementQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildElementQuery orderByAdministrative($order = Criteria::ASC) Order by the administrative column
 * @method     ChildElementQuery orderByShortName($order = Criteria::ASC) Order by the short_name column
 * @method     ChildElementQuery orderByInitialValue($order = Criteria::ASC) Order by the initial_value column
 * @method     ChildElementQuery orderByHelpText($order = Criteria::ASC) Order by the help_text column
 * @method     ChildElementQuery orderByPlaceholderText($order = Criteria::ASC) Order by the placeholder_text column
 * @method     ChildElementQuery orderByChoices($order = Criteria::ASC) Order by the choices column
 * @method     ChildElementQuery orderByDependentUpon($order = Criteria::ASC) Order by the dependent_upon column
 * @method     ChildElementQuery orderByRequired($order = Criteria::ASC) Order by the required column
 * @method     ChildElementQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 *
 * @method     ChildElementQuery groupById() Group by the id column
 * @method     ChildElementQuery groupByType() Group by the type column
 * @method     ChildElementQuery groupByLabel() Group by the label column
 * @method     ChildElementQuery groupByActive() Group by the active column
 * @method     ChildElementQuery groupByAdministrative() Group by the administrative column
 * @method     ChildElementQuery groupByShortName() Group by the short_name column
 * @method     ChildElementQuery groupByInitialValue() Group by the initial_value column
 * @method     ChildElementQuery groupByHelpText() Group by the help_text column
 * @method     ChildElementQuery groupByPlaceholderText() Group by the placeholder_text column
 * @method     ChildElementQuery groupByChoices() Group by the choices column
 * @method     ChildElementQuery groupByDependentUpon() Group by the dependent_upon column
 * @method     ChildElementQuery groupByRequired() Group by the required column
 * @method     ChildElementQuery groupByParentId() Group by the parent_id column
 *
 * @method     ChildElementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildElementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildElementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildElementQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildElementQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildElementQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildElementQuery leftJoinElementRelatedByParentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the ElementRelatedByParentId relation
 * @method     ChildElementQuery rightJoinElementRelatedByParentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ElementRelatedByParentId relation
 * @method     ChildElementQuery innerJoinElementRelatedByParentId($relationAlias = null) Adds a INNER JOIN clause to the query using the ElementRelatedByParentId relation
 *
 * @method     ChildElementQuery joinWithElementRelatedByParentId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ElementRelatedByParentId relation
 *
 * @method     ChildElementQuery leftJoinWithElementRelatedByParentId() Adds a LEFT JOIN clause and with to the query using the ElementRelatedByParentId relation
 * @method     ChildElementQuery rightJoinWithElementRelatedByParentId() Adds a RIGHT JOIN clause and with to the query using the ElementRelatedByParentId relation
 * @method     ChildElementQuery innerJoinWithElementRelatedByParentId() Adds a INNER JOIN clause and with to the query using the ElementRelatedByParentId relation
 *
 * @method     ChildElementQuery leftJoinParent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Parent relation
 * @method     ChildElementQuery rightJoinParent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Parent relation
 * @method     ChildElementQuery innerJoinParent($relationAlias = null) Adds a INNER JOIN clause to the query using the Parent relation
 *
 * @method     ChildElementQuery joinWithParent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Parent relation
 *
 * @method     ChildElementQuery leftJoinWithParent() Adds a LEFT JOIN clause and with to the query using the Parent relation
 * @method     ChildElementQuery rightJoinWithParent() Adds a RIGHT JOIN clause and with to the query using the Parent relation
 * @method     ChildElementQuery innerJoinWithParent() Adds a INNER JOIN clause and with to the query using the Parent relation
 *
 * @method     ChildElementQuery leftJoinRootElement($relationAlias = null) Adds a LEFT JOIN clause to the query using the RootElement relation
 * @method     ChildElementQuery rightJoinRootElement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RootElement relation
 * @method     ChildElementQuery innerJoinRootElement($relationAlias = null) Adds a INNER JOIN clause to the query using the RootElement relation
 *
 * @method     ChildElementQuery joinWithRootElement($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RootElement relation
 *
 * @method     ChildElementQuery leftJoinWithRootElement() Adds a LEFT JOIN clause and with to the query using the RootElement relation
 * @method     ChildElementQuery rightJoinWithRootElement() Adds a RIGHT JOIN clause and with to the query using the RootElement relation
 * @method     ChildElementQuery innerJoinWithRootElement() Adds a INNER JOIN clause and with to the query using the RootElement relation
 *
 * @method     \FormsAPI\ElementQuery|\FormsAPI\FormQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildElement findOne(ConnectionInterface $con = null) Return the first ChildElement matching the query
 * @method     ChildElement findOneOrCreate(ConnectionInterface $con = null) Return the first ChildElement matching the query, or a new ChildElement object populated from the query conditions when no match is found
 *
 * @method     ChildElement findOneById(int $id) Return the first ChildElement filtered by the id column
 * @method     ChildElement findOneByType(string $type) Return the first ChildElement filtered by the type column
 * @method     ChildElement findOneByLabel(string $label) Return the first ChildElement filtered by the label column
 * @method     ChildElement findOneByActive(boolean $active) Return the first ChildElement filtered by the active column
 * @method     ChildElement findOneByAdministrative(boolean $administrative) Return the first ChildElement filtered by the administrative column
 * @method     ChildElement findOneByShortName(string $short_name) Return the first ChildElement filtered by the short_name column
 * @method     ChildElement findOneByInitialValue(string $initial_value) Return the first ChildElement filtered by the initial_value column
 * @method     ChildElement findOneByHelpText(string $help_text) Return the first ChildElement filtered by the help_text column
 * @method     ChildElement findOneByPlaceholderText(string $placeholder_text) Return the first ChildElement filtered by the placeholder_text column
 * @method     ChildElement findOneByChoices(string $choices) Return the first ChildElement filtered by the choices column
 * @method     ChildElement findOneByDependentUpon(string $dependent_upon) Return the first ChildElement filtered by the dependent_upon column
 * @method     ChildElement findOneByRequired(boolean $required) Return the first ChildElement filtered by the required column
 * @method     ChildElement findOneByParentId(int $parent_id) Return the first ChildElement filtered by the parent_id column *

 * @method     ChildElement requirePk($key, ConnectionInterface $con = null) Return the ChildElement by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOne(ConnectionInterface $con = null) Return the first ChildElement matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElement requireOneById(int $id) Return the first ChildElement filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByType(string $type) Return the first ChildElement filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByLabel(string $label) Return the first ChildElement filtered by the label column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByActive(boolean $active) Return the first ChildElement filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByAdministrative(boolean $administrative) Return the first ChildElement filtered by the administrative column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByShortName(string $short_name) Return the first ChildElement filtered by the short_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByInitialValue(string $initial_value) Return the first ChildElement filtered by the initial_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByHelpText(string $help_text) Return the first ChildElement filtered by the help_text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByPlaceholderText(string $placeholder_text) Return the first ChildElement filtered by the placeholder_text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByChoices(string $choices) Return the first ChildElement filtered by the choices column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByDependentUpon(string $dependent_upon) Return the first ChildElement filtered by the dependent_upon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByRequired(boolean $required) Return the first ChildElement filtered by the required column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElement requireOneByParentId(int $parent_id) Return the first ChildElement filtered by the parent_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElement[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildElement objects based on current ModelCriteria
 * @method     ChildElement[]|ObjectCollection findById(int $id) Return ChildElement objects filtered by the id column
 * @method     ChildElement[]|ObjectCollection findByType(string $type) Return ChildElement objects filtered by the type column
 * @method     ChildElement[]|ObjectCollection findByLabel(string $label) Return ChildElement objects filtered by the label column
 * @method     ChildElement[]|ObjectCollection findByActive(boolean $active) Return ChildElement objects filtered by the active column
 * @method     ChildElement[]|ObjectCollection findByAdministrative(boolean $administrative) Return ChildElement objects filtered by the administrative column
 * @method     ChildElement[]|ObjectCollection findByShortName(string $short_name) Return ChildElement objects filtered by the short_name column
 * @method     ChildElement[]|ObjectCollection findByInitialValue(string $initial_value) Return ChildElement objects filtered by the initial_value column
 * @method     ChildElement[]|ObjectCollection findByHelpText(string $help_text) Return ChildElement objects filtered by the help_text column
 * @method     ChildElement[]|ObjectCollection findByPlaceholderText(string $placeholder_text) Return ChildElement objects filtered by the placeholder_text column
 * @method     ChildElement[]|ObjectCollection findByChoices(string $choices) Return ChildElement objects filtered by the choices column
 * @method     ChildElement[]|ObjectCollection findByDependentUpon(string $dependent_upon) Return ChildElement objects filtered by the dependent_upon column
 * @method     ChildElement[]|ObjectCollection findByRequired(boolean $required) Return ChildElement objects filtered by the required column
 * @method     ChildElement[]|ObjectCollection findByParentId(int $parent_id) Return ChildElement objects filtered by the parent_id column
 * @method     ChildElement[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ElementQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \FormsAPI\Base\ElementQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\FormsAPI\\Element', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildElementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildElementQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildElementQuery) {
            return $criteria;
        }
        $query = new ChildElementQuery();
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
     * @return ChildElement|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ElementTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ElementTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildElement A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, type, label, active, administrative, short_name, initial_value, help_text, placeholder_text, choices, dependent_upon, required, parent_id FROM element WHERE id = :p0';
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
            /** @var ChildElement $obj */
            $obj = new ChildElement();
            $obj->hydrate($row);
            ElementTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildElement|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ElementTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ElementTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ElementTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ElementTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElementTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElementTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the label column
     *
     * Example usage:
     * <code>
     * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
     * $query->filterByLabel('%fooValue%', Criteria::LIKE); // WHERE label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $label The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByLabel($label = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($label)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElementTableMap::COL_LABEL, $label, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ElementTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the administrative column
     *
     * Example usage:
     * <code>
     * $query->filterByAdministrative(true); // WHERE administrative = true
     * $query->filterByAdministrative('yes'); // WHERE administrative = true
     * </code>
     *
     * @param     boolean|string $administrative The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByAdministrative($administrative = null, $comparison = null)
    {
        if (is_string($administrative)) {
            $administrative = in_array(strtolower($administrative), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ElementTableMap::COL_ADMINISTRATIVE, $administrative, $comparison);
    }

    /**
     * Filter the query on the short_name column
     *
     * Example usage:
     * <code>
     * $query->filterByShortName('fooValue');   // WHERE short_name = 'fooValue'
     * $query->filterByShortName('%fooValue%', Criteria::LIKE); // WHERE short_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shortName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByShortName($shortName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shortName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElementTableMap::COL_SHORT_NAME, $shortName, $comparison);
    }

    /**
     * Filter the query on the initial_value column
     *
     * Example usage:
     * <code>
     * $query->filterByInitialValue('fooValue');   // WHERE initial_value = 'fooValue'
     * $query->filterByInitialValue('%fooValue%', Criteria::LIKE); // WHERE initial_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $initialValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByInitialValue($initialValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($initialValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElementTableMap::COL_INITIAL_VALUE, $initialValue, $comparison);
    }

    /**
     * Filter the query on the help_text column
     *
     * Example usage:
     * <code>
     * $query->filterByHelpText('fooValue');   // WHERE help_text = 'fooValue'
     * $query->filterByHelpText('%fooValue%', Criteria::LIKE); // WHERE help_text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $helpText The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByHelpText($helpText = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($helpText)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElementTableMap::COL_HELP_TEXT, $helpText, $comparison);
    }

    /**
     * Filter the query on the placeholder_text column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaceholderText('fooValue');   // WHERE placeholder_text = 'fooValue'
     * $query->filterByPlaceholderText('%fooValue%', Criteria::LIKE); // WHERE placeholder_text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $placeholderText The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByPlaceholderText($placeholderText = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($placeholderText)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElementTableMap::COL_PLACEHOLDER_TEXT, $placeholderText, $comparison);
    }

    /**
     * Filter the query on the choices column
     *
     * Example usage:
     * <code>
     * $query->filterByChoices('fooValue');   // WHERE choices = 'fooValue'
     * $query->filterByChoices('%fooValue%', Criteria::LIKE); // WHERE choices LIKE '%fooValue%'
     * </code>
     *
     * @param     string $choices The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByChoices($choices = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($choices)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElementTableMap::COL_CHOICES, $choices, $comparison);
    }

    /**
     * Filter the query on the dependent_upon column
     *
     * Example usage:
     * <code>
     * $query->filterByDependentUpon('fooValue');   // WHERE dependent_upon = 'fooValue'
     * $query->filterByDependentUpon('%fooValue%', Criteria::LIKE); // WHERE dependent_upon LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dependentUpon The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByDependentUpon($dependentUpon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dependentUpon)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElementTableMap::COL_DEPENDENT_UPON, $dependentUpon, $comparison);
    }

    /**
     * Filter the query on the required column
     *
     * Example usage:
     * <code>
     * $query->filterByRequired(true); // WHERE required = true
     * $query->filterByRequired('yes'); // WHERE required = true
     * </code>
     *
     * @param     boolean|string $required The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByRequired($required = null, $comparison = null)
    {
        if (is_string($required)) {
            $required = in_array(strtolower($required), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ElementTableMap::COL_REQUIRED, $required, $comparison);
    }

    /**
     * Filter the query on the parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParentId(1234); // WHERE parent_id = 1234
     * $query->filterByParentId(array(12, 34)); // WHERE parent_id IN (12, 34)
     * $query->filterByParentId(array('min' => 12)); // WHERE parent_id > 12
     * </code>
     *
     * @see       filterByElementRelatedByParentId()
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(ElementTableMap::COL_PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(ElementTableMap::COL_PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElementTableMap::COL_PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query by a related \FormsAPI\Element object
     *
     * @param \FormsAPI\Element|ObjectCollection $element The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildElementQuery The current query, for fluid interface
     */
    public function filterByElementRelatedByParentId($element, $comparison = null)
    {
        if ($element instanceof \FormsAPI\Element) {
            return $this
                ->addUsingAlias(ElementTableMap::COL_PARENT_ID, $element->getId(), $comparison);
        } elseif ($element instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ElementTableMap::COL_PARENT_ID, $element->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByElementRelatedByParentId() only accepts arguments of type \FormsAPI\Element or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ElementRelatedByParentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function joinElementRelatedByParentId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ElementRelatedByParentId');

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
            $this->addJoinObject($join, 'ElementRelatedByParentId');
        }

        return $this;
    }

    /**
     * Use the ElementRelatedByParentId relation Element object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FormsAPI\ElementQuery A secondary query class using the current class as primary query
     */
    public function useElementRelatedByParentIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinElementRelatedByParentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ElementRelatedByParentId', '\FormsAPI\ElementQuery');
    }

    /**
     * Filter the query by a related \FormsAPI\Element object
     *
     * @param \FormsAPI\Element|ObjectCollection $element the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildElementQuery The current query, for fluid interface
     */
    public function filterByParent($element, $comparison = null)
    {
        if ($element instanceof \FormsAPI\Element) {
            return $this
                ->addUsingAlias(ElementTableMap::COL_ID, $element->getParentId(), $comparison);
        } elseif ($element instanceof ObjectCollection) {
            return $this
                ->useParentQuery()
                ->filterByPrimaryKeys($element->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByParent() only accepts arguments of type \FormsAPI\Element or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Parent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function joinParent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Parent');

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
            $this->addJoinObject($join, 'Parent');
        }

        return $this;
    }

    /**
     * Use the Parent relation Element object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FormsAPI\ElementQuery A secondary query class using the current class as primary query
     */
    public function useParentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinParent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Parent', '\FormsAPI\ElementQuery');
    }

    /**
     * Filter the query by a related \FormsAPI\Form object
     *
     * @param \FormsAPI\Form|ObjectCollection $form the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildElementQuery The current query, for fluid interface
     */
    public function filterByRootElement($form, $comparison = null)
    {
        if ($form instanceof \FormsAPI\Form) {
            return $this
                ->addUsingAlias(ElementTableMap::COL_ID, $form->getRootElementId(), $comparison);
        } elseif ($form instanceof ObjectCollection) {
            return $this
                ->useRootElementQuery()
                ->filterByPrimaryKeys($form->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRootElement() only accepts arguments of type \FormsAPI\Form or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RootElement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function joinRootElement($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RootElement');

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
            $this->addJoinObject($join, 'RootElement');
        }

        return $this;
    }

    /**
     * Use the RootElement relation Form object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FormsAPI\FormQuery A secondary query class using the current class as primary query
     */
    public function useRootElementQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRootElement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RootElement', '\FormsAPI\FormQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildElement $element Object to remove from the list of results
     *
     * @return $this|ChildElementQuery The current query, for fluid interface
     */
    public function prune($element = null)
    {
        if ($element) {
            $this->addUsingAlias(ElementTableMap::COL_ID, $element->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the element table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ElementTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ElementTableMap::clearInstancePool();
            ElementTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ElementTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ElementTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ElementTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ElementTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ElementQuery