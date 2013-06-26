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


class ClubRegControllerClubgroup extends JControllerForm{	
	//protected $default_view = 'Official';
	
	protected $text_prefix = 'COM_CLUBREG_CLUBGROUP';
	
	public function __construct($config = array())
	{
		parent::__construct($config);
		$this->registerTask('savesub', 'save');
		$this->registerTask('subedit', 'edit');
	
	}

	public function save($key = null, $urlVar = null){
		
		$data = $this->input->post->get('jform', array(), 'array');	
		
		$current_model = $this->getModel();
		$current_model->setState('group_id',$data['group_id']);		
		
		if(intval($data['group_id']) > 0){
			if(isset($data["group_members"])){
				$current_model->saveMyMembers($data["group_members"]);
			}else{
				// remove official from  all groups.
				$current_model->saveMyMembers(array());
			}
		}	
		
		$return = parent::save();
	}
	/**
	 *  This function has to be ammended to teh url when we call the {controller}.{task}
	 *  rather than just trying to use the layout instead.
	 * @see JControllerForm::getRedirectToItemAppend()
	 */
	
	protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id'){
		$append = parent::getRedirectToItemAppend($recordId,$urlVar);
		
		$group_parent = $this->input->get('group_parent');
		if ($group_parent)
		{
			$append .= '&group_parent=' . $group_parent;
		}
	
		return $append;
	}
	
	
	
}