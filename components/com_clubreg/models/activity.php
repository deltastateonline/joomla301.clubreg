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



/**
 * Club Reg Component Activity Model
 *
 */
class ClubRegModelActivity extends JModelLegacy
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function getActivityList($user_id){			
		return $this->getAuditList($user_id);	;		
	}
	
	
	private function getAuditList($user_id){
		
		$db		= JFactory::getDbo();
		
		$activity = $where_ = array();
		
		$where_[] = sprintf(" createdby = %d", $user_id);
		
		$where_[] = sprintf(" a.short_desc in ('updated junior', 'updated senior','updated guardian') ");
		$where_str = "where ".implode(" and ", $where_);
		
		$join_[] = sprintf("  left join %s as b on
				a.primary_id = b.member_id ", CLUB_REGISTEREDMEMBERS_TABLE);
		
		
		$var_str[] = " concat(b.surname,' ',b.givenname) as activity_item";
		$var_string = "";
		
		if(count($var_str) > 0)
			$var_string = ",".implode(",",$var_str );
		
		$join_string = implode(" ",$join_);
		
		$d_qry = sprintf("select 'contacts' as which,
				a.short_desc as activity_label, 
				concat( date_format(a.created_date,'%%d/%%m/%%Y'),' ', a.created_time) as activity_created,
				concat(a.created_date,' ',a.created_time) as acreated				
				%s ,concat('-') as item_key	 from
				%s as a
				%s
				%s 		
				
				 union 
				
				select 'payments' as which, 
				concat('Payment Added To ',cd.givenname,' ',cd.surname) as 'activity_label', 
				date_format(c.created, '%%d/%%m/%%Y %%H:%%i:%%s') as activity_created,
				c.created as acreated,
				concat('Ref No :',c.payment_transact_no) as activity_item,
				concat(c.payment_id,payment_key,'-',length(c.payment_id)) as item_key	
				from %s as c 
				left join %s as cd on (c.member_id = cd.member_id)	
				where c.created_by = %d 
				
				union
				
				select 'notes' as which, 
				concat('Notes Added To ',e.givenname,' ',e.surname) as 'activity_label', 
				date_format(d.created, '%%d/%%m/%%Y %%H:%%i:%%s') as activity_created,
				d.created as acreated,
				concat(SUBSTRING(d.notes,1,50),'...') as activity_item,
				concat(note_id,note_key,'-',length(note_id)) as item_key		
				from %s as d 	
				left join %s as e on (d.primary_id = e.member_id)			
				where d.created_by = %d 
				and lcase(d.note_type) = 'member'				
				
				order by acreated desc
				",
				$var_string,
				CLUB_AUDIT_TABLE,
				$join_string,
				$where_str,
				CLUB_PAYMENTS_TABLE,
				CLUB_REGISTEREDMEMBERS_TABLE,
				$user_id,
				CLUB_NOTES_TABLE,
				CLUB_REGISTEREDMEMBERS_TABLE,
				$user_id
				);
		
		$db->setQuery($d_qry, 0, 20);
		
		$activity = $db->loadObjectList();
		if($db->getErrorNum()> 0){
			write_debug($db);
		}
		
		return $activity;
	}
	public function getBirthdays(){
		
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		
		$activity = $where_ = array();
		
		$where_[] = "date_format(dob,'%m-%d') >= date_format(CURDATE(),'%m-%d')";
		$where_[] = "date_format(dob,'%m-%d') <= date_format(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '%m-%d')";
		
		$where_[] = "dob IS  NOT NULL";
		$where_[] = "date_format(dob,'%Y') != '0000'";
		
		$where_str = "where ".implode(" and ", $where_);
		
		$all_string[] = " member_id, member_key, date_format(dob,'%m-%d') as bdays, surname, givenname ";
		
		$d_var =implode(",", $all_string);
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}		
		
		$query->order('dob asc');
		
		$db->setQuery($query);
		return $db->loadObjectList();
		
	}
}