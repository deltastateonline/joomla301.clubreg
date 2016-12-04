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

class ClubRegRenderDivsFindplayersHelper extends ClubRegRenderTablesHelper
{
	protected $headings = array();
	protected $otherconfigs = array();
	
	function __construct(){		
		parent::__construct();	
	}	

	public function render($viewObject){		
		$params = JComponentHelper::getParams('com_clubreg');		
		$folder_path = $params->get("attachment_folder");
	
		$media_params = JComponentHelper::getParams('com_media');		
		$full_media_path = $media_params->get('file_path').DS.$folder_path.DS;
		
		$thumbrenderer = new ClubRegProfileThumbsHelper($full_media_path);		
		
		$defaultImg = "<img src='".JURI::base().CLUBREG_ASSETS."/images/clublogo32.png' >";
		
		$i = 0;		
		$this->headings =  $viewObject->headingsConfig;
		?>		
		<div class="row-fluid">		 
			  <?php		$isEmpty = array("0","-1");	  
			  	foreach($viewObject->items as $an_item){ 
			  		$an_item->t_address = "";$t_phone =  array();
			  		
			  		
			  	if($an_item->address){
			  		$an_item->t_address = ucwords($an_item->address)."<br />";
			  	}
			  	
			  	$an_item->suburb = str_replace("-1", "",$an_item->suburb);
			  	
			  	if($an_item->suburb || $an_item->postcode){
			  		$an_item->t_address = $an_item->t_address.ucwords($an_item->suburb)." ";
			  	}
			  	
			  	if($an_item->ausstate){
			  		$an_item->t_address = $an_item->t_address.", ".$an_item->ausstate." ";
			  	}
			  	
			  	if($an_item->postcode){
			  		$an_item->t_address = $an_item->t_address.$an_item->postcode;
			  	}
			  	if($an_item->phoneno && !in_array($an_item->phoneno,$isEmpty)){
			  		$t_phone[] = $an_item->phoneno;
			  	}
			  	if($an_item->mobile && !in_array($an_item->mobile,$isEmpty)){
			  		$t_phone[] = $an_item->mobile;
			  	}
			  	$an_item->t_phone = $t_phone ;			  	
			  	$fkey = $viewObject->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);

			  	

			  	$profile_pix = $thumbrenderer->renderMemberThumb($an_item->member_id,FALSE,FALSE);
			  	?>			 
			    <div class="row cgroup-div" style="margin:7px 5px 7px 10px;">	    
			     <div class="pull-left">			     	
			     	<span class="pull-right numbering"><?php echo $i+1 ; ?>	</span>
				    <div style="margin-top:5px;">				    	
				    	<div class="thumbnail">
				    		<?php echo ($profile_pix)?$profile_pix:$defaultImg; ?>		
				    	</div>	   
				    	
				    </div>		
				  </div>
				  <div class="span10">
				  	<div class="pull-left h21" style="border:0px;">
			  			<a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $fkey;?>')"><?php echo ucwords($an_item->surname); ?></a>
			  		</div>
				    <?php $this->rendererItems($an_item); ?>
				    <div class="clearfix"></div>
				    <p class=" pull-right small"><?php echo JText::_('COM_CLUBREG_REGISTERED_LABEL');?> :<?php echo $an_item->t_created_by;?> on  <?php echo $an_item->t_created_date;?></p>
			    	</div>  
			    </div>		 	  
			  <?php $i++; }
		?></div><?php 	 
	}	
	/**
	 * $this->headings structure
	 * 		[playertype][headings] = array(
	 * 			array(label1=>array(),label2=>array)
	 * 			array(label3=>array(),
	 * 			array(label4=>array(),label5=>array(),label6=>()) 
	 * 		)
	 * @see ClubRegRenderTablesHelper::rendererItems()
	 */
	protected function rendererItems($an_item){?>
	<div class="clearfix"></div>
			<div class="reg-well" id='regdata_<?php echo $an_item->member_id; ?>'>			
			<?php 
			
			foreach($this->headings[$an_item->playertype]["headings"] as $curIndex =>$aheading){ ?>
				<div class="row each-row">
				<?php $howmany = count($aheading);				
				$each = 12 / $howmany;
				$eachSpan = "span".$each;		
								
				foreach($aheading as $akey => $aHead){ ?>
						<div class="<?php echo $eachSpan?>" >							
							<div class="text-info pull-left reg-label"><?php echo $aHead["label"]?></div>
							<div class="pull-left reg-colon"> : </div>
							<div class="pull-left reg-value-div"><?php echo $this->itemRenderer->render($an_item->$akey,$aHead); ?></div>						
						</div>
			<?php 	} ?>
				</div>
			<?php }  ?>
			</div>	
			<?php
	}
}

?>