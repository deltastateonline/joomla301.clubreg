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

class ClubRegModelTemplate extends JModelAdmin
{
	
	
	protected $text_prefix = 'COM_CLUBREG';
	
	public function publish(&$pks, $value = 1)
	{
		$result = parent::publish($pks, $value);

		// Clean extra cache for newsfeeds
		$this->cleanCache('clubreg_templates');		
		return $result;
	}
	
	public function getTable($type = 'Template', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_clubreg.template', 'template', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
	
		return $form;
	}
	
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_clubreg.edit.template.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();	
			// Prime some default values.
			if ($this->getState('template.template_id') == 0) {				
				$data->set('template_status','new_template');
				$data->set('template_access', 'everyone');
			}
		}
		
		return $data;
		
	
	}
	protected function populateState()
	{
		
		parent::populateState();
		$input = JFactory::getApplication()->input;
		
		$template_id = (int) $input->getInt('template_id');
		$this->setState('template.template_id', $template_id);
		
	}
	/**
	 *  @desc try to prepare the table, before you attempt to store
	 * @see JModelAdmin::prepareTable()
	 */
	protected function prepareTable($table)
	{	
		if (empty($table->template_id)) {
			// Set the values
			$user	= JFactory::getUser();
	
			$table->created_by = $user->get('id');
			$table->created = date('Y-m-d H:i:s');
	
			// Set ordering to the last item if not set
			if (empty($table->ordering)) {
				$db = JFactory::getDbo();
				$db->setQuery(sprintf('SELECT MAX(ordering) FROM %s ',CLUB_TEMPLATE_TABLE));
				$max = $db->loadResult();
	
				$table->ordering = $max+1;
			}
		}
		
			$filter = JFilterInput::getInstance(); //getInstance(array(), array(), 1, 1);			
			$table->template_ptext = $filter->clean($table->template_text,'string');
		
	}
}