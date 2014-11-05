<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/

defined('JPATH_PLATFORM') or die;

/**
 * Abstract class defining methods that can be
 * implemented by an Observer class of a JTable class (which is an Observable).
 * Attaches $this Observer to the $table in the constructor.
 * The classes extending this class should not be instanciated directly, as they
 * are automatically instanciated by the JObserverMapper
 *
 * @package     Joomla.Libraries
 * @subpackage  Table
 * @link        http://docs.joomla.org/JTableObserver
 * @since       3.1.2
 */
class JTableObserverAudit extends JTableObserver
{

	/**
	 * Pre-processor for $table->store($updateNulls)
	 *
	 * @param   boolean  $updateNulls  The result of the load
	 * @param   string   $tableKey     The key of the table
	 *
	 * @return  void
	 *
	 * @since   3.1.2
	 */
	
	/**
	 * Creates the associated observer instance and attaches it to the $observableObject
	 * Creates the associated tags helper class instance
	 * $typeAlias can be of the form "{variableName}.type", automatically replacing {variableName} with table-instance variables variableName
	 *
	 * @param   JObservableInterface  $observableObject  The subject object to be observed
	 * @param   array                 $params            ( 'typeAlias' => $typeAlias )
	 *
	 * @return  JTableObserverTags
	 *
	 * @since   3.1.2
	 */
	// the table is the observable object
	public static function createObserver(JObservableInterface $observableObject, $params = array())
	{
		//$typeAlias = $params['typeAlias'];
	/**
	 * the table becomes the observable object.
	 * then in the inteface, we attach the observer to the table using table->attachObserver and giving this observer the table name
	 * @var unknown_type
	 */
		$observer = new self($observableObject);	// create a new observer with this table.
	
		//$observer->tagsHelper = new JHelperTags;
		//$observer->typeAliasPattern = $typeAlias;
		$observer->typeAlias = $params['typeAlias'];
	
		return $observer;
	}
	
	
	
	public function onBeforeStore($updateNulls, $tableKey)
	{
				
		$currentObject = $this->table;	
			
		
		$oldTable = clone $this->table;
		$oldTable->reset();
		$key = $oldTable->getKeyName();		
		
		if ($oldTable->$key && $oldTable->load())
		{		
			
			$db		= JFactory::getDBO();
			$user		= JFactory::getUser();
			
			$new_data = new stdClass();
			foreach($oldTable as $t_key => $t_value){
				if($t_key[0] == "_") continue;
				$new_data->$t_key = $oldTable->$t_key;
			}
			$audit_data = serialize($new_data);
			
			if(strpos($this->typeAlias, "{playertype}")){
				$this->typeAlias = str_replace("{playertype}", $oldTable->playertype, $this->typeAlias);
			}
			
			$created = date("Y-m-d H:i:s");
			
			$d_qry = sprintf("insert into %s set primary_id = '%d', short_desc=%s, audit_details = %s,
					created_date ='%s',created_time= '%s',createdby = '%d'",CLUB_AUDIT_TABLE,
					$oldTable->$key,$db->Quote($this->typeAlias),$db->Quote($audit_data),
					$created,$created,$user->id);
			$db->setQuery($d_qry);
			$db->execute();
			
		}
		

		

	}
}