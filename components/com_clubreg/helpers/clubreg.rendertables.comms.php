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
require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.php';
require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.profilethumbs.php';
class ClubRegRenderTablesCommsHelper extends ClubRegRenderTablesHelper
{
	protected $headings = array();
	protected $otherconfigs = array();
	public $edit_comms_url = NULL;
	
	function __construct(){		
		parent::__construct();	
	}	

	public function render($viewObject){		
		
		$params = JComponentHelper::getParams('com_clubreg');			
		
		$i = 0;		
		$this->headings =  $viewObject->entity_filters["headings"];	
		$this->otherconfigs = $viewObject->entity_filters["otherconfigs"];?>
		
			<?php $this->renderHead($viewObject);?>
		  <div class="comm-list">
			  <?php 
			  if(count($viewObject->items) > 0){
				  	foreach($viewObject->items as $an_item){
				  		$an_item->idx = $i+1 ;	 
					   	$this->rendererItems($an_item); 
				  		$i++; 
				  	}
			  } else {?>		  			  		
			  		<div class="alert alert-error"><h3>No Results</h3></div>			  	
			  <?php } ?>
		  </div>		
		<?php
	}	
	
	protected function rendererItems($an_item){ 
			$d_url = JRoute::_($this->edit_comms_url .$an_item->comm_id);
		?>
		<div class="comms-div" data-comm_id=<?php echo $an_item->comm_id; ?>>
		<div class="h21 pull-left">
		<?php if(in_array($an_item->comm_status,$this->otherconfigs["allowedstatus"]) ||  in_array($an_item->commtype,$this->otherconfigs["checkboxes"])){ ?>
			<?php echo JHtml::_('grid.id', $an_item->idx, $an_item->comm_id);  } ?>		
			<a href="<?php echo $d_url ?>" ><?php echo ucwords($an_item->comm_subject); ?><?php echo ($an_item->template_name)?"&nbsp;<span class='small label label-info'>".$an_item->template_name."</span>":"";?></a></div>			
			
			<?php if($an_item->comm_type == "sms") {?>
				<img src="<?php echo CLUBREG_ASSETS; ?>/images/sms-blue-24.png" hspace=10 width="24"/>
			<?php } ?>
			<p class="small pull-right"><?php echo jText::_('COM_CLUBREG_COMMCREATED_LABEL');?> :<?php echo $an_item->t_created_by;?> on  <?php echo $an_item->t_created_date;?></p> 
			<div class="clearfix"></div>
			<div style="border-top:1px dashed #A3A3A3"></div>
			<div class="comm_msg_intro">
				<?php 
					$t_string  = strip_tags(trim($an_item->comm_message));
					echo ucfirst(strtok($t_string,"\n"));
					echo "<br />";
					echo strtok("\n")."<a href='javascript:void(0);' class='pull-right comm_msg_more' title='Show Full Message'><img src=\"".CLUBREG_ASSETS."/images/down.png\"/></a>";					
				?>
					<a href='javascript:void(0);' class='pull-right comm_msg_more comm-delete-message' title='Delete message' ><img src="<?php echo CLUBREG_ASSETS; ?>/images/delete-32.png"/></a>
				<div class="clearfix"></div>
			</div>
			<div><b><?php echo $this->headings["added_groups"]["label"]; ?> :&nbsp;</b><?php if(!empty($an_item->added_groups)){ $all_groups = explode(":", $an_item->added_groups); 
						foreach($all_groups as $a_group){
							echo "<span class=\"label label-success\">{$a_group}</span>&nbsp;";	
						}				
			}?></div>
			<div style="padding:5px;" class="comm_msg">				
				<?php echo trim($an_item->comm_message); ?>	
				<div><a href='javascript:void(0);' class='comm_msg_more pull-right' title='Hide Message'><img src="<?php echo CLUBREG_ASSETS?>/images/up.png"/></a></div>			
				<div class="clearfix"></div>
			</div>
			
		</div>
		<?php 
	}
	
	protected function renderHead($viewObject){
		$listOrder	= $viewObject->escape($viewObject->state->get('list.ordering'));
		$listDirn	= $viewObject->escape($viewObject->state->get('list.direction'));
		$sortFields = $viewObject->getSortFields();
		?>
				<div class="comms-order" >
				   <input type="checkbox" value="all" name="checkall-toggle"  title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				   <div class="eoi  pull-right">
				   	<div class="btn-group  pull-right">
						<label for="sortTable" class="element-invisible"><?php echo JText::_('COM_CLUBREG_SORT_BY');?></label>					
						<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
							<option value=""><?php echo JText::_('COM_CLUBREG_SORT_BY');?></option>
							<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder);?>
						</select>
					</div>			   
				    <div class="btn-group  pull-right">
					    <label for="directionTable" class="element-invisible"><?php echo JText::_('COM_CLUBREG_ORDERING_DESC');?></label>
						<select name="directionTable" id="directionTable" class="input-small" onchange="Joomla.orderTable()">
							<option value=""><?php echo JText::_('COM_CLUBREG_ORDERING_DESC');?></option>
							<option value="asc" <?php if (strtoupper($listDirn) == 'ASC') echo 'selected="selected"'; ?>><?php echo JText::_('COM_CLUBREG_ORDER_ASCENDING');?></option>
							<option value="desc" <?php if (strtoupper($listDirn) == 'DESC') echo 'selected="selected"'; ?>><?php echo JText::_('COM_CLUBREG_ORDER_DESCENDING');?></option>
						</select>
					</div>
					<div class="clearfix"></div>
				    </div>	
				    <div class="clearfix"></div>
				  </div>			    
		<?php 		
		}
		 
}
?>