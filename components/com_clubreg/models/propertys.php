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
class ClubregModelPropertys extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.property_id',
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
	public function getPropertys($user_id,$member_id = null){
		
		$db		= $this->getDbo();
		if(isset($member_id) && intval($member_id) > 0){
			$where_[] = sprintf(" member_id = %d",$member_id) ;
		}
		
		$data_["property_id"] = intval($this->getState("com_clubreg.propertys.property_id"));
		$data_["property_key"] = trim(strval($this->getState("com_clubreg.propertys.property_key")));
		if($data_["property_id"] > 0  && strlen($data_["property_key"]) > 0 ){			
			$where_[] = ' property_id = '.$db->quote($data_["property_id"]);
			$where_[] = ' property_key = '.$db->quote($data_["property_key"]);			
		}	
		
		$where_str = implode(" and ", $where_);		
		
		$query	= $db->getQuery(true);
		
		$all_string[] = "`property_id`, `property_key`, `member_id`, pt.`config_name` as `property_type`, 
		`property_make`, `property_model`, `property_serial`,`property_notes`,`property_checked_out`, `property_checked_in`";
		$all_string[] = "date_format(a.created, '%d/%m/%Y %H:%i:%s') as created, user_reg.name ";
		
		$d_var = implode(",", $all_string);
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_PROPERTY_TABLE).' AS a');
		$query->join('LEFT', '#__users AS user_reg ON a.created_by = user_reg.id');		
		$query->join('LEFT', $db->quoteName(CLUB_CONFIG_TABLE).' AS pt ON a.property_type = pt.config_short');
				
		foreach($where_ as $a_where){
			$query->where($a_where);
		}		
		
		$query->order('a.property_id asc');
		
		$db->setQuery($query);
		$propertyList = $db->loadObjectList();
		
		if(count($propertyList) > 0){
			return $propertyList;
		}else 
			return array();
		
	}
}