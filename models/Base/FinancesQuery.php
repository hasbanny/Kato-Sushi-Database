<?php

namespace Base;

use \Finances as ChildFinances;
use \FinancesQuery as ChildFinancesQuery;
use \Exception;
use Map\FinancesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'finances' table.
 *
 *
 *
 * @method     ChildFinancesQuery orderByInvoices($order = Criteria::ASC) Order by the invoices column
 * @method     ChildFinancesQuery orderByBills($order = Criteria::ASC) Order by the bills column
 * @method     ChildFinancesQuery orderByPaidBy($order = Criteria::ASC) Order by the paid_by column
 * @method     ChildFinancesQuery orderByPayroll($order = Criteria::ASC) Order by the payroll column
 * @method     ChildFinancesQuery orderByDueOn($order = Criteria::ASC) Order by the due_on column
 *
 * @method     ChildFinancesQuery groupByInvoices() Group by the invoices column
 * @method     ChildFinancesQuery groupByBills() Group by the bills column
 * @method     ChildFinancesQuery groupByPaidBy() Group by the paid_by column
 * @method     ChildFinancesQuery groupByPayroll() Group by the payroll column
 * @method     ChildFinancesQuery groupByDueOn() Group by the due_on column
 *
 * @method     ChildFinancesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFinancesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFinancesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFinancesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFinancesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFinancesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFinancesQuery leftJoinOwner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Owner relation
 * @method     ChildFinancesQuery rightJoinOwner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Owner relation
 * @method     ChildFinancesQuery innerJoinOwner($relationAlias = null) Adds a INNER JOIN clause to the query using the Owner relation
 *
 * @method     ChildFinancesQuery joinWithOwner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Owner relation
 *
 * @method     ChildFinancesQuery leftJoinWithOwner() Adds a LEFT JOIN clause and with to the query using the Owner relation
 * @method     ChildFinancesQuery rightJoinWithOwner() Adds a RIGHT JOIN clause and with to the query using the Owner relation
 * @method     ChildFinancesQuery innerJoinWithOwner() Adds a INNER JOIN clause and with to the query using the Owner relation
 *
 * @method     \OwnerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFinances findOne(ConnectionInterface $con = null) Return the first ChildFinances matching the query
 * @method     ChildFinances findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFinances matching the query, or a new ChildFinances object populated from the query conditions when no match is found
 *
 * @method     ChildFinances findOneByInvoices(int $invoices) Return the first ChildFinances filtered by the invoices column
 * @method     ChildFinances findOneByBills(int $bills) Return the first ChildFinances filtered by the bills column
 * @method     ChildFinances findOneByPaidBy(int $paid_by) Return the first ChildFinances filtered by the paid_by column
 * @method     ChildFinances findOneByPayroll(int $payroll) Return the first ChildFinances filtered by the payroll column
 * @method     ChildFinances findOneByDueOn(string $due_on) Return the first ChildFinances filtered by the due_on column *

 * @method     ChildFinances requirePk($key, ConnectionInterface $con = null) Return the ChildFinances by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinances requireOne(ConnectionInterface $con = null) Return the first ChildFinances matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFinances requireOneByInvoices(int $invoices) Return the first ChildFinances filtered by the invoices column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinances requireOneByBills(int $bills) Return the first ChildFinances filtered by the bills column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinances requireOneByPaidBy(int $paid_by) Return the first ChildFinances filtered by the paid_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinances requireOneByPayroll(int $payroll) Return the first ChildFinances filtered by the payroll column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinances requireOneByDueOn(string $due_on) Return the first ChildFinances filtered by the due_on column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFinances[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFinances objects based on current ModelCriteria
 * @method     ChildFinances[]|ObjectCollection findByInvoices(int $invoices) Return ChildFinances objects filtered by the invoices column
 * @method     ChildFinances[]|ObjectCollection findByBills(int $bills) Return ChildFinances objects filtered by the bills column
 * @method     ChildFinances[]|ObjectCollection findByPaidBy(int $paid_by) Return ChildFinances objects filtered by the paid_by column
 * @method     ChildFinances[]|ObjectCollection findByPayroll(int $payroll) Return ChildFinances objects filtered by the payroll column
 * @method     ChildFinances[]|ObjectCollection findByDueOn(string $due_on) Return ChildFinances objects filtered by the due_on column
 * @method     ChildFinances[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FinancesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\FinancesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Finances', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFinancesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFinancesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFinancesQuery) {
            return $criteria;
        }
        $query = new ChildFinancesQuery();
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
     * @return ChildFinances|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The Finances object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        throw new LogicException('The Finances object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildFinancesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The Finances object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFinancesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The Finances object has no primary key');
    }

    /**
     * Filter the query on the invoices column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoices(1234); // WHERE invoices = 1234
     * $query->filterByInvoices(array(12, 34)); // WHERE invoices IN (12, 34)
     * $query->filterByInvoices(array('min' => 12)); // WHERE invoices > 12
     * </code>
     *
     * @param     mixed $invoices The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinancesQuery The current query, for fluid interface
     */
    public function filterByInvoices($invoices = null, $comparison = null)
    {
        if (is_array($invoices)) {
            $useMinMax = false;
            if (isset($invoices['min'])) {
                $this->addUsingAlias(FinancesTableMap::COL_INVOICES, $invoices['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($invoices['max'])) {
                $this->addUsingAlias(FinancesTableMap::COL_INVOICES, $invoices['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinancesTableMap::COL_INVOICES, $invoices, $comparison);
    }

    /**
     * Filter the query on the bills column
     *
     * Example usage:
     * <code>
     * $query->filterByBills(1234); // WHERE bills = 1234
     * $query->filterByBills(array(12, 34)); // WHERE bills IN (12, 34)
     * $query->filterByBills(array('min' => 12)); // WHERE bills > 12
     * </code>
     *
     * @param     mixed $bills The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinancesQuery The current query, for fluid interface
     */
    public function filterByBills($bills = null, $comparison = null)
    {
        if (is_array($bills)) {
            $useMinMax = false;
            if (isset($bills['min'])) {
                $this->addUsingAlias(FinancesTableMap::COL_BILLS, $bills['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bills['max'])) {
                $this->addUsingAlias(FinancesTableMap::COL_BILLS, $bills['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinancesTableMap::COL_BILLS, $bills, $comparison);
    }

    /**
     * Filter the query on the paid_by column
     *
     * Example usage:
     * <code>
     * $query->filterByPaidBy(1234); // WHERE paid_by = 1234
     * $query->filterByPaidBy(array(12, 34)); // WHERE paid_by IN (12, 34)
     * $query->filterByPaidBy(array('min' => 12)); // WHERE paid_by > 12
     * </code>
     *
     * @see       filterByOwner()
     *
     * @param     mixed $paidBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinancesQuery The current query, for fluid interface
     */
    public function filterByPaidBy($paidBy = null, $comparison = null)
    {
        if (is_array($paidBy)) {
            $useMinMax = false;
            if (isset($paidBy['min'])) {
                $this->addUsingAlias(FinancesTableMap::COL_PAID_BY, $paidBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paidBy['max'])) {
                $this->addUsingAlias(FinancesTableMap::COL_PAID_BY, $paidBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinancesTableMap::COL_PAID_BY, $paidBy, $comparison);
    }

    /**
     * Filter the query on the payroll column
     *
     * Example usage:
     * <code>
     * $query->filterByPayroll(1234); // WHERE payroll = 1234
     * $query->filterByPayroll(array(12, 34)); // WHERE payroll IN (12, 34)
     * $query->filterByPayroll(array('min' => 12)); // WHERE payroll > 12
     * </code>
     *
     * @param     mixed $payroll The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinancesQuery The current query, for fluid interface
     */
    public function filterByPayroll($payroll = null, $comparison = null)
    {
        if (is_array($payroll)) {
            $useMinMax = false;
            if (isset($payroll['min'])) {
                $this->addUsingAlias(FinancesTableMap::COL_PAYROLL, $payroll['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($payroll['max'])) {
                $this->addUsingAlias(FinancesTableMap::COL_PAYROLL, $payroll['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinancesTableMap::COL_PAYROLL, $payroll, $comparison);
    }

    /**
     * Filter the query on the due_on column
     *
     * Example usage:
     * <code>
     * $query->filterByDueOn('2011-03-14'); // WHERE due_on = '2011-03-14'
     * $query->filterByDueOn('now'); // WHERE due_on = '2011-03-14'
     * $query->filterByDueOn(array('max' => 'yesterday')); // WHERE due_on > '2011-03-13'
     * </code>
     *
     * @param     mixed $dueOn The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFinancesQuery The current query, for fluid interface
     */
    public function filterByDueOn($dueOn = null, $comparison = null)
    {
        if (is_array($dueOn)) {
            $useMinMax = false;
            if (isset($dueOn['min'])) {
                $this->addUsingAlias(FinancesTableMap::COL_DUE_ON, $dueOn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dueOn['max'])) {
                $this->addUsingAlias(FinancesTableMap::COL_DUE_ON, $dueOn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinancesTableMap::COL_DUE_ON, $dueOn, $comparison);
    }

    /**
     * Filter the query by a related \Owner object
     *
     * @param \Owner|ObjectCollection $owner The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFinancesQuery The current query, for fluid interface
     */
    public function filterByOwner($owner, $comparison = null)
    {
        if ($owner instanceof \Owner) {
            return $this
                ->addUsingAlias(FinancesTableMap::COL_PAID_BY, $owner->getOwnerId(), $comparison);
        } elseif ($owner instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FinancesTableMap::COL_PAID_BY, $owner->toKeyValue('PrimaryKey', 'OwnerId'), $comparison);
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
     * @return $this|ChildFinancesQuery The current query, for fluid interface
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
     * @param   ChildFinances $finances Object to remove from the list of results
     *
     * @return $this|ChildFinancesQuery The current query, for fluid interface
     */
    public function prune($finances = null)
    {
        if ($finances) {
            throw new LogicException('Finances object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the finances table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FinancesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FinancesTableMap::clearInstancePool();
            FinancesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FinancesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FinancesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FinancesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FinancesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FinancesQuery
