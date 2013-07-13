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
require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.renderItem.php';
class ClubRegRenderTablesHelper extends JObject
{
	protected $headings = array();
	protected $otherconfigs = array();
	
	protected $send_news = array();
	protected $itemRenderer = NULL;
	
	function __construct(){		
		//$this->send_news = array("-1"=>JText::_('JNO'),"0"=>JText::_('JNO'),"1"=>JText::_('JYES'));
		$this->itemRenderer = new ClubRegRenderItemHelper();
		
	}
	/**
	 *  render the checkall boxes, sort and order boxes
	 *  expand button and table head.
	 * @param unknown_type $viewObject
	 */
	
	protected function renderHead($viewObject){		
		$listOrder	= $viewObject->escape($viewObject->state->get('list.ordering'));
		$listDirn	= $viewObject->escape($viewObject->state->get('list.direction'));
		$sortFields = $viewObject->getSortFields();		
	?>
			<thead>
			  <tr style="background: none repeat scroll 0 0 #EFEFEF;">
			    <th width="5%">#</th>
			    <th width="95%"><input type="checkbox" value="all" name="checkall-toggle"  title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
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
			    </div>
			    <div class="pull-right"><a class="btn btn-small reg-button-all" title="Toggle All" href="javascript:void(0);">-</a></div>
			    </th>			    		     	      
			  </tr>
		  </thead>	
	<?php 		
	}
	
	public function render($viewObject){		
		$i = 0;		
		$this->headings =  $viewObject->entity_filters["headings"];	
		$this->otherconfigs = $viewObject->entity_filters["otherconfigs"];?>
		<table class="table table-bordered table-striped table-hover table-condensed">
			<?php $this->renderHead($viewObject);?>
		  <tbody>
			  <?php 
			  if(count($viewObject->items) > 0){
			  	foreach($viewObject->items as $an_item){ 
			  		$an_item->t_address = "";$t_phone =  array();
			  	if($an_item->address){
			  		$an_item->t_address = ucwords($an_item->address)."<br />";
			  	}
			  	if($an_item->suburb || $an_item->postcode){
			  		$an_item->t_address = $an_item->t_address.ucwords($an_item->suburb)." ";
			  	}
			  	if($an_item->postcode){
			  		$an_item->t_address = $an_item->t_address.$an_item->postcode;
			  	}
			  	if($an_item->phoneno){
			  		$t_phone[] = $an_item->phoneno;
			  	}
			  	if($an_item->mobile){
			  		$t_phone[] = $an_item->mobile;
			  	}
			  	$an_item->t_phone = $t_phone ;
			  	?>
			  <tr>
			    <td><?php echo $i+1 ; ?></td>
			    <td class="row"><?php if(in_array($an_item->member_status,$this->otherconfigs["allowedstatus"]) &&  in_array($an_item->playertype,$this->otherconfigs["checkboxes"])){ ?><div class="pull-left"><?php echo JHtml::_('grid.id', $i, $an_item->member_id); ?>&nbsp;</div><?php } ?>
			    	<div class="pull-left h21" ><?php echo $an_item->surname; ?></div>			    	
			    	<?php /*<div class="pull-right"><a class="btn btn-mini reg-button" rel='<?php echo $an_item->member_id; ?>' href="javascript:void(0);">+</a></div>*/?>
				    <div class="clearfix"></div>
				    <?php $this->rendererItems($an_item); ?>
				    <div class="clearfix"></div>
				    <p class="text-info pull-right small"><?php echo JText::_('COM_CLUBREG_REGISTERED_LABEL');?> : <?php echo $an_item->t_created_date;?></p>
			    </td>			    
			  </tr>			  
			  <?php $i++; }
			  } else {?> 
			  <tr>
			  	<td colspan=2 >			  		
			  		<div class="alert alert-error"><h3>No Results</h3></div>
			  	</td>
			  </tr>
			  <?php } ?>
		  </tbody>
		</table>
		<?php
	}
	protected function rendererItems($an_item){?>			
			<div class="reg-well" id='regdata_<?php echo $an_item->member_id; ?>'>
			<?php 
			foreach($this->headings as $akey=>$aheading){ 
				if(isset($aheading["csvonly"]) && $aheading["csvonly"] ){continue;}
				?>					
					<div class="text-info pull-left reg-label"><?php echo $aheading["label"]?></div>
					<div class="pull-left reg-colon"> :&nbsp;&nbsp;</div>
					<div class="pull-left reg-value">
					<?php echo $this->itemRenderer->render($an_item->$akey,$aheading); ?>&nbsp;</div>				
			<?php	if(isset($aheading["clearfix"]) && $aheading["clearfix"] ){?><div class="clearfix"></div> <?php }				
			}  ?>
			</div>			
			<?php
		}
	
}?>