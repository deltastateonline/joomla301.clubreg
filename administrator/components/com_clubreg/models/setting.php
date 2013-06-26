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

class ClubRegModelSetting extends JModelAdmin
{
	
	
	protected $text_prefix = 'COM_CLUBREG';
	
	public function publish(&$pks, $value = 1)
	{
		$result = parent::publish($pks, $value);

		// Clean extra cache for newsfeeds
		$this->cleanCache('clubreg_settings');		
		return $result;
	}
	
	public function getTable($type = 'Setting', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_clubreg.setting', 'setting', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
	
		return $form;
	}
	
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_clubreg.edit.setting.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();	
			
			$app = JFactory::getApplication();
			// Prime some default values.
			if ($this->getState('setting.config_id') == 0) {				
				
				$app = JFactory::getApplication();
				$context = $this->option.".edit.setting";
				$whichConfig = $app->getUserState($context .'.whichConfig', TOPMOST); // orginally set in the add method in the setting controller
				
				$data->set('which_config', $whichConfig);
			}
		}
		
		return $data;
		
	
	}
	protected function populateState()
	{
		
		parent::populateState();
		$input = JFactory::getApplication()->input;
		
		$config_id = (int) $input->getInt('config_id');
		$this->setState('setting.config_id', $config_id);
		
	}
	/**
	 *  @desc try to prepare the table, before you attempt to store
	 * @see JModelAdmin::prepareTable()
	 */
	protected function prepareTable($table)
	{
		
		$table->config_short = JApplication::stringURLSafe($table->config_short);
	
		if (empty($table->config_short)) {
			$table->config_short = JApplication::stringURLSafe($table->config_name);
		}
		
		$table->config_short = str_replace("-", "_", $table->config_short);
	
		if (empty($table->config_id)) {
			// Set the values
			$user	= JFactory::getUser();
	
			$table->createdby = $user->get('id');
			$table->created = date('Y-m-d H:i:s');
	
			// Set ordering to the last item if not set
			if (empty($table->ordering)) {
				$db = JFactory::getDbo();
				$db->setQuery(sprintf('SELECT MAX(ordering) FROM %s where which_config = %s ',CLUB_CONFIG_TABLE,
				$db->quote($table->which_config)));
				$max = $db->loadResult();
	
				$table->ordering = $max+1;
			}
		}else{			
			/**
			 * this is wrong, if the setting details can not be save, the change would have occured anyway
			 * @var unknown_type
			 */
			$db = JFactory::getDbo();
			$db->setQuery(sprintf('SELECT * FROM %s where config_id = %d ',CLUB_CONFIG_TABLE,
					$table->config_id));
			$current_data = $db->loadObject();	

			if($current_data->config_short !== $table->config_short){
			
				$d_qry = sprintf("update %s set which_config = %s where which_config = %s", CLUB_CONFIG_TABLE,
						$db->quote($table->config_short),$db->quote($current_data->config_short));
				
				$db->setQuery($d_qry);
				$db->execute();
				
			}		
		}		
	}
	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param	JTable	$table	A record object.
	 *
	 * @return	array	An array of conditions to add to add to ordering queries.
	 * @since	1.6
	 */
	protected function getReorderConditions($table)
	{
		$condition = array();
		$condition[] =  sprintf("which_config = '%s'",$table->which_config);
	
		return $condition;
	}	
}