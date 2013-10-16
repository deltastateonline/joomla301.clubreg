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
}?>