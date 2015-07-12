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

class ClubRegRenderTablesStatsReportingHelper extends ClubRegRenderTablesHelper
{
	protected $headings = array();
	protected $otherconfigs = array();
	
	protected  $stats_date = NULL;
	protected  $end_date = NULL;
	protected  $stats_reporting = NULL;
	
	function __construct($stats_date,$end_date,$stats_reporting){		
		
		$this->stats_date = $stats_date;
		$this->end_date = $end_date;
		$this->stats_reporting = $stats_reporting;
		
		parent::__construct();	
	}	

	public function render($viewObject){		
		$params = JComponentHelper::getParams('com_clubreg');		
		$folder_path = $params->get("attachment_folder");
	
		$media_params = JComponentHelper::getParams('com_media');		
		$full_media_path = $media_params->get('file_path').DS.$folder_path.DS;
		
		$thumbrenderer = new ClubRegProfileThumbsHelper($full_media_path);		
		
		$id = 0;		
		
		$this->headings =  $viewObject->entity_filters["headingsConfig"];	
		$this->otherconfigs = $viewObject->entity_filters["otherconfigs"];?>
		
		<table class="table table-bordered table-striped table-hover table-condensed">
			<?php $this->renderHead($viewObject);?>
		</table>
		<?php //  ?>
		<table  class="table table-bordered table-striped table-hover table-condensed" id="reporting-stats">
		<thead>
				<tr>
					<th width="10">#</th>
					<th width="100"></th>					
					<th width="100" ></th>					
					<?php 
						$startTime = strtotime($this->stats_date); 
						$endTime = strtotime($this->end_date); $format = "%".str_replace("-", "-%", JText::_('DATE_FORMAT_LC4'));
						$date_array = array();
						for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) { 
							$a_date = strftime($format, $i);
							$date_array[] = $a_date;							
							$a_date_obj = new JDate($i); ?>
								<th width=20 class="rotate"><div><span><?php  echo $a_date_obj->format(JText::_('DATE_FORMAT_LC3')); ?></span></div></th>
						<?php	}	?>					
				</tr>
		</thead>
		<tbody>	
			  <?php 			 
			  if(count($viewObject->items) > 0){
			  	$defaultImg = "<img src='".JURI::base().CLUBREG_ASSETS."/images/clublogo32.png' >";
			  	foreach($viewObject->items as $an_item){ 
			  		$profile_pix =  $thumbrenderer->renderMemberThumb($an_item->member_id,FALSE,64);
			  		$t_phone =  $currentStats = array();		  	
			  	
				  	if($an_item->phoneno){
				  		$t_phone[] = $an_item->phoneno;
				  	}
				  	if($an_item->mobile){
				  		$t_phone[] = $an_item->mobile;
				  	}
				  	$an_item->t_phone = $t_phone ;			  	
				  	$fkey = $viewObject->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);	//data-toggle="buttons-radio"
				  	
				  	if(isset($this->stats_reporting[$an_item->member_id]))
				  		$currentStats = $this->stats_reporting[$an_item->member_id]; 
			  	?>				    
			    <tr data-member_key='<?php echo $fkey; ?>'>	    
			      	<td><?php echo $id+1; ?></td>			    
				  	<td><div class="thumbnail"><?php echo ($profile_pix)?$profile_pix:$defaultImg; ?></div></td>			  
				  	<td><a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $fkey;?>')"><?php echo ucwords($an_item->surname); ?></a>
				  		<br /><small><?php echo $an_item->group; ?><br /><?php if($an_item->subgroup){ echo "|".$an_item->subgroup; } ?></small>
				  	</td>			  		
			  		<?php foreach($date_array as $aDate){ ?>
			  			<td class="stats"><?php if(isset($currentStats[$aDate])){echo ucfirst($currentStats[$aDate]) ;}else{ echo "-"; }?></td>
			  		<?php } ?>			  				  				  	    	
			    </tr>		 	  
			  <?php $id++; } ?>
			  </tbody>	 
			  </table>
			 <?php } else {?>			  			  		
			  		<div class="alert alert-error"><h3>No Results</h3></div>			  
			  <?php } ?>		  	
		<?php
	}	
	
	protected function rendererItems($an_item){ ?><h2>what</h2>
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