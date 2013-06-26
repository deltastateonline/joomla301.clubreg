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

//echo "here1";
class ClubregViewSettings extends JViewLegacy
{
	protected $form;

	protected $item;

	protected $state;
	
	public function display($tpl = null)
	{
		$layout =  $this->getLayout();	
		
		switch($layout){

			default :
				$currentModel = $this->getModel();
				
				$currentModel->set("has_children",true);				
				$this->config_list = ClubRegHelper::configOptions(TOPMOST);
			break;
		}		
		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		
		$this->formaction = 'index.php?option=com_clubreg&view=settings';
		$this->colspan = 9;
		
		ClubRegHelper::addSubmenu('settings');
		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);		
		
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
			
		$canDo = ClubRegHelper::getActions($this->state->get('filter.category_id'));		
		
		$user = JFactory::getUser();
		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');
				
		$cTitle = sprintf("%s::%s",JText::_('COM_CLUBREG'),JText::_('CLUBREG_SETTINGS'));
	
		JToolbarHelper::title($cTitle, 'templates.png');
		if ($canDo->get('core.create')) 
		{
			JToolbarHelper::addNew('setting.add');
		}
	
		if (($canDo->get('core.edit')))
		{
			JToolbarHelper::editList('setting.edit');
		}
	
		if ($canDo->get('core.edit.state'))
		{
			if ($this->state->get('filter.state') != 2)
			{
				JToolbarHelper::publish('settings.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('settings.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			}
	
			if ($this->state->get('filter.state') != -1)
			{
				if ($this->state->get('filter.state') != 2)
				{
					JToolbarHelper::archiveList('settings.archive');
				}
				elseif ($this->state->get('filter.state') == 2)
				{
					JToolbarHelper::unarchiveList('settings.publish');
				}
			}
		}	
	
	
		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'settings.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('settings.trash');
		}		
	
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_clubreg');
		}		
	
		JHtmlSidebar::setAction('index.php?option=com_clubreg&view=settings');		
	
		JHtmlSidebar::addFilter(
				JText::_('JOPTION_SELECT_PUBLISHED'),
				'filter_state',
				JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);	
		
		JHtmlSidebar::addFilter(
				JText::_('- Setting List - '),
				'which_config',
				JHtml::_('select.options', $this->config_list, 'value', 'text', $this->state->get('filter.whichConfig'),true)
		);		
	}
	protected function getSortFields()
	{
		return array(
				'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
				'a.published' => JText::_('Published'),
				'a.created' => JText::_('Created On'),
				'b.name' => JText::_('Created By'),
				'a.config_name' => JText::_('Setting Name'),
				'a.config_short' => JText::_('Setting Tag'),				
				'a.config_id' => JText::_('Setting Id')
		);
	}
	
}