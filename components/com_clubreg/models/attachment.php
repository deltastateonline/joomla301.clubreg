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

class ClubregModelAttachment extends JModelForm
{
	
	protected $view_item = 'attachment';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.attachment';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.		
		$form = $this->loadForm('com_clubreg.attachment', 'attachment', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'Attachment', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.attachment.data', array());
		if (empty($data)) {
				
		}
		$data["member_key"] = $this->getState("com_clubreg.attachment.member_key");
		$data["link_type"] = $this->getState("com_clubreg.attachment.link_type");
		return $data;
	}
	
	protected function getItem($pk = null){
		
	}
	
	public function save($data){
		
		$attachmentTable = $this->getTable();
		$created_when = date('Y-m-d H:i:s');
		
		$attachmentTable->bind($data);
		$attachmentTable->created = $created_when;
		
		if(!$attachmentTable->store()){
			$this->setError($attachmentTable->getError());
			return FALSE;
		}else{
			return TRUE;
		}		
	}
	public function changeStatus($status){
		
		$db = JFactory::getDbo();
		$error_ = 0;
		
		$attachment_id = $this->getState("com_clubreg.attachment.attachment_id");
		$attachment_key = $this->getState("com_clubreg.attachment.attachment_key");		
		
		$d_qry = sprintf("update %s set attachment_status = %s where attachment_id = %s and attachment_key = %s",
				$db->quoteName(CLUB_ATTACHMENTS_TABLE),$db->quote($status), $db->quote($attachment_id),$db->quote($attachment_key));
		
		$db->setQuery($d_qry);		
		try
		{
			$db->query();
		}
		catch (RuntimeException $e)
		{
			$this->setError($e->getMessage());
			$error_++;
		}
		
		if($error_ > 0){
			return FALSE;
		}else{
			return TRUE;
		}
		
	}
	public function getAttachment(){
	
		$attachment_id = $this->getState("com_clubreg.attachment.attachment_id");
		$attachment_key = $this->getState("com_clubreg.attachment.attachment_key");
	
		
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);
		
		$d_var = "a.*";
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_ATTACHMENTS_TABLE).' AS a');
		
		$query->where(' attachment_id = '.$db->quote($attachment_id));
		$query->where(' attachment_key = '.$db->quote($attachment_key));
		$query->where(' attachment_status = 1');
		$db->setQuery($query);
		$row = $db->loadAssoc();		
		return $row;
		
		
		
	
	}
}