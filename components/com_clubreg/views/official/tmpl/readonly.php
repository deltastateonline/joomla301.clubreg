<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;
JHtml::_('behavior.framework');
jimport('joomla.html.html.bootstrap');

//JHtml::_('formbehavior.chosen', 'select');
JHTML::_('behavior.calendar');
JHtml::_('behavior.tooltip');

global $clubreg_Itemid;
$rel_string = array("Itemid"=>$clubreg_Itemid);

$in_type = "hidden"; ?>
<script type="text/javascript">
<!--
Joomla.sbutton = function(pk)
{

	var form = document.getElementById('adminForm');	
	document.adminForm.action='<?php echo JRoute::_($this->formaction_edit,false); ?>';		
	document.adminForm.layout.value= 'viewonly';		
	document.adminForm.pk.value = pk;
	form.submit();
}

Joomla.formToken = '<?php echo JSession::getFormToken() ;?>';	

var noResults = "<?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_NORESULTS'); ?>";
//-->
</script>

<?php if($this->render_sections["breakdown"]) { ?>
	<script type="text/javascript">
	<!--
		//Load the Visualization API and the piechart package.
		//google.load('visualization', '1.0', {'packages':['corechart']});

		google.charts.load('49',    {packages: ['corechart']});
		
		// Set a callback to run when the Google Visualization API is loaded.
		// google.setOnLoadCallback(drawChart);
	
		ClubregObjectDefinition.prototype.drawChart  = function (ajaxData,configData) {
	
			  // Create the data table.
			var data = new google.visualization.DataTable();
	
			var howmanyColumns = configData.columns.length;
				
	 		for(var i = 0; i < howmanyColumns ; i++){
	 			var b = configData.columns[i]; 				
	 			data.addColumn(b.ty,b.vl);
	 		}
			//[abreakdown['chartLabel'],abreakdown['men'],abreakdown['women'],abreakdown['noset'] ]
			var dataArray = Array();
	 		for(var i = 0;i < ajaxData.length; i++){
	 	 		
	 	 		var b = Array(); // mt array 					
	 			for(var j = 0; j < howmanyColumns ;j++){  // use the columns passed in
	 	 			var labelElement = configData.columns[j].labelElement; 	
					if(labelElement == "chartLabel" && configData.labels != undefined ){	// pass in extra labels				
						var aLabel = ajaxData[i][labelElement];
						ajaxData[i][labelElement] = configData.labels[aLabel];					
					}
	 	 			
	 	 			if(configData.columns[j].ty == "number"){
	 	 				b.push(Number(ajaxData[i][labelElement])); // format numbers
	 	 			}else{
						b.push(ajaxData[i][labelElement]);
	 	 			}
				}
	 			dataArray.push(b) 				
	 		} 		
	 		data.addRows(dataArray); // add all the data into an array 		
	 		
			  // Instantiate and draw our chart, passing in some options.
			  if(configData.chartType == "bar-chart"){
				  //new google.visualization.PieChart
				  var chart = new google.visualization.BarChart(document.getElementById(configData.container));
			  }else if(configData.chartType == "pie-chart"){
				  var chart = new google.visualization.PieChart(document.getElementById(configData.container));
			  }
			  
			  chart.draw(data, configData.options);  
		}
		
		ClubregObjectDefinition.prototype.groupData = {
		  options :{'title':'<?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_BREAKDOWN'),  " - " , JText::_('COM_CLUBREG_GROUPSN_LABEL')?>',
			  		 'titlePosition':'out','width':600,'height':300,isStacked: true,'legend':{position:'bottom'}
	 		 		},
		  columns:[ 
			  {ty: 'string', vl:'<?php echo JText::_('COM_CLUBREG_GROUPN_LABEL'); ?>','labelElement':'chartLabel'},
			  {ty: 'number', vl:'<?php echo JText::_('COM_CLUBREG_MALE'); ?>','labelElement':'men'},
			  {ty: 'number', vl:'<?php echo JText::_('COM_CLUBREG_FEMALE'); ?>','labelElement':'women'},
			  {ty: 'number', vl:'<?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_NORESULTS'); ?>','labelElement':'noset'}
			],
		  container: 'chart_div',
		  chartType : 'bar-chart'
		};
	
		ClubregObjectDefinition.prototype.subGroupData = {
			options : {'title':'<?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_BREAKDOWN'),  " - " , JText::_('COM_CLUBREG_SUBGROUPSN_LABEL')?>',
		                 'width':600, 'height':300, isStacked: true, 'legend':{position:'bottom'}
	            	},
			columns:[ 
	        	{ty: 'string', vl:'<?php echo JText::_('COM_CLUBREG_SUBGROUPSN_LABEL'); ?>','labelElement':'chartLabel'},
	          	{ty: 'number', vl:'<?php echo JText::_('COM_CLUBREG_MALE'); ?>','labelElement':'men'},
	          	{ty: 'number', vl:'<?php echo JText::_('COM_CLUBREG_FEMALE'); ?>','labelElement':'women'},
				{ty: 'number', vl:'<?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_NORESULTS'); ?>','labelElement':'noset'}
	   		],
	  	  container: 'chart_div_sub',
	  	  chartType : 'bar-chart'
		};
	
		ClubregObjectDefinition.prototype.playerTypeData = {
			options : {'title':'<?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_BREAKDOWN'),  " - " , JText::_('COM_CLUBREG_PT')?>',
	                 'width':600,'height':300,'legend':{position:'bottom'}
	        		},
			columns:[ 
	        	{ty: 'string', vl:'<?php echo JText::_('COM_CLUBREG_PT'); ?>','labelElement':'chartLabel'},
				{ty: 'number', vl:'<?php echo JText::_('COM_CLUBREG_PT'); ?>','labelElement':'howmany'}
				],
			container: 'chart_div_player',
			chartType : 'pie-chart',
			labels:{
				'guardian': '<?php echo JText::_('COM_CLUBREG_PT_GUARDIAN');?>',
				'junior' : '<?php echo JText::_('COM_CLUBREG_PT_JUNIOR');?>',
				'senior': '<?php echo JText::_('COM_CLUBREG_PT_SENIOR');?>'
			}
		};
	//-->
	</script>
<?php } ?>
<div class="profile <?php echo $this->pageclass_sfx?>">
<?php 
$renderTab["group"] = $renderTab["dashboard"] = FALSE;
if($this->canedit){
	$renderTab["dashboard"] = TRUE;
?>
<div class="btn-group pull-right" >
<button class="btn"><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_LINKS'); ?></button>
	<button class="btn dropdown-toggle" data-toggle="dropdown">
    	<span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
		<li><a href="<?php echo JRoute::_('index.php?option=com_clubreg&task=official.edit&user_id='.(int) $this->member_id);?>">
				<span class="icon-user"></span><?php echo JText::_('CLUBREG_EDIT_PROFILE'); ?></a>
		</li>
	</ul>
</div>
<div class="clearfix"></div>
<?php } 
	/*
	 * 
	 * class="btn-toolbar pull-right"
	 * */
	$myGroups = $this->official_details->group_member; // group_name
	$myLeaders = $this->official_details->group_leader;
	if(count($myGroups) > 0 || count($myLeaders)> 0){ $renderTab["group"] = TRUE; }
	
	if($renderTab["dashboard"]){ $next_tab =""; }else{ $next_tab = "active"; }
	
?>
<fieldset id="users-profile-core">
	<legend>
		<?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_DESC'), " - ",$this->official_details->official_name; ?>
	</legend>
	
	<div class="tabbable tabs-top">
		<ul class="nav nav-tabs">
			<?php  if($renderTab["dashboard"]){ ?><li class="active"><a href="#tabDashboard" data-toggle="tab"><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_DASHBOARD') ?></a></li><?php } ?>
			<li class="<?php echo $next_tab; ?>"><a href="#tabDetails" data-toggle="tab"><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_DETAILS') ?></a></li>
			<?php  if($renderTab["group"]){ ?><li><a href="#tabGroups" data-toggle="tab"><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_GROUP') ?></a></li><?php } ?>
			
			
		</ul>
	<div class="tab-content">		
		<?php 		
		
		$joomla_details = $this->official_details->extraDetails;
		
	if(count($this->extradetails) > 0){	?>
		<div class="tab-pane <?php echo $next_tab; ?>" id="tabDetails">
			<dl class="dl-horizontal">
			<?php 
			foreach($this->extradetails as $a_detail){ 	$a_detail->config_short;?>
				<dt>
					<?php echo $a_detail->config_name; ?> :
				</dt>
				<dd class="well well-small">
					<?php 
					$registry = new JRegistry($a_detail->params);
					$paramArray = $registry->toArray();
			
					$ControlRender = new ClubRegControlsReadonlyHelper($paramArray);
					$ControlRender->set('configData', $a_detail) ;
					
					if(isset($joomla_details[$a_detail->config_short])){ 				
						$ControlRender->set('memberDetails',$joomla_details[$a_detail->config_short]);							
					}
					$ControlRender->render($paramArray);
					?>
				</dd>		
				<?php 
				unset($registry);unset($ControlRender);unset($paramArray);
			}?>
		<?php ?>
			</dl>
		</div>
<?php 	} if($renderTab["group"]){  ?>
			<div class="tab-pane" id="tabGroups">
			<?php if(count($myLeaders) > 0 ){ ?>
				<div class="alert alert-info"><img alt="" src="components/com_clubreg/assets/images/groups.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_LEADER'); ?></strong></div>
					<div class="well well-large">
						<ol>
						<?php foreach($myLeaders as $aGroup){?>
							<li><?php echo $aGroup->group_name ?></li>
						<?php } ?>
						</ol>
					</div>
			<?php }?>
			<?php if(count($myGroups) > 0 ){ ?>
				<div class="alert alert-info"><img alt="" src="components/com_clubreg/assets/images/groups.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_MEMBER'); ?></strong></div>
					<div class="well well-large">
						<ol>
						<?php foreach($myGroups as $aGroup){?>
							<li><?php echo $aGroup->group_name ?></li>
						<?php } ?>
						</ol>
					</div>
			<?php }?>
			</div>
		<?php } // render group tab 
		if($renderTab["dashboard"]){  
			$render_sections = $this->render_sections; ?>
			<div class="tab-pane active" id="tabDashboard">				
				<div class="alert alert-info section-head" data-section='profileMembers'><img alt="" src="components/com_clubreg/assets/images/groups.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_MEMBERS'); ?></strong></div>
				<div class="loading1" id="profileMembers" rel=<?php echo json_encode($rel_string)?>></div>	
							
				<?php if($render_sections["showeoi"]) { ?>
				<div class="alert alert-info section-head" data-section='profileEoi'><img alt="" src="components/com_clubreg/assets/images/groups.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_EOI'); ?></strong></div>
				<div class="loading1" id="profileEoi" rel=<?php echo json_encode($rel_string)?>></div>				
				<?php } ?>
				<?php if($render_sections["breakdown"]) { ?>
				<div class="alert alert-info section-head" data-section='breakdownTab'><img alt="" src="components/com_clubreg/assets/images/stats.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_BREAKDOWN'); ?></strong> </div>				
					<div class="dashboard-div loading1" id="breakdownTab">				
						<div id="chart_div"></div>				
						<div id="chart_div_sub"></div>	
						<div id="chart_div_player"></div>	

						<div id="chart_div1"></div>
					</div>		
				<?php } 									
				if($render_sections["showbday"]){ ?>
				<div class="alert alert-info section-head" data-section='profileAlerts'><img alt="" src="components/com_clubreg/assets/images/groups.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_BDAY'); ?></strong> / <strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_ALERTS'); ?></strong>  </div>
				
				<div class="loading1" id="profileAlerts" rel=<?php echo json_encode($rel_string)?>></div>			
				<?php } ?>
				
				<div class="alert alert-info section-head" data-section='profileActivity'><img alt="" src="components/com_clubreg/assets/images/groups.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_ACTIVITY'); ?></strong></div>
				<div class="loading1" id="profileActivity" rel=<?php echo json_encode($rel_string)?>></div>
				
			</div>
		<?php }  ?>
	</div>
</div>
</fieldset>
</div>
<form action="<?php echo JRoute::_($this->formaction_edit); ?>" method="post" name="adminForm" id="adminForm" target='_blank'>

	<input type="<?php echo $in_type;  ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
	<input type="<?php echo $in_type;  ?>" name="option" value="com_clubreg" />
	
	<input type="<?php echo $in_type;  ?>" name="layout" value="viewonly" />	
	<input type="<?php echo $in_type;  ?>" name="pk" value="" />	
		<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php 
$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "common",array("css"));
ClubregHelper::writeTabAssets($document, "clubreg",array("js"));
ClubregHelper::writeTabAssets($document, "official");
ClubregHelper::write_footer(); 
//$document->addScript('https://www.google.com/jsapi');
$document->addScript('https://www.gstatic.com/charts/loader.js');

?>