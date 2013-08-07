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

class ClubregViewTemplates extends JViewLegacy
{
	protected $form;

	protected $item;

	protected $state;
	
	public function display($tpl = null)
	{		
		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');		
		
		$this->formaction = 'index.php?option=com_clubreg&view=templates';
		
		$templateModel = $this->getModel();
		$templateModel->set("whichConfig","template_status");
		$this->templateStatus	=  $this->get("templateConfig");	
		
		$templateModel->set("whichConfig","template_access");
		$this->templateAccess	=  $this->get("templateConfig");
		
		$templateModel->set("whichConfig","template_type");
		$this->templateType	=  $this->get("templateConfig");
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		ClubRegHelper::addSubmenu('templates');
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
		//require_once JPATH_COMPONENT . '/helpers/banners.php';
	
		$canDo = ClubRegHelper::getActions($this->state->get('filter.category_id'));
		$user = JFactory::getUser();
		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');
		
		$cTitle = sprintf("%s::%s",JText::_('COM_CLUBREG'),JText::_('CLUBREG_TEMPLATES'));
	
		JToolbarHelper::title($cTitle, 'templates.png');
		if ($canDo->get('core.create')) 
		{
			JToolbarHelper::addNew('template.add');
		}
	
		if (($canDo->get('core.edit')))
		{
			JToolbarHelper::editList('template.edit');
		}
	
		if ($canDo->get('core.edit.state'))
		{
			if ($this->state->get('filter.state') != 2)
			{
				JToolbarHelper::publish('templates.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('templates.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			}
	
			if ($this->state->get('filter.state') != -1)
			{
				if ($this->state->get('filter.state') != 2)
				{
					JToolbarHelper::archiveList('templates.archive');
				}
				elseif ($this->state->get('filter.state') == 2)
				{
					JToolbarHelper::unarchiveList('templates.publish');
				}
			}
		}	
	
	
		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'templates.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('templates.trash');
		}		
	
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_clubreg');
		}		
	
		JHtmlSidebar::setAction('index.php?option=com_clubreg&view=templates');		
	
		JHtmlSidebar::addFilter(
				JText::_('JOPTION_SELECT_PUBLISHED'),
				'filter_state',
				JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);	
		
		JHtmlSidebar::addFilter(
				JText::_('Template Access'),
				'template_access',
				JHtml::_('select.options', $this->templateAccess, 'value', 'text', $this->state->get('filter.templateaccess'))
		);
		
		JHtmlSidebar::addFilter(
				JText::_('Template Status'),
				'template_status',
				JHtml::_('select.options', $this->templateStatus, 'value', 'text', $this->state->get('filter.templatestatus'))
		);
		JHtmlSidebar::addFilter(
				JText::_('Template Type'),
				'user_group',
				JHtml::_('select.options', $this->templateType, 'value', 'text', $this->state->get('filter.templateType'))
		);	
		
	}
	protected function getSortFields()
	{
		return array(				
				'a.created' => JText::_('Created On'),
				'f.name' => JText::_('Created By'),
				'a.published' => JText::_('Published'),
				'a.template_name' => JText::_('Template Name'),							
				'a.template_id' => JText::_('Template Id')
		);
		//'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
		//'a.template_status' => JText::_('Template Status'),	
	}
	
}