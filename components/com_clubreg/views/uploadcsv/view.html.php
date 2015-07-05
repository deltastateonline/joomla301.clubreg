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


class ClubRegViewuploadcsv extends ClubRegViews
{
	
	
	protected function start_uploadcsv (){
		
		$user		= JFactory::getUser();
		$proceed = FALSE;
		
		unset($current_model);		
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));
		
		$app		= JFactory::getApplication();
		$active	= $app->getMenu()->getActive(); // if logged in
		
	
		
		if($current_model->getPermissions('manageusers')){
			$proceed = TRUE;		
			
			unset($currentModel);
			$this->formaction = 'index.php?option=com_clubreg&view=uploadcsv';
			
			
			$currentModel = JModelLegacy::getInstance('uploadcsv', 'ClubregModel', array('ignore_request' => false));			
			$currentModel->setState('com_clubreg.uploadcsv.link_type',"members"); // use the note type in the model			
			$this->uploadForm = $currentModel->getForm();			
			
		}
		
		$this->pageTitle = $active->title;
		
		return $proceed;
	}
	
	
	
	
	
	
}