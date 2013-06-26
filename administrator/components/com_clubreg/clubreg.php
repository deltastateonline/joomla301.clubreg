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
require_once (JPATH_COMPONENT.DS.'constants.php');
if (!JFactory::getUser()->authorise('core.manage', 'com_contact'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}


// Execute the task.
$controller	= JControllerLegacy::getInstance('Clubreg');
// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();