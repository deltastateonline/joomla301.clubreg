<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2012 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ClubRegButtonsHelper extends JObject
{
	
	static public function writeButtons($joomla_id){
		global $clubreg_Itemid;
		$db = JFactory::getDbo();
	
		$d_var = "a.joomla_id, a.status, a.params";
	
		$query	= $db->getQuery(true);
	
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_MEMBERS_TABLE).' AS a');
	
		$query->where('a.joomla_id = '.$joomla_id);
		$query->where('a.status = 1');
	
		$db->setQuery($query);
		$userPermission = $db->loadObject();
	
		$registry = isset($userPermission->params)?new JRegistry($userPermission->params):new JObject();
	
		$proceed = FALSE;
	
		$permission["manageeoi"] = array("txt" => JText::_('CLUBREG_EOI'),"url"=>JRoute::_("index.php?option=com_clubreg&view=eoi&layout=renderlist&Itemid=".$clubreg_Itemid) );
		$permission["manageusers"] = array("txt" => JText::_('CLUBREG_USERS'),"url"=>JRoute::_("index.php") );
		$permission["managestats"] = array("txt" => JText::_('CLUBREG_STATS') ,"url"=>JRoute::_("index.php"));
		$permission["sendcommunication"] = array("txt" => JText::_('CLUBREG_SENDCOMMS') ,"url"=>JRoute::_("index.php"));
	
	
		foreach($permission as $a_key => $a_permission){
			if($registry->get($a_key)){
				if($registry->get($a_key) == "yes"){
					?>
						<li><a href="<?php echo $permission[$a_key]["url"]; ?>">
								<span class="icon-user"></span><?php echo $permission[$a_key]["txt"]; ?></a>
						</li>
						<?php 
					}
				}
			}
			return $proceed;
		}
		protected function getButtons(){?>
			
				<div class="btn-group pull-right">		
					<button class="btn btn-small btn-primary" type="button" onclick="document.adminForm.layout.value='renderregmembers';return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_FILTER');?></button>
					<button class="btn btn-small" type="button" onclick="return Joomla.addbutton('0-0');"><?php echo JText::_('CLUBREG_ADDNEW');?></button>
					<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#"><?php echo JText::_('CLUBREG_ACTIONS');?><span class="caret"></span></a>
				  <ul class="dropdown-menu">
				    	<li><a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.register');}" ><?php echo JText::_('CLUBREG_BATCHUPDATE');?></a></li>
						<li><a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.resetMemberKey');}" ><?php echo JText::_('CLUBREG_RESETKEY');?></a></li>
						<li><a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.delete');}" ><?php echo JText::_('CLUBREG_DELETE');?></a></li>
						<li><a href="#" onclick="document.adminForm.layout.value='exportregmembers';return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_EXPORT');?></a></li>
				  </ul>
		  		</div>
		  		<?php 
			}
}