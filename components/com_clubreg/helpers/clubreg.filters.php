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

class ClubRegFiltersHelper extends JObject
{
	
	protected function get_filters_headings($input_data= array(), $group_where=array()){
		
		require_once("clubreg.seasons.php");
		require_once("clubreg.playertype.php");
	
		$filter_heading = array();
	
		$db	= JFactory::getDBO();		
	
		$filter_heading["surname"] = array("label"=>JText::_('COM_CLUBREG_SURNAME_LABEL'),"control"=>"text","other"=>"class='inputbox input-medium'");
		$filter_heading["address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'),"control"=>"text","other"=>"class='inputbox input-large'");
		$filter_heading["suburb"] = array("label"=>JText::_('COM_CLUBREG_SUBURB'),"control"=>"text","other"=>"class='inputbox input-small'");
		$filter_heading["postcode"] = array("label"=>JText::_('COM_CLUBREG_POSTCODE'),"control"=>"text","other"=>"class='inputbox input-mini'");
	
		//guardian details
		$filter_heading["gaddress"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'),"control"=>"text","other"=>"class='inputbox input-medium'","filter_col"=>"d.`address`");
		$filter_heading["gsuburb"] = array("label"=>JText::_('COM_CLUBREG_SUBURB'),"control"=>"text","other"=>"class='inputbox input-small'","filter_col"=>"d.`suburb`");
		$filter_heading["gpostcode"] = array("label"=>JText::_('COM_CLUBREG_POSTCODE'),"control"=>"text","other"=>"class='inputbox input-mini'","filter_col"=>"d.`postcode`");
	
		$filter_heading["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'),"control"=>"text","other"=>"class='inputbox input-medium'");
		$filter_heading["memberlevel"] = array("label"=>PLAYER." Level","control"=>"select.genericlist","other"=>"class='inputbox input-medium'");
	
		$filter_heading["playertype"] = array("label"=>JText::_('COM_CLUBREG_PT'),"control"=>"select.genericlist","other"=>"class='inputbox input-medium'");
			
		$filter_heading["group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'),"control"=>"select.genericlist","other"=>"class='inputbox input-medium'");
	
		$filter_heading["subgroup"] = array("label"=>JText::_('COM_CLUBREG_SUBGROUPN_LABEL'),"control"=>"select.genericlist","other"=>"class='inputbox input-medium'");
	
		$filter_heading["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),"control"=>"select.genericlist","other"=>"class='inputbox input-medium'");
			
		$filter_heading["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),"control"=>"select.genericlist","other"=>"class='inputbox input-medium'");
				
		$filter_heading["f_created_date"] = $filter_heading["t_created_date"] = array("label"=>JText::_('COM_CLUBREG_CREATED_LABEL'),"control"=>"select.genericlist","other"=>"class='inputbox input-medium'");
		$filter_heading["year_registered"] = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL'),"control"=>"select.genericlist","other"=>"class='inputbox input-small'");
	
		$query = sprintf("select -1 as value, '-".PLAYER." Level -' as text union  select  `config_short` as value,`config_name` as text
				from %s as a where which_config = '%s' and published = 1  order by text asc ",
				CLUB_CONFIG_TABLE,CLUB_PLAYER_LEVEL);
	
		$db->setQuery( $query );
		$tmp_list = $db->loadObjectList('value');
		$filter_heading["memberlevel"]["values"] = $tmp_list;	
		
		unset($tmp_list);		
		$tmp_list = array(); $group_where_str = $subgroup_where = "";
		if(isset($group_where["groups"]) && preg_match("/group_id/", $group_where["groups"]) ){
			$group_where_[] = $group_where["groups"];
			
			$subgroup_where = str_replace("a.group_id", "a.group_parent", $group_where["groups"]);
		}
		$group_where_[] = "published=1";
		$group_where_[] = "group_parent = 0";
	
		$group_where_str = "where ".implode(" and ", $group_where_);
	
		
		$query = sprintf("select -1 as value, '-".JText::_('COM_CLUBREG_GROUPN_LABEL')."-' as text union  select  `group_id` as value,`group_name` as text
				from %s as a %s  order by text asc ",CLUB_GROUPS_TABLE,$group_where_str);
	
		$db->setQuery( $query );
		$tmp_list = $db->loadObjectList();
		$filter_heading["group"]["values"] = $tmp_list;
		
		
	
		unset($tmp_list);
		unset($group_where_);		
	
		$tmp_list = array();$group_where_str = "";
		if(isset($group_where["subgroups"]) && preg_match("/group_id/", $group_where["subgroups"]) ){
			$group_where_[] = $group_where["subgroups"];
		}
		
		if(isset($subgroup_where) && preg_match("/group_parent/", $subgroup_where)){
			$group_where_[] = $subgroup_where;
		}
		
		$group_where_[] = "published=1";
		$group_where_[] = "group_parent != 0";
	
		$group_where_str = "where ".implode(" and ", $group_where_);
	
		$query = sprintf("select -1 as value, '-".JText::_('COM_CLUBREG_SUBGROUPN_LABEL')."-' as text union  select  `group_id` as value,`group_name` as text
				from %s as a %s  order by text asc  ",CLUB_GROUPS_TABLE,$group_where_str);
	
		$db->setQuery( $query );
		$tmp_list = $db->loadObjectList();
		
		$filter_heading["subgroup"]["values"] = $tmp_list;
	
		unset($tmp_list);
		unset($group_where);
	
		$tmp_list = array();
		$tmp_list['-1'] = JHTML::_('select.option',  '-1','-'.JText::_('COM_CLUBREG_GENDER_LABEL') );
		$tmp_list['male'] = JHTML::_('select.option',  'male', JText::_( 'COM_CLUBREG_MALE' ) );
		$tmp_list['female'] = JHTML::_('select.option',  'female', JText::_( 'COM_CLUBREG_FEMALE' ) );
	
		$filter_heading["gender"]["values"] = $tmp_list;
	
		unset($tmp_list);
	
		$tmp_list = array();
		$tmp_list['-1'] = JHTML::_('select.option',  '-1', JText::_( '-Dates-' ) );
		$tmp_list['today'] = JHTML::_('select.option',  'today', JText::_( 'Today' ) );
		$tmp_list['7days'] = JHTML::_('select.option',  '7days', JText::_( 'Last 7 Days' ) );
		$tmp_list['month'] = JHTML::_('select.option',  'month', JText::_( 'This Month' ) );
		$tmp_list['lastmonth'] = JHTML::_('select.option',  'lastmonth', JText::_( 'Last Month' ) );
	
		$filter_heading["f_created_date"]["values"] = $filter_heading["t_created_date"]["values"] = $tmp_list;
	
		$filter_heading["year_registered"]["values"] = ClubRegSeasonsHelper::generate_List();
		$filter_heading["playertype"]["values"] = ClubRegPlayertypeHelper::generate_List();	
			
		$filter_heading["member_status"]["values"] = $this->getMemberstatus();
	
		unset($tmp_list);
	
		return $filter_heading;
	
	}
	protected function getMemberstatus(){		
		$tmp_list = array();
		$tmp_list['eoi'] = JHTML::_('select.option',  'eoi', JText::_( 'COM_CLUBREG_EOI' ) );
		$tmp_list['approved'] = JHTML::_('select.option',  'approved', JText::_( 'COM_CLUBREG_APPROVED' ) );
		$tmp_list['deleted'] = JHTML::_('select.option',  'deleted', JText::_( 'COM_CLUBREG_DELETED' ) );
		
		return $tmp_list;
	}
	
	protected function getButtons(){?>  
	<div class="btn-group pull-right">
	<button class="btn btn-small btn-primary" type="button" onclick="document.adminForm.layout.value='rendereoi';return Joomla.submitbutton('filter');">Filter</button>
	<button class="btn btn-small" type="button" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('eois.register');}" ><?php echo JText::_('CLUBREG_REGISTER');?></button>
	<?php if(LIVE_SITE){?>
	<button class="btn btn-small" type="button" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('eois.delete');}" ><?php echo JText::_('CLUBREG_DELETE');?></button>
	<?php } ?>
	<button class="btn btn-small" type="button" onclick="document.adminForm.layout.value='exporteois';return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_EXPORT');?></button>
	</div>
	<?php
	}
	
	
	public function renderFilters($filters = array()){			
		
			$request_data = $filters["request_data"];
			$group_where = $filters["group_where"];
			$all_filters = $this->get_filters_headings($request_data, $group_where);			
			
			$inValue  = $request_data->get('filter.playertype');	
			$attr = $all_filters["playertype"]["other"];			
			?>				
			<fieldset class="eoi" >
			<div class="well well-small" style="margin-bottom:5px;"><div class="pull-left"><strong><?php echo $all_filters["playertype"]["label"]?> : </strong> <?php echo JHtml::_('select.genericlist', $all_filters["playertype"]["values"],"playertype", trim($attr), 'value','text',$inValue);?></div>
				<?php $this->getButtons(); ?>
			</div>	
			<div><button class="btn btn-mini btn-primary show-filters" type="button" rel='0'>Show Filters</button></div>			
			<div class="reg-filters well well-small" id="all_filters">
			<div class="row-fluid">
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
			
			</div>
			</div>
			</fieldset>			
			<?php 		
	}
}
