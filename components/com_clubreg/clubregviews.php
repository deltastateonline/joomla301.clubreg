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

//jimport( 'joomla.application.component.view');

class ClubRegViews extends JViewLegacy
{
	protected $layout = NULL;
	
	function display($tpl = null)
	{			
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$this->layout = $this->getLayout();
		
		$renderer =  sprintf("%s_%s",$this->layout,$this->getName());
		
		$proceed = FALSE;
		
		$options = array();
		$options['format'] = '{DATE}\t{TIME}\t{LEVEL}\t{CODE}\t{MESSAGE}';
		$options["text_file"] = "clubreg.{$this->getName()}.error.php";
		JLog::addLogger($options);
				
		if(method_exists($this, $renderer)){			
			$proceed =  $this->$renderer();			
		}		
		
		if($proceed){		
			parent::display($tpl);					
		}else{
			ClubRegUnAuthHelper::unAuthorised();
		}
	}
}