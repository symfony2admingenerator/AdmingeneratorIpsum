<?php

namespace Admingenerator\PropelDemoBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'propel_actors_movies' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.host/admingen/src/Admingenerator/PropelDemoBundle/Model.map
 */
class ActorHasMovieTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'host/admingen/src/Admingenerator/PropelDemoBundle/Model.map.ActorHasMovieTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('propel_actors_movies');
		$this->setPhpName('ActorHasMovie');
		$this->setClassname('Admingenerator\\PropelDemoBundle\\Model\\ActorHasMovie');
		$this->setPackage('host/admingen/src/Admingenerator/PropelDemoBundle/Model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ACTOR_ID', 'ActorId', 'INTEGER' , 'propel_actors', 'ID', true, null, null);
		$this->addForeignPrimaryKey('MOVIE_ID', 'MovieId', 'INTEGER' , 'propel_movies', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Actor', 'Admingenerator\\PropelDemoBundle\\Model\\Actor', RelationMap::MANY_TO_ONE, array('actor_id' => 'id', ), null, null);
		$this->addRelation('Movie', 'Admingenerator\\PropelDemoBundle\\Model\\Movie', RelationMap::MANY_TO_ONE, array('movie_id' => 'id', ), null, null);
	} // buildRelations()

} // ActorHasMovieTableMap
