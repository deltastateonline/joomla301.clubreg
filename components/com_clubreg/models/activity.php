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
		
		$where_[] = sprintf(" a.short_desc in ('updated juniorx', 'updated seniorx','updated guardianx') ");
		$where_str = "where ".implode(" and ", $where_);
		
		$join_[] = sprintf("  left join %s as b on
				a.primary_id = b.member_id ", CLUB_REGISTEREDMEMBERS_TABLE);
		
		
		$var_str[] = " concat(b.surname,' ',b.givenname) as activity_item";
		$var_string = "";
		
		if(count($var_str) > 0)
			$var_string = ",".implode(",",$var_str );
		
		$join_string = implode(" ",$join_);
		
		$d_qry = sprintf("select 'contacts' as which,
				a.short_desc as which_label, a.short_desc as activity_label, 
				concat( date_format(a.created_date,'%%d/%%m/%%Y'),' ', a.created_time) as activity_created,
				concat(a.created_date,' ',a.created_time) as acreated				
				%s ,concat('-') as item_key,
				b.member_id, b.member_key
				from
				%s as a
				%s
				%s 		
				
				 union 
				
				select 'payments' as which, 
				concat('Payment Added To ') as which_label , concat(cd.givenname,' ',cd.surname) as 'activity_label', 
				date_format(c.created, '%%d/%%m/%%Y %%H:%%i:%%s') as activity_created,
				c.created as acreated,
				concat('Ref No :',c.payment_transact_no) as activity_item,
				concat(c.payment_id,payment_key,'-',length(c.payment_id)) as item_key,
				cd.member_id, cd.member_key	
				from %s as c 
				left join %s as cd on (c.member_id = cd.member_id)	
				where c.created_by = %d 
				
				union
				
				select 'notes' as which, 
				concat('Notes Added To ') as which_label, concat(e.givenname,' ',e.surname) as 'activity_label', 
				date_format(d.created, '%%d/%%m/%%Y %%H:%%i:%%s') as activity_created,
				d.created as acreated,
				if(length(d.notes) > 50,concat(SUBSTRING(d.notes,1,50),'...'),d.notes) as activity_item,
				hex(`note_key`) as item_key,
				e.member_id, e.member_key		
				from %s as d 	
				left join %s as e on (d.primary_id = e.member_id)			
				where d.created_by = %d 
				and lcase(d.note_type) = 'member'
				and note_status != 99

				union
				
				select 'files' as which, 
				concat('Files Added To ') as which_label, concat(att_m.givenname,' ',att_m.surname) as 'activity_label', 
				date_format(att.created, '%%d/%%m/%%Y %%H:%%i:%%s') as activity_created,
				att.created as acreated,
				if(length(att.attachment_fname) > 50,concat(SUBSTRING(att.attachment_fname,1,50),'...'),att.attachment_fname) as activity_item,
				concat(attachment_id,attachment_key,'-',length(attachment_id)) as item_key,
				att_m.member_id, att_m.member_key		
				from %s as att 	
				left join %s as att_m on (att.primary_id = att_m.member_id)			
				where att.created_by = %d 
				and lcase(att.link_type) = 'member'				
				
				union
				
				select 'assets' as which, 
				concat('Asset Added To ') as which_label, concat(ass_m.givenname,' ',ass_m.surname) as 'activity_label', 
				date_format(asset.created, '%%d/%%m/%%Y %%H:%%i:%%s') as activity_created,
				asset.created as acreated,
				concat('Make :',asset.property_make,' S/N:',asset.property_serial) as activity_item,
				concat(property_id,property_key,'-',length(property_id)) as item_key,
				ass_m.member_id, ass_m.member_key		
				from %s as asset 	
				left join %s as ass_m on (asset.member_id = ass_m.member_id)			
				where asset.created_by = %d 				
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
				$user_id,
				CLUB_ATTACHMENTS_TABLE,
				CLUB_REGISTEREDMEMBERS_TABLE,
				$user_id,
				CLUB_PROPERTY_TABLE,
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
	/**
	 * Get a list of players who have a birthday in the next 7 days
	 * @return mixed
	 */
	public function getBirthdays(){
		
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		
		$activity = $where_ = array();
		
		$where_[] = "date_format(dob,'%m-%d') >= date_format(CURDATE(),'%m-%d')";
		$where_[] = "date_format(dob,'%m-%d') <= date_format(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '%m-%d')";
		
		$where_[] = "dob IS  NOT NULL";
		$where_[] = "date_format(dob,'%Y') != '0000'";
		
		$where_str = "where ".implode(" and ", $where_);
		
		$all_string[] = " member_id, member_key, date_format(dob,'%a %D %M') as bdays, surname, givenname ";
		
		$d_var =implode(",", $all_string);
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}		
		
		$query->order("date_format(dob,'%m %d') asc");
		
		$db->setQuery($query);
		return $db->loadObjectList();
		
	}
}