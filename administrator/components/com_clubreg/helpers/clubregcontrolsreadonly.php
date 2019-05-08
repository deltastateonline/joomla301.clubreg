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


class ClubRegControlsReadonlyHelper extends JObject
{
	private $control_type = null;
	private $clubregControl = null;
	private $fieldXml = null;
	private $params = null;
	private $defaultValue = null;
	private $controlValue = null;
	protected $configData = null;
	protected $memberDetails = null;
	
	public function __construct($params){
		if(!isset($params['control_type']) || strlen($params['control_type']) < 4){
			$this->control_type = "text";
		}else{
			$this->control_type = $params['control_type'];
		}
	
		$this->params = $params;
		$this->controlValue = null;
		$this->defaultValue = "";
	}
	public  function render(){			
		$renderer = "render".ucfirst(strtolower($this->control_type));
		
		if(method_exists($this,$renderer)){
		
			$this->controlValue = isset($this->memberDetails)?$this->memberDetails->member_value:null;
		
			
			if(!isset($this->controlValue)){
				$this->controlValue = $this->defaultValue;
			}			
			echo $this->$renderer();		
			
		}else{
			echo $renderer;
		}
	}
	
	private function renderTextarea(){		
		return nl2br($this->controlValue);
	}
	private function renderText(){
		return  $this->controlValue;
	}
	private function renderEmail(){
		return JHtml::_('email.cloak', $this->controlValue); ;
	}
	private function renderDate(){
		return JHtml::_('date', $this->controlValue, JText::_('DATE_FORMAT_LC1'));
	}
	
	private function renderMonthyear(){
		
		$monthYearValues = (strpos($this->controlValue,"-")===FALSE)?array():explode("-",$this->controlValue);		
		
		$monthYearValues[0] = isset($monthYearValues[0])?$monthYearValues[0]:"0";
		$monthYearValues[1] = isset($monthYearValues[1])?" ".$monthYearValues[1]:"";
		$all_months = ClubRegHelper::getMonths();
		
		return $all_months[$monthYearValues[0]]->text." , ".$monthYearValues[1];
	}
	private function renderList(){
		$possibleOptions = explode("\r\n",trim($this->configData->config_text));
		foreach($possibleOptions as $anOption){			
			$options[trim($anOption)] = ucwords(trim($anOption));				
		}
		return  @$options[trim($this->controlValue)];		
	}
	
	/**
	 * the control value has been json encoded and should be decoded
	 * @return string
	 */
	private function renderMlist(){			
		 return  (!empty($this->controlValue))? implode("<br />",json_decode($this->controlValue)):"";	
	}
}