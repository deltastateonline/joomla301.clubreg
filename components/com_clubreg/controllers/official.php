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
class ClubregControllerOfficial extends JControllerForm
{
	
	public function __construct($config = array())
	{		
		
		parent::__construct($config);
		$this->registerTask('edit', 'edit');
		$this->registerTask('save', 'save');
	}	
	
	public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
	{
		
		return parent::getModel($name, $prefix, array('ignore_request' => false));
	}
	
	public function edit(){
		
		$app			= JFactory::getApplication();
		$user			= JFactory::getUser();
		$loginUserId	= (int) $user->get('id');
		$Itemid	= $this->input->getInt('Itemid');
		$userId = $this->input->getInt('user_id', null, 'array');
		
		// Check if the user is trying to edit another users profile.
		if ($userId != $loginUserId)
		{
			//JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
			$app->enqueueMessage("Not Authorised Edit Profile", 'warning');
			$durl = JRoute::_('index.php?option=com_clubreg&view=official&layout=noauth&Itemid='.$Itemid, false);
			$this->setRedirect($durl);
			return false;
		}
		
		// Set the user id for the user to edit in the session.
		$app->setUserState('com_clubreg.edit.official.Itemid', $Itemid);
		$app->setUserState('com_clubreg.edit.official.id', $userId);
		
		$this->setRedirect(JRoute::_('index.php?option=com_clubreg&view=official&layout=edit', false));
	}
	
	public function save(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		$app			= JFactory::getApplication();
		$user			= JFactory::getUser();
		$Itemid			= $this->input->post->get('Itemid');		
		$userId 		= $app->getUserState('com_clubreg.edit.official.id');		
		
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$userId);
		
		$extraDetails = $this->input->post->get('extraDetails', array(), 'array');
		$monthyear = $this->input->post->get('monthyear', array(), 'array');
		$current_model->saveExtraDetails($extraDetails,$monthyear );
		
		unset($current_model);
		
		$durl = JRoute::_('index.php?option=com_clubreg&task=official.edit&user_id='.$userId.'Itemid='.$Itemid, false);
		$this->setRedirect($durl);
	}
}