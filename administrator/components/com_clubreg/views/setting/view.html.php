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

class ClubRegViewSetting extends JViewLegacy
{
	protected $item;
	
	protected $form;
	
	protected $state;
	
	/**
	 * Display the view
	 */
	public function display($tpl = null){
		
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		$this->addToolbar();
		
		$parent_which = $this->form->getValue('which_config');		
		$this->parent_data = ClubRegHelper::getConfigTagByName($parent_which);
		
		parent::display($tpl);
		
	}
	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		
		
		JFactory::getApplication()->input->set('hidemainmenu', true);
	
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->config_id == 0);
		$checkedOut	= isset($this->item->checked_out) && !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		// Since we don't track these assets at the item level, use the category id.
		$canDo		= @ClubRegHelper::getActions($this->item->catid, 0);
		
		$cTitle = sprintf("%s::%s",JText::_('COM_CLUBREG'),JText::_('CLUBREG_SETTINGS'));
		
		JToolbarHelper::title($cTitle, 'settings.png');
	
		// If not checked out, can save the item.
		if (!$checkedOut && $canDo->get('core.edit')) {
			JToolbarHelper::apply('setting.apply');
			JToolbarHelper::save('setting.save');
		}
		if (!$checkedOut){
			//JToolbarHelper::save2new('setting.save2new');
		}
		
		if (empty($this->item->config_id))  {
			JToolbarHelper::cancel('setting.cancel');
		} else {
			JToolbarHelper::cancel('setting.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}