<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

/**
 * Tags Component Tag Model
 *
 * @since  3.1
 */
class ClubregModelAlerts extends JModelList
{
	
	/**
	 * Method to build an SQL query to load the list data of all items with a given tag.
	 *
	 * @return  string  An SQL query
	 *
	 * @since   3.1
	 */
	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$where_ = array();
		
		if($type == "yearly"){
			$where_[] = "date_format(alert_date,'%m-%d') >= date_format(CURDATE(),'%m-%d')";
			$where_[] = "date_format(alert_date,'%m-%d') <= date_format(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '%m-%d')";
			$where_[] = "a.alert_interval = 'yearly'";
		}else if($type == "monthly"){
			$where_[] = "date_format(alert_date,'%d') >= date_format(CURDATE(),'%d')";
			$where_[] = "date_format(alert_date,'%d') <= date_format(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '%d')";
			$where_[] = "a.alert_interval = 'monthly'";
		}
		
	
		
		$all_string[] = " member_id, member_key, date_format(alert_date,'%a %D %M') as alertDate, surname, givenname ";
		$all_string[] = "c.config_name ";		
		
		$d_var =implode(",", $all_string);
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_ALERTS_TABLE).' AS a');
		$query->join('LEFT', $db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS b ON a.member_id = b.member_id');
		$query->join('LEFT', $db->quoteName(CLUB_CONFIG_TABLE).' AS c ON a.alert_type = b.config_short');
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'a.alert_date');
		$orderDirn	= $this->state->get('list.direction', 'DESC');
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
				
		
		return $query;
	}
}