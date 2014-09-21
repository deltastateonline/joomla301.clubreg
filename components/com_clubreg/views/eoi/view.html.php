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

jimport( 'joomla.application.component.view');

class ClubRegVieweoi extends JViewLegacy
{
	function display($tpl = null)
	{
		
		$renderer =  $this->getLayout();
		$proceed = FALSE;
		
		$app	= JFactory::getApplication();
		$menu	= $app->getMenu();		
		$menuItem = $menu->getActive();
		if($menuItem){ $this->eoi_usetable =  $menuItem->params->get('eoi_usetable'); }
		
		if(method_exists($this, $renderer)){
			$proceed =  $this->$renderer();			
		}	

		if($proceed){
			parent::display($tpl);
		}else{
			ClubRegUnAuthHelper::unAuthorised();
		}
	}
	private function senior(){					
		$this->form		= $this->get('Form');	
		return TRUE;
	}
	private function junior(){		
		$this->form		= $this->get('Form');	
		$this->juniorDetails = $this->get('JuniorDetails');	
		$this->juniorControls = $this->get('juniorControls');
		return TRUE;
	}
	private function success(){
		$this->eoi_template	= $this->get('Template');	
		return TRUE;
	}	
	
}