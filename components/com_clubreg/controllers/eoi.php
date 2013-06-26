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
class ClubregControllerEoi extends JControllerForm
{
	
	public function __construct($config = array())
	{		
		parent::__construct($config);
		$this->registerTask('sendrequest', 'save');
		//$this->registerTask('subedit', 'edit');	
	}	
	
	public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, array('ignore_request' => false));
	}
	//
	public function save($key = null, $urlVar = null){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		$app    = JFactory::getApplication();
		$model  = $this->getModel();
		$Itemid	= $this->input->getInt('Itemid');
		
		$data = $this->input->post->get('jform', array(), 'array');
		
		switch($data["playertype"]){
			
			case "senior":		
				// Attempt to save the data.
				$return	= $model->save($data);				
				$redirect_url = JRoute::_('index.php?option=com_clubreg&view=eoi&layout=senior&Itemid='.$Itemid, false);
			break;
			case "junior":
				$return	= $model->save($data);
				$app->setUserState('com_clubreg.eoi.junior.data', $data);				
				$redirect_url = JRoute::_('index.php?option=com_clubreg&view=eoi&layout=junior&Itemid='.$Itemid, false);
			break;
			
		}

	
		if($return === TRUE){	
			$app->setUserState('com_clubreg.eoi.data', null);
			$app->setUserState('com_clubreg.eoi.junior.data', null);
			$durl = JRoute::_('index.php?option=com_clubreg&view=eoi&layout=success&Itemid='.$Itemid, false);			
		}else{
			// Get the validation messages.
			$errors	= $model->getErrors();
			$app->enqueueMessage($errors[0], 'warning');
			// Save the data in the session.
			$app->setUserState('com_clubreg.eoi.data', $data);			
			$durl = $redirect_url;
		}
		
		$this->setRedirect($durl);
		return false;
	}
}