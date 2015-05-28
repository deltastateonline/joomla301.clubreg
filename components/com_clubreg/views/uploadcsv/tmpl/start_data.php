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
if(!empty($return_data)){
?>
<div class="alert <?php echo ($return_data["proceed"])?"alert-success":"alert-danger"?>">
<?php 
	foreach($return_data["msg"] as $aMsg){
		echo $aMsg, "<br />";
	}
?></div>
<?php 	

	if($return_data["proceed"]){
		?><div><button class="btn btn-medium btn-primary pull-right">Import Records</button></div>
			<table class="table table-bordered table-striped csv-table">
				<thead>
				  <tr>
				  		<th>#</th>
				  	<?php foreach($return_data["data"]["heading"] as $aHeading){?>
				    	<th><?php echo $aHeading ;?></th>
				    <?php } ?>			   
				  </tr>
			  </thead>
			  <?php $i=1;
			  foreach($return_data["data"]["data"] as $aData){?>			  
				  <tr>
				    <td><?php echo $i++; ?></td>
				     <?php foreach($return_data["data"]["heading"] as $aHeading){?>	
				    	<td><?php echo $aData[$aHeading]; ?></td>
				    <?php } ?>
				  </tr>
			  <?php } ?>
			</table>					
			<?php 
		}
	}

?>