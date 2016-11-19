<?php echo JHtml::_('bootstrap.addSlide', 'slide-updates', JText::_('This Update. 3.0.20 - Player Search'), 'version-3020'); ?>
This feature allows users of clubreg to search for players or members by player name, email address and phone numbers.
<h3>To make this feature available</h3>
	<ul>
		<li>Go to the Menus</li>
		<li>Select the menu group you want to add this option to.</li>
		<li>Select add new menu</li>
		<li>On the New Item page, click the "Select" Button.</li>
		<li>In the Modal, select "Club Registration Manager", then select "Find Player / Member" option</li>
		<li>Add the "Menu title", then update the "Access" to "registered"</li>
		<li>Save the details.</li>
	</ul>	
<div class="alert alert-success">You will need to make sure that the users have the "Manage Registered Users" permission for clubreg</div>
<?php echo JHtml::_('bootstrap.endSlide'); ?>