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
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once (JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_clubreg'.DIRECTORY_SEPARATOR.'constants.php');
require_once (JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_clubreg'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'clubreg.php');


class JFormFieldClubsendto extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'clubsendto';
	
	protected function getInput()
	{
		$html =  array();
		$attr = '';
	
	
		$tab_values = array();
	
		
		//$class = $this->element['class'] ? ' class="radio ' . (string) $this->element['class'] . '"' : ' class="radio"';
	
					
			$hide = array("0"=>' checked="checked"',"1"=>"");
			$show = array("0"=>"","1"=>' checked="checked"');
				
			
				$html[] = "<div class='sendto-groups'>";
				
				if(is_array($this->value) && count($this->value) > 0 ){				
					$options = ClubRegHelper::get_selected_group_list($this->value);
					foreach($options as $a_group){
						$html[] = "<a class=\"btn btn-mini btn-success\" title=\"click to add\" data-groupid='".$a_group->group_id."'>".$a_group->group_name."</a>"; 
						$html[] = "&nbsp;";						
					}
					
				}else{
					$html[] ="&nbsp;";
				}
				
				
				
			
				$html[] = "</div>";
		
	
	
		return implode($html);
	}

}