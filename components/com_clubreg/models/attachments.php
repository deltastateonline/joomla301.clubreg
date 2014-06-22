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
class ClubregModelAttachments extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.attachment_id',
					'a.primary_id','a.created'
					
			);
		}
	
		parent::__construct($config);
		
		//Get configuration
		$app    = JFactory::getApplication();
		$config = JFactory::getConfig();		
		
		$this->setState('limit', $app->getUserStateFromRequest('com_clubreg.limit', 'limit', $config->get('list_limit'), 'uint'));
		$this->setState('limitstart', $app->input->get('limitstart', 0, 'uint'));
		
	}
	public function getAttachments($user_id,$primary_id,$link_type='member'){
		
		$where_[] = sprintf(" primary_id = %d",$primary_id) ;
		$where_[] = sprintf(" ( attachment_status in (1) or a.created_by = %d  )",$user_id) ;
		$where_[] = sprintf("  attachment_status != 99 ") ;
		$where_[] = sprintf("  link_type = '%s' ",$link_type) ;
		
		$where_str = implode(" and ", $where_);
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$limit_["limit"] = intval($this->getState("com_clubreg.attachments.limit"));
		$limit_["limitstart"] = intval($this->getState("com_clubreg.attachments.limitstart"));
		
		$all_string[] = "`attachment_id`, `attachment_key`, `primary_id`, `link_type`, `attachment_fname`, `attachment_notes`, 
		`attachment_type`, a.`params`, `attachment_savedfname`, `attachment_location`, a. `created_by`, 
		`attachment_parameter_type`, `attachment_file_type`, `attachment_status`, `attachment_access_level`";
		$all_string[] = "date_format(a.created, '%d/%m/%Y %H:%i:%s') as created, user_reg.name ";
		$all_string[] = "config_tags.config_name as attachment_type_name";
		
		$d_var = implode(",", $all_string);
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_ATTACHMENTS_TABLE).' AS a');
		$query->join('LEFT', '#__users AS user_reg ON a.created_by = user_reg.id');		
		$query->join('LEFT', CLUB_CONFIG_TABLE.' AS config_tags ON a.attachment_type = config_tags.config_short');
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}		
		
		$query->order('config_tags.config_name asc , a.attachment_id desc');
		
		if($limit_["limit"] && $limit_["limitstart"] ){			
			$db->setQuery($query,$limit_["limitstart"],$limit_["limit"]);
		}else{		
			$db->setQuery($query);
		}
		try {
			$attachmentsList = $db->loadObjectList();
			return $attachmentsList;
		} catch (Exception $e) {
			echo $e->getMessage();
		}		
	
			return array();
		
	}
}