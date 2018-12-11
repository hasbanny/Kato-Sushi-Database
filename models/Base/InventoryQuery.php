<?php

namespace Base;

use \Inventory as ChildInventory;
use \InventoryQuery as ChildInventoryQuery;
use \Exception;
use \PDO;
use Map\InventoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'inventory' table.
 *
 *
 *
 * @method     ChildInventoryQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildInventoryQuery orderByItemName($order = Criteria::ASC) Order by the item_name column
 * @method     ChildInventoryQuery orderBySuppliedBy($order = Criteria::ASC) Order by the supplied_by column
 * @method     ChildInventoryQuery orderByShipDate($order = Criteria::ASC) Order by the ship_date column
 * @method     ChildInventoryQuery orderByInStock($order = Criteria::ASC) Order by the in_stock column
 * @method     ChildInventoryQuery orderByDoneBy($order = Criteria::ASC) Order by the done_by column
 *
 * @method     ChildInventoryQuery groupByItemId() Group by the item_id column
 * @method     ChildInventoryQuery groupByItemName() Group by the item_name column
 * @method     ChildInventoryQuery groupBySuppliedBy() Group by the supplied_by column
 * @method     ChildInventoryQuery groupByShipDate() Group by the ship_date column
 * @method     ChildInventoryQuery groupByInStock() Group by the in_stock column
 * @method     ChildInventoryQuery groupByDoneBy() Group by the done_by column
 *
 * @method     ChildInventoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInventoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInventoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInventoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildInventoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildInventoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildInventoryQuery leftJoinSupplier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Supplier relation
 * @method     ChildInventoryQuery rightJoinSupplier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Supplier relation
 * @method     ChildInventoryQuery innerJoinSupplier($relationAlias = null) Adds a INNER JOIN clause to the query using the Supplier relation
 *
 * @method     ChildInventoryQuery joinWithSupplier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Supplier relation
 *
 * @method     ChildInventoryQuery leftJoinWithSupplier() Adds a LEFT JOIN clause and with to the query using the Supplier relation
 * @method     ChildInventoryQuery rightJoinWithSupplier() Adds a RIGHT JOIN clause and with to the query using the Supplier relation
 * @method     ChildInventoryQuery innerJoinWithSupplier() Adds a INNER JOIN clause and with to the query using the Supplier relation
 *
 * @method     ChildInventoryQuery leftJoinOwner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Owner relation
 * @method     ChildInventoryQuery rightJoinOwner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Owner relation
 * @method     ChildInventoryQuery innerJoinOwner($relationAlias = null) Adds a INNER JOIN clause to the query using the Owner relation
 *
 * @method     ChildInventoryQuery joinWithOwner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Owner relation
 *
 * @method     ChildInventoryQuery leftJoinWithOwner() Adds a LEFT JOIN clause and with to the query using the Owner relation
 * @method     ChildInventoryQuery rightJoinWithOwner() Adds a RIGHT JOIN clause and with to the query using the Owner relation
 * @method     ChildInventoryQuery innerJoinWithOwner() Adds a INNER JOIN clause and with to the query using the Owner relation
 *
 * @method     \SupplierQuery|\OwnerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildInventory findOne(ConnectionInterface $con = null) Return the first ChildInventory matching the query
 * @method     ChildInventory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInventory matching the query, or a new ChildInventory object populated from the query conditions when no match is found
 *
 * @method     ChildInventory findOneByItemId(int $item_id) Return the first ChildInventory filtered by the item_id column
 * @method     ChildInventory findOneByItemName(string $item_name) Return the first ChildInventory filtered by the item_name column
 * @method     ChildInventory findOneBySuppliedBy(int $supplied_by) Return the first ChildInventory filtered by the supplied_by column
 * @method     ChildInventory findOneByShipDate(string $ship_date) Return the first ChildInventory filtered by the ship_date column
 * @method     ChildInventory findOneByInStock(int $in_stock) Return the first ChildInventory filtered by the in_stock column
 * @method     ChildInventory findOneByDoneBy(int $done_by) Return the first ChildInventory filtered by the done_by column *

 * @method     ChildInventory requirePk($key, ConnectionInterface $con = null) Return the ChildInventory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOne(ConnectionInterface $con = null) Return the first ChildInventory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInventory requireOneByItemId(int $item_id) Return the first ChildInventory filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByItemName(string $item_name) Return the first ChildInventory filtered by the item_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneBySuppliedBy(int $supplied_by) Return the first ChildInventory filtered by the supplied_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByShipDate(string $ship_date) Return the first ChildInventory filtered by the ship_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByInStock(int $in_stock) Return the first ChildInventory filtered by the in_stock column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByDoneBy(int $done_by) Return the first ChildInventory filtered by the done_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInventory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildInventory objects based on current ModelCriteria
 * @method     ChildInventory[]|ObjectCollection findByItemId(int $item_id) Return ChildInventory objects filtered by the item_id column
 * @method     ChildInventory[]|ObjectCollection findByItemName(string $item_name) Return ChildInventory objects filtered by the item_name column
 * @method     ChildInventory[]|ObjectCollection findBySuppliedBy(int $supplied_by) Return ChildInventory objects filtered by the supplied_by column
 * @method     ChildInventory[]|ObjectCollection findByShipDate(string $ship_date) Return ChildInventory objects filtered by the ship_date column
 * @method     ChildInventory[]|ObjectCollection findByInStock(int $in_stock) Return ChildInventory objects filtered by the in_stock column
 * @method     ChildInventory[]|ObjectCollection findByDoneBy(int $done_by) Return ChildInventory objects filtered by the done_by column
 * @method     ChildInventory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class InventoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\InventoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Inventory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInventoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInventoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildInventoryQuery) {
            return $criteria;
        }
        $query = new ChildInventoryQuery();
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
     * @return ChildInventory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InventoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = InventoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildInventory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT item_id, item_name, supplied_by, ship_date, in_stock, done_by FROM inventory WHERE item_id = :p0';
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
            /** @var ChildInventory $obj */
            $obj = new ChildInventory();
            $obj->hydrate($row);
            InventoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildInventory|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InventoryTableMap::COL_ITEM_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InventoryTableMap::COL_ITEM_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByItemId(1234); // WHERE item_id = 1234
     * $query->filterByItemId(array(12, 34)); // WHERE item_id IN (12, 34)
     * $query->filterByItemId(array('min' => 12)); // WHERE item_id > 12
     * </code>
     *
     * @param     mixed $itemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(InventoryTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(InventoryTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_ITEM_ID, $itemId, $comparison);
    }

    /**
     * Filter the query on the item_name column
     *
     * Example usage:
     * <code>
     * $query->filterByItemName('fooValue');   // WHERE item_name = 'fooValue'
     * $query->filterByItemName('%fooValue%', Criteria::LIKE); // WHERE item_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $itemName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByItemName($itemName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($itemName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_ITEM_NAME, $itemName, $comparison);
    }

    /**
     * Filter the query on the supplied_by column
     *
     * Example usage:
     * <code>
     * $query->filterBySuppliedBy(1234); // WHERE supplied_by = 1234
     * $query->filterBySuppliedBy(array(12, 34)); // WHERE supplied_by IN (12, 34)
     * $query->filterBySuppliedBy(array('min' => 12)); // WHERE supplied_by > 12
     * </code>
     *
     * @see       filterBySupplier()
     *
     * @param     mixed $suppliedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterBySuppliedBy($suppliedBy = null, $comparison = null)
    {
        if (is_array($suppliedBy)) {
            $useMinMax = false;
            if (isset($suppliedBy['min'])) {
                $this->addUsingAlias(InventoryTableMap::COL_SUPPLIED_BY, $suppliedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($suppliedBy['max'])) {
                $this->addUsingAlias(InventoryTableMap::COL_SUPPLIED_BY, $suppliedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_SUPPLIED_BY, $suppliedBy, $comparison);
    }

    /**
     * Filter the query on the ship_date column
     *
     * Example usage:
     * <code>
     * $query->filterByShipDate('2011-03-14'); // WHERE ship_date = '2011-03-14'
     * $query->filterByShipDate('now'); // WHERE ship_date = '2011-03-14'
     * $query->filterByShipDate(array('max' => 'yesterday')); // WHERE ship_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $shipDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByShipDate($shipDate = null, $comparison = null)
    {
        if (is_array($shipDate)) {
            $useMinMax = false;
            if (isset($shipDate['min'])) {
                $this->addUsingAlias(InventoryTableMap::COL_SHIP_DATE, $shipDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shipDate['max'])) {
                $this->addUsingAlias(InventoryTableMap::COL_SHIP_DATE, $shipDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_SHIP_DATE, $shipDate, $comparison);
    }

    /**
     * Filter the query on the in_stock column
     *
     * Example usage:
     * <code>
     * $query->filterByInStock(1234); // WHERE in_stock = 1234
     * $query->filterByInStock(array(12, 34)); // WHERE in_stock IN (12, 34)
     * $query->filterByInStock(array('min' => 12)); // WHERE in_stock > 12
     * </code>
     *
     * @param     mixed $inStock The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByInStock($inStock = null, $comparison = null)
    {
        if (is_array($inStock)) {
            $useMinMax = false;
            if (isset($inStock['min'])) {
                $this->addUsingAlias(InventoryTableMap::COL_IN_STOCK, $inStock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($inStock['max'])) {
                $this->addUsingAlias(InventoryTableMap::COL_IN_STOCK, $inStock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_IN_STOCK, $inStock, $comparison);
    }

    /**
     * Filter the query on the done_by column
     *
     * Example usage:
     * <code>
     * $query->filterByDoneBy(1234); // WHERE done_by = 1234
     * $query->filterByDoneBy(array(12, 34)); // WHERE done_by IN (12, 34)
     * $query->filterByDoneBy(array('min' => 12)); // WHERE done_by > 12
     * </code>
     *
     * @see       filterByOwner()
     *
     * @param     mixed $doneBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByDoneBy($doneBy = null, $comparison = null)
    {
        if (is_array($doneBy)) {
            $useMinMax = false;
            if (isset($doneBy['min'])) {
                $this->addUsingAlias(InventoryTableMap::COL_DONE_BY, $doneBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($doneBy['max'])) {
                $this->addUsingAlias(InventoryTableMap::COL_DONE_BY, $doneBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_DONE_BY, $doneBy, $comparison);
    }

    /**
     * Filter the query by a related \Supplier object
     *
     * @param \Supplier|ObjectCollection $supplier The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInventoryQuery The current query, for fluid interface
     */
    public function filterBySupplier($supplier, $comparison = null)
    {
        if ($supplier instanceof \Supplier) {
            return $this
                ->addUsingAlias(InventoryTableMap::COL_SUPPLIED_BY, $supplier->getSupId(), $comparison);
        } elseif ($supplier instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InventoryTableMap::COL_SUPPLIED_BY, $supplier->toKeyValue('PrimaryKey', 'SupId'), $comparison);
        } else {
            throw new PropelException('filterBySupplier() only accepts arguments of type \Supplier or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Supplier relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function joinSupplier($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Supplier');

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
            $this->addJoinObject($join, 'Supplier');
        }

        return $this;
    }

    /**
     * Use the Supplier relation Supplier object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SupplierQuery A secondary query class using the current class as primary query
     */
    public function useSupplierQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSupplier($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Supplier', '\SupplierQuery');
    }

    /**
     * Filter the query by a related \Owner object
     *
     * @param \Owner|ObjectCollection $owner The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByOwner($owner, $comparison = null)
    {
        if ($owner instanceof \Owner) {
            return $this
                ->addUsingAlias(InventoryTableMap::COL_DONE_BY, $owner->getOwnerId(), $comparison);
        } elseif ($owner instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InventoryTableMap::COL_DONE_BY, $owner->toKeyValue('PrimaryKey', 'OwnerId'), $comparison);
        } else {
            throw new PropelException('filterByOwner() only accepts arguments of type \Owner or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Owner relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function joinOwner($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Owner');

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
            $this->addJoinObject($join, 'Owner');
        }

        return $this;
    }

    /**
     * Use the Owner relation Owner object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OwnerQuery A secondary query class using the current class as primary query
     */
    public function useOwnerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOwner($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Owner', '\OwnerQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildInventory $inventory Object to remove from the list of results
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function prune($inventory = null)
    {
        if ($inventory) {
            $this->addUsingAlias(InventoryTableMap::COL_ITEM_ID, $inventory->getItemId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the inventory table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InventoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InventoryTableMap::clearInstancePool();
            InventoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(InventoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InventoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            InventoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            InventoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // InventoryQuery
