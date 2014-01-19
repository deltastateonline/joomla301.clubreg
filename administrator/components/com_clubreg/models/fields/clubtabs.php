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
define('DS',DIRECTORY_SEPARATOR);
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_clubreg'.DS.'constants.php');
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_clubreg'.DS.'helpers'.DS.'clubreg.php');

require_once JPATH_ROOT.DS.CLUBREG_CONFIGS.'config.profile.php';


class JFormFieldClubtabs extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'clubtabs';

	protected function getInput()
	{
		$html =  array();
		$attr = '';
		
		$value = "group_id";
		$text = "group_name";
		$tab_values = array();
		
		$control_which = 	($this->element['configwhich'])?$this->element['configwhich']:"";
		
		$class = $this->element['class'] ? ' class="radio ' . (string) $this->element['class'] . '"' : ' class="radio"';
		
		$ctrl_prefix = $this->element['name'];
		$tab_values = $this->value;	
		
		if(isset($control_which)){
			
			$configObj = new ClubRegProfileConfig();
			$all_tabs =  $configObj->all_tabs(); // return headings which hold config details
			
			$hide = array("0"=>' checked="checked"',"1"=>"");
			$show = array("0"=>"","1"=>' checked="checked"');
			
			if(count($all_tabs) > 0){
				$html[] = "<div class='row-striped'>";
				
				foreach($all_tabs as $key =>$a_tab){	

					if(in_array($control_which, $a_tab["applies"])){ // does this tab apply to this type
						
						$tmp_ctrl_id = sprintf("%s_%s",$ctrl_prefix,$key);
						
						$ctrl_name = sprintf("jform[%s][%s]",$ctrl_prefix,$key); // [tab{type}][tab_name]

						$show_checked = "";
						$hide_checked = "";
						if(isset($tab_values[$key]) ){
							$show_checked = $show[$tab_values[$key]];
							$hide_checked = $hide[$tab_values[$key]];
						}else{
							$hide_checked = $hide[0];
						}				
						
						$onclick = $class =   '';					
											
						$html[] = "<div class='row '>";
						$html[] = "<div class='control-label'>".JText::_($a_tab["label"])."</div>";
						$html[] = "<div class='controls'>";
						$html[] = "<fieldset class='radio btn-group'>";
						$ctrl = $tmp_ctrl_id."0";
						$html[] = '<input type="radio" id="' . $ctrl. '" name="' . $ctrl_name . '" value="0"' . $hide_checked . '/>';					
						$html[] = '<label for="' . $ctrl .'">'. JText::_('JHIDE') . '</label>';				
						
						
						$ctrl = $tmp_ctrl_id."1";
						$html[] = '<input type="radio" id="' . $ctrl. '" name="' . $ctrl_name . '" value="1"' . $show_checked . '/>';		
						$html[] = '<label for="' . $ctrl .'">'. JText::_('JSHOW') . '</label>';
						
						$html[] = "</fieldset>";
						$html[] = "</div>";
						
						$html[] = "</div>";
					}
				}
				$html[] = "</div>";
			}			
		}


		return implode($html);
	}
}
