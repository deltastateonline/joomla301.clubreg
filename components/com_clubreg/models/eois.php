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
class ClubregModelEois extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.member_id',
					'a.surname','a.givenname',
					'a.emailaddress'
			);
		}
	
		parent::__construct($config);
		
		//Get configuration
		$app    = JFactory::getApplication();
		$config = JFactory::getConfig();		
		
		$this->setState('limit', $app->getUserStateFromRequest('com_clubreg.limit', 'limit', $config->get('list_limit'), 'uint'));
		$this->setState('limitstart', $app->input->get('limitstart', 0, 'uint'));
		
	}
	public function getUnApproved($which = NULL){
		
		if(isset($which) && strlen($which)> 0 ) {			
			$db = JFactory::getDbo();
			$d_var = "count(a.member_id) as howmany";
			
			$query	= $db->getQuery(true);
			
			$query->select($d_var);
			$query->from($db->quoteName(CLUB_EOIMEMBERS_TABLE).' AS a');
			
			$query->where("a.member_status = 'eoi'");
			$query->where(sprintf(" a.playertype in (%s) ",$db->quote($which)));
			
			$db->setQuery($query);
			
			return $db->loadResult();
			
			
		}else{			
			JError::raiseWarning( 500, "Method not called with the right arguments!!!" );	
			return 0;
		}
		
	}
	
	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);		
		
		$where_ = array();
		
		$d_var = "a.*";
		
		$all_string["n"] = 'a.*';
		
		$all_string["member_name"] = "concat(UCASE(a.`surname`),' ' ,LCASE(a.`givenname`)) as surname";		
		$all_string["t_created_date"] = "date_format(a.created,'%d/%m/%Y') as t_created_date";
		$all_string["t_group"] = "b.group_name as `group`";
		$all_string["dob"] = " (if(a.dob = '0000-00-00' , '-' , date_format(a.dob,'%d/%m/%Y'))) as dob";
		$all_string["gender"] = " (if(a.gender = '-1' , '' , a.gender)) as gender";
		
		
		//$table_join ="";	
		$cfilter = 	$this->state->get('filter.playertype');
		if($cfilter == "junior"){
			$all_string["guardian"] = "concat(d.`surname`,' ' ,d.`givenname`) as guardian";		
			$all_string["gaddress"] = "d.`address` as address";
			$all_string["gsuburb"] = "d.`suburb` as suburb";
			$all_string["gpostcode"] = "d.`postcode` as postcode";
			$query->join('LEFT', $db->quoteName(CLUB_EOIMEMBERS_TABLE).' AS d on (a.parent_id = d.member_id)');
		}	
		
		if($cfilter == "guardian"){
			$all_string["howmany"] = " count( c.member_id )  as `howmany`";
			$all_string["my_children"] = " concat('<ol class=\"intable\">',group_concat(concat('<li>',c.`surname`,' ' ,c.`givenname`,'</li>') ORDER BY c.`surname` ASC SEPARATOR '' ),'</ol>')  as `my_children`";
			$query->join('LEFT', $db->quoteName(CLUB_EOIMEMBERS_TABLE).' AS c on (a.member_id = c.parent_id)');
		}
		
		
		if($cfilter){
			$where_[] = sprintf(" a.playertype = '%s' ",$cfilter);  // Only Eoi Members
		}
		
		unset($cfilter);
		
		$s_key = "search.columns";
		$search_columns = $this->getState($s_key);	// get the list of passed columns for filtering
		
		$d_var =implode(",", $all_string);
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_EOIMEMBERS_TABLE).' AS a');
		$query->join('LEFT', CLUB_GROUPS_TABLE.' AS b ON a.group = b.group_id');			
		
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
						}						
					break;
					case "date.range":						
						$dateRangeObj->getQuery($filter_value, $a_col['filter_col'], $where_); // too complex not to be a method should be static??
					break;
					default:
						$filter_value = trim($filter_value);											
							if(strlen($filter_value) > 0){
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
		
		$query->group('a.member_id');	
		
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
				
		$states[] = array("filter.playertype","playertype","guardian");	
		$states[] = array("filter.member_status","member_status","eoi");
	
		$tmp_value = null;
		foreach($states as $a_state){
			$tmp_value = $this->getUserStateFromRequest($this->context.'.'.$a_state[0], $a_state[1], $a_state[2]);
			$this->setState($a_state[0], $tmp_value);				
			unset($tmp_value);
		}	
	}
	/**
	 * use the filters set up in the config
	 * @param array $states
	 */
	public function setMoreStates($states = array()){
		
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
		$this->setState($s_key, $states);
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