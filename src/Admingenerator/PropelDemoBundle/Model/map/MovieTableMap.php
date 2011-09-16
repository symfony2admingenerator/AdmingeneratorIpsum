<?php

namespace Admingenerator\PropelDemoBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'propel_movies' table.
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
class MovieTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'host/admingen/src/Admingenerator/PropelDemoBundle/Model.map.MovieTableMap';

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
		$this->setName('propel_movies');
		$this->setPhpName('Movie');
		$this->setClassname('Admingenerator\\PropelDemoBundle\\Model\\Movie');
		$this->setPackage('host/admingen/src/Admingenerator/PropelDemoBundle/Model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'propel_actors_movies', 'MOVIE_ID', true, null, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', true, 255, null);
		$this->getColumn('TITLE', false)->setPrimaryString(true);
		$this->addColumn('IS_PUBLISHED', 'IsPublished', 'BOOLEAN', false, 1, null);
		$this->addColumn('RELEASE_DATE', 'ReleaseDate', 'DATE', false, null, null);
		$this->addForeignKey('PRODUCER_ID', 'ProducerId', 'INTEGER', 'propel_producers', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Producer', 'Admingenerator\\PropelDemoBundle\\Model\\Producer', RelationMap::MANY_TO_ONE, array('producer_id' => 'id', ), 'CASCADE', 'CASCADE');
		$this->addRelation('ActorHasMovieRelatedById', 'Admingenerator\\PropelDemoBundle\\Model\\ActorHasMovie', RelationMap::MANY_TO_ONE, array('id' => 'movie_id', ), 'CASCADE', 'CASCADE');
		$this->addRelation('ActorHasMovieRelatedByMovieId', 'Admingenerator\\PropelDemoBundle\\Model\\ActorHasMovie', RelationMap::ONE_TO_MANY, array('id' => 'movie_id', ), null, null, 'ActorHasMoviesRelatedByMovieId');
		$this->addRelation('ActorRelatedByActorId', 'Admingenerator\\PropelDemoBundle\\Model\\Actor', RelationMap::MANY_TO_MANY, array(), null, null, 'ActorsRelatedByActorId');
	} // buildRelations()

} // MovieTableMap
