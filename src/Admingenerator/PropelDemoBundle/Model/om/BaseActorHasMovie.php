<?php

namespace Admingenerator\PropelDemoBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Admingenerator\PropelDemoBundle\Model\Actor;
use Admingenerator\PropelDemoBundle\Model\ActorHasMoviePeer;
use Admingenerator\PropelDemoBundle\Model\ActorHasMovieQuery;
use Admingenerator\PropelDemoBundle\Model\ActorQuery;
use Admingenerator\PropelDemoBundle\Model\Movie;
use Admingenerator\PropelDemoBundle\Model\MovieQuery;

/**
 * Base class that represents a row from the 'propel_actors_movies' table.
 *
 * 
 *
 * @package    propel.generator.host/admingen/src/Admingenerator/PropelDemoBundle/Model.om
 */
abstract class BaseActorHasMovie extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'Admingenerator\\PropelDemoBundle\\Model\\ActorHasMoviePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ActorHasMoviePeer
	 */
	protected static $peer;

	/**
	 * The value for the actor_id field.
	 * @var        int
	 */
	protected $actor_id;

	/**
	 * The value for the movie_id field.
	 * @var        int
	 */
	protected $movie_id;

	/**
	 * @var        Actor
	 */
	protected $aActorRelatedByActorId;

	/**
	 * @var        Movie
	 */
	protected $aMovieRelatedByMovieId;

	/**
	 * @var        Actor one-to-one related Actor object
	 */
	protected $singleActorRelatedById;

	/**
	 * @var        Movie one-to-one related Movie object
	 */
	protected $singleMovieRelatedById;

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
	 * Get the [actor_id] column value.
	 * 
	 * @return     int
	 */
	public function getActorId()
	{
		return $this->actor_id;
	}

	/**
	 * Get the [movie_id] column value.
	 * 
	 * @return     int
	 */
	public function getMovieId()
	{
		return $this->movie_id;
	}

	/**
	 * Set the value of [actor_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ActorHasMovie The current object (for fluent API support)
	 */
	public function setActorId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->actor_id !== $v) {
			$this->actor_id = $v;
			$this->modifiedColumns[] = ActorHasMoviePeer::ACTOR_ID;
		}

		if ($this->aActorRelatedByActorId !== null && $this->aActorRelatedByActorId->getId() !== $v) {
			$this->aActorRelatedByActorId = null;
		}

		return $this;
	} // setActorId()

	/**
	 * Set the value of [movie_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ActorHasMovie The current object (for fluent API support)
	 */
	public function setMovieId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->movie_id !== $v) {
			$this->movie_id = $v;
			$this->modifiedColumns[] = ActorHasMoviePeer::MOVIE_ID;
		}

		if ($this->aMovieRelatedByMovieId !== null && $this->aMovieRelatedByMovieId->getId() !== $v) {
			$this->aMovieRelatedByMovieId = null;
		}

		return $this;
	} // setMovieId()

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

			$this->actor_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->movie_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 2; // 2 = ActorHasMoviePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating ActorHasMovie object", $e);
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

		if ($this->aActorRelatedByActorId !== null && $this->actor_id !== $this->aActorRelatedByActorId->getId()) {
			$this->aActorRelatedByActorId = null;
		}
		if ($this->aMovieRelatedByMovieId !== null && $this->movie_id !== $this->aMovieRelatedByMovieId->getId()) {
			$this->aMovieRelatedByMovieId = null;
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
			$con = Propel::getConnection(ActorHasMoviePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ActorHasMoviePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aActorRelatedByActorId = null;
			$this->aMovieRelatedByMovieId = null;
			$this->singleActorRelatedById = null;

			$this->singleMovieRelatedById = null;

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
			$con = Propel::getConnection(ActorHasMoviePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = ActorHasMovieQuery::create()
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
			$con = Propel::getConnection(ActorHasMoviePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				ActorHasMoviePeer::addInstanceToPool($this);
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

			if ($this->aActorRelatedByActorId !== null) {
				if ($this->aActorRelatedByActorId->isModified() || $this->aActorRelatedByActorId->isNew()) {
					$affectedRows += $this->aActorRelatedByActorId->save($con);
				}
				$this->setActorRelatedByActorId($this->aActorRelatedByActorId);
			}

			if ($this->aMovieRelatedByMovieId !== null) {
				if ($this->aMovieRelatedByMovieId->isModified() || $this->aMovieRelatedByMovieId->isNew()) {
					$affectedRows += $this->aMovieRelatedByMovieId->save($con);
				}
				$this->setMovieRelatedByMovieId($this->aMovieRelatedByMovieId);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setNew(false);
				} else {
					$affectedRows += ActorHasMoviePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->singleActorRelatedById !== null) {
				if (!$this->singleActorRelatedById->isDeleted()) {
						$affectedRows += $this->singleActorRelatedById->save($con);
				}
			}

			if ($this->singleMovieRelatedById !== null) {
				if (!$this->singleMovieRelatedById->isDeleted()) {
						$affectedRows += $this->singleMovieRelatedById->save($con);
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

			if ($this->aActorRelatedByActorId !== null) {
				if (!$this->aActorRelatedByActorId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aActorRelatedByActorId->getValidationFailures());
				}
			}

			if ($this->aMovieRelatedByMovieId !== null) {
				if (!$this->aMovieRelatedByMovieId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMovieRelatedByMovieId->getValidationFailures());
				}
			}


			if (($retval = ActorHasMoviePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->singleActorRelatedById !== null) {
					if (!$this->singleActorRelatedById->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleActorRelatedById->getValidationFailures());
					}
				}

				if ($this->singleMovieRelatedById !== null) {
					if (!$this->singleMovieRelatedById->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleMovieRelatedById->getValidationFailures());
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
		$pos = ActorHasMoviePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getActorId();
				break;
			case 1:
				return $this->getMovieId();
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
		if (isset($alreadyDumpedObjects['ActorHasMovie'][serialize($this->getPrimaryKey())])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['ActorHasMovie'][serialize($this->getPrimaryKey())] = true;
		$keys = ActorHasMoviePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getActorId(),
			$keys[1] => $this->getMovieId(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aActorRelatedByActorId) {
				$result['ActorRelatedByActorId'] = $this->aActorRelatedByActorId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aMovieRelatedByMovieId) {
				$result['MovieRelatedByMovieId'] = $this->aMovieRelatedByMovieId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->singleActorRelatedById) {
				$result['ActorRelatedById'] = $this->singleActorRelatedById->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
			}
			if (null !== $this->singleMovieRelatedById) {
				$result['MovieRelatedById'] = $this->singleMovieRelatedById->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
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
		$pos = ActorHasMoviePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setActorId($value);
				break;
			case 1:
				$this->setMovieId($value);
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
		$keys = ActorHasMoviePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setActorId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMovieId($arr[$keys[1]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ActorHasMoviePeer::DATABASE_NAME);

		if ($this->isColumnModified(ActorHasMoviePeer::ACTOR_ID)) $criteria->add(ActorHasMoviePeer::ACTOR_ID, $this->actor_id);
		if ($this->isColumnModified(ActorHasMoviePeer::MOVIE_ID)) $criteria->add(ActorHasMoviePeer::MOVIE_ID, $this->movie_id);

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
		$criteria = new Criteria(ActorHasMoviePeer::DATABASE_NAME);
		$criteria->add(ActorHasMoviePeer::ACTOR_ID, $this->actor_id);
		$criteria->add(ActorHasMoviePeer::MOVIE_ID, $this->movie_id);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();
		$pks[0] = $this->getActorId();
		$pks[1] = $this->getMovieId();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{
		$this->setActorId($keys[0]);
		$this->setMovieId($keys[1]);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return (null === $this->getActorId()) && (null === $this->getMovieId());
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of ActorHasMovie (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setActorId($this->getActorId());
		$copyObj->setMovieId($this->getMovieId());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			$relObj = $this->getActorRelatedById();
			if ($relObj) {
				$copyObj->setActorRelatedById($relObj->copy($deepCopy));
			}

			$relObj = $this->getMovieRelatedById();
			if ($relObj) {
				$copyObj->setMovieRelatedById($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
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
	 * @return     ActorHasMovie Clone of current object.
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
	 * @return     ActorHasMoviePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ActorHasMoviePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Actor object.
	 *
	 * @param      Actor $v
	 * @return     ActorHasMovie The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setActorRelatedByActorId(Actor $v = null)
	{
		if ($v === null) {
			$this->setActorId(NULL);
		} else {
			$this->setActorId($v->getId());
		}

		$this->aActorRelatedByActorId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Actor object, it will not be re-added.
		if ($v !== null) {
			$v->addActorHasMovieRelatedByActorId($this);
		}

		return $this;
	}


	/**
	 * Get the associated Actor object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Actor The associated Actor object.
	 * @throws     PropelException
	 */
	public function getActorRelatedByActorId(PropelPDO $con = null)
	{
		if ($this->aActorRelatedByActorId === null && ($this->actor_id !== null)) {
			$this->aActorRelatedByActorId = ActorQuery::create()->findPk($this->actor_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aActorRelatedByActorId->addActorHasMoviesRelatedByActorId($this);
			 */
		}
		return $this->aActorRelatedByActorId;
	}

	/**
	 * Declares an association between this object and a Movie object.
	 *
	 * @param      Movie $v
	 * @return     ActorHasMovie The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMovieRelatedByMovieId(Movie $v = null)
	{
		if ($v === null) {
			$this->setMovieId(NULL);
		} else {
			$this->setMovieId($v->getId());
		}

		$this->aMovieRelatedByMovieId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Movie object, it will not be re-added.
		if ($v !== null) {
			$v->addActorHasMovieRelatedByMovieId($this);
		}

		return $this;
	}


	/**
	 * Get the associated Movie object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Movie The associated Movie object.
	 * @throws     PropelException
	 */
	public function getMovieRelatedByMovieId(PropelPDO $con = null)
	{
		if ($this->aMovieRelatedByMovieId === null && ($this->movie_id !== null)) {
			$this->aMovieRelatedByMovieId = MovieQuery::create()->findPk($this->movie_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aMovieRelatedByMovieId->addActorHasMoviesRelatedByMovieId($this);
			 */
		}
		return $this->aMovieRelatedByMovieId;
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
	}

	/**
	 * Gets a single Actor object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con optional connection object
	 * @return     Actor
	 * @throws     PropelException
	 */
	public function getActorRelatedById(PropelPDO $con = null)
	{

		if ($this->singleActorRelatedById === null && !$this->isNew()) {
			$this->singleActorRelatedById = ActorQuery::create()->findPk($this->getPrimaryKey(), $con);
		}

		return $this->singleActorRelatedById;
	}

	/**
	 * Sets a single Actor object as related to this object by a one-to-one relationship.
	 *
	 * @param      Actor $v Actor
	 * @return     ActorHasMovie The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setActorRelatedById(Actor $v = null)
	{
		$this->singleActorRelatedById = $v;

		// Make sure that that the passed-in Actor isn't already associated with this object
		if ($v !== null && $v->getActorHasMovieRelatedById() === null) {
			$v->setActorHasMovieRelatedById($this);
		}

		return $this;
	}

	/**
	 * Gets a single Movie object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con optional connection object
	 * @return     Movie
	 * @throws     PropelException
	 */
	public function getMovieRelatedById(PropelPDO $con = null)
	{

		if ($this->singleMovieRelatedById === null && !$this->isNew()) {
			$this->singleMovieRelatedById = MovieQuery::create()->findPk($this->getPrimaryKey(), $con);
		}

		return $this->singleMovieRelatedById;
	}

	/**
	 * Sets a single Movie object as related to this object by a one-to-one relationship.
	 *
	 * @param      Movie $v Movie
	 * @return     ActorHasMovie The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMovieRelatedById(Movie $v = null)
	{
		$this->singleMovieRelatedById = $v;

		// Make sure that that the passed-in Movie isn't already associated with this object
		if ($v !== null && $v->getActorHasMovieRelatedById() === null) {
			$v->setActorHasMovieRelatedById($this);
		}

		return $this;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->actor_id = null;
		$this->movie_id = null;
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
			if ($this->singleActorRelatedById) {
				$this->singleActorRelatedById->clearAllReferences($deep);
			}
			if ($this->singleMovieRelatedById) {
				$this->singleMovieRelatedById->clearAllReferences($deep);
			}
		} // if ($deep)

		if ($this->singleActorRelatedById instanceof PropelCollection) {
			$this->singleActorRelatedById->clearIterator();
		}
		$this->singleActorRelatedById = null;
		if ($this->singleMovieRelatedById instanceof PropelCollection) {
			$this->singleMovieRelatedById->clearIterator();
		}
		$this->singleMovieRelatedById = null;
		$this->aActorRelatedByActorId = null;
		$this->aMovieRelatedByMovieId = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(ActorHasMoviePeer::DEFAULT_STRING_FORMAT);
	}

} // BaseActorHasMovie
