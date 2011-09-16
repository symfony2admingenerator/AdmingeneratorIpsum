<?php

namespace Admingenerator\PropelDemoBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \DateTimeZone;
use \PDO;
use \Persistent;
use \Propel;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Admingenerator\PropelDemoBundle\Model\Actor;
use Admingenerator\PropelDemoBundle\Model\ActorHasMovie;
use Admingenerator\PropelDemoBundle\Model\ActorHasMovieQuery;
use Admingenerator\PropelDemoBundle\Model\ActorQuery;
use Admingenerator\PropelDemoBundle\Model\MoviePeer;
use Admingenerator\PropelDemoBundle\Model\MovieQuery;
use Admingenerator\PropelDemoBundle\Model\Producer;
use Admingenerator\PropelDemoBundle\Model\ProducerQuery;

/**
 * Base class that represents a row from the 'propel_movies' table.
 *
 * 
 *
 * @package    propel.generator.host/admingen/src/Admingenerator/PropelDemoBundle/Model.om
 */
abstract class BaseMovie extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'Admingenerator\\PropelDemoBundle\\Model\\MoviePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        MoviePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the is_published field.
	 * @var        boolean
	 */
	protected $is_published;

	/**
	 * The value for the release_date field.
	 * @var        string
	 */
	protected $release_date;

	/**
	 * The value for the producer_id field.
	 * @var        int
	 */
	protected $producer_id;

	/**
	 * @var        Producer
	 */
	protected $aProducer;

	/**
	 * @var        ActorHasMovie
	 */
	protected $aActorHasMovieRelatedById;

	/**
	 * @var        array ActorHasMovie[] Collection to store aggregation of ActorHasMovie objects.
	 */
	protected $collActorHasMoviesRelatedByMovieId;

	/**
	 * @var        array Actor[] Collection to store aggregation of Actor objects.
	 */
	protected $collActorsRelatedByActorId;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [is_published] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsPublished()
	{
		return $this->is_published;
	}

	/**
	 * Get the [optionally formatted] temporal [release_date] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getReleaseDate($format = NULL)
	{
		if ($this->release_date === null) {
			return null;
		}


		if ($this->release_date === '0000-00-00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->release_date);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->release_date, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [producer_id] column value.
	 * 
	 * @return     int
	 */
	public function getProducerId()
	{
		return $this->producer_id;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Movie The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = MoviePeer::ID;
		}

		if ($this->aActorHasMovieRelatedById !== null && $this->aActorHasMovieRelatedById->getMovieId() !== $v) {
			$this->aActorHasMovieRelatedById = null;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     Movie The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = MoviePeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Sets the value of the [is_published] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     Movie The current object (for fluent API support)
	 */
	public function setIsPublished($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->is_published !== $v) {
			$this->is_published = $v;
			$this->modifiedColumns[] = MoviePeer::IS_PUBLISHED;
		}

		return $this;
	} // setIsPublished()

	/**
	 * Sets the value of [release_date] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Movie The current object (for fluent API support)
	 */
	public function setReleaseDate($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->release_date !== null || $dt !== null) {
			$currentDateAsString = ($this->release_date !== null && $tmpDt = new DateTime($this->release_date)) ? $tmpDt->format('Y-m-d') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->release_date = $newDateAsString;
				$this->modifiedColumns[] = MoviePeer::RELEASE_DATE;
			}
		} // if either are not null

		return $this;
	} // setReleaseDate()

	/**
	 * Set the value of [producer_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Movie The current object (for fluent API support)
	 */
	public function setProducerId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->producer_id !== $v) {
			$this->producer_id = $v;
			$this->modifiedColumns[] = MoviePeer::PRODUCER_ID;
		}

		if ($this->aProducer !== null && $this->aProducer->getId() !== $v) {
			$this->aProducer = null;
		}

		return $this;
	} // setProducerId()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->is_published = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->release_date = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->producer_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 5; // 5 = MoviePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Movie object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aActorHasMovieRelatedById !== null && $this->id !== $this->aActorHasMovieRelatedById->getMovieId()) {
			$this->aActorHasMovieRelatedById = null;
		}
		if ($this->aProducer !== null && $this->producer_id !== $this->aProducer->getId()) {
			$this->aProducer = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MoviePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = MoviePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aProducer = null;
			$this->aActorHasMovieRelatedById = null;
			$this->collActorHasMoviesRelatedByMovieId = null;

			$this->collActorsRelatedByActorId = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MoviePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = MovieQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MoviePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				MoviePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aProducer !== null) {
				if ($this->aProducer->isModified() || $this->aProducer->isNew()) {
					$affectedRows += $this->aProducer->save($con);
				}
				$this->setProducer($this->aProducer);
			}

			if ($this->aActorHasMovieRelatedById !== null) {
				if ($this->aActorHasMovieRelatedById->isModified() || $this->aActorHasMovieRelatedById->isNew()) {
					$affectedRows += $this->aActorHasMovieRelatedById->save($con);
				}
				$this->setActorHasMovieRelatedById($this->aActorHasMovieRelatedById);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = MoviePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(MoviePeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.MoviePeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += MoviePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collActorHasMoviesRelatedByMovieId !== null) {
				foreach ($this->collActorHasMoviesRelatedByMovieId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aProducer !== null) {
				if (!$this->aProducer->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProducer->getValidationFailures());
				}
			}

			if ($this->aActorHasMovieRelatedById !== null) {
				if (!$this->aActorHasMovieRelatedById->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aActorHasMovieRelatedById->getValidationFailures());
				}
			}


			if (($retval = MoviePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collActorHasMoviesRelatedByMovieId !== null) {
					foreach ($this->collActorHasMoviesRelatedByMovieId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MoviePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getIsPublished();
				break;
			case 3:
				return $this->getReleaseDate();
				break;
			case 4:
				return $this->getProducerId();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['Movie'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Movie'][$this->getPrimaryKey()] = true;
		$keys = MoviePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getIsPublished(),
			$keys[3] => $this->getReleaseDate(),
			$keys[4] => $this->getProducerId(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aProducer) {
				$result['Producer'] = $this->aProducer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aActorHasMovieRelatedById) {
				$result['ActorHasMovieRelatedById'] = $this->aActorHasMovieRelatedById->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collActorHasMoviesRelatedByMovieId) {
				$result['ActorHasMoviesRelatedByMovieId'] = $this->collActorHasMoviesRelatedByMovieId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MoviePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setIsPublished($value);
				break;
			case 3:
				$this->setReleaseDate($value);
				break;
			case 4:
				$this->setProducerId($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MoviePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsPublished($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setReleaseDate($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setProducerId($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(MoviePeer::DATABASE_NAME);

		if ($this->isColumnModified(MoviePeer::ID)) $criteria->add(MoviePeer::ID, $this->id);
		if ($this->isColumnModified(MoviePeer::TITLE)) $criteria->add(MoviePeer::TITLE, $this->title);
		if ($this->isColumnModified(MoviePeer::IS_PUBLISHED)) $criteria->add(MoviePeer::IS_PUBLISHED, $this->is_published);
		if ($this->isColumnModified(MoviePeer::RELEASE_DATE)) $criteria->add(MoviePeer::RELEASE_DATE, $this->release_date);
		if ($this->isColumnModified(MoviePeer::PRODUCER_ID)) $criteria->add(MoviePeer::PRODUCER_ID, $this->producer_id);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MoviePeer::DATABASE_NAME);
		$criteria->add(MoviePeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Movie (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setTitle($this->getTitle());
		$copyObj->setIsPublished($this->getIsPublished());
		$copyObj->setReleaseDate($this->getReleaseDate());
		$copyObj->setProducerId($this->getProducerId());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getActorHasMoviesRelatedByMovieId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addActorHasMovieRelatedByMovieId($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Movie Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     MoviePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MoviePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Producer object.
	 *
	 * @param      Producer $v
	 * @return     Movie The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setProducer(Producer $v = null)
	{
		if ($v === null) {
			$this->setProducerId(NULL);
		} else {
			$this->setProducerId($v->getId());
		}

		$this->aProducer = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Producer object, it will not be re-added.
		if ($v !== null) {
			$v->addMovie($this);
		}

		return $this;
	}


	/**
	 * Get the associated Producer object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Producer The associated Producer object.
	 * @throws     PropelException
	 */
	public function getProducer(PropelPDO $con = null)
	{
		if ($this->aProducer === null && ($this->producer_id !== null)) {
			$this->aProducer = ProducerQuery::create()->findPk($this->producer_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aProducer->addMovies($this);
			 */
		}
		return $this->aProducer;
	}

	/**
	 * Declares an association between this object and a ActorHasMovie object.
	 *
	 * @param      ActorHasMovie $v
	 * @return     Movie The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setActorHasMovieRelatedById(ActorHasMovie $v = null)
	{
		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getMovieId());
		}

		$this->aActorHasMovieRelatedById = $v;

		// Add binding for other direction of this 1:1 relationship.
		if ($v !== null) {
			$v->setMovieRelatedById($this);
		}

		return $this;
	}


	/**
	 * Get the associated ActorHasMovie object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     ActorHasMovie The associated ActorHasMovie object.
	 * @throws     PropelException
	 */
	public function getActorHasMovieRelatedById(PropelPDO $con = null)
	{
		if ($this->aActorHasMovieRelatedById === null && ($this->id !== null)) {
			$this->aActorHasMovieRelatedById = ActorHasMovieQuery::create()
				->filterByMovieRelatedById($this) // here
				->findOne($con);
			// Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
			$this->aActorHasMovieRelatedById->setMovieRelatedById($this);
		}
		return $this->aActorHasMovieRelatedById;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
		if ('ActorHasMovieRelatedByMovieId' == $relationName) {
			return $this->initActorHasMoviesRelatedByMovieId();
		}
	}

	/**
	 * Clears out the collActorHasMoviesRelatedByMovieId collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addActorHasMoviesRelatedByMovieId()
	 */
	public function clearActorHasMoviesRelatedByMovieId()
	{
		$this->collActorHasMoviesRelatedByMovieId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collActorHasMoviesRelatedByMovieId collection.
	 *
	 * By default this just sets the collActorHasMoviesRelatedByMovieId collection to an empty array (like clearcollActorHasMoviesRelatedByMovieId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initActorHasMoviesRelatedByMovieId($overrideExisting = true)
	{
		if (null !== $this->collActorHasMoviesRelatedByMovieId && !$overrideExisting) {
			return;
		}
		$this->collActorHasMoviesRelatedByMovieId = new PropelObjectCollection();
		$this->collActorHasMoviesRelatedByMovieId->setModel('ActorHasMovie');
	}

	/**
	 * Gets an array of ActorHasMovie objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Movie is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ActorHasMovie[] List of ActorHasMovie objects
	 * @throws     PropelException
	 */
	public function getActorHasMoviesRelatedByMovieId($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collActorHasMoviesRelatedByMovieId || null !== $criteria) {
			if ($this->isNew() && null === $this->collActorHasMoviesRelatedByMovieId) {
				// return empty collection
				$this->initActorHasMoviesRelatedByMovieId();
			} else {
				$collActorHasMoviesRelatedByMovieId = ActorHasMovieQuery::create(null, $criteria)
					->filterByMovieRelatedByMovieId($this)
					->find($con);
				if (null !== $criteria) {
					return $collActorHasMoviesRelatedByMovieId;
				}
				$this->collActorHasMoviesRelatedByMovieId = $collActorHasMoviesRelatedByMovieId;
			}
		}
		return $this->collActorHasMoviesRelatedByMovieId;
	}

	/**
	 * Returns the number of related ActorHasMovie objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ActorHasMovie objects.
	 * @throws     PropelException
	 */
	public function countActorHasMoviesRelatedByMovieId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collActorHasMoviesRelatedByMovieId || null !== $criteria) {
			if ($this->isNew() && null === $this->collActorHasMoviesRelatedByMovieId) {
				return 0;
			} else {
				$query = ActorHasMovieQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByMovieRelatedByMovieId($this)
					->count($con);
			}
		} else {
			return count($this->collActorHasMoviesRelatedByMovieId);
		}
	}

	/**
	 * Method called to associate a ActorHasMovie object to this object
	 * through the ActorHasMovie foreign key attribute.
	 *
	 * @param      ActorHasMovie $l ActorHasMovie
	 * @return     Movie The current object (for fluent API support)
	 */
	public function addActorHasMovieRelatedByMovieId(ActorHasMovie $l)
	{
		if ($this->collActorHasMoviesRelatedByMovieId === null) {
			$this->initActorHasMoviesRelatedByMovieId();
		}
		if (!$this->collActorHasMoviesRelatedByMovieId->contains($l)) { // only add it if the **same** object is not already associated
			$this->collActorHasMoviesRelatedByMovieId[]= $l;
			$l->setMovieRelatedByMovieId($this);
		}

		return $this;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Movie is new, it will return
	 * an empty collection; or if this Movie has previously
	 * been saved, it will retrieve related ActorHasMoviesRelatedByMovieId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Movie.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ActorHasMovie[] List of ActorHasMovie objects
	 */
	public function getActorHasMoviesRelatedByMovieIdJoinActorRelatedByActorId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ActorHasMovieQuery::create(null, $criteria);
		$query->joinWith('ActorRelatedByActorId', $join_behavior);

		return $this->getActorHasMoviesRelatedByMovieId($query, $con);
	}

	/**
	 * Clears out the collActorsRelatedByActorId collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addActorsRelatedByActorId()
	 */
	public function clearActorsRelatedByActorId()
	{
		$this->collActorsRelatedByActorId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collActorsRelatedByActorId collection.
	 *
	 * By default this just sets the collActorsRelatedByActorId collection to an empty collection (like clearActorsRelatedByActorId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initActorsRelatedByActorId()
	{
		$this->collActorsRelatedByActorId = new PropelObjectCollection();
		$this->collActorsRelatedByActorId->setModel('Actor');
	}

	/**
	 * Gets a collection of Actor objects related by a many-to-many relationship
	 * to the current object by way of the propel_actors_movies cross-reference table.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Movie is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     PropelCollection|array Actor[] List of Actor objects
	 */
	public function getActorsRelatedByActorId($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collActorsRelatedByActorId || null !== $criteria) {
			if ($this->isNew() && null === $this->collActorsRelatedByActorId) {
				// return empty collection
				$this->initActorsRelatedByActorId();
			} else {
				$collActorsRelatedByActorId = ActorQuery::create(null, $criteria)
					->filterByMovieRelatedByMovieId($this)
					->find($con);
				if (null !== $criteria) {
					return $collActorsRelatedByActorId;
				}
				$this->collActorsRelatedByActorId = $collActorsRelatedByActorId;
			}
		}
		return $this->collActorsRelatedByActorId;
	}

	/**
	 * Gets the number of Actor objects related by a many-to-many relationship
	 * to the current object by way of the propel_actors_movies cross-reference table.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      boolean $distinct Set to true to force count distinct
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     int the number of related Actor objects
	 */
	public function countActorsRelatedByActorId($criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collActorsRelatedByActorId || null !== $criteria) {
			if ($this->isNew() && null === $this->collActorsRelatedByActorId) {
				return 0;
			} else {
				$query = ActorQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByMovieRelatedByMovieId($this)
					->count($con);
			}
		} else {
			return count($this->collActorsRelatedByActorId);
		}
	}

	/**
	 * Associate a Actor object to this object
	 * through the propel_actors_movies cross reference table.
	 *
	 * @param      Actor $actor The ActorHasMovie object to relate
	 * @return     void
	 */
	public function addActorRelatedByActorId($actor)
	{
		if ($this->collActorsRelatedByActorId === null) {
			$this->initActorsRelatedByActorId();
		}
		if (!$this->collActorsRelatedByActorId->contains($actor)) { // only add it if the **same** object is not already associated
			$actorHasMovie = new ActorHasMovie();
			$actorHasMovie->setActorRelatedByActorId($actor);
			$this->addActorHasMovieRelatedByMovieId($actorHasMovie);

			$this->collActorsRelatedByActorId[]= $actor;
		}
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->title = null;
		$this->is_published = null;
		$this->release_date = null;
		$this->producer_id = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collActorHasMoviesRelatedByMovieId) {
				foreach ($this->collActorHasMoviesRelatedByMovieId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collActorsRelatedByActorId) {
				foreach ($this->collActorsRelatedByActorId as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collActorHasMoviesRelatedByMovieId instanceof PropelCollection) {
			$this->collActorHasMoviesRelatedByMovieId->clearIterator();
		}
		$this->collActorHasMoviesRelatedByMovieId = null;
		if ($this->collActorsRelatedByActorId instanceof PropelCollection) {
			$this->collActorsRelatedByActorId->clearIterator();
		}
		$this->collActorsRelatedByActorId = null;
		$this->aProducer = null;
		$this->aActorHasMovieRelatedById = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string The value of the 'title' column
	 */
	public function __toString()
	{
		return (string) $this->getTitle();
	}

} // BaseMovie
