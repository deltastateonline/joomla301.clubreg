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


class ClubRegControllerOfficial extends JControllerForm{	
	//protected $default_view = 'Official';
	
	protected $text_prefix = 'COM_CLUBREG_OFFICIAL';
	
	public function __construct($config = array())
	{
		parent::__construct($config);
	
	}

	public function save($key = null, $urlVar = null){
		
		//JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		$data = $this->input->post->get('jform', array(), 'array');	
		
		$current_model = $this->getModel();
		$current_model->setState('joomla_id',$data['joomla_id']);
		
		if(isset($data["group_leader"])){
			$current_model->makeMeLeader($data["group_leader"]);
		}else{
			// remove official as group leader
			$current_model->makeMeLeader(array());
		}
		if(isset($data["group_member"])){
			$current_model->makeMeMember($data["group_member"]);
		}else{
			// remove official from  all groups.
			$current_model->makeMeMember(array());
		}
		
		
		$extraDetails = $this->input->post->get('extraDetails', array(), 'array');
		$monthyear = $this->input->post->get('monthyear', array(), 'array');		
		$current_model->saveExtraDetails($extraDetails,$monthyear );	
		
		$return = parent::save();
	}
	
	
	
}