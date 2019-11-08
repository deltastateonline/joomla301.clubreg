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
class ClubregControllerPayment extends JControllerLegacy
{

	
	
	public function __construct($config = array())
	{
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		parent::__construct($config);
		$this->registerTask('save', 'savepayment');	
		
		$this->uKeyObject = new ClubRegUniqueKeysHelper(10);	

	}
	
	
	public function savepayment(){
	
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
	
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
	
		$proceed = FALSE;
		$data_ = $this->input->post->get('jform', array(), 'array');
		$memberKey = "_".$data_['member_key'];
		$data = array();
	
	
		foreach($data_ as $k => $v){
			$nKey = str_replace($memberKey, "", $k);
			$data[$nKey] = $v;
		}
	
	
		unset($current_model);
		$member_key_data = new stdClass();
		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
		$member_key_data->full_key = $data['member_key'];
		$current_model->processKey($member_key_data);
		$data["member_id"] = $member_key_data->member_id;
		$data["created_by"] = $user->get('id');
	
		unset($current_model);unset($key_data);
		$key_data = new stdClass();
		$current_model = JModelLegacy::getInstance('payment', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['payment_key'];
		$this->uKeyObject->deconstructKey($key_data);
	
		$isNew = FALSE;
		$data["payment_key"] = $key_data->string_key;
		$data["payment_id"] = $key_data->pk_id;
	
		if($key_data->pk_id > 0 && strlen($key_data->string_key) == 0){
			$data["payment_key"] =  $this->uKeyObject->getUniqueKey();
		}else if($key_data->pk_id == 0){
			$data["payment_key"] =  $this->uKeyObject->getUniqueKey();
			$data["payment_id"] = NULL;
			$isNew = TRUE;
		}
	
		$data["payment_amount"] *= FACTOR;
		$current_model->setState('com_clubreg.payment.isnew',$isNew);
		$proceed = $current_model->save($data);
	
		$return_array = array();
		$return_array["proceed"] = $proceed;
		$return_array["isNew"] = $isNew;
	
	
		if($proceed){
			$return_array["member_id"] = $member_key_data->member_id;
			$return_array["payment_id"] =$current_model->get("payment_id");
			$return_array["msg"][] = JText::_('COM_CLUBREG_DETAILS_UPDATE');
		}else{
			$return_array["msg"] =  $current_model->getError();
				
		}
	
	
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
	
		$app->close();
	
	}
}