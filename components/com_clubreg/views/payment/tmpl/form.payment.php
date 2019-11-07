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
        inputField: 'jform_payment_date_<?php echo $this->member_key; ?>',
        // Format of the input field
        ifFormat: '%Y-%m-%d',
        // Trigger for the calendar (button ID)
        button: 'jform_payment_date_btn_<?php echo $this->member_key; ?>',
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
				<?php if(strpos($field->id, "clubregPlaceholder")){	
					ob_start() ; ?>
					<div class="control-label"><?php echo $field->label; ?></div>		
					<div class="controls"><?php echo $field->input; ?></div>				
				<?php 	$dInput  = ob_get_contents(); 
						ob_end_clean();
						echo str_replace("clubregPlaceholder", $this->member_key, $dInput);						
					 }else{?>
				<div class="control-label"><?php echo $field->label; ?></div>
				<div class="controls"><?php echo $field->input; ?></div>	
				<?php } ?>					
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

<?php if(!empty($this->source) && count($this->payments)> 0){ $headings = $this->entity_filters["headings"]; ?>
	<div class="frame-div" style="padding-bottom:10px;">
		<div class="h21"><?php echo JText::_('COM_CLUBREG_PROFILE_PAYMENTS'); ?> : </div>
		<table class="table table-bordered table-condensed table-striped" style="font-size:xx-small;">		
			<thead>
				<tr>
					
					<th><?php echo JText::_('COM_CLUBREG_PAYMENT_DESCRIPTION'); ?></th>
					<th><?php echo $headings["payment_transact_no"]["label"]; ?></th>
					<th><?php echo $headings["payment_date"]["label"]; ?></th>
					<th><?php echo $headings["payment_season"]["label"]; ?></th>
					<th><?php echo $headings["payment_method"]["label"]; ?></th>
					<th><?php echo $headings["payment_amount"]["label"]; ?></th>
					<th><?php echo $headings["payment_status"]["label"]; ?></th>
				</tr>
			</thead>
				<?php 					
					foreach($this->payments as $adata){	
						$fkey = $this->uKeyObject->constructKey($adata->payment_id,$adata->payment_key);
						$rel_string = json_encode(array("Itemid"=>$this->Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1,'payment_key'=>$fkey,'action'=>'update'));
									?>
					<tr title="<?php echo "Created On : ",$adata->created;?>">
						<td><a  href="javascript:void(0);" rel="payment" class="profile-payment-button" data-paymentdata=<?php echo $rel_string; ?> data-memberid=<?php echo $this->member_id?>></i>
						<?php echo $adata->payment_desc?></a></td>
						<td ><?php echo $adata->payment_transact_no?></td>
						<td ><?php echo $adata->payment_date?></td>
						<td ><?php echo $adata->payment_season?></td>
						<td ><?php echo $adata->payment_method?></td>
						<td ><?php echo applyFactor($adata->payment_amount);?></td>
						<td ><?php echo $adata->payment_status?></td>
						
			
					</tr>
				<?php }?>
				
		</table>		
						
	</div>
<?php } ?>