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
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.modal');
JHtml::_('formbehavior.chosen', 'select');

$canDo	= ClubregHelper::getActions();

$activeTab = $this->state->get('clubgroup.activeTab');
if(!isset($activeTab)){
	$activeTab = "general-details";
}
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'clubgroup.cancel' || document.formvalidator.isValid(document.id('clubgroup-form'))) {
			Joomla.submitform(task, document.getElementById('clubgroup-form'));
		}
	}

	window.addEvent('domready', function(){
		document.formvalidator.setHandler('select', function (value) { return (value != 0); }	);
	});	
</script>
<form action="<?php echo JRoute::_('index.php?option=com_clubreg&layout=edit&group_id='.(int) $this->item->group_id); ?>" method="post" name="adminForm" id="clubgroup-form" class="form-validate form-horizontal">
	<ul class="nav nav-tabs" id="clubgroupDetails">
	  <li <?php echo  ($activeTab == "general-details")?"class=\"active\"":""; ?>><a href="#general-details" data-toggle="tab" class="clubregTab"><?php echo empty($this->item->group_id) ? JText::_('New Details') : JText::sprintf('Edit '.JText::_('COM_CLUBREG_GROUPN_LABEL'), $this->item->group_id);?></a></li>
	</ul>
<?php 	echo JHtml::_('bootstrap.startPane', 'clubgroupDetails', array('active' => $activeTab));  
			echo JHtml::_('bootstrap.addPanel', 'clubgroupDetails', 'general-details');
?>		
			<div class="row-fluid">
				<div class="span5">				
					<?php foreach($this->form->getFieldset('details') as $field): ?>
					<div class="control-group"> 
						<?php if (!$field->hidden): ?>
							<div class="control-label">
								<?php echo $field->label; ?>
							</div>
						<?php endif;  ?>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>								
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>				
				</div>
				
				<div class="span4 pull-right">													
					<fieldset class="form-vertical">
						<?php foreach($this->form->getFieldset('extradetails') as $field): ?>
					<div class="control-group"> 
						<?php if (!$field->hidden): ?>
							<div class="control-label">
								<?php echo $field->label; ?>
							</div>
						<?php endif; ?>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
			<?php endforeach; ?>					
					</fieldset>	
					<?php if((int) $this->item->group_id > 0){ $i =1; 
						/* <span class="label label-info pull-left"><i class="icon-edit"></i>Add <?php echo JText::_('COM_CLUBREG_SUBGROUPN_LABEL');?></span>*/
						//$whatAfter = ", onClose: function() {window.location.reload()}";
						$whatAfter = ", onClose:function() { reloadSubgroup() } ";
					?>				
					
										<div></div>
					<div class="clearfix"></div>
					<div id="subDivisionDiv">
							<a href="index.php?option=com_clubreg&view=clubgroup&tmpl=component&task=clubgroup.subedit&group_parent=<?php echo (int) $this->item->group_id; ?>&group_id=0&layout=subedit" class="modal"  rel="{handler: 'iframe', size: {x: 600, y: 550} <?php echo $whatAfter;?>}">Add <?php echo JText::_('COM_CLUBREG_SUBGROUPN_LABEL');?></a>
						
					<table class="table table-striped ">
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo JText::_('COM_CLUBREG_SUBGROUPSN_LABEL') ?></th>
								<th><?php echo JText::_('COM_CLUBREG_GROUPTYPE_LABEL'); ?></th>
								<th>Status</th>					
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->item->group_children as $agroup){ 
								$link = sprintf("<a href='index.php?option=com_clubreg&view=clubgroup&tmpl=component&task=clubgroup.subedit&group_parent=%d&group_id=%d&layout=subedit' class=\"modal\"  rel=\"{handler: 'iframe', size: {x: 600, y: 550} %s}\">%s</a>",
										$agroup->group_parent,$agroup->group_id,$whatAfter,$agroup->group_name);
							?>
								<tr>
									<td><?php echo $i++; ?></td>
									<td><?php echo  $link ; ?></td>
									<td><?php echo $agroup->group_type ; ?></td>
									<td><?php echo JHtml::_('jgrid.published', $agroup->published, $i, 'clubgroups.', false);?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					</div>	
					<?php } ?>
				</div>
			</div>
		<?php 
			echo JHtml::_('bootstrap.endPanel');			
		echo JHtml::_('bootstrap.endPane');
?>
</form>
<?php 
$document = JFactory::getDocument();
$document->addScript('components/com_clubreg/assets/js/clubreg.js?'.time());
$document->addScript('components/com_clubreg/assets/js/clubgroup.js?'.time());
?>