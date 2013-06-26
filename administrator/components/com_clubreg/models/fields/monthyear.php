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

/**
 * this is a composite control ie made up of 2 controls, but only i vaule will be store in the database table.
 * month-year, rather than trying to save 2 values.
 */

defined('JPATH_BASE') or die;

class JFormFieldMonthyear extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'monthyear';

	protected function getInput(){
		
		$value = "value";	$text = "text";
		
		$attr["month"]  = "";		
		$attr["month"] .= ' class="input-medium"';				
		$name["month"] = str_replace("]", "_month]", $this->name); // given the control create the month field
		
		$options = ClubRegHelper::getMonths();			
		
		$name["year"] = str_replace("]", "_year]", $this->name); // create the year field as well
		$attr["year"] =  ' class="input-mini"';
		$attr["year"] .=  ' maxlength="4"';			

		$name["hidden"] = substr($this->name,strpos($this->name, "[")+1); // create hidden variable to store monthyear
		$name["hidden"] = str_replace("]", "", $name["hidden"]);	

		$monthYearValues = explode("-",$this->value);
		
		$monthYearValues[0] = isset($monthYearValues[0])?$monthYearValues[0]:"0";
		$monthYearValues[1] = isset($monthYearValues[1])?$monthYearValues[1]:"";
		 
		
		$html[] = JHtml::_('select.genericlist', $options,$name["month"], trim($attr["month"]), $value,$text,$monthYearValues[0],$this->id."_month");
		$html[] = sprintf("<input type=\"text\" %s name='%s' id='%s' value='%s' />", trim($attr["year"]) ,$name["year"],$this->id."_year" , $monthYearValues[1]);		
		$html[] = sprintf("<input type=\"hidden\" name='monthyear[%s]'  value='%s' />" ,$name["hidden"],$name["hidden"]);
		
		unset($name);unset($attr);
		return implode($html);
		
	}
	
	
}