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
			  <?php	$isEmpty = array("0","-1");	  		  
			  	foreach($viewObject->items as $an_item){ 
			  	$an_item = ClubRegRenderHelper::reformatObject($an_item);
			  	$fkey = $viewObject->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);	

			  	$profile_pix = $thumbrenderer->renderMemberThumb($an_item->member_id,FALSE,FALSE);
			  	
			  	$alertdata = json_encode(array("member_key"=>$fkey));
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
			  		<div class="pull-right"><a href="javascript:void(0);"  title="Add Anniversary" class="btn btn-mini" rel='anniversary' data-alertdata='<?php echo $alertdata ;?>' data-memberid='<?php echo $an_item->member_id; ?>'><i class="fa fa-bell" aria-hidden="true"></i></a></div>
				    <?php $this->rendererItems($an_item); ?>
				    <div class="clearfix"></div>
				    <?php if(LIVE_SITE){?>
				    	<a href="javascript:void(0);"  title="Delete" class="btn btn-mini pull-left" rel='delete-member' data-memberkey='<?php echo $fkey; ?>'><i class="fa fa-trash" aria-hidden="true"></i></a>
				   	<?php } ?>
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
							<div class="pull-left reg-value-div"><?php echo $this->itemRenderer->render(@$an_item->$akey,$aHead); ?></div>						
						</div>
			<?php 	} ?>
				</div>
			<?php }  ?>
			</div>	
			<div class="reg-well" id='regdiv_<?php echo $an_item->member_id; ?>' style="display:none"></div>
			<?php
	}
}

?>