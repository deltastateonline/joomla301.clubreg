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
define('DS',DIRECTORY_SEPARATOR);
//require_once JPATH_COMPONENT . '/helpers/route.php';
require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'constants.php');
require_once (JPATH_COMPONENT.DS."helpers/buttons.php");
require_once (JPATH_COMPONENT.DS."helpers/clubreg.unauth.php");
JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

global $clubreg_Itemid,$overRide;

$overRide = TRUE;

$app = JFactory::getApplication();
$clubreg_Itemid = $app->input->get('Itemid', 0, 'int');

$controller = JControllerLegacy::getInstance('Clubreg');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();

/**
 * update #__clubreg_eoimembers set approved_by =NULL,approved=NULL,member_status = 'eoi';
 *  delete from #__clubreg_registeredmembers where eoi > 0
 */
