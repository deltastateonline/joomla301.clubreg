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
JHtml::_('formbehavior.chosen', 'select');

$canDo	= ClubregHelper::getActions();
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'setting.cancel' || document.formvalidator.isValid(document.id('setting-form'))) {
			Joomla.submitform(task, document.getElementById('setting-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_clubreg&layout=edit&config_id='.(int) $this->item->config_id); ?>" method="post" name="adminForm" id="setting-form" class="form-validate form-horizontal">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#general" data-toggle="tab"><?php echo empty($this->item->config_id) ? JText::_('New Details') : JText::sprintf('Edit Setting', $this->item->config_id);?></a></li>
	</ul>
	
	<div class="tab-content">
		<!-- Begin Tabs -->
		<div class="tab-pane active" id="general">
			<div class="row-fluid">
				<div class="span6">
				
					<?php foreach($this->form->getFieldset('details') as $field): ?>
					<div class="control-group"> 
						<?php if (!$field->hidden): ?>
							<div class="control-label">
								<?php echo $field->label; ?>
							</div>
						<?php endif; if($field->type == "whichcontrol"){ $this->params_which_config =  $field->value; } ?>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>				
				</div>
				
				<div class="span3 pull-right">	
<?php 	
		
		//$fieldsets = $this->form->getFieldsets("params"); 
		$parameter_settings = array("generic");
		$param_settings = NULL;
		
		if($this->params_which_config  == TOPMOST){
			$parameter_settings = array("configItems");
		}else{		
			if(isset($this->parent_data) && !is_null($this->parent_data)){			
				if(isset($this->parent_data->params) && isset($this->parent_data->params['config_type'])){
					$parameter_settings[] =  $this->parent_data->params['config_type'];				
				}
			}
			
		}
		
		if(isset($parameter_settings)){	?>												
			<fieldset class="form-vertical">
				<?php $parameter_settings[1] = "";
					foreach($parameter_settings as $param_settings){ 
						if(! (strlen($param_settings) > 0)){ continue;}
						foreach($this->form->getFieldset($param_settings) as $field){ ?>
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
				<?php }			
			}?>					
			</fieldset>	
			<?php } ?>
				</div>
			</div>
		</div> <!--  -->
	</div> <!-- Tab -->

</form>
