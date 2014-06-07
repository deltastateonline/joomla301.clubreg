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
class ClubRegRenderTablesRegMembersHelper extends ClubRegRenderTablesHelper
{
	protected $headings = array();
	protected $otherconfigs = array();
	
	function __construct(){		
		parent::__construct();	
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
			  	
			  	$fkey = $viewObject->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);
			  	?>
			  <tr>
			    <td><?php echo $i+1 ; ?></td>
			    <td class="row"><?php if(in_array($an_item->member_status,$this->otherconfigs["allowedstatus"]) &&  in_array($an_item->playertype,$this->otherconfigs["checkboxes"])){ ?><div class="pull-left"><?php echo JHtml::_('grid.id', $i, $an_item->member_id); ?>&nbsp;</div><?php } ?>
			    	<div class="pull-left h21" ><a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $fkey;?>')"><?php echo ucwords($an_item->surname); ?></a></div>			    			    	
			    	<?php /*<div class="pull-right"><a class="btn btn-mini reg-button" rel='<?php echo $an_item->member_id; ?>' href="javascript:void(0);">+</a></div>*/?>
				    <div class="clearfix"></div>
				    <?php $this->rendererItems($an_item); ?>
				    <div class="clearfix"></div>
				    <p class=" pull-right small"><?php echo JText::_('COM_CLUBREG_REGISTERED_LABEL');?> :<?php echo $an_item->t_created_by;?> on  <?php echo $an_item->t_created_date;?></p>
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
}
class ClubRegRenderListsRegMembersHelper extends ClubRegRenderTablesHelper
{
	protected $headings = array();
	protected $otherconfigs = array();

	function __construct(){
		parent::__construct();
	}

	public function render($viewObject){
		$i = 0;
		$this->headings =  $viewObject->entity_filters["headings"];
		$this->otherconfigs = $viewObject->entity_filters["otherconfigs"];
		$this->renderSorting($viewObject); ?>		
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
			  	
			  	$fkey = $viewObject->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);
			  	?>
			  <tr>
			    <td><?php echo $i+1 ; ?><?php if(in_array($an_item->member_status,$this->otherconfigs["allowedstatus"]) &&  in_array($an_item->playertype,$this->otherconfigs["checkboxes"])){ echo JHtml::_('grid.id', $i, $an_item->member_id); } ?></td>			    
			    <td><a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $fkey;?>')"><?php echo ucwords($an_item->surname); ?></a></td>			    			    	
			   	<?php $this->rendererItems($an_item); ?>						    		    
			  </tr>			  
			  <?php $i++; }
			  } else {?> 
			  <tr>
			  	<td colspan=<?php echo count($this->headings);?> >			  		
			  		<div class="alert alert-error"><h3>No Results</h3></div>
			  	</td>
			  </tr>
			  <?php } ?>
		  </tbody>
		</table>
		<?php
	}	
	private function renderSorting($viewObject){		
		$listOrder	= $viewObject->escape($viewObject->state->get('list.ordering'));
		$listDirn	= $viewObject->escape($viewObject->state->get('list.direction'));
		$sortFields = $viewObject->getSortFields();	?>
		<table>
			<thead>
			  <tr style="background: none repeat scroll 0 0 #EFEFEF;">			    
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
			    
			    </th>			    		     	      
			  </tr>
		  </thead>		   
		</table>
	<?php 	
	}
	
	protected function renderHead($viewObject){?>
		<thead>
			<tr>
			<?php 
				foreach($this->headings as $a_head){ ?>
					<th style="vertical-align: top"><?php echo $a_head["label"] ; ?></th>		
				<?php 
}?>
			</tr>
		</thead>
		<?php
	}
	protected function rendererItems($an_item){
			foreach($this->headings as $akey=>$aheading){
				if(isset($aheading["csvonly"]) && $aheading["csvonly"] ){continue;}	?>					
				 <td >
					<?php echo $this->itemRenderer->render($an_item->$akey,$aheading); ?>
				</td>				
			<?php				
			}  
			?>
			 <td><?php echo $an_item->t_created_by;?> on  <?php echo $an_item->t_created_date;?></td>
			<?php
		}
}

?>