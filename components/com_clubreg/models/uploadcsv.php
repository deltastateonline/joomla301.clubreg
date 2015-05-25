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

class ClubregModelUploadcsv extends JModelForm
{
	
	protected $view_item = 'attachment';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.uploadcsv';
	
	//public $uploaded_data = "";
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.		
		$form = $this->loadForm('com_clubreg.uploadcsv', 'uploadcsv', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'uploadcsv', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.uploadcsv.data', array());
		if (empty($data)) {
				
		}
		$data["member_key"] = $this->getState("com_clubreg.uploadcsv.member_key");
		$data["link_type"] = $this->getState("com_clubreg.uploadcsv.link_type");
		return $data;
	}
	
	protected function getItem($pk = null){
		
	}
	
	
}