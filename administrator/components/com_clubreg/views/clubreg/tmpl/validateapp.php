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
$i = 1;
?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>	
<div id="j-main-container" class="span10">	
	<table class="table table-stripped table-bordered">
		<thead>
			<tr>
				<th width="10" >#</th>
				<th>Table Name</th>
				<th width="10" >Table Status</th>
			</tr>
		</thead>
		<?php foreach($this->componentTables as $atable){?>
			<tr>
				<td><?php echo $i++ ;?></td>
				<td><?php echo $atable["comtable"] ;?></td>
				<td><?php echo !(empty($atable["tablestatus"]))?"<span class=\"icon-publish\"></span>":"<span class=\"icon-unpublish\" title='Table doesnt exist, check sql script'></span>";?></td>
			</tr>
		
		<?php } ?>
	</table>
</div>