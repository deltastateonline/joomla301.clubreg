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

class ClubRegUnAuthHelper extends JObject
{
	
	public static function unAuthorised(){				
		JError::raiseWarning( 500, JText::_('CLUBREG_NOTAUTH') );
		return;
	}
	
	public static function noResults(){	?>
			<div class="alert alert-error"><h3><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_NORESULTS'); ?></h3></div>
		<?php	
		return;
	}
}
class ClubRegAuditHelper extends JObject{
	
	static function saveData($old_data,$other_details){
	
		$db		= JFactory::getDBO();
		$user		= JFactory::getUser();
		
		$new_data = new stdClass();
		foreach($old_data as $t_key => $t_value){
			if($t_key[0] == "_") continue;
			$new_data->$t_key = $old_data->$t_key;
		}
		$audit_data = serialize($new_data);
	
		$created = date("Y-m-d H:i:s");
	
		$d_qry = sprintf("insert into %s set primary_id = '%d', short_desc=%s, audit_details = %s,
				created_date ='%s',created_time= '%s',createdby = '%d'",CLUB_AUDIT_TABLE,
				$other_details["primary_id"],$db->Quote($other_details["short_desc"]),$db->Quote($audit_data),
				$created,$created,$user->id);
		$db->setQuery($d_qry);
		$db->query();
	
	}
}