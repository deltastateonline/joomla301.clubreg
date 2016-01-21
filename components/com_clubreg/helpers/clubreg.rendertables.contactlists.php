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
class ClubRegRenderTablesContactlistsHelper extends ClubRegRenderTablesHelper
{
	protected $headings = array();	
	
	function __construct(){		
		parent::__construct();	
	}	

	public function render($viewObject){	
		global $clubreg_Itemid;	
		$i = 0;		
		$this->headings =  $viewObject->entity_filters["headings"];	?>		
			  <table class="table table-bordered table-condensed table-striped">
				  <tr>
				  <?php foreach($this->headings as $akey=>$aheading){  ?>
				    <th><?php echo $aheading["label"]?></th>
				  <?php } ?>				    
				  </tr>
				  <?php $i=1;
				  foreach($viewObject->items as $an_item){  
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
	protected function rendererItems($an_item){?>
				<tr>
				<?php 
				foreach($this->headings as $akey=>$aheading){ 
					if(isset($aheading["csvonly"]) && $aheading["csvonly"] ){continue;}	?>						
						<td><?php echo $this->itemRenderer->render($an_item->$akey,$aheading);?></td>				
				<?php }  ?>
				</tr>			
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
				<div class='profile-sub-head-div'>
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
	<?php 		
	}
		
}
class ClubRegRenderDivContactlistsHelper extends ClubRegRenderTablesHelper
{
	protected $headings = array();	
	
	function __construct(){		
		parent::__construct();	
	}	

	public function render($viewObject){	
		global $clubreg_Itemid;	
		$i = 0;		
		$this->headings =  $viewObject->entity_filters["headings"];	
		 $i=1;
		  foreach($viewObject->items as $an_item){  
		  	$an_item->idx = $i++;				  		
		  	$fkey = $viewObject->uKeyObject->constructKey($an_item->contactlist_id,$an_item->contactlist_key);
			$an_item->rel_string = json_encode(array("Itemid"=>$clubreg_Itemid,"member_key"=>$viewObject->member_key,JSession::getFormToken()=>1,'contactlist_key'=>$fkey,'action'=>'update'));
			  		
		  	$this->rendererItems($an_item); 
		   }
	}	
	/**
	 * (non-PHPdoc)
	 * @see ClubRegRenderTablesHelper::rendererItems()
	 */
	protected function rendererItems($an_item){?>
		<div class="profile-new-div" id='contactlistdata_<?php echo $an_item->contactlist_id; ?>' rel=<?php echo $an_item->rel_string ?>>
			<div class="profile-sub-head-div">
				<div class="pull-left">
				<a href="javascript:void(0);"  rel=<?php echo $an_item->rel_string ?> class='profile-contactlist-link' >
			<?php $akey = "contactlist_sname";$aheading = $this->headings[$akey];
					echo $this->itemRenderer->render($an_item->$akey,$aheading);
					$akey = "contactlist_fname";$aheading = $this->headings[$akey];
					echo "&nbsp;" , $this->itemRenderer->render($an_item->$akey,$aheading);
			?></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="profile-reg-well contact-list-item">
				<?php $akey = "contactlist_phoneno"; $aheading = $this->headings[$akey]; ?>
				<div  class="pull-left reg-label"><?php echo $aheading['label']; ?></div>
				<div class="pull-left reg-colon">:&nbsp;</div>
				<div class="pull-left reg-value"><?php echo $this->itemRenderer->render($an_item->$akey,$aheading);?>&nbsp;</div>
				<?php $akey = "contactlist_email";$aheading = $this->headings[$akey]; ?>				
				<div class="pull-left reg-label1"><?php echo $aheading['label']; ?></div>	
				<div class="pull-left reg-colon">&nbsp;:&nbsp;</div>			
				<div class="pull-left reg-value"><?php echo $this->itemRenderer->render($an_item->$akey,$aheading);?></div>
			
			<div class="clearfix"></div>
				<?php $akey = "contactlist_notify";$aheading = $this->headings[$akey]; ?>
				<div class="pull-left reg-label"><?php echo $aheading['label']; ?></div>
				<div class="pull-left reg-colon">:&nbsp;</div>				
				<div class="pull-left reg-value"><?php echo $this->itemRenderer->render($an_item->$akey,$aheading);?></div>
				<a class="pull-right img_hidden contactlist-delete" rel=<?php echo $an_item->rel_string ?>><img src="<?php echo CLUBREG_ASSETS; ?>/images/delete.png" /></a>
				<div class="clearfix"></div>
			</div>	
		</div>
		<div class="clearfix"></div>
<?php 			
	}
	protected function rendererItems5($an_item){		
		?>
		<div class="contact-list-item">
			<div class="contact-title"><a href="">Player Name Here</a></div>
			<div class="contact-phone">
				<div class="pull-left reg-label">Email</div>
				<div class="pull-left reg-colon">:</div>
				<div class="pull-left reg-value">sample@hotmail.com.au</div> 
				<div class="pull-left reg-label1">Phone:</div><div class="pull-left reg-value">0413923009</div>
			</div><span class="clearfix"></span>
			<div class="contact-notify"><div class="pull-left reg-label">Notify Contact?</div>
			<div class="pull-left reg-colon">:</div>
			<div class="pull-left reg-value">Yes </div>
			<span class="pull-right"><img src="<?php echo CLUBREG_ASSETS; ?>/images/delete.png" /></a></span></div>
			<span class="clearfix"></span>
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
				<div class='profile-sub-head-div'>
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
	<?php 		
	}
		
}?>