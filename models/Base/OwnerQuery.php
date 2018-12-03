<?php

namespace Base;

use \Owner as ChildOwner;
use \OwnerQuery as ChildOwnerQuery;
use \Exception;
use \PDO;
use Map\OwnerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'owner' table.
 *
 *
 *
 * @method     ChildOwnerQuery orderByOwnerId($order = Criteria::ASC) Order by the owner_id column
 * @method     ChildOwnerQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildOwnerQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildOwnerQuery orderByPhoneNum($order = Criteria::ASC) Order by the phone_num column
 * @method     ChildOwnerQuery orderByPasswordHash($order = Criteria::ASC) Order by the password_hash column
 *
 * @method     ChildOwnerQuery groupByOwnerId() Group by the owner_id column
 * @method     ChildOwnerQuery groupByName() Group by the name column
 * @method     ChildOwnerQuery groupByAddress() Group by the address column
 * @method     ChildOwnerQuery groupByPhoneNum() Group by the phone_num column
 * @method     ChildOwnerQuery groupByPasswordHash() Group by the password_hash column
 *
 * @method     ChildOwnerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOwnerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOwnerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOwnerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOwnerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOwnerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOwner findOne(ConnectionInterface $con = null) Return the first ChildOwner matching the query
 * @method     ChildOwner findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOwner matching the query, or a new ChildOwner object populated from the query conditions when no match is found
 *
 * @method     ChildOwner findOneByOwnerId(int $owner_id) Return the first ChildOwner filtered by the owner_id column
 * @method     ChildOwner findOneByName(string $name) Return the first ChildOwner filtered by the name column
 * @method     ChildOwner findOneByAddress(string $address) Return the first ChildOwner filtered by the address column
 * @method     ChildOwner findOneByPhoneNum(string $phone_num) Return the first ChildOwner filtered by the phone_num column
 * @method     ChildOwner findOneByPasswordHash(string $password_hash) Return the first ChildOwner filtered by the password_hash column *

 * @method     ChildOwner requirePk($key, ConnectionInterface $con = null) Return the ChildOwner by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOwner requireOne(ConnectionInterface $con = null) Return the first ChildOwner matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOwner requireOneByOwnerId(int $owner_id) Return the first ChildOwner filtered by the owner_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOwner requireOneByName(string $name) Return the first ChildOwner filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOwner requireOneByAddress(string $address) Return the first ChildOwner filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOwner requireOneByPhoneNum(string $phone_num) Return the first ChildOwner filtered by the phone_num column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOwner requireOneByPasswordHash(string $password_hash) Return the first ChildOwner filtered by the password_hash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOwner[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOwner objects based on current ModelCriteria
 * @method     ChildOwner[]|ObjectCollection findByOwnerId(int $owner_id) Return ChildOwner objects filtered by the owner_id column
 * @method     ChildOwner[]|ObjectCollection findByName(string $name) Return ChildOwner objects filtered by the name column
 * @method     ChildOwner[]|ObjectCollection findByAddress(string $address) Return ChildOwner objects filtered by the address column
 * @method     ChildOwner[]|ObjectCollection findByPhoneNum(string $phone_num) Return ChildOwner objects filtered by the phone_num column
 * @method     ChildOwner[]|ObjectCollection findByPasswordHash(string $password_hash) Return ChildOwner objects filtered by the password_hash column
 * @method     ChildOwner[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OwnerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OwnerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Owner', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOwnerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOwnerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOwnerQuery) {
            return $criteria;
        }
        $query = new ChildOwnerQuery();
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
     * @return ChildOwner|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OwnerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OwnerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOwner A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT owner_id, name, address, phone_num, password_hash FROM owner WHERE owner_id = :p0';
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
            /** @var ChildOwner $obj */
            $obj = new ChildOwner();
            $obj->hydrate($row);
            OwnerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOwner|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOwnerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OwnerTableMap::COL_OWNER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOwnerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OwnerTableMap::COL_OWNER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the owner_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOwnerId(1234); // WHERE owner_id = 1234
     * $query->filterByOwnerId(array(12, 34)); // WHERE owner_id IN (12, 34)
     * $query->filterByOwnerId(array('min' => 12)); // WHERE owner_id > 12
     * </code>
     *
     * @param     mixed $ownerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOwnerQuery The current query, for fluid interface
     */
    public function filterByOwnerId($ownerId = null, $comparison = null)
    {
        if (is_array($ownerId)) {
            $useMinMax = false;
            if (isset($ownerId['min'])) {
                $this->addUsingAlias(OwnerTableMap::COL_OWNER_ID, $ownerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ownerId['max'])) {
                $this->addUsingAlias(OwnerTableMap::COL_OWNER_ID, $ownerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OwnerTableMap::COL_OWNER_ID, $ownerId, $comparison);
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
     * @return $this|ChildOwnerQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OwnerTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOwnerQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OwnerTableMap::COL_ADDRESS, $address, $comparison);
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
     * @return $this|ChildOwnerQuery The current query, for fluid interface
     */
    public function filterByPhoneNum($phoneNum = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneNum)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OwnerTableMap::COL_PHONE_NUM, $phoneNum, $comparison);
    }

    /**
     * Filter the query on the password_hash column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswordHash('fooValue');   // WHERE password_hash = 'fooValue'
     * $query->filterByPasswordHash('%fooValue%', Criteria::LIKE); // WHERE password_hash LIKE '%fooValue%'
     * </code>
     *
     * @param     string $passwordHash The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOwnerQuery The current query, for fluid interface
     */
    public function filterByPasswordHash($passwordHash = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($passwordHash)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OwnerTableMap::COL_PASSWORD_HASH, $passwordHash, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOwner $owner Object to remove from the list of results
     *
     * @return $this|ChildOwnerQuery The current query, for fluid interface
     */
    public function prune($owner = null)
    {
        if ($owner) {
            $this->addUsingAlias(OwnerTableMap::COL_OWNER_ID, $owner->getOwnerId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the owner table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OwnerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OwnerTableMap::clearInstancePool();
            OwnerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OwnerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OwnerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OwnerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OwnerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OwnerQuery
