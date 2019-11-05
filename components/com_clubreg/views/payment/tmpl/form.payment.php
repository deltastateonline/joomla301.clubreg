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
JHtml::_('behavior.formvalidation');
global $clubreg_Itemid;
$in_type = "hidden";?>
<style>
<!--
.form-horizontal .control-group {
    margin-bottom: 10px;
    padding-left:5px;   
}
-->
</style>
<script type="text/javascript">
<!--

    jQuery(document).ready(function($) {
        Calendar.setup({
        // Id of the input field
        inputField: 'jform_payment_date',
        // Format of the input field
        ifFormat: '%Y-%m-%d',
        // Trigger for the calendar (button ID)
        button: 'jform_payment_date_btn',
        // Alignment (defaults to "Bl")
        align: 'Tl',
        singleClick: true,
        firstDay: '0'
        });
    });
//-->
</script>
<form action="index.php" method="post" name="PaymentForm" id="payment-form" class="form-validate form-horizontal form-clubreg">	
		<div class="fieldSetDiv"><?php echo JText::_('COM_CLUBREG_PAYMENT_DETAILS');?></div>
		<?php foreach($this->paymentForm->getFieldset('paymentDetails') as $field){ ?>
			<div class="control-group">					
				<div class="control-label"><?php echo $field->label; ?></div>
				<div class="controls"><?php echo $field->input; ?></div>						
			</div>		
		<?php 		 				
		 }		
		 foreach($this->paymentForm->getFieldset('hiddenControls') as $field){ 	
					echo $field->input; 				
		 }		
		 ?>
	<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
	<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
	<input type="<?php echo $in_type;?>" name="task" value="ajax.savepayment" />
	<?php echo JHtml::_('form.token'); ?>		
	<div class="clearfix" ></div>	
		<div class="form-actions">			 
			<button type="submit" class="btn btn-primary validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>	
			<button type="button" class="btn" id="toggle-payments-div" data-memberid='<?php echo $this->member_id; ?>'><?php echo JText::_('JCANCEL'); ?></button>				
		</div>			
</form>

<?php if(!empty($this->source) && is_array($this->payments)){ ?>
	<div class="frame-div" style="padding-bottom:10px;">
		<div class="h21"><?php echo JText::_('COM_CLUBREG_PROFILE_PAYMENTS'); ?> : </div>
				<?php 
					foreach($this->payments as $adata){	
						$fkey = $this->uKeyObject->constructKey($adata->payment_id,$adata->payment_key);
						$rel_string = json_encode(array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1,'alert_key'=>$fkey,'action'=>'delete'));
									?>
					<div class="row-fluid" style="border-bottom:1px solid #EEEFEF" tooltip="tooltip" title="Description, transaction, date, season, amount, method, status">
						<div class="pull-left profile-label1"><?php echo $adata->payment_desc?></div>
						<div class="pull-left" style='padding:0px 5px;'>| </div>
						<div class="pull-left profile-value"> <?php echo $adata->payment_transact_no; ?> | <?php echo ucwords($adata->payment_date);?>|<?php echo $adata->payment_season ;?>|<?php echo applyFactor($adata->payment_amount) ?>| <?php echo $adata->payment_method ?></div>
						<div class="pull-right"><a class="btn btn-mini" data-alertinfo=<?php echo $rel_string; ?> ><i class="fa fa-edit"></i></a></div>
					</div>
				<?php }?>		
	</div>
<?php } ?>