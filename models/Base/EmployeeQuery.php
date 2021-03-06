<?php

namespace Base;

use \Employee as ChildEmployee;
use \EmployeeQuery as ChildEmployeeQuery;
use \Exception;
use \PDO;
use Map\EmployeeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'employee' table.
 *
 *
 *
 * @method     ChildEmployeeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildEmployeeQuery orderByEmpSsn($order = Criteria::ASC) Order by the emp_ssn column
 * @method     ChildEmployeeQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildEmployeeQuery orderByPhoneNum($order = Criteria::ASC) Order by the phone_num column
 * @method     ChildEmployeeQuery orderBySalary($order = Criteria::ASC) Order by the salary column
 * @method     ChildEmployeeQuery orderByJobTitle($order = Criteria::ASC) Order by the job_title column
 * @method     ChildEmployeeQuery orderByHiredBy($order = Criteria::ASC) Order by the hired_by column
 *
 * @method     ChildEmployeeQuery groupById() Group by the id column
 * @method     ChildEmployeeQuery groupByEmpSsn() Group by the emp_ssn column
 * @method     ChildEmployeeQuery groupByName() Group by the name column
 * @method     ChildEmployeeQuery groupByPhoneNum() Group by the phone_num column
 * @method     ChildEmployeeQuery groupBySalary() Group by the salary column
 * @method     ChildEmployeeQuery groupByJobTitle() Group by the job_title column
 * @method     ChildEmployeeQuery groupByHiredBy() Group by the hired_by column
 *
 * @method     ChildEmployeeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeQuery leftJoinOwner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Owner relation
 * @method     ChildEmployeeQuery rightJoinOwner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Owner relation
 * @method     ChildEmployeeQuery innerJoinOwner($relationAlias = null) Adds a INNER JOIN clause to the query using the Owner relation
 *
 * @method     ChildEmployeeQuery joinWithOwner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Owner relation
 *
 * @method     ChildEmployeeQuery leftJoinWithOwner() Adds a LEFT JOIN clause and with to the query using the Owner relation
 * @method     ChildEmployeeQuery rightJoinWithOwner() Adds a RIGHT JOIN clause and with to the query using the Owner relation
 * @method     ChildEmployeeQuery innerJoinWithOwner() Adds a INNER JOIN clause and with to the query using the Owner relation
 *
 * @method     \OwnerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployee findOne(ConnectionInterface $con = null) Return the first ChildEmployee matching the query
 * @method     ChildEmployee findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployee matching the query, or a new ChildEmployee object populated from the query conditions when no match is found
 *
 * @method     ChildEmployee findOneById(int $id) Return the first ChildEmployee filtered by the id column
 * @method     ChildEmployee findOneByEmpSsn(int $emp_ssn) Return the first ChildEmployee filtered by the emp_ssn column
 * @method     ChildEmployee findOneByName(string $name) Return the first ChildEmployee filtered by the name column
 * @method     ChildEmployee findOneByPhoneNum(string $phone_num) Return the first ChildEmployee filtered by the phone_num column
 * @method     ChildEmployee findOneBySalary(int $salary) Return the first ChildEmployee filtered by the salary column
 * @method     ChildEmployee findOneByJobTitle(string $job_title) Return the first ChildEmployee filtered by the job_title column
 * @method     ChildEmployee findOneByHiredBy(int $hired_by) Return the first ChildEmployee filtered by the hired_by column *

 * @method     ChildEmployee requirePk($key, ConnectionInterface $con = null) Return the ChildEmployee by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOne(ConnectionInterface $con = null) Return the first ChildEmployee matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployee requireOneById(int $id) Return the first ChildEmployee filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByEmpSsn(int $emp_ssn) Return the first ChildEmployee filtered by the emp_ssn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByName(string $name) Return the first ChildEmployee filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByPhoneNum(string $phone_num) Return the first ChildEmployee filtered by the phone_num column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneBySalary(int $salary) Return the first ChildEmployee filtered by the salary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByJobTitle(string $job_title) Return the first ChildEmployee filtered by the job_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByHiredBy(int $hired_by) Return the first ChildEmployee filtered by the hired_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployee[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployee objects based on current ModelCriteria
 * @method     ChildEmployee[]|ObjectCollection findById(int $id) Return ChildEmployee objects filtered by the id column
 * @method     ChildEmployee[]|ObjectCollection findByEmpSsn(int $emp_ssn) Return ChildEmployee objects filtered by the emp_ssn column
 * @method     ChildEmployee[]|ObjectCollection findByName(string $name) Return ChildEmployee objects filtered by the name column
 * @method     ChildEmployee[]|ObjectCollection findByPhoneNum(string $phone_num) Return ChildEmployee objects filtered by the phone_num column
 * @method     ChildEmployee[]|ObjectCollection findBySalary(int $salary) Return ChildEmployee objects filtered by the salary column
 * @method     ChildEmployee[]|ObjectCollection findByJobTitle(string $job_title) Return ChildEmployee objects filtered by the job_title column
 * @method     ChildEmployee[]|ObjectCollection findByHiredBy(int $hired_by) Return ChildEmployee objects filtered by the hired_by column
 * @method     ChildEmployee[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\EmployeeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Employee', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeeQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeQuery();
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
     * @return ChildEmployee|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployee A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, emp_ssn, name, phone_num, salary, job_title, hired_by FROM employee WHERE id = :p0';
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
            /** @var ChildEmployee $obj */
            $obj = new ChildEmployee();
            $obj->hydrate($row);
            EmployeeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployee|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the emp_ssn column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpSsn(1234); // WHERE emp_ssn = 1234
     * $query->filterByEmpSsn(array(12, 34)); // WHERE emp_ssn IN (12, 34)
     * $query->filterByEmpSsn(array('min' => 12)); // WHERE emp_ssn > 12
     * </code>
     *
     * @param     mixed $empSsn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByEmpSsn($empSsn = null, $comparison = null)
    {
        if (is_array($empSsn)) {
            $useMinMax = false;
            if (isset($empSsn['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_EMP_SSN, $empSsn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($empSsn['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_EMP_SSN, $empSsn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_EMP_SSN, $empSsn, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the phone_num column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneNum('fooValue');   // WHERE phone_num = 'fooValue'
     * $query->filterByPhoneNum('%fooValue%', Criteria::LIKE); // WHERE phone_num LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneNum The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPhoneNum($phoneNum = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneNum)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_PHONE_NUM, $phoneNum, $comparison);
    }

    /**
     * Filter the query on the salary column
     *
     * Example usage:
     * <code>
     * $query->filterBySalary(1234); // WHERE salary = 1234
     * $query->filterBySalary(array(12, 34)); // WHERE salary IN (12, 34)
     * $query->filterBySalary(array('min' => 12)); // WHERE salary > 12
     * </code>
     *
     * @param     mixed $salary The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterBySalary($salary = null, $comparison = null)
    {
        if (is_array($salary)) {
            $useMinMax = false;
            if (isset($salary['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_SALARY, $salary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($salary['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_SALARY, $salary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_SALARY, $salary, $comparison);
    }

    /**
     * Filter the query on the job_title column
     *
     * Example usage:
     * <code>
     * $query->filterByJobTitle('fooValue');   // WHERE job_title = 'fooValue'
     * $query->filterByJobTitle('%fooValue%', Criteria::LIKE); // WHERE job_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $jobTitle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByJobTitle($jobTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jobTitle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_JOB_TITLE, $jobTitle, $comparison);
    }

    /**
     * Filter the query on the hired_by column
     *
     * Example usage:
     * <code>
     * $query->filterByHiredBy(1234); // WHERE hired_by = 1234
     * $query->filterByHiredBy(array(12, 34)); // WHERE hired_by IN (12, 34)
     * $query->filterByHiredBy(array('min' => 12)); // WHERE hired_by > 12
     * </code>
     *
     * @see       filterByOwner()
     *
     * @param     mixed $hiredBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByHiredBy($hiredBy = null, $comparison = null)
    {
        if (is_array($hiredBy)) {
            $useMinMax = false;
            if (isset($hiredBy['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_HIRED_BY, $hiredBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hiredBy['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_HIRED_BY, $hiredBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_HIRED_BY, $hiredBy, $comparison);
    }

    /**
     * Filter the query by a related \Owner object
     *
     * @param \Owner|ObjectCollection $owner The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByOwner($owner, $comparison = null)
    {
        if ($owner instanceof \Owner) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_HIRED_BY, $owner->getOwnerId(), $comparison);
        } elseif ($owner instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeeTableMap::COL_HIRED_BY, $owner->toKeyValue('PrimaryKey', 'OwnerId'), $comparison);
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
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
     * @param   ChildEmployee $employee Object to remove from the list of results
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function prune($employee = null)
    {
        if ($employee) {
            $this->addUsingAlias(EmployeeTableMap::COL_ID, $employee->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeTableMap::clearInstancePool();
            EmployeeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeeQuery
