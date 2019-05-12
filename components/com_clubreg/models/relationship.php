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
		
		$error_ = 0;
		$proceed = FALSE;
		
		$db	= $this->getDbo();			
		$created_when = date('Y-m-d H:i:s');			
		
		$d_qry = sprintf("insert into %s set `member_id` = %s ,`member2_id` = %s ,`relationship_tag`=%s, `created_by` = %s , created = %s on duplicate key update
				relationship_tag = values(relationship_tag) ;
				",CLUB_RELATIONSHIPS_TABLE,$db->Quote($data['member_id']),$db->Quote($data['member2_id']),$db->Quote($data['relationship_tag'])
				,$db->Quote($data['created_by']),$db->Quote($created_when));		
		
		$db->setQuery($d_qry);
		
		try{
			$db->query();
		}catch (RuntimeException $e){
			
			$this->setError($e->getMessage());
			$error_++;
		}
		
		 $relation_ = array("child"=>"parent","spouse"=>"spouse","parent"=>"child");
		
		
		$d_qry = sprintf("insert into %s set `member_id` = %s ,`member2_id` = %s ,`relationship_tag`=%s, `created_by` = %s , created = %s on duplicate key update
				relationship_tag = values(relationship_tag) ;
				",CLUB_RELATIONSHIPS_TABLE,$db->Quote($data['member2_id']),$db->Quote($data['member_id']),$db->Quote($relation_[$data['relationship_tag']])
				,$db->Quote($data['created_by']),$db->Quote($created_when));
		
		$db->setQuery($d_qry);
		
		try{
			$db->query();
		}catch (RuntimeException $e){				
			$this->setError($e->getMessage());
			$error_++;
		}
		

		if($error_ == 0){
			$proceed = TRUE;
		}
		
		return $proceed;
	}
}