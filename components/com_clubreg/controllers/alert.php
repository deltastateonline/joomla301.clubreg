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
class ClubregControllerAlert extends JControllerLegacy
{

	
	
	public function __construct($config = array())
	{
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		parent::__construct($config);
		$this->registerTask('save', 'savealert');	

		$this->uKeyObject = new ClubRegUniqueKeysHelper(10);	

	}
	
	public function savealert(){	
	
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
	
		$proceed = TRUE;		
		$data_ = $this->input->post->get('jform', array(), 'array');		
		$memberKey = "_".$data_['member_key'];
		
		/**
		 * remove the member key from the array key
		 */
		foreach($data_ as $k => $v){
			$nKey = str_replace($memberKey, "", $k);
			$data[$nKey] = $v;
		}
		
		$data['alert_date_clubregPlaceholder'] = $data['alert_date'];
			
		unset($member_key_data);
		$member_key_data = new stdClass();
		$member_key_data->full_key = $data['member_key'];
		$this->uKeyObject->deconstructKey($member_key_data);
				
		$data["member_id"] = $member_key_data->pk_id;
		
		unset($alert_key_data);
		$alert_key_data = new stdClass();
		$alert_key_data->full_key = $data['alert_key'];
		$this->uKeyObject->deconstructKey($alert_key_data);		
		
		$isNew = FALSE;
		
		$current_model = JModelLegacy::getInstance('alert', 'ClubregModel', array('ignore_request' => true));
		
		if($alert_key_data->pk_id > 0 && strlen($alert_key_data->string_key) == 0){
			$data["alert_key"] =  $this->uKeyObject->getUniqueKey();
		}else if($alert_key_data->pk_id == 0){
			$data["alert_key"] =  $this->uKeyObject->getUniqueKey();
			$data["alert_id"] = NULL;
			$data["created_by"] = $user->get('id');
			$isNew = TRUE;			
		}		
		
		$current_model->setState('com_clubreg.alert.isnew',$isNew);		
		$proceed = $current_model->save($data);
		
		if($proceed){
			$return_array["member_id"] = $member_key_data->pk_id;
			$return_array["isNew"] = $isNew;
			$return_array["alert_id"] =$current_model->get("alert_id");
			$return_array["message"][] = JText::_('COM_CLUBREG_ALERT_DETAILS_CREATED');
		}else{			
			$return_array["error"] = array_merge( ClubRegErrorHelper::error_from_model($current_model),[JText::_('COM_CLUBREG_NOUPDATE')]);		
		}
		
		$return_array["proceed"] = $proceed;
		echo json_encode($return_array);
		
		$app->close();
	}
}