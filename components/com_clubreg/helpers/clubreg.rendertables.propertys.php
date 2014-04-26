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
class ClubRegRenderTablesPropertysHelper extends ClubRegRenderTablesHelper
{
	protected $headings = array();	
	
	function __construct(){		
		parent::__construct();	
	}	

	public function render($viewObject){	
		global $clubreg_Itemid;	
		$i = 0;		
		$this->headings =  $viewObject->entity_filters["headings"];	?>		
		
			  <?php 
			  if(count($viewObject->items) > 0){?>
			 <div><?php 
			  	foreach($viewObject->items as $an_item){ 			  		
			  		$fkey = $viewObject->uKeyObject->constructKey($an_item->property_id,$an_item->property_key);
			  		$rel_string = json_encode(array("Itemid"=>$clubreg_Itemid,"member_key"=>$viewObject->member_key,JSession::getFormToken()=>1,'property_key'=>$fkey,'action'=>'update'));
			  	?>			  
			    <div class="profile-new-div" id='propertydata_<?php echo $an_item->property_id; ?>' rel=<?php echo $rel_string ?>>
			    	<div class='profile-sub-head-div'>
			    	<div class="pull-left"><a href="javascript:void(0);"  rel=<?php echo $rel_string ?> class='profile-property-button' title=<?php echo JText::_('COM_CLUBREG_PROPERTY_EDIT');?>><?php echo JText::_('COM_CLUBREG_PROPERTY_TYPE'),' - ', $an_item->property_type; ?></a></div>	
			    	<div class="pull-right" style='font-size:0.8em;padding-left:15px;'><?php echo $an_item->name;?> on  <?php echo $an_item->created;?></div>		    	
				    <div class="clearfix"></div>
				    </div>
				    <?php $this->rendererItems($an_item); ?>
				    <div class="clearfix"></div>				    
			    </div>			  
			  <?php  }?>
			 </div> 		
		<?php }else{?>			  		  		
			  	<div class="alert alert-error"><h3>No Results</h3></div>			  
		<?php } 
	}	
	/**
	 * (non-PHPdoc)
	 * @see ClubRegRenderTablesHelper::rendererItems()
	 */
	protected function rendererItems($an_item){?>
				<div class="profile-reg-well" >
				<?php 
				foreach($this->headings as $akey=>$aheading){ 
					if(isset($aheading["csvonly"]) && $aheading["csvonly"] ){continue;}	?>					
						<div class="pull-left <?php echo !isset($aheading["label_class"])?"reg-label1":"reg-label"?>"><?php echo $aheading["label"]?></div>
						<div class="pull-left reg-colon">&nbsp;:&nbsp;</div>
						<div class="pull-left reg-value"><?php echo $this->itemRenderer->render($an_item->$akey,$aheading); ?>&nbsp;</div>				
				<?php	if(isset($aheading["clearfix"]) && $aheading["clearfix"] ){?><div class="clearfix"></div> <?php }				
				}  ?>
				</div>			
				<?php
	}
	/**
	 *  renders the wrapper around the item
	 * @param unknown_type $viewObject
	 */
	public function renderAnItem($viewObject){
		
		global $clubreg_Itemid;		
		
				$this->headings =  $viewObject->entity_filters["headings"];	
							 
				$an_item = current($viewObject->items);?>
			<div class="payment-new-div">
				<div class='payment-sub-head-div'>
				<?php if(isset($viewObject->hide_created) && $viewObject->hide_created){?>
					<div class="pull-left" ><?php echo JText::_('COM_CLUBREG_PROPERTY_TYPE'),' - ', $an_item->property_type; ?></div>
				<?php }else{					  		  		
					$fkey = $viewObject->uKeyObject->constructKey($an_item->property_id,$an_item->property_key);
					$rel_string = json_encode(array("Itemid"=>$clubreg_Itemid,"member_key"=>$viewObject->member_key,JSession::getFormToken()=>1,'property_key'=>$fkey,'action'=>'update')); ?>					   
			    	<div class="pull-left" ><a href="javascript:void(0);"  rel=<?php echo $rel_string ?> class='profile-property-button' title=<?php echo JText::_('COM_CLUBREG_PROPERTY_EDIT');?>><?php echo JText::_('COM_CLUBREG_PROPERTY_TYPE'),' - ', $an_item->property_type; ?></a></div>	
			    	<div class="pull-right small" style='font-size:0.8em;padding-left:15px;'><?php echo $an_item->name;?> on  <?php echo $an_item->created;?></div>		    	
				<?php } ?>								   
				    <div class="clearfix"></div>
				    </div>
				    <?php $this->rendererItems($an_item); ?>
				    <div class="clearfix"></div>
			</div>					    		  
	<?php 		
	}
		
}?>