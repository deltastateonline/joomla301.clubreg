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
class ClubRegRenderTablesChildrenHelper extends ClubRegRenderTablesHelper
{
	protected $headings = array();	
	
	function __construct(){		
		parent::__construct();	
	}	

	public function render($viewObject){	
		global $clubreg_Itemid;	
		$i = 0;		
		$this->headings =  $viewObject->entity_filters["headings"];	?>		
		<div >
			  <?php 
			  if(count($viewObject->items) > 0){
			  	foreach($viewObject->items as $an_item){ 			  		
			  		$fkey = $viewObject->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);
			  		$rel_string = json_encode(array("Itemid"=>$clubreg_Itemid,"parent_key"=>$viewObject->parent_key,JSession::getFormToken()=>1,'pk'=>$fkey,'action'=>'update'));
			  	?>			  
			    <div class="profile-new-div" id='childdata_<?php echo $an_item->member_id; ?>' rel=<?php echo $rel_string ?>>
			    	<div class="profile-sub-head-div">
			    		<div class="pull-left"><a href="javascript:void(0);"  rel=<?php echo $rel_string ?> class='profile-children-button' title=<?php echo JText::_('COM_CLUBREG_PAYMENT_EDIT');?>><?php echo  $an_item->surname; ?></a></div>	
			    		<div class="pull-right" style='font-size:0.8em'><?php echo $an_item->reg_created_by;?> on  <?php echo $an_item->reg_created_date;?></div>		    	
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
	protected function rendererItems($an_item){?>
				<div class="profile-reg-well" >
				<?php 
				foreach($this->headings as $akey=>$aheading){ 
					if(isset($aheading["csvonly"]) && $aheading["csvonly"] ){continue;}	?>					
						<div class="pull-left <?php echo !isset($aheading["label_class"])?"reg-label":$aheading["label_class"]?>"><?php echo $aheading["label"]?></div>
						<div class="pull-left reg-colon">&nbsp;:&nbsp;</div>
						<div class="pull-left reg-value"><?php echo $this->itemRenderer->render($an_item->$akey,$aheading); ?>&nbsp;</div>				
				<?php	if(isset($aheading["clearfix"]) && $aheading["clearfix"] ){?><div class="clearfix"></div> <?php }				
				}  ?>
				</div>			
				<?php
	}
	public function renderAnItem($viewObject){
		
		global $clubreg_Itemid;
		
				$this->headings =  $viewObject->entity_filters["headings"];						 
				$an_item = current($viewObject->items);
					  		  		
				$fkey = $viewObject->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);
				$rel_string = json_encode(array("Itemid"=>$clubreg_Itemid,"member_key"=>$viewObject->member_key,JSession::getFormToken()=>1,'payment_key'=>$fkey,'action'=>'update')); ?>					   
			    	<div class="pull-left h21" ><a href="javascript:void(0);"  rel=<?php echo $rel_string ?> class='profile-children-button' title=<?php echo JText::_('COM_CLUBREG_PAYMENT_EDIT');?>><?php echo JText::_('COM_CLUBREG_PAYMENT_DESCRIPTION'),' - ', $an_item->payment_desc; ?></a></div>	
			    	<div class="pull-right small" style='padding-top:5px;padding-left:15px;'><?php echo $an_item->name;?> on  <?php echo $an_item->created;?></div>		    	
				    <div class="clearfix"></div>
				    <?php $this->rendererItems($an_item); ?>
				    <div class="clearfix"></div>					    		  
	<?php 		
	}
		
}?>