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

class ClubRegRenderDivsStatsHelper extends ClubRegRenderTablesHelper
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
		
		$i = 0;		
		
		
		$this->headings =  $viewObject->entity_filters["headingsConfig"];	
		$this->otherconfigs = $viewObject->entity_filters["otherconfigs"];?>
		<table class="table table-bordered table-striped table-hover table-condensed">
			<?php $this->renderHead($viewObject);?>
		</table>
		<div class="row-fluid">		 
			  <?php 
			  if(count($viewObject->items) > 0){
			  	$defaultImg = "<img src='".JURI::base().CLUBREG_ASSETS."/images/clublogo32.png' >";
			  	foreach($viewObject->items as $an_item){ 
			  		$profile_pix =  $thumbrenderer->renderMemberThumb($an_item->member_id,FALSE,64);
			  		$t_phone =  array();		  	
			  	
				  	if($an_item->phoneno){
				  		$t_phone[] = $an_item->phoneno;
				  	}
				  	if($an_item->mobile){
				  		$t_phone[] = $an_item->mobile;
				  	}
				  	$an_item->t_phone = $t_phone ;			  	
				  	$fkey = $viewObject->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);			 
			  	?>			 
			    <div class="row cgroup-div-stats" style="margin:7px 5px 7px 10px;">		    
			      <div class="pull-left"><?php echo $i+1; ?></div>			    
				  <div class="thumbnail pull-left" style="margin-left:5px;"><?php echo ($profile_pix)?$profile_pix:$defaultImg; ?></div>			  
				  	<div class="p-thumbnail pull-left" >
			  			<a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $fkey;?>')"><?php echo ucwords($an_item->surname); ?></a>
			  			<br /><span><?php echo $an_item->group; ?>
			  			<?php if($an_item->subgroup){?>|&nbsp;<span class='small-group recent-subgroup'><?php echo $an_item->subgroup;?></span>&nbsp;<?php } ?>
			  			<div class="btn-group">	
			  				<a href="" class="btn btn-mini">Yes</a>
			  				<a href="" class="btn btn-mini">No</a>
			  			</div>
			  		</div>			  				    
				   <div class="clearfix"></div>		    	
			    </div>		 	  
			  <?php $i++; }
			  } else {?>			  			  		
			  		<div class="alert alert-error"><h3>No Results</h3></div>
			  
			  <?php } ?>
		  	</div>
		<?php
	}	
	
	protected function rendererItems($an_item){?>
	<div class="clearfix"></div>
			<div class="reg-well" id='regdata_<?php echo $an_item->member_id; ?>'>	
			<?php foreach($this->headings as $curIndex =>$aheading){ ?>
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