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

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
class com_clubregInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
		// $parent is the class calling this method
		echo "All Good";
	}
 
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		// $parent is the class calling this method
		echo "Not Good";
	}
 
	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		// $parent is the class calling this method
		echo '<p>' . JText::_('COM_OLA_UPDATE_TEXT') . '</p>';
	}
 
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
/*	function preflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		echo '<p>' . JText::_('COM_OLA_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}*/
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		
		$db = JFactory::getDbo();
		$d_qry = sprintf('UPDATE `#__extensions` SET `params` = \'{"playertype":["junior","senior","guardian"],"default_playertype":"senior","attachment_folder":"clubreg","profile_divrightedge":"750","profile_tabposition":"top","appkey":"","appsecret":"","appfolder":"","access_type":"","tabjunior":{"guardian":"1","notes":"1","payments":"0","other":"0","attachments":"0","property":"0"},"tabsenior":{"emergency":"1","notes":"1","payments":"0","other":"0","attachments":"0","property":"0"},"tabguardian":{"children":"1","notes":"1"}}\'
		WHERE `name` = \'com_clubreg\'');

		$db->setQuery($d_qry);		
		try
		{
			$db->query();
			echo "Permission set";
		}
		catch (RuntimeException $e)
		{
			echo "Error Setting clubreg permissions";
			$error_++;
		}
	}
}
