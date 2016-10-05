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
class ClubregModelExpresscheckin extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.member_id',
					'a.surname','a.givenname',
					'a.emailaddress',
					'a.gender'
			);
		}
	
		parent::__construct($config);
		
		//Get configuration
		$app    = JFactory::getApplication();
		$config = JFactory::getConfig();		
		
		$this->setState('limit', $app->getUserStateFromRequest('com_clubreg.limit', 'limit', $config->get('list_limit'), 'uint'));
		$this->setState('limitstart', $app->input->get('limitstart', 0, 'uint'));
		
	}
	
	protected function getListQuery(){
		
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'a.surname');
		$orderDirn	= $this->state->get('list.direction', 'ASC');
		
		$this->getState('com_clubreg.expresscheckin.member_key');
		
		//$member_id  = $this->getState('com_clubreg.expresscheckin.member_id');
		$search_value = sprintf('%%%s%%',$this->getState('com_clubreg.expresscheckin.search_value'));
		
		$groupIds = $this->getState('com_clubreg.expresscheckin.group_ids');
		
		
		$where_ = array();
		
		$where_[] = sprintf("(a.surname like %s or a.givenname like %s) ", $db->quote($search_value),$db->quote($search_value));
		//$where_[] = sprintf("a.playertype = 'guardian' ");  // Only Eoi Members
		
		if(!empty($groupIds["sub_groups_ids"])){
			$where_[] = sprintf("( a.group in (%s) or  a.subgroup in (%s) )",
					implode(",",$groupIds["allowed_groups"]),
					implode(",",$groupIds["sub_groups_ids"]));  // Only Eoi Members
		}else{
			if(!empty($groupIds["allowed_groups"]))
				$where_[] = sprintf(" a.group in (%s) ",implode(",",$groupIds["allowed_groups"]));  // Only Eoi Members
		}		
		
		$all_string[] = "a.*";
		
		$all_string["member_name"] = "concat(UCASE(a.`surname`),' ' ,LCASE(a.`givenname`)) as surname";
		
		$all_string["t_group"] = "b.group_name as `group`";
		$all_string["subgroup"] = "sg.group_name as `subgroup`";
		
		
		$all_string["dob"] = " (if(a.dob = '0000-00-00' , '-' , date_format(a.dob,'%d/%m/%Y'))) as dob";
		$all_string["gender"] = " (if(a.gender in ('0','-1') , '' , a.gender)) as gender";
		
		
		$all_string["address"] = " (if(a.address in ('0','-1') , 'N/A' , a.address)) as address";		
		$all_string["suburb"] = " (if(a.suburb in ('0','-1') , '' , a.suburb)) as suburb";
		$all_string["postcode"] = " (if(a.postcode in ('0','-1') , '' , a.postcode)) as postcode";		
		
	 	$all_string["guardian"] = "concat(d.`surname`,' ' ,d.`givenname`) as guardian";	
		
		$all_string["gaddress"] = " (if(d.address in ('0','-1') , 'N/A' , d.address)) as g_address";
		$all_string["gsuburb"] = " (if(d.suburb in ('0','-1') , '' , d.suburb)) as g_suburb";
		$all_string["gpostcode"] = " (if(d.postcode in ('0','-1') , '' , d.postcode)) as g_postcode";
		
		
		$d_var =implode(",", $all_string);
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');
		$query->join('LEFT', CLUB_GROUPS_TABLE.' AS b ON a.group = b.group_id');
		$query->join('LEFT', CLUB_GROUPS_TABLE.' AS sg ON a.subgroup = sg.group_id');
		
		$query->join('LEFT', $db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS d on (a.parent_id = d.member_id)');
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
		
		return $query;
		
	}
}