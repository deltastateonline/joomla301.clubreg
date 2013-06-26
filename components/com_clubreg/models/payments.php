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
class ClubregModelPayments extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.payment_id',
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
	public function getPayments($user_id,$member_id = null){
		
		$db		= $this->getDbo();
		if(isset($member_id) && intval($member_id) > 0){
			$where_[] = sprintf(" member_id = %d",$member_id) ;
		}
		
		$data_["payment_id"] = intval($this->getState("com_clubreg.payments.payment_id"));
		$data_["payment_key"] = trim(strval($this->getState("com_clubreg.payments.payment_key")));
		if($data_["payment_id"] > 0  && strlen($data_["payment_key"]) > 0 ){			
			$where_[] = ' payment_id = '.$db->quote($data_["payment_id"]);
			$where_[] = ' payment_key = '.$db->quote($data_["payment_key"]);
			
		}	
		
		$where_str = implode(" and ", $where_);		
		
		$query	= $db->getQuery(true);
		
		$all_string[] = "`payment_id`, `payment_key`, `member_id`,`payment_transact_no`, `payment_date`, `payment_season`,
		pm.`config_name` as `payment_method`,		
		ps.`config_name` as `payment_status`,		
		 pd.`config_name` as `payment_desc`, 
		`payment_notes`, `payment_amount`";
		$all_string[] = "date_format(a.created, '%d/%m/%Y %H:%i:%s') as created, user_reg.name ";
		
		$d_var = implode(",", $all_string);
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_PAYMENTS_TABLE).' AS a');
		$query->join('LEFT', '#__users AS user_reg ON a.created_by = user_reg.id');		
		$query->join('LEFT', $db->quoteName(CLUB_CONFIG_TABLE).' AS pd ON a.payment_desc = pd.config_short');
		$query->join('LEFT', $db->quoteName(CLUB_CONFIG_TABLE).' AS pm ON a.payment_method = pm.config_short');
		$query->join('LEFT', $db->quoteName(CLUB_CONFIG_TABLE).' AS ps ON a.payment_status = ps.config_short');
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}		
		
		$query->order('a.payment_id asc');
		
		$db->setQuery($query);
		$paymentList = $db->loadObjectList();
		
		if(count($paymentList) > 0){
			return $paymentList;
		}else 
			return array();
		
	}
}