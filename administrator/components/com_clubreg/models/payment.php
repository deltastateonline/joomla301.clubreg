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

class ClubRegModelPayment extends JModelAdmin
{
	
	
	protected $text_prefix = 'COM_CLUBREG';
	
	public function publish(&$pks, $value = 1)
	{
		$result = parent::publish($pks, $value);

		// Clean extra cache for newsfeeds
		$this->cleanCache('clubreg_payments');		
		return $result;
	}
	
	public function getTable($type = 'Payment', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_clubreg.payment', 'payment', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
	
		return $form;
	}
	
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_clubreg.edit.payment.data', array());
	
		if (empty($data)) {
			$data = $this->getItem();
			$data->product_amount /= FACTOR;
		
		/*		
			$app = JFactory::getApplication();
			// Prime some default values.
			if ($this->getState('payment.product_id') == 0) {				
				
				$app = JFactory::getApplication();
				$context = $this->option.".edit.payment";
				$whichConfig = $app->getUserState($context .'.whichConfig', TOPMOST); // orginally set in the add method in the setting controller
				
				$data->set('which_config', $whichConfig);
			}	*/
		}
	
		return $data;
		
	
	}
	protected function populateState()
	{
		
		parent::populateState();
		$input = JFactory::getApplication()->input;
		
		$product_id = (int) $input->getInt('product_id');
		$this->setState('payment.product_id', $product_id);
		
	}
	/**
	 *  @desc try to prepare the table, before you attempt to store
	 * @see JModelAdmin::prepareTable()
	 */
	protected function prepareTable($table)
	{
	
		if (empty($table->product_id)) {
			// Set the values
			$user	= JFactory::getUser();
	
			$table->createdby = $user->get('id');
			$table->created = date('Y-m-d H:i:s');		
		}
		
		$table->product_amount = $table->product_amount * FACTOR;
			//$filter = JFilterInput::getInstance(); //getInstance(array(), array(), 1, 1);			
			//$table->template_ptext = $filter->clean($table->template_text,'string');
		
	}
	
}