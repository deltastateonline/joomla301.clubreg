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
class ClubregViewPayments extends JViewLegacy
{
	protected $form;

	protected $item;

	protected $state;
	
	public function display($tpl = null)
	{
		$layout =  $this->getLayout();		
		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		
		$this->formaction = 'index.php?option=com_clubreg&view=payments';
		$this->colspan = 9;
		
		
		
		ClubRegHelper::addSubmenu('payments');
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
				
		$cTitle = sprintf("%s::%s",JText::_('COM_CLUBREG'),JText::_('CLUBREG_PAYMENTS'));
	
		JToolbarHelper::title($cTitle, 'templates.png');
		if ($canDo->get('core.create')) 
		{
			JToolbarHelper::addNew('payment.add');
		}
	
		if (($canDo->get('core.edit')))
		{
			JToolbarHelper::editList('payment.edit');
		}
	
		if ($canDo->get('core.edit.state'))
		{
			if ($this->state->get('filter.state') != 2)
			{
				JToolbarHelper::publish('payments.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('payments.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			}
	
			if ($this->state->get('filter.state') != -1)
			{
				if ($this->state->get('filter.state') != 2)
				{
					JToolbarHelper::archiveList('payments.archive');
				}
				elseif ($this->state->get('filter.state') == 2)
				{
					JToolbarHelper::unarchiveList('payments.publish');
				}
			}
		}	
	
	
		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'payments.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('payments.trash');
		}		
	
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_clubreg');
		}		
	
		JHtmlSidebar::setAction('index.php?option=com_clubreg&view=payments');		
	
		JHtmlSidebar::addFilter(
				JText::_('JOPTION_SELECT_PUBLISHED'),
				'filter_state',
				JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);	
		
	}
	protected function getSortFields()
	{
		return array(
				
				'a.published' => JText::_('Published'),
				'a.created' => JText::_('Created On'),
				'b.name' => JText::_('Created By'),
				'a.product_name' => JText::_('Product Name'),							
				'a.product_id' => JText::_('Product Id')
		);
	}
	
}