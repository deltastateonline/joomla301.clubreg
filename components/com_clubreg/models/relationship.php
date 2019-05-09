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
defined('_JEXEC') or die;

class ClubregModelRelationship extends JModelForm
{
	
	protected $view_item = 'relationship';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.relationship';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.			
		$form = $this->loadForm('com_clubreg.relationship', 'relationship', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'Relationship', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function save($data){		
		
		$isNew = $this->getState("com_clubreg.relationship.isnew");	
		$update_me = FALSE;
		
		if(!$isNew){			
			$update_me = TRUE;		
		}
		
		$proceed = FALSE;
		if($isNew || $update_me){
			$relationshipTable = $this->getTable();
		
			$relationshipTable->bind($data);
			if($isNew){
				$created_when = date('Y-m-d H:i:s');
				$relationshipTable->created = $created_when;
			}			
			
			if(!$relationshipTable->store()){
				$proceed =  FALSE;
				$this->setError($relationshipTable->getError());
			}else{
				$proceed =  TRUE;				
				$this->set("relationship_id", $relationshipTable->relationship_id);
			}	
		}
		
		return $proceed;
	}
}