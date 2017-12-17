<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2018 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
/**
 * @desc helper
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ClubRegMailHelper extends JObject
{

	function __construct(){
		parent::__construct();
	}
	
	/**
	 * 
	 * @param string $message
	 */
	public static function sendDeleteEmail($message){
		
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();		
		
		$sending_['mailfrom'] = $app->get('mailfrom');
		$sending_['fromname'] = $app->get('fromname');
		$sending_['sitename'] = $app->get('sitename');		
		
		$mail = JFactory::getMailer();		
		$mail->addRecipient($app->get('mailfrom'), $user->get('name'));		
		$mail->setSender(array($app->get('mailfrom'), $app->get('fromname')));		
		
		$mail->setSubject($app->get('sitename') . ': Attempting To Delete Item !');
		$mail->setBody($message);
		$mail->isHtml();
		
		return $mail->Send();
		
		
	}
}