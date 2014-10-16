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
class ClubregModelCommunications extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.comm_id',
					'a.template_id','a.comm_subject',
					'a.sent_date',
					'a.created_by'
			);
		}
	
		parent::__construct($config);
		
		//Get configuration
		$app    = JFactory::getApplication();
		$config = JFactory::getConfig();		
		
		$this->setState('limit', $app->getUserStateFromRequest('com_clubreg.limit', 'limit', $config->get('list_limit'), 'uint'));
		$this->setState('limitstart', $app->input->get('limitstart', 0, 'uint'));
		
	}
	
	
	protected function getListQuery()
	{
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);		
		
		$where_ = array();
		$back_url = array();
		
		$d_var = "a.*";
		
		$all_string["n"] = 'a.*';
		
		$all_string["template_name"] = "b.template_name";		
		$all_string["t_created_date"] = "date_format(a.created,'%d/%m/%Y') as t_created_date";
		$all_string["t_sent_date"] = "date_format(a.sent_date,'%d/%m/%Y') as t_sent_date";
		
		$all_string["t_created_by"] = "usert.name as `t_created_by`";
		
		$all_string["added_groups"] = " group_concat(gr.`group_name` ORDER BY gr.`group_name` ASC SEPARATOR ':' ) as added_groups";
	
		
		$s_key = "search.comms.columns";
		$search_columns = $this->getState($s_key);	// get the list of passed columns for filtering		
		
		$d_var =implode(",", $all_string);
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_SAVEDCOMMS_TABLE).' AS a');
		$query->join('LEFT', CLUB_TEMPLATE_TABLE.' AS b ON a.template_id = b.template_id');	
		$query->join('LEFT', '#__users AS usert ON a.created_by = usert.id');
		$query->join('LEFT', CLUB_SAVEDCOMMS_GROUP_TABLE.' AS s ON a.comm_id = s.comm_id');
		$query->join('LEFT', CLUB_GROUPS_TABLE.' AS gr ON s.group_id = gr.group_id');
		
		require_once(CLUBREG_COMPONENTS."helpers/clubreg.daterange.php");
		$dateRangeObj = new ClubRegDateRangeHelper();
		
		foreach($search_columns as $skey => $a_col){ // only loop thru filters passed
			$control = isset($a_col['control'])?$a_col['control']:"";
			$fkey = "filter.".$skey;
			$filter_value =  $this->state->get($fkey);			
			if(isset($a_col['filter_col'])){
				switch($control){					
					case "select.genericlist":					
						if($filter_value !== "-1" && !is_null($filter_value)){
							$where_[] = sprintf(" %s = %s ",$a_col['filter_col'],$db->quote($filter_value) );  // Only Eoi Members 
							$back_url[$skey] = $filter_value;
						}						
					break;
					case "date.range":
						
						if($filter_value != '-1'){				
							$dateRangeObj->getQuery($filter_value, $a_col['filter_col'], $where_); // too complex not to be a method should be static??
							$back_url[$skey] = $filter_value;
						}
					break;
					default:
						$filter_value = trim($filter_value);											
							if(strlen($filter_value) > 0){
								$back_url[$skey] = $filter_value;
								$filter_value = sprintf('%%%s%%',$filter_value); $quoute_value = $db->quote($filter_value);
								if(is_array($a_col['filter_col'])){										
									$where_[] = "(". implode(sprintf(" like %s or ",$quoute_value ),$a_col['filter_col']). " like ".$quoute_value.")";
								}else{								
									$where_[] = sprintf(" %s like %s ",$a_col['filter_col'],$quoute_value );  // Only Eoi Members
								}
								
							}	
															
					break;
				}
				
			}
		}	
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}
				
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'a.created');
		$orderDirn	= $this->state->get('list.direction', 'DESC');		
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
		
		$query->group('a.comm_id');		
		
		$session = JFactory::getSession();		
		$session->set("com_clubreg.back_url", $back_url);// save the back url		
		
		return $query;
		
	}
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since   1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{	
		parent::populateState('a.created', 'DESC');				
		$states[] = array("filter.comm_status","comm_status","1");		 // possible that this doesn't work
	
		$tmp_value = null;
		foreach($states as $a_state){
			$vartype = isset($a_state[3])?$a_state[3]:null;
			$tmp_value = $this->getUserStateFromRequest($this->context.'.'.$a_state[0], $a_state[1], $a_state[2],$vartype);			
			$this->setState($a_state[0], $tmp_value);	

			
			unset($tmp_value);
		}	
	}
	/**
	 * use the filters set up in the config
	 * states contains the actual data definition, ie control type, which columns to filter on and default value
	 * @param array $states
	 */
	public function setMoreStates($states = array(), $allowed_groups = array()){
		
		$reset = TRUE;
		$app = JFactory::getApplication();
		
		$reseter = $this->getUserStateFromRequest($this->context.'resetpage', "resetpage");
		
		if($reseter == "reset"){
			$reset = FALSE;
		}
		
		
		//write_debug($states);
		
		foreach($states as $a_key => $a_state){
			$f_key = "filter.".$a_key;	// this will set the state filter key as filter.{colname}

			if($reset){
				$default = isset($a_state["def"])?$a_state["def"]:NULL; // check if a default is set in the config				
			}else{
				$default = isset($a_state["def"])?$a_state["def"]:NULL; // check if a default is set in the config
				$app->setUserState($this->context.'.'.$f_key, NULL); // we should try and reset the session variables
			}
			$tmp_value = $this->getUserStateFromRequest($this->context.'.'.$f_key, $a_key, $default); // get the key in the request which is in the format {column name}
			
			$this->setState($f_key, $tmp_value);			// set the state for the getListQuery Method	
	
			
			unset($tmp_value);
		}
		$s_key = "search.comms.columns";
		$this->setState($s_key, $states); // set the search column it contains all the meta data about the filter boxes, ie columns, contol type and default value 
	
		
		if (isset($allowed_groups["group_leader"]) && count($allowed_groups["group_leader"]) > 0){
			$this->setState("search.allowedgroups", array_keys($allowed_groups["group_leader"]));
		}else{
			$this->setState("search.allowedgroups", array());
		}
		
		if (isset($allowed_groups["sub_groups_ids"]) && count($allowed_groups["sub_groups_ids"]) > 0){
			$this->setState("search.allowedsubgroups", $allowed_groups["sub_groups_ids"]);
		}else{
			$this->setState("search.allowedsubgroups", array());
		}
	}
	
	/**
	 * Method to get a pagination object of the weblink items for the category
	 *
	 * @access public
	 * @return integer
	 */
	public function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			$this->_pagination = new ClubRegPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
		}
	
		return $this->_pagination;
	}
	
}