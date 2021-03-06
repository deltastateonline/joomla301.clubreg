<style>
<!--
.csv-table  td, th{
	font-size:0.8em;
	padding:1px;
}
-->
</style>

<?php 
$return_data = $this->get('return_array');
if(!empty($return_data)){?>

	<div class="alert <?php echo ($return_data["proceed"])?"alert-success":"alert-danger"?>">
	<?php 
		foreach($return_data["msg"] as $aMsg){
			echo $aMsg, "<br />";
		}
	?></div>
<?php if($return_data["proceed"] && $return_data["show_importform"] ){ ?>

<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="uploadcsvFForm" id="uploadcsvf-form" class="form-horizontal form-clubreg form-validate" enctype='multipart/form-data' >
<?php
$uri = JURI::getInstance();
$Itemid = $uri->getVar('Itemid');
$in_type = "hidden";
?>
	<div><button type="submit" class="btn btn-primary pull-right" id="btImportCsv" <?php echo ($return_data['hasDuplicates'])?"disabled":""?>><span><?php echo JText::_('Import Records'); ?></span></button></div>
			<table class="table table-bordered table-striped csv-table">
				<thead>
				  <tr>
				  		<th>#</th>
				  	<?php foreach($return_data["data"]["heading"] as $aHeading){?>
				    	<th><?php echo ucwords($aHeading) ;?></th>
				    <?php } ?>			   
				  </tr>
			  </thead>
			  <?php $i=1;
			  foreach($return_data["data"]["data"] as $aData){ $duplicate_style = ($aData['duplicates'])?"class='alert alert-danger' style='font-size:1.2em;font-weight:bold'":"";?>			  
				  <tr <?php echo $duplicate_style; ?>>
				    <td style="font-weight:bold"><?php echo $i++; ?></td>
				     <?php foreach($return_data["data"]["heading"] as $aHeading){?>	
				    	<td><?php echo $aData[$aHeading]; ?></td>
				    <?php } ?>
				  </tr>
			  <?php } ?>
			</table>			
		<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $Itemid; ?>" />		
		<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
		<input type="<?php echo $in_type;?>" name="view" value="uploadcsv" />
		<input type="<?php echo $in_type;?>" name="task" value="uploadcsv.finishcsv" />
		<input type="<?php echo $in_type;?>" name="layout" value="start" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
<?php 
}
} ?>