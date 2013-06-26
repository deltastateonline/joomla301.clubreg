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
class ClubregViewOfficials extends JViewLegacy
{
	protected $form;

	protected $item;

	protected $state;
	
	public function display($tpl = null)
	{
		$layout =  $this->getLayout();		
		
		switch($layout){
			case "link":
				$this->formaction 	= 'index.php?option=com_clubreg&view=officials';
				$this->items		= $this->get('linkedOfficials');
			break;
			
			default:
				$this->items		= $this->get('Items');				
				$this->pagination	= $this->get('Pagination');
				$this->state		= $this->get('State');				
				
				$this->formaction = 'index.php?option=com_clubreg&view=officials';
				$this->colspan = 9;		
				
				ClubRegHelper::addSubmenu('officials');
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
				
		$cTitle = sprintf("%s::%s",JText::_('COM_CLUBREG'),JText::_('CLUBREG_OFFICIALS'));
	
		JToolbarHelper::title($cTitle, 'templates.png');
		
	
		if ($canDo->get('core.edit.state'))
		{
			if ($this->state->get('filter.state') != 2)
			{			
				
				$bar->appendButton('Popup', 'stats', 'CLUBREG_LINK', 'index.php?option=com_clubreg&view=officials&layout=link&tmpl=component', 600, 350, 0, 0, 'window.parent.location.reload()', 'CLUBREG_LINK');			
				JToolbarHelper::custom('officials.unlink', 'unpublish.png', 'unpublish.png','CLUBREG_UNLINK', true);
				
			}			
		}		
	
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_clubreg');
		}		
	
		JHtmlSidebar::setAction('index.php?option=com_clubreg&view=officials');		
		
		$options[] = JHtml::_('select.option', '0', 'CLUBREG_UNLINKED');
		$options[] = JHtml::_('select.option', '1', 'CLUBREG_LINKED');
	
		JHtmlSidebar::addFilter(
				JText::_('JOPTION_SELECT_PUBLISHED'),
				'filter_state',
				JHtml::_('select.options', $options, 'value', 'text', $this->state->get('filter.state'), true)
		);
		
		unset($options);
		$options = ClubRegHelper::get_group_list("value","text");
		$first_select = sprintf("-Select %s-",JText::_('COM_CLUBREG_GROUPLEADER_LABEL'));
		JHtmlSidebar::addFilter(
				$first_select,
				'filter_leaderof',
				JHtml::_('select.options', $options, 'value', 'text', $this->state->get('filter.leaderof'), true)
		);
		
		$first_select = sprintf("-Select %s-",JText::_('COM_CLUBREG_GROUPMEMBER_LABEL'));
		JHtmlSidebar::addFilter(
				$first_select,
				'filter_memberof',
				JHtml::_('select.options', $options, 'value', 'text', $this->state->get('filter.memberof'), true)
		);
		
	}
	protected function getSortFields()
	{
		return array(				
				'a.status' => JText::_('Status'),				
				'b.name' => JText::_('Name'),
				'b.username' => JText::_('Username'),
				'a.joomla_id' => JText::_('Joomla Id')
				
		);
	}
	
}