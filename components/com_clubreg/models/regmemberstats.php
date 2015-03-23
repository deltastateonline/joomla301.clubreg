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

class ClubregModelRegmemberstats extends JModelForm
{
	
	protected $view_item = 'regmemberstats';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.regmemberstats';
	
	public function getTable($type = 'Regmemberstats', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_clubreg.regmemberstats', 'regmemberstats', array('control' => 'jform', 'load_data' => true));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function save($data){
		
		unset($data['pk']);
		unset($data['member_key']);		
		
		$data['stats_date'] = str_replace("/", "-", $data['stats_date']); // replace / with a -  so that you can perform a strtotime properly				
		$data['stats_date'] = date('Y-m-d',strtotime($data['stats_date']));
		
		$statsTable = $this->getTable();
		
		$statsTable->bind($data);
		
		try {
			$statsTable->store();
			$proceed =  TRUE;
			$this->setError($statsTable->getError());
		}catch (Exception $e) {			
			$this->setError($e);
			$proceed =  FALSE;			
		}
		
		return $proceed;
		
	}
	
	public function getStats($member_keys , $stats_date){
		
		$member_ids = array_keys($member_keys);	
		
		$all_results = array();
		
		$stats_date = str_replace("/", "-", $stats_date); // replace / with a -  so that you can perform a strtotime properly
		$stats_date = date('Y-m-d',strtotime($stats_date));		
		
		try {
			$db = JFactory::getDbo();
			
			$query	= $db->getQuery(true);
				
			$query->select("a.member_id, a.stats_value");
			$query->from($db->quoteName(CLUB_STATS_TABLE).' AS a');
				
			$query->where(sprintf("a.stats_date = %s", $db->quote($stats_date)));
			$query->where(sprintf(" a.stats_detail in (%s) ",$db->quote("stats_attendance")));
			
			$query->where(sprintf(" a.member_id in (%s) ",implode(',',$member_ids)));
				
			$db->setQuery($query);
			
			$all_results = $db->loadObjectList("member_id");
			
		}catch (Exception $e) {
			$this->setError($e);			
			return FALSE;
		}		
		
		
		return $all_results;
		
	}
	
}