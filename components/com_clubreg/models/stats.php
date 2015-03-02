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
class ClubregModelStats extends JModelList
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

	
	protected function getListQuery()
	{
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);		
		
		$where_ = array();
		$back_url = array();
		
		$d_var = "a.*";
		
		$all_string["n"] = 'a.*';
		
		$all_string["member_name"] = "concat(UCASE(a.`surname`),' ' ,LCASE(a.`givenname`)) as surname";		
		$all_string["t_created_date"] = "date_format(a.created,'%d/%m/%Y') as t_created_date";
		$all_string["t_group"] = "b.group_name as `group`";	
			

		$back_url["playertype"] =  $cfilter = 	$this->state->get('filter.playertype');
		
		if($cfilter == "junior"){
			$all_string["guardian"] = "concat(d.`surname`,' ' ,d.`givenname`) as guardian";		
			$all_string["gaddress"] = "d.`address` as address";
			$all_string["gsuburb"] = "d.`suburb` as suburb";
			$all_string["gpostcode"] = "d.`postcode` as postcode";
			$query->join('LEFT', $db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS d on (a.parent_id = d.member_id)');			
			
		}	
		
		if(in_array($cfilter, array("junior","senior"))){			
			$all_string["ts_group"] = "sg.group_name as `subgroup`";
			$query->join('LEFT', CLUB_GROUPS_TABLE.' AS sg ON a.subgroup = sg.group_id');		

			$allowed_groups = 	$this->state->get('search.allowedgroups');
			if(count($allowed_groups) > 0){
				$allowed_groups[] = 0;
				$allowed_groups[] = -1;				
			}
			
			$allowed_subgroups = 	$this->state->get('search.allowedsubgroups');
			if(count($allowed_subgroups) > 0){				
				$where_[] = sprintf("( a.group in (%s) or  a.subgroup in (%s) )",
						implode(",",$allowed_groups),
						implode(",",$allowed_subgroups));  // Only Eoi Members				
			}else{
				if(is_array($allowed_groups) && count($allowed_groups) > 0)
				$where_[] = sprintf(" a.group in (%s) ",implode(",",$allowed_groups));  // Only Eoi Members
			}	
			
		}
		
		if($cfilter == "guardian"){
			$all_string["howmany"] = " count( c.member_id )  as `howmany`";
			$all_string["my_children"] = " concat('<ol class=\"intable\">',group_concat(concat('<li>',c.`surname`,' ' ,c.`givenname`,'</li>') ORDER BY c.`surname` ASC SEPARATOR '' ),'</ol>')  as `my_children`";
			$query->join('LEFT', $db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS c on (a.member_id = c.parent_id)');
		}
		
		
		if($cfilter){
			$where_[] = sprintf(" a.playertype = '%s' ",$cfilter);  // Only Eoi Members
		}
		
		unset($cfilter);
	
		
		$s_key = "search.columns";
		$search_columns = $this->getState($s_key);	// get the list of passed columns for filtering
		
		$d_var =implode(",", $all_string);
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');
		$query->join('LEFT', CLUB_GROUPS_TABLE.' AS b ON a.group = b.group_id');	
		$query->join('LEFT', '#__users AS usert ON a.created_by = usert.id');
		
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
									$where_[] = "(". implode(sprintf(" like %s or ",$quoute_value ),$a_col['filter_col']). " like ".$quoute_value.")"; // multiple items to be searched
								}else{								
									$where_[] = sprintf(" %s like %s ",$a_col['filter_col'],$quoute_value );  // simple like clause
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
		
		$query->group('a.member_id');		
		
		$session = JFactory::getSession();		
		$session->set("com_clubreg.back_url", $back_url);// save the back url	
		
		//write_debug($query->__toString());
		
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
		
		$params = JComponentHelper::getParams('com_clubreg');
		$default_playertype = $params->get("default_playertype");
		$default_playertype = isset($default_playertype)?$default_playertype:"senior";
				
		$states[] = array("filter.playertype","playertype",$default_playertype,"string");	
		$states[] = array("filter.member_status","member_status","registered");		
	
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
		foreach($states as $a_key => $a_state){
			$f_key = "filter.".$a_key;	// this will set the state filter key as filter.{colname}

			if($reset){
				$default = isset($a_state["def"])?$a_state["def"]:NULL; // check if a default is set in the config				
			}else{
				$app->setUserState($this->context.'.'.$f_key, NULL); // we should try and reset the session variables
			}
			$tmp_value = $this->getUserStateFromRequest($this->context.'.'.$f_key, $a_key, $default); // get the key in the request which is in the format {column name}
			
			$this->setState($f_key, $tmp_value);			// set the state for the getListQuery Method	
	
			
			unset($tmp_value);
		}
		$s_key = "search.columns";
		$this->setState($s_key, $states); // set the search column it contains all the meta data about the filter boxes, ie columns, contol type and default value 
	
		
		if (isset($allowed_groups["allowed_groups"]) && count($allowed_groups["allowed_groups"]) > 0){
			$this->setState("search.allowedgroups", $allowed_groups["allowed_groups"]);
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