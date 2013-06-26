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
/*
 * Manage a list of products or items which payments should be requested for
 */
defined('_JEXEC') or die;

jimport( 'joomla.application.component.controlleradmin' );

class ClubRegControllerpayments extends JControllerAdmin{
	
	//protected $default_view = 'payments';
	
	public function getModel($name = 'Payment', $prefix = 'ClubregModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);		
		return $model;
	}
	
}