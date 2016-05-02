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
class ClubRegRenderTablesPaymentsReportingHelper extends ClubRegRenderTablesHelper
{
	protected $headings = array();	
	
	function __construct(){		
		parent::__construct();	
	}	

	public function render($viewObject){	
		global $clubreg_Itemid;	
		$i = 0;		
		$this->headings =  $viewObject->entity_filters["headingsConfig"]; ?>		
			  <table class="table table-bordered table-condensed table-striped" style="font-size:xx-small;">
				  <tr>
				  	<th>#</th>
				  	<th></th>
				  <?php foreach($this->headings as $akey=>$aheading){  ?>
				    <th><?php echo $aheading["label"]?></th>
				  <?php } ?>				    
				  </tr>
				  <?php $i=1;
				 
				  foreach($viewObject->items as $an_item){  
				  		$fkey = $viewObject->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);
				  		
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
				  		
				  		if($an_item->subgroup){ $an_item->group = $an_item->group."|".$an_item->subgroup; }
				  		
				  		
				  		$an_item->fkey = $fkey ;
				  		$an_item->idx = $i++;
				  		$this->rendererItems($an_item); 
				   } ?>
				</table>		  
			  <?php 	
	}	
	/**
	 * (non-PHPdoc)
	 * @see ClubRegRenderTablesHelper::rendererItems()
	 */
	protected function rendererItems($an_item){		
		?>
				<tr>
					<td><?php echo $an_item->idx; ?></td>	
					<td><a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $an_item->fkey;?>')" ><?php echo ucwords($an_item->surname); ?></a></td>
				<?php 
				foreach($this->headings as $akey=>$aheading){ 
					if(isset($aheading["csvonly"]) && $aheading["csvonly"] ){continue;}	?>						
						<td><?php echo $this->itemRenderer->render($an_item->$akey,$aheading);?></td>				
				<?php }  ?>
				</tr>			
				<?php
	}
	
		
}