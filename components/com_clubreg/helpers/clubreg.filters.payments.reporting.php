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
 * Render the controls used to filter the stats reporting
 *
 */
class ClubRegFiltersPaymentsReportingHelper extends ClubRegFiltersHelper{


	protected function getButtons(){  $attribs = array("class"=>"inputbox input-small"); ?>
		<div class="btn-group pull-right">		
			<button class="btn btn-small btn-primary" type="button" onclick="return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_FILTER');?></button>
  		</div>
	  		<div class="clearfix"></div>
	  		<div class="row-fluid">  		  		
		  		
			</div>		
  		<?php 
	}
	
	protected function getMemberstatus(){
		$tmp_list = array();
		$tmp_list['registered'] = JHTML::_('select.option',  'registered', JText::_( 'COM_CLUBREG_OPTREGISTERED' ) );
		//$tmp_list['approved'] = JHTML::_('select.option',  'approved', JText::_( 'COM_CLUBREG_APPROVED' ) );
		$tmp_list['deleted'] = JHTML::_('select.option',  'deleted', JText::_( 'COM_CLUBREG_DELETED' ) );
	
		return $tmp_list;
	}
	
	public function render_payments_filters($filters = array()){
	
		
	
		$page_filters = $filters["paymentConfigs"];	
		$request_data = $filters["request_data"];	
		$all_filters = $page_filters["filters"];
		
		//$all_filters = 1;		
	
		//$all_filters["playertype"]["values"] = ClubRegPlayertypeHelper::batch_generate_List();;
		?>
			<fieldset class="eoi" >
				<div class="reg-filters"  id="all_batch_filters">
						<div class="shadowed-div" style="margin-right:10px;">			
						<div class="row-fluid ">
							<?php /*$attr="";
						foreach($page_filters["filters"] as $fkey=>$fvalue){ 					
							
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
							
						} */?>
						
						
						<?php 
							foreach($page_filters["headings"] as $headingRow){								
								$howmany = 12 / count($headingRow);							
								?>
									<div class="row-fluid">
										<?php foreach($headingRow as $fkey => $aHeading){ $control_type = $all_filters[$fkey]["control"];   ?>
										<div class="control-group span<?php echo $howmany;?>">
											<div class="control-label"><strong><?php echo $aHeading["label"]?></strong></div> 
																					
											<div class="controls">
											 <?php $attr = isset($aHeading["class"])?$aHeading["class"]:""; switch($control_type){ 
											 	case "select.genericlist":					 		
											 		echo JHtml::_('select.genericlist', $all_filters[$fkey]["values"],$fkey, trim($attr), 'value','text',$default,$fkey);
											 	break;					 	
											 	default:					 		
												?><input type="text" id="<?php echo $fkey ?>" name="<?php echo $fkey ?>" <?php echo $attr; ?> placeholder="<?php echo $all_filters[$fkey]["label"]?>" value="<?php echo $default; ?>"><?php 
											 	break;
											}?>						 
											 </div>											
											</div>
										<?php  } ?>
									</div>
									<?php 
									
							}
						
						
						?>
						
						
						
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