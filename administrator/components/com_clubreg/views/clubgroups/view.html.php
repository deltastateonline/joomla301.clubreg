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
class ClubregViewClubgroups extends JViewLegacy
{
	protected $form;

	protected $item;

	protected $state;
	
	public function display($tpl = null)
	{
		$layout =  $this->getLayout();		
		
		switch($layout){
			case "subgroups":
				$return_data = $this->get('SubGroups');				
				$this->items = $return_data["group_children"] ;
				$this->parent_id = $return_data["parent_id"] ;
				
			break;
			
			default:
				$this->items		= $this->get('Items');				
				$this->pagination	= $this->get('Pagination');
				$this->state		= $this->get('State');				
				
				$this->formaction = 'index.php?option=com_clubreg&view=clubgroups';
				$this->colspan = 9;
				
				$this->grouptypes = ClubRegHelper::configOptions(CLUB_GROUPTYPE);
				
				ClubRegHelper::addSubmenu('clubgroups');
				$this->addToolbar();
				$this->sidebar = JHtmlSidebar::render();
			break;
		}
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
		
		$cTitle = sprintf("%s::%s",JText::_('COM_CLUBREG'),JText::_('CLUBREG_GROUPS'));
	
		JToolbarHelper::title($cTitle, 'clubgroups.png');
		if ($canDo->get('core.create')) 
		{
			JToolbarHelper::addNew('clubgroup.add');
		}
	
		if (($canDo->get('core.edit')))
		{
			JToolbarHelper::editList('clubgroup.edit');
		}
	
		if ($canDo->get('core.edit.state'))
		{
			if ($this->state->get('filter.state') != 2)
			{
				JToolbarHelper::publish('clubgroups.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('clubgroups.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			}
	
			if ($this->state->get('filter.state') != -1)
			{
				if ($this->state->get('filter.state') != 2)
				{
					JToolbarHelper::archiveList('clubgroups.archive');
				}
				elseif ($this->state->get('filter.state') == 2)
				{
					JToolbarHelper::unarchiveList('clubgroups.publish');
				}
			}
		}	
	
	
		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'clubgroups.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('clubgroups.trash');
		}		
	
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_clubreg');
		}		
	
		JHtmlSidebar::setAction('index.php?option=com_clubreg&view=clubgroups');		
	
		JHtmlSidebar::addFilter(
				JText::_('JOPTION_SELECT_PUBLISHED'),
				'filter_state',
				JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);	
		
		JHtmlSidebar::addFilter(
				JText::_('COM_CLUBREG_GROUPN_LABEL')." Type",
				'group_type',
				JHtml::_('select.options', $this->grouptypes, 'value', 'text', $this->state->get('filter.grouptype'))
		);
		
	
		
	}
	protected function getSortFields()
	{
		return array(				
				'a.created' => JText::_('Created On'),
				'f.name' => JText::_('COM_CLUBREG_GROUPLEADER_LABEL'),
				'a.published' => JText::_('Published'),
				'a.group_name' => JText::_('COM_CLUBREG_GROUPN_LABEL')." Name",							
				'a.group_id' => JText::_('COM_CLUBREG_GROUPN_LABEL')." Id"
				
		);	
	}
	
	
}