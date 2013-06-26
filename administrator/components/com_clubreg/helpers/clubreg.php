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


class ClubRegHelper
{
	public static function addSubmenu($vName){
		
		JHtmlSidebar::addEntry(
				JText::_('COM_CLUBREG'),
				'index.php?option=com_clubreg',
				$vName == 'homepage'
		);
		JHtmlSidebar::addEntry(
				JText::_('COM_CLUBREG_SUBMENU_SETTINGS'),
				'index.php?option=com_clubreg&view=settings',
				$vName == 'settings'
		);
		JHtmlSidebar::addEntry(
				JText::_('COM_CLUBREG_SUBMENU_PAYMENTS'),
				'index.php?option=com_clubreg&view=payments',
				$vName == 'payments'
		);
		JHtmlSidebar::addEntry(
				JText::_('COM_CLUBREG_SUBMENU_OFFICIALS'),
				'index.php?option=com_clubreg&view=officials',
				$vName == 'officials'
		);
		
		JHtmlSidebar::addEntry(
				JText::_('COM_CLUBREG_SUBMENU_GROUPS'),
				'index.php?option=com_clubreg&view=clubgroups',
				$vName == 'clubgroups'
		);
		JHtmlSidebar::addEntry(
				JText::_('COM_CLUBREG_SUBMENU_TEMPLATES'),
				'index.php?option=com_clubreg&view=templates',
				$vName == 'templates'
		);
		
		JHtmlSidebar::addEntry(
				JText::_('COM_CLUBREG_SUBMENU_REPORTS'),
				'index.php?option=com_clubreg&view=reports',
				$vName == 'reports'
		);		
		
	}
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param	int		The category ID.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions($categoryId = 0)
	{		
		$user	= JFactory::getUser();
		$result	= new JObject;
	
		if (empty($categoryId)) {
			$assetName = 'com_clubreg';
			$level = 'component';
		} else {
			$assetName = 'com_clubreg.category.'.(int) $categoryId;
			$level = 'category';
		}
	
		$actions = JAccess::getActions('com_clubreg', $level);
	
		foreach ($actions as $action) {
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}
	
		return $result;
	}
	public static function configOptions($whichConfig, $ordering='ordering asc'){
			
		
			$db		= JFactory::getDbo();
			$query	= $db->getQuery(true);
		
			$query->select("  config_short as value, config_name as text, ordering ");
			$query->from($db->quoteName(CLUB_CONFIG_TABLE));
			
			if(is_array($whichConfig)){
				$query->where(sprintf('which_config = %s', $db->quote($whichConfig[0])));
				$query->where(sprintf('config_short = %s', $db->quote($whichConfig[1])));
				
			}else{		
				$query->where(sprintf('which_config = %s', $db->quote($whichConfig)));
			}
			$query->order($db->quote($ordering));
		
			$db->setQuery($query);
		
			$options = array();
		
			try
			{
				$options = $db->loadObjectList();
			}
			catch (RuntimeException $e)
			{
				JError::raiseWarning(500, $e->getMessage());
			}
		
			return $options;
		
	}
	
	public static function renderParams($params,$view){
		
		global $clubreg_params;
		
		$registry = new JRegistry($params);
		$paramArray = $registry->toArray();
		
		foreach ($paramArray as $akey => $aValue){
			if(isset($aValue) && strlen($aValue)> 0){
				echo $clubreg_params[$view][$akey]["label"] ," : ",ucwords($aValue),"<br />";
			}
		}		
		unset($registry);		
	}
	public static function getConfigTagByName($config_short = NULL){
		
		$data = NULL;
		if(!is_null($config_short)){
			$db		= JFactory::getDbo();
			$query	= $db->getQuery(true);
			
			$query->select(" * ");
			$query->from($db->quoteName(CLUB_CONFIG_TABLE));
			
			if(is_array($config_short)){				
				$query->where(sprintf('config_short in ( %s)', implode(',',$config_short)));			
			}else{
				$query->where(sprintf('config_short = %s', $db->quote($config_short)));
			}
						
			$db->setQuery($query);			
			
			try
			{
				$data = $db->loadObject();
				if(isset($data) && isset($data->params)){
					$registry = new JRegistry;
					$registry->loadString($data->params);
					$data->params = $registry->toArray();
				}else{
					
				}
			}
			catch (RuntimeException $e)
			{
				JError::raiseWarning(500, $e->getMessage());
			}			
			return $data;			
		}
		
	} 
	
	public static function get_group_list($value = "group_id" ,$text= "group_name",$grouptype=NULL ){
		
		$options = array();
		
		$db		= JFactory::getDBO();
	
		$where[] = "published = 1";
		$where[] = "group_parent = 0";
		if($grouptype){
			$where[] = "group_type = ".$db->quote($grouptype);
		}
		// Build the query for the ordering list.
		$query = 'SELECT group_id AS '.$value.', group_name AS '.$text .
		' FROM '.CLUB_GROUPS_TABLE.
		sprintf(" WHERE %s ",implode(" and ",$where )) .
		' ORDER BY group_name asc ';
		
		
		$db->setQuery($query);
		try {
			$options = $db->loadObjectList();
		} catch (RuntimeException $e) {
			JError::raiseWarning(500, $e->getMessage());
		}
		
		return $options;
	}
	public static function get_subgroup_list($value = "group_id" ,$text= "group_name",$parent_id=0 ){
	
		$options = array();
	
		$db		= JFactory::getDBO();
	
		$where[] = "published = 1";
		$where[] = "group_parent = ".$parent_id;
		
		// Build the query for the ordering list.
		$query = 'SELECT group_id AS '.$value.', group_name AS '.$text .
		' FROM '.CLUB_GROUPS_TABLE.
		sprintf(" WHERE %s ",implode(" and ",$where )) .
		' ORDER BY group_name asc ';	
	
		$db->setQuery($query);
		try {
			$options = $db->loadObjectList();
		} catch (RuntimeException $e) {
			JError::raiseWarning(500, $e->getMessage());
		}
	
		return $options;
	}
	public static function get_member_list($value = "joomla_id" ,$text= "name"){
		
		$options = array();		
		$db		= JFactory::getDBO();
		
		$query = 'SELECT joomla_id AS '.$value.', b.name AS '.$text .
		' FROM '.CLUB_MEMBERS_TABLE.' as a '.
		' left join #__users as b on (a.joomla_id = b.id) WHERE status = 1 ORDER BY name asc ';
		
		$db->setQuery($query);
		try {
			$options = $db->loadObjectList();
		} catch (RuntimeException $e) {
			JError::raiseWarning(500, $e->getMessage());
		}
		
		return $options;
		
	}
	
	public static function getMonths(){
		$months = array(
				1 => 'january',
				2 => 'february',
				3 => 'march',
				4 => 'april',
				5 => 'may',
				6 => 'june',
				7 => 'july',
				8 => 'august',
				9 => 'september',
				10 => 'october',
				11 => 'november',
				12 => 'december');
	
		$t_array['0'] = JHtml::_('select.option', '0',	'-Month-', 'value', 'text');
		foreach($months as $t_key => $a_month){
			$t_array[$t_key] = JHtml::_('select.option', $t_key,	ucwords($a_month), 'value', 'text');
		}
	
		return $t_array;
	}
	static function write_footer(){
		?>
		<small><?php echo JText::_("Designed By ")?><a href="http://<?php echo  OUR_WEBSITE; ?>">http://<?phP echo DESIGNED_BY ?></a></small>
		<?php 
	}
	static function writePageHeader($pageTitle){?>
		<h2 style="border-bottom:1px solid #A5A5A5;padding-bottom:4px"><?php echo $pageTitle; ?></h2>
	<?php }
	static function writeImage($imagedata){
		?><img src='<?php echo CLUBREG_ASSETS?>/images/<?php echo $imagedata["fname"]; ?>' <?php echo isset($imagedata["attr"])?$imagedata["attr"]:"";?>/><?php 	
	}
	
	static function writeTabAssets($document,$whichTab, $assets = array("css","js")){		
		if(in_array("css", $assets)){
			$document->addStyleSheet(CLUBREG_ASSETS.'/css/'.$whichTab.'.css?'.time());
		}
		if(in_array("js", $assets)){
			$document->addScript(CLUBREG_ASSETS.'/js/'.$whichTab.'.js?'.time());
		}
	}
	static function writeFieldText($fieldText){?>	
		<div class="fieldSetDiv"><?php echo JText::_($fieldText); ?></div>
	<?php 		
	}
	
}