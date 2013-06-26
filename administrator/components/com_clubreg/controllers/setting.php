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


class ClubRegControllersetting extends JControllerForm{	
	//protected $default_view = 'setting';
	
	public function __construct($config = array())
	{
		parent::__construct($config);
		
		$this->registerTask('add', 'add');
	}

	
	
	public function add(){
		
		$app = JFactory::getApplication();
		
		$context = "$this->option.edit.$this->context";	
		$whichConfig = $app->input->post->get('whichConfig');
		$app->setUserState($context . '.whichConfig', $whichConfig);
		parent::add();
	}
}