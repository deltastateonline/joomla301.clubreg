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
/*
 * Manage a list of products or items which payments should be requested for
 */
defined('_JEXEC') or die;

jimport( 'joomla.application.component.controlleradmin' );

class ClubRegControllerOfficials extends JControllerAdmin{
	
	//protected $default_view = 'Officials';
	public function __construct($config = array())
	{
		parent::__construct($config);
		$this->registerTask('link', 'link');
		$this->registerTask('unlink', 'unlink');
	}
	
	public function getModel($name = 'Official', $prefix = 'ClubregModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);		
		return $model;
	}
	public function link(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));

		// Get items to remove from the request.
		$cid = JFactory::getApplication()->input->get('cid', array(), 'array');
		
		$msg = "";

		if (!is_array($cid) || count($cid) < 1)
		{
			JLog::add(JText::_($this->text_prefix . '_NO_ITEM_SELECTED'), JLog::WARNING, 'jerror');
			$msg = "No User Selected";
		}
		else
		{
			// Get the model.
			$model = $this->getModel();

			// Make sure the item ids are integers
			jimport('joomla.utilities.arrayhelper');
			JArrayHelper::toInteger($cid);

			// Remove the items.
			if ($model->link($cid))
			{
				$msg = JText::plural($this->text_prefix . '_N_ITEMS_LINKED', count($cid));
				
			}
			else
			{
				$msg = "Link Method can not be called ";
			}
		}	
		
		$url = "index.php?option=com_clubreg&view=officials&layout=link&tmpl=component";

		$this->setRedirect(JRoute::_($url, false),$msg);
	}
	
	public function unlink(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		// Get items to remove from the request.
		$cid = JFactory::getApplication()->input->get('cid', array(), 'array');
	
		$msg = "";
	
		if (!is_array($cid) || count($cid) < 1)
		{
			JLog::add(JText::_($this->text_prefix . '_NO_ITEM_SELECTED'), JLog::WARNING, 'jerror');
			
		}
		else
		{
			// Get the model.
			$model = $this->getModel();
	
			// Make sure the item ids are integers
			jimport('joomla.utilities.arrayhelper');
			JArrayHelper::toInteger($cid);
	
			// Remove the items.
			if ($model->link($cid,'0'))
			{
				$msg = JText::plural($this->text_prefix . '_N_ITEMS_UNLINKED', count($cid));
	
			}
			else
			{
				$msg = "Link Method can not be called ";
			}
		}
		
		$this->setMessage($msg, 'message');
	
		$extension = $this->input->get('extension');
		$extensionURL = ($extension) ? '&extension=' . $extension : '';
		$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $extensionURL, false));
	}
	
}