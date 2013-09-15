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
	
	function display($tpl = null)
	{			
		
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$renderer =  sprintf("%s_%s",$this->getLayout(),$this->getName());
		
		$proceed = FALSE;
		
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