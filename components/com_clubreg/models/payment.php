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

class ClubregModelPayment extends JModelForm
{
	
	protected $view_item = 'payment';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.payment';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.			
		$form = $this->loadForm('com_clubreg.payment', 'payment', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'Paymentfrn', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.payment.data', array());
		//
		if (empty($data)) {
			$data = $this->getItem();			
		}
		$data["payment_amount"] /= FACTOR;
		$data["member_key"] = $this->getState("com_clubreg.payment.member_key");	
		$data["payment_key"] = $this->getState("com_clubreg.payment.full_key");	
		
		return $data;
	}
	
	protected function getItem($pk = null){
		$data_ = array();
		$data_["payment_id"] = $this->getState("com_clubreg.payment.payment_id");
		$data_["payment_key"] = $this->getState("com_clubreg.payment.payment_key");		
		
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);	
		
		$d_var = "a.*";
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_PAYMENTS_TABLE).' AS a');
		
		$query->where(' payment_id = '.$db->quote($data_["payment_id"]));
		$query->where(' payment_key = '.$db->quote($data_["payment_key"]));
		
		$db->setQuery($query);
		$row = $db->loadAssoc();
		
		if($row["payment_id"] == $data_["payment_id"] && $row["payment_key"] == $data_["payment_key"]){
			return $row;
		}	
		
		return array("payment_amount"=>0,"payment_season"=>date('Y'));
	}	
	
	public function save($data){		
		
		$isNew = $this->getState("com_clubreg.payment.isnew");	
		$update_me = FALSE;
		
		if(!$isNew){
			
			$db = JFactory::getDBO();
			
			$old_rec = $this->getTable();
			$tb_keys = array("payment_id"=>$data["payment_id"],"payment_key"=>$data["payment_key"]);
			$old_rec->load($tb_keys);
			
			if($old_rec->payment_id == $data["payment_id"] && $old_rec->payment_key == $data["payment_key"]){
				$update_me = TRUE;			
					
				$other_details["short_desc"] = "updated payment";
				$other_details["primary_id"] = $data["payment_id"];
				ClubRegAuditHelper::saveData($old_rec, $other_details);
				
			}else{
				$this->setError(JText::_("COM_CLUBREG_NOUPDATE"));
			}		
			
		}
		
		$proceed = FALSE;
		if($isNew || $update_me){
			$paymentTable = $this->getTable();
		
			$paymentTable->bind($data);
			if($isNew){
				$created_when = date('Y-m-d H:i:s');
				$paymentTable->created = $created_when;
			}			
			
			if(!$paymentTable->store()){
				$proceed =  FALSE;
				$this->setError($paymentTable->getError());
			}else{
				$proceed =  TRUE;				
				$this->set("payment_id", $paymentTable->payment_id);
			}	
		}
		
		return $proceed;
	}
}