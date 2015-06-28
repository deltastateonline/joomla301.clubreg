<?php echo JHtml::_('bootstrap.addSlide', 'slide-updates', JText::_('This Update. 3.0.17 - Upload CSV'), 'version-3017'); ?>
This feature allows the site administrator to upload a csv file containing player details. These details are imported and used to create new players. 
<h4>You can upload a csv with the following headings.</h4>
	<ol>
		<li><strong>Surname <span class="text-error">(Required)</span></strong></li>
		<li><strong>Givenname <span class="text-error">(Required)</span></strong></li>
		<li><strong>Playertype <span class="text-error">(Required)</span></strong><br /><span class="small text-info">(Possible values are [junior|senior]. Any thing else will be ignored.)</span></li>
		<li>Mobile</li>
		<li>Address</li>
		<li>Suburb</li>
		<li>Postcode</li>
		<li>Phoneno</li>
		<li>Emailaddress</li>
		<li>Memberid</li>		
		<li>Gender <br /><span class="small text-info">(Possible values [male|female]. Any thing else will be ignored.)</span></li>
		<li>Year_registered</li>				
	</ol>

<?php echo JHtml::_('bootstrap.endSlide'); ?>