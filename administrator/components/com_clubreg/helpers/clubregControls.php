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


class ClubRegControlsHelper extends JObject
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
	private function createXMLElement(){
		$this->fieldXml = new SimpleXMLElement('<field />');	
		
		$controlName= sprintf("extraDetails[%s]",$this->configData->config_short);
		$this->fieldXml->addAttribute('name', $controlName);
		
		$controlId = sprintf("control_%d",$this->configData->config_id);
		$this->fieldXml->addAttribute('id',$controlId );
		
		
		if(isset($this->params["control_class"]) && strlen($this->params["control_class"])> 3){
			$this->fieldXml->addAttribute('class',trim($this->params["control_class"]) );			
		}
		
		if(isset($this->params["default_value"]) && strlen($this->params["default_value"])> 0){
			$this->defaultValue = $this->params["default_value"];		
		}else{
			$this->defaultValue = "";
		}
		
		$this->controlValue = isset($this->memberDetails)?$this->memberDetails->member_value:null;
		
		
	}		
	
	public static function configOptions($whichConfig, $ordering='ordering asc'){
			
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
	
		$query->select(" * ");
		$query->from($db->quoteName(CLUB_CONFIG_TABLE));
			
		if(is_array($whichConfig)){
			$query->where(sprintf('which_config = %s', $db->quote($whichConfig[0])));
			$query->where(sprintf('config_short = %s', $db->quote($whichConfig[1])));
	
		}else{
			$query->where(sprintf('which_config = %s', $db->quote($whichConfig)));
		}
		
		$query->where('published = 1');
		$query->order($ordering);
	
		$db->setQuery($query);
		
		//echo $query->__toString();
	
		$options = array();
	
		try
		{
			$options = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	
		return $options;
	
	}
	
	public  function render(){	
		
		$this->createXMLElement();
		
		$renderer = "render".ucfirst(strtolower($this->control_type));
		
		if(method_exists($this,$renderer)){
			$this->clubregControl = $this->$renderer();
			
			if($this->clubregControl && !is_null($this->clubregControl)){
				
				if(!isset($this->controlValue)){
					$this->controlValue = $this->defaultValue;
				}
				$this->clubregControl->setup($this->fieldXml,$this->controlValue);
				
				if($rendered = $this->clubregControl->__get('input')){
					echo $rendered;
				}
			}
			
		}else{
			echo "no renderer";
		}
	}
	
	private function renderCheckboxes(){
	
	}
	private function renderDate(){
		JFormHelper::loadFieldClass("calendar");
		return  new JFormFieldCalendar();	
	}
	private function renderCalendar(){
		JFormHelper::loadFieldClass("calendar");
		return  new JFormFieldCalendar();	
	}
	
	private function renderList(){
		JFormHelper::loadFieldClass("list");
		
		$possibleOptions = explode("\r\n",trim($this->configData->config_text));
		
		$optionXml = $this->fieldXml->addChild('option',trim('-Select '.$this->configData->config_name.'-')) ;			
		$optionXml->addAttribute('value','none' );
		foreach($possibleOptions as $anOption){	
			
			$optionXml = $this->fieldXml->addChild('option') ;			
			$optionXml->addAttribute('value',trim($anOption) );
			
		}
		
		return  new JFormFieldList();
	}
	
	
	private function renderMlist(){
		JFormHelper::loadFieldClass("list");
	
		$possibleOptions = explode("\r\n",trim($this->configData->config_text));		
		
		$this->fieldXml->addAttribute('multiple',TRUE );
	
		$optionXml = $this->fieldXml->addChild('option',trim('-Select '.$this->configData->config_name.'-')) ;
		$optionXml->addAttribute('value','none' );
		foreach($possibleOptions as $anOption){
				
			$optionXml = $this->fieldXml->addChild('option') ;
			$optionXml->addAttribute('value',trim($anOption) );
				
		}
	
		return  new JFormFieldList();
	}
	
	
	private function renderEmail(){
		JFormHelper::loadFieldClass("email");
		return  new JFormFieldEmail();
	
	}
	private function renderMonthyear(){
		JFormHelper::loadFieldClass("monthyear");		
		return  new JFormFieldMonthyear();
	}
	private function renderTextarea(){
		JFormHelper::loadFieldClass("textarea");		
		$this->fieldXml->addAttribute('rows',10 );		
		return new JFormFieldTextarea();; 
	}
	private function renderText(){	
		JFormHelper::loadFieldClass('text');
		return  new JFormFieldText();	
	}
	private function renderFile(){
	
	}
}