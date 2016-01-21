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
class ClubregModelContactlists extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.contactlist_id',
					'a.member_id','a.created'					
			);
		}
	
		parent::__construct($config);
		
		//Get configuration
		$app    = JFactory::getApplication();
		$config = JFactory::getConfig();		
		
		$this->setState('limit', $app->getUserStateFromRequest('com_clubreg.limit', 'limit', $config->get('list_limit'), 'uint'));
		$this->setState('limitstart', $app->input->get('limitstart', 0, 'uint'));
		
	}
	public function getContactlists($user_id,$member_id = null){
		
		$db		= $this->getDbo();
		if(isset($member_id) && intval($member_id) > 0){
			$where_[] = sprintf(" member_id = %d",$member_id) ;
		}
		
		$where_[] = " contactlist_status = 1 " ;
		
		$data_["contactlist_id"] = intval($this->getState("com_clubreg.contactlists.contactlist_id"));
		$data_["contactlist_key"] = trim(strval($this->getState("com_clubreg.contactlists.contactlist_key")));
		if($data_["contactlist_id"] > 0  && strlen($data_["contactlist_key"]) > 0 ){			
			$where_[] = ' contactlist_id = '.$db->quote($data_["contactlist_id"]);
			$where_[] = ' contactlist_key = '.$db->quote($data_["contactlist_key"]);			
		}		
		
		$query	= $db->getQuery(true);
		
		$all_string[] = "`contactlist_id`, `contactlist_key`, `member_id`,
		`contactlist_email`, `contactlist_phoneno`, `contactlist_fname`,`contactlist_sname`,contactlist_notify";		
		$all_string[] = "date_format(a.created, '%d/%m/%Y %H:%i:%s') as created, user_reg.name ";
		
		$d_var = implode(",", $all_string);
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_CONTACTLIST_TABLE).' AS a');
		$query->join('LEFT', '#__users AS user_reg ON a.created_by = user_reg.id');		

				
		foreach($where_ as $a_where){
			$query->where($a_where);
		}		
		
		$query->order('a.contactlist_sname asc');
		
		$db->setQuery($query);
		$contactlistList = $db->loadObjectList();
		
		if(count($contactlistList) > 0){
			return $contactlistList;
		}else 
			return array();
		
	}
}