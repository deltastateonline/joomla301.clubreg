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
jimport('joomla.html.html.bootstrap');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
JHtml::_('formbehavior.chosen', 'select');

$uri = JURI::getInstance();
$Itemid = $uri->getVar('Itemid');


?>
<form action="<?php echo JRoute::_('index.php')?> " method="post" name="adminForm" id="eoi-form" class="form-validate form-horizontal">
<?php 
if($this->eoi_usetable){
	?>
	<div class="eoi-heading" style="font-size:1.5em;"><?php echo JText::_('COM_CLUBREG_EOIFORM_LABEL'); ?></div>
	<table width="90%" class="eoi-table eoi-guardian">		
		<?php foreach($this->form->getFieldset('senior') as $field): ?>
			<?php if (!$field->hidden){ ?>
			<tr>
				<td class='label-g'><?php echo $field->label; ?></td>
				<td><?php echo $field->input; ?></td>
			</tr>
			<?php }else{  ?>
					<?php echo $field->input; ?>
			<?php } ?>
		<?php endforeach; ?>
	</table>
	
	<?php 
}
else{ ?>
<fieldset class="well">
<legend><?php echo JText::_('COM_CLUBREG_EOIFORM_LABEL'); ?></legend>
<div class="row-fluid">
		<?php foreach($this->form->getFieldset('senior') as $field): ?>
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
</div>
</fieldset>
<?php } ?>
		<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />	
		<input type="hidden" name="jform[playertype]" id="jform_playertype" value="senior" />
		<input type="hidden" name="option" value="com_clubreg" />
		<input type="hidden" name="task" value="eoi.sendrequest" />
		<?php echo JHtml::_('form.token'); ?>		
	<div class="form-actions">		
		<button class="btn btn-primary" type="submit">
			<?php echo JText::_('COM_CLUBREG_SENDREQUEST'); ?>
		</button>
		<button class="btn" type="reset"  >
			<?php echo JText::_('JCANCEL'); ?>
		</button>
	</div>
</form>
<?php 
$document = JFactory::getDocument();
$document->addScript('components/com_clubreg/assets/js/eoi.js?'.time());
$document->addStyleSheet('components/com_clubreg/assets/css/eoi.css?'.time());
ClubregHelper::write_footer(); ?>