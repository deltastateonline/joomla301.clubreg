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
require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.filters.php';
/**
 * 
 * @author omo
 *
 */
class ClubRegFiltersCommunicationsHelper extends ClubRegFiltersHelper
{	
	private $templateValues = array();
	protected function get_filters_headings($input_data= array(), $group_where=array()){
	
		require_once("clubreg.seasons.php");
		require_once("clubreg.playertype.php");
	
		$filter_heading = array();
	
		$db	= JFactory::getDBO();
		
		$filter_heading["comm_type"] = array("label"=>JText::_('COMM_CLUBREG_COMM_COMM_TYPE'),"control"=>"select.genericlist","other"=>"class='inputbox input-large'");
	
		$filter_heading["comm_subject"] = array("label"=>JText::_('COM_CLUBREG_COMMS_SUBMSG'),"control"=>"text","other"=>"class='inputbox input-large'");
	
		$filter_heading["template_id"] = array("label"=>JText::_('COM_CLUBREG_COMMS_TEMPLATES'),"control"=>"select.genericlist","other"=>"class='inputbox input-large'");
					
		$filter_heading["comm_status"] = array("label"=>JText::_('COM_CLUBREG_COMMSTATUS_LABEL'),"control"=>"select.genericlist","other"=>"class='inputbox input-large'");
	
		$filter_heading["added_groups"] = array("label"=>JText::_('COM_CLUBREG_COMMADDEDGROUPS_LABEL'),"control"=>"select.genericlist","other"=>"class='inputbox input-large'");
		
		
		$filter_heading["f_created_date"] = $filter_heading["t_created_date"] = array("label"=>JText::_('COM_CLUBREG_CREATED_LABEL'),"control"=>"select.genericlist","other"=>"class='inputbox input-large'");
		
		
		
		unset($tmp_list);
		$tmp_list = array(); $group_where_str = $subgroup_where = "";
		if(isset($group_where["groups"]) && preg_match("/group_id/", $group_where["groups"]) ){
			$group_where_[] = $group_where["groups"];
				
			$subgroup_where = str_replace("a.group_id", "a.group_parent", $group_where["groups"]); // use the group_id as group_parent
		}else{
			$group_where_[] = "a.group_leader in (0,-1)";
		}
		$group_where_[] = "published=1";
		$group_where_[] = "group_parent = 0";
	
		$group_where_str = "where ".implode(" and ", $group_where_);	
	
		$query = sprintf("select -1 as value, '-".JText::_('COM_CLUBREG_GROUPN_LABEL')."-' as text union  select  `group_id` as value,`group_name` as text
				from %s as a %s  order by text asc ",CLUB_GROUPS_TABLE,$group_where_str);
	
		$db->setQuery( $query );
		$tmp_list_groups = $db->loadObjectList();		
	
		unset($tmp_list);
		unset($group_where_);
	
		$tmp_list = array();$group_where_str = "";
		if(isset($group_where["subgroups"]) && preg_match("/group_id/", $group_where["subgroups"]) ){
			$group_where_[] = $group_where["subgroups"];
		}
	
		if(isset($subgroup_where) && preg_match("/group_parent/", $subgroup_where)){
			//$group_where_[] = $subgroup_where;
		}
	
		$group_where_[] = "published=1";
		$group_where_[] = "group_parent != 0";
	
		$group_where_str = "where ".implode(" and ", $group_where_);
	
		$query = sprintf("select  `group_id` as value,concat('%s ',`group_name`) as text
				from %s as a %s  order by text asc  ",'---',CLUB_GROUPS_TABLE,$group_where_str);
	
		$db->setQuery( $query );
		$tmp_list = $db->loadObjectList();	
	
		$filter_heading["added_groups"]["values"] = array_merge($tmp_list_groups, $tmp_list);
		
		unset($tmp_list);
		unset($group_where);
		
		$filter_heading["template_id"]["values"]  = $this->templateValues;
	
		
	
		unset($tmp_list);
	
		$tmp_list = array();
		$tmp_list['-1'] = JHTML::_('select.option',  '-1', JText::_( '-Dates-' ) );
		$tmp_list['today'] = JHTML::_('select.option',  'today', JText::_( 'Today' ) );
		$tmp_list['7days'] = JHTML::_('select.option',  '7days', JText::_( 'Last 7 Days' ) );
		$tmp_list['month'] = JHTML::_('select.option',  'month', JText::_( 'This Month' ) );
		$tmp_list['lastmonth'] = JHTML::_('select.option',  'lastmonth', JText::_( 'Last Month' ) );
	
		$filter_heading["f_created_date"]["values"] = $filter_heading["t_created_date"]["values"] = $tmp_list;
	
		$filter_heading["year_registered"]["values"] = ClubRegSeasonsHelper::generate_List();
		$filter_heading["comm_type"]["values"] = $this->getCommType();
			
		$filter_heading["comm_status"]["values"] = $this->getCommstatus();
	
		unset($tmp_list);
	
		return $filter_heading;
	
	}
	protected function getCommstatus(){
		$tmp_list = array();
		$tmp_list['-1'] = JHTML::_('select.option',  '-1', '-'.JText::_('COM_CLUBREG_COMMSTATUS_LABEL').'-' );
		$tmp_list['0'] = JHTML::_('select.option',  '0', JText::_( 'COM_CLUBREG_COMMS_UNSENT' ) );
		$tmp_list['1'] = JHTML::_('select.option',  CLUBREG_COMM_SENTSTATUS, JText::_( 'COM_CLUBREG_COMMS_SENT' ) );
		$tmp_list['2'] = JHTML::_('select.option',  CLUBREG_COMM_DELETESTATUS, JText::_( 'COM_CLUBREG_COMMS_DELETED' ) );
	
		return $tmp_list;
	}
	
	protected function getCommType(){
		$tmp_list = array();
		$tmp_list['-1'] = JHTML::_('select.option',  '-1', '-'.JText::_('COMM_CLUBREG_COMM_COMM_TYPE').'-' );
		$tmp_list['email'] = JHTML::_('select.option',  'email', JText::_( 'COMM_CLUBREG_COMM_COMM_TYPE_EMAIL' ) );
		$tmp_list['sms'] = JHTML::_('select.option',  "sms", JText::_( 'COMM_CLUBREG_COMM_COMM_TYPE_SMS' ) );
	
		return $tmp_list;
	}
	
	
	protected function getButtons($templates,$editAction){ 
		$params = JComponentHelper::getParams('com_clubreg');
		$sms_suffix = $params->get("sms_suffix");	
		
		if(preg_match("/@/", $sms_suffix)){		?>	
			<div class="btn-group pull-right">		  	 
			  <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#"><?php echo JText::_('CLUBREG_COMMUNICATIONS_TEMPLATES_SMS');?>&nbsp;<span class="caret"></span></a>
			  <ul class="dropdown-menu">
			  	<?php 
					if(count($templates) > 0 ){ 					
						foreach($templates as $a_template){ if($a_template->value == -1) continue; // ignore the
						$t_action = JRoute::_($editAction.$a_template->value."&comm_type=sms");
						?>
					<li><a href="<?php echo $t_action ?>" data-template_id="<?php echo $a_template->value; ?>" class="template-action"><?php echo JText::_($a_template->text);?></a></li>
					<?php } } ?>				
			  </ul>		  
	  		</div>
  		<?php } ?>
  		
		<div class="btn-group pull-right">	
			<button class="btn btn-small btn-primary" type="button" onclick="document.adminForm.layout.value='communications';return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_FILTER');?></button>
			 &nbsp;
			<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#"><?php echo JText::_('CLUBREG_COMMUNICATIONS_TEMPLATES');?><span class="caret"></span></a>
		  <ul class="dropdown-menu">
		  	<?php 
				if(count($templates) > 0){ 					
					foreach($templates as $a_template){ if($a_template->value == -1) continue; // ignore the
					$t_action = JRoute::_($editAction.$a_template->value);
					?>
				<li><a href="<?php echo $t_action ?>" data-template_id="<?php echo $a_template->value; ?>" class="template-action"><?php echo JText::_($a_template->text);?></a></li>
				<?php } } ?>				
		  </ul>	
		  </div>

  		<div class="clearfix"></div>
  		<?php 
	}
	
	public function renderFilters($filters = array()){
	
		$request_data = $filters["request_data"];
		$group_where = $filters["group_where"];
		$this->templateValues = $filters["currentTemplates"];
		$all_filters = $this->get_filters_headings($request_data, $group_where);	

		$inValue  = $request_data->get('filter.comm_type');
		$attr = $all_filters["comm_type"]["other"];
		
		?>
				<fieldset class="eoi" >
				
				<div class="well well-small" style="margin-bottom:5px;">
					<div class="pull-left">
						<strong><?php echo $all_filters["comm_type"]["label"]?> : </strong><?php echo JHtml::_('select.genericlist', $all_filters["comm_type"]["values"],"comm_type", trim($attr), 'value','text',$inValue);?>
					</div>
				
					<div class="comms-order">
						<?php $this->getButtons($filters["currentTemplates"],$filters["editAction"]); ?>												
					</div>					
					<div><button class="btn btn-mini btn-primary show-filters" type="button" rel='0'>Show Filters</button>
						<div id="reg-filter-selected" class="pull-right"></div>	
					</div>
					<div class="reg-filters" id="all_filters">
						<div class="shadowed-div" style="margin-right:10px;">		
							<div class="row-fluid">
								<!-- Control -->									
									<?php $attr="";
											foreach($filters["filter_heading"] as $fkey=>$fvalue){ 
												$control_type = $all_filters[$fkey]["control"];  				
												$ctrl_class = isset($fvalue["class"])?$fvalue["class"]:"";				
												$nfkey = "filter.".$fkey;  $default =  $request_data->get($nfkey);	
												$attr= $all_filters[$fkey]["other"];
												?>				
												<div class='control-group  <?php echo $ctrl_class; ?>'>
													<div class="control-label"><strong><?php echo $all_filters[$fkey]["label"]?></strong></div> 
													 <div class="controls">
													 <?php  switch($control_type){ 
													 	case "select.genericlist":					 		
													 		echo JHtml::_('select.genericlist', $all_filters[$fkey]["values"],$fkey, trim($attr), 'value','text',$default);
													 	break;					 	
													 	default:					 		
														?><input type="text" id="<?php echo $fkey ?>" name="<?php echo $fkey ?>" <?php echo $attr; ?> placeholder="<?php echo $all_filters[$fkey]["label"]?>" value="<?php echo $default; ?>"><?php 
													 	break;
													}?>						 
													 </div> 
													 <input type="hidden" name="prev_filters[]" value="<?php echo $fkey; ?>" />
												 </div>
												<?php  	
												if(isset($fvalue["clearfix"])){?></div><div class="row-fluid"><?php }			
											}  ?>
								<!-- Controls -->
							</div>
						</div>
					</div>							
				</fieldset>			
				<?php 		
	}
}