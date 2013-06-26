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
		if (task == 'payment.cancel' || document.formvalidator.isValid(document.id('payment-form'))) {
			Joomla.submitform(task, document.getElementById('payment-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_clubreg&layout=edit&product_id='.(int) $this->item->product_id); ?>" method="post" name="adminForm" id="payment-form" class="form-validate form-horizontal">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#general" data-toggle="tab"><?php echo empty($this->item->product_id) ? JText::_('New Details') : JText::sprintf('Edit Payment', $this->item->product_id);?></a></li>
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
						<?php endif;  ?>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>				
				</div>
				
				<div class="span3 pull-right">													
					<fieldset class="form-vertical">
						<?php foreach($this->form->getFieldset('configItems') as $field): ?>
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
				</div>
			</div>
		</div> <!--  -->
	</div> <!-- Tab -->

</form>
