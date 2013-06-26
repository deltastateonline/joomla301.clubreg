<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2012 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class ClubRegDateRangeHelper extends JObject
{
	/**
	 * Generate the where clause for a date range
	 * @param unknown_type $date_range
	 * @param unknown_type $column
	 * @param unknown_type $where_
	 */
	public function getQuery($date_range, $column, &$where_){
				
		switch($date_range){
			case "today":
				$where_[] = sprintf("date_format(a.created,'%%Y-%%m-%%d') = '%s'",date('Y-m-d'));
				break;
			case "7days":
				$where_[] = $column."  >= DATE_ADD(CURDATE(), INTERVAL -7 DAY) ";
				$where_[] = $column."  <= CURDATE() ";
				break;
			case "month":
				$where_[] = sprintf("date_format(%s,'%%Y-%%m') = '%s'",$column, date('Y-m'));
				break;
			case "lastmonth":
				$where_[] = sprintf(" date_format(%s, '%%Y-%%m') = date_format(CURDATE() - INTERVAL 1 MONTH, '%%Y-%%m') ",$column);
			break;
		}	
	}
}