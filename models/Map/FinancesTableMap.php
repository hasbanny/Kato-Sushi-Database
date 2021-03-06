<?php

namespace Map;

use \Finances;
use \FinancesQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'finances' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FinancesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.FinancesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'finances';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Finances';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Finances';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the invoices field
     */
    const COL_INVOICES = 'finances.invoices';

    /**
     * the column name for the bills field
     */
    const COL_BILLS = 'finances.bills';

    /**
     * the column name for the paid_by field
     */
    const COL_PAID_BY = 'finances.paid_by';

    /**
     * the column name for the payroll field
     */
    const COL_PAYROLL = 'finances.payroll';

    /**
     * the column name for the due_on field
     */
    const COL_DUE_ON = 'finances.due_on';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Invoices', 'Bills', 'PaidBy', 'Payroll', 'DueOn', ),
        self::TYPE_CAMELNAME     => array('invoices', 'bills', 'paidBy', 'payroll', 'dueOn', ),
        self::TYPE_COLNAME       => array(FinancesTableMap::COL_INVOICES, FinancesTableMap::COL_BILLS, FinancesTableMap::COL_PAID_BY, FinancesTableMap::COL_PAYROLL, FinancesTableMap::COL_DUE_ON, ),
        self::TYPE_FIELDNAME     => array('invoices', 'bills', 'paid_by', 'payroll', 'due_on', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Invoices' => 0, 'Bills' => 1, 'PaidBy' => 2, 'Payroll' => 3, 'DueOn' => 4, ),
        self::TYPE_CAMELNAME     => array('invoices' => 0, 'bills' => 1, 'paidBy' => 2, 'payroll' => 3, 'dueOn' => 4, ),
        self::TYPE_COLNAME       => array(FinancesTableMap::COL_INVOICES => 0, FinancesTableMap::COL_BILLS => 1, FinancesTableMap::COL_PAID_BY => 2, FinancesTableMap::COL_PAYROLL => 3, FinancesTableMap::COL_DUE_ON => 4, ),
        self::TYPE_FIELDNAME     => array('invoices' => 0, 'bills' => 1, 'paid_by' => 2, 'payroll' => 3, 'due_on' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('finances');
        $this->setPhpName('Finances');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Finances');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('invoices', 'Invoices', 'INTEGER', true, null, null);
        $this->addColumn('bills', 'Bills', 'INTEGER', true, null, null);
        $this->addForeignKey('paid_by', 'PaidBy', 'INTEGER', 'owner', 'owner_id', true, null, null);
        $this->addColumn('payroll', 'Payroll', 'INTEGER', true, null, null);
        $this->addColumn('due_on', 'DueOn', 'DATE', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Owner', '\\Owner', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':paid_by',
    1 => ':owner_id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return null;
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return '';
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? FinancesTableMap::CLASS_DEFAULT : FinancesTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Finances object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FinancesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FinancesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FinancesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FinancesTableMap::OM_CLASS;
            /** @var Finances $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FinancesTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = FinancesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FinancesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Finances $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FinancesTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(FinancesTableMap::COL_INVOICES);
            $criteria->addSelectColumn(FinancesTableMap::COL_BILLS);
            $criteria->addSelectColumn(FinancesTableMap::COL_PAID_BY);
            $criteria->addSelectColumn(FinancesTableMap::COL_PAYROLL);
            $criteria->addSelectColumn(FinancesTableMap::COL_DUE_ON);
        } else {
            $criteria->addSelectColumn($alias . '.invoices');
            $criteria->addSelectColumn($alias . '.bills');
            $criteria->addSelectColumn($alias . '.paid_by');
            $criteria->addSelectColumn($alias . '.payroll');
            $criteria->addSelectColumn($alias . '.due_on');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(FinancesTableMap::DATABASE_NAME)->getTable(FinancesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FinancesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FinancesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FinancesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Finances or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Finances object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FinancesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Finances) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The Finances object has no primary key');
        }

        $query = FinancesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FinancesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FinancesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the finances table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FinancesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Finances or Criteria object.
     *
     * @param mixed               $criteria Criteria or Finances object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FinancesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Finances object
        }


        // Set the correct dbName
        $query = FinancesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FinancesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FinancesTableMap::buildTableMap();
