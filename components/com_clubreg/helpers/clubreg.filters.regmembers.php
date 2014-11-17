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
class ClubRegFiltersRegmembersHelper extends ClubRegFiltersHelper
{
	
	
	protected function getMemberstatus(){			
		$tmp_list = array();		
		$tmp_list['registered'] = JHTML::_('select.option',  'registered', JText::_( 'COM_CLUBREG_OPTREGISTERED' ) );
		//$tmp_list['approved'] = JHTML::_('select.option',  'approved', JText::_( 'COM_CLUBREG_APPROVED' ) );
		$tmp_list['deleted'] = JHTML::_('select.option',  'deleted', JText::_( 'COM_CLUBREG_DELETED' ) );
		
		return $tmp_list;
	}
	protected function getButtons(){
		/*
		// onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.batchUpdate');}"
	*/	?>
	
		<div class="btn-group pull-right">		
			<button class="btn btn-small btn-primary" type="button" onclick="document.adminForm.layout.value='renderregmembers';return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_FILTER');?></button>
			<button class="btn btn-small" type="button" onclick="return Joomla.addbutton('0-0');"><?php echo JText::_('CLUBREG_ADDNEW');?></button>
			<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#"><?php echo JText::_('CLUBREG_ACTIONS');?><span class="caret"></span></a>
		  <ul class="dropdown-menu">
		    	<li><a href="#" class="show-batch-filters" ><?php echo JText::_('CLUBREG_BATCHUPDATE');?></a></li>
				<?php if(LIVE_SITE){?>
				<li><a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.resetMemberKey');}" ><?php echo JText::_('CLUBREG_RESETKEY');?></a></li>
				<li><a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.delete');}" ><?php echo JText::_('CLUBREG_DELETE');?></a></li>
				<?php } ?>
				<li><a href="#" onclick="document.adminForm.layout.value='exportregmembers';return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_EXPORT');?></a></li>
		  </ul>
  		</div>
  		<?php 
	}
	
	public function render_batch_filters($filters = array()){
	
		//write_debug();
		
		$batch_filters = $filters["batch_update"];
		
		$request_data = $filters["request_data"];
		$group_where = $batch_filters["group_where"];
			
		unset($group_where["groups"]);
	
		$group_where["group_type"] = $group_where[0];
		$group_where["subgroups"] = " a.group_id in (-99)";	 // set this value to extreme so that the subgroup is empty.
	
		$all_filters = $this->get_filters_headings($request_data, $group_where);
		
		$all_filters["playertype"]["values"] = ClubRegPlayertypeHelper::batch_generate_List();;
		?>
		<fieldset class="eoi" >
			<div class="reg-filters"  id="all_batch_filters">
					<div class="shadowed-div" style="margin-right:10px;">			
					<div class="row-fluid ">
						<?php $attr="";
					foreach($batch_filters["filters"] as $fkey=>$fvalue){ 					
						
							$control_type = $all_filters[$fkey]["control"];  				
							$ctrl_class = isset($fvalue["class"])?$fvalue["class"]:"";				
							$nfkey = "batch.".$fkey;  $default =  "";
							$attr= $all_filters[$fkey]["other"];							
							?>				
							<div class='control-group  <?php echo $ctrl_class; ?>'>
								<div class="control-label"><strong><?php echo $all_filters[$fkey]["label"]?></strong></div> 
								 <div class="controls">
								 <?php  switch($control_type){ 
								 	case "select.genericlist":					 		
								 		echo JHtml::_('select.genericlist', $all_filters[$fkey]["values"],"batch[".$fkey."]", trim($attr), 'value','text',$default,"batch_".$fkey);
								 	break;					 	
								 	default:					 		
									?><input type="text" id="batch_<?php echo $fkey ?>" name="batch[<?php echo $fkey ?>]" <?php echo $attr; ?> placeholder="<?php echo $all_filters[$fkey]["label"]?>" value="<?php echo $default; ?>"><?php 
								 	break;
								}?>						 
								 </div>						
							 </div>
							<?php  	
							if(isset($fvalue["clearfix"])){?>
							</div>
							<div class="row-fluid"><?php }			
						
					} ?>
					</div>
					<button class="btn btn-small btn-primary btn-batch-update" type="button" ><?php echo JText::_('CLUBREG_BATCHUPDATE');?></button>
					<div class="pull-right"><a href='javascript:void(0);' class='msg_more pull-right hide-batch-filters' title='Hide'><img src="<?php echo CLUBREG_ASSETS?>/images/up.png"/></a></div>
					<div class="clearfix"></div>
					</div>
						
				</div>
			</fieldset>			
			<?php 			
		}
}