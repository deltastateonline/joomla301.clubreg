<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2015 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;
jimport('joomla.html.html.bootstrap');
//JHtml::_('formbehavior.chosen', 'select');
JHTML::_('behavior.calendar');
JHtml::_('behavior.tooltip');

$uri = JURI::getInstance();
$Itemid = $uri->getVar('Itemid');
$in_type = "hidden";
ClubregHelper::writePageHeader($this->pageTitle);?>
<div id='loading-div'></div>
<?php echo $this->loadTemplate("data"); ?>
<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="uploadcsvForm" id="uploadcsv-form" class="form-horizontal form-clubreg form-validate" enctype='multipart/form-data' >
	<?php foreach($this->uploadForm->getFieldset('csvAttachment')  as $field){ ?>
			<div class="control-group">					
				<div class="control-label"><?php echo $field->label; ?></div>
				<div class="controls"><?php echo $field->input; ?></div>						
			</div>	
<?php  } foreach($this->uploadForm->getFieldset('hiddenControls') as $field){
				echo $field->input;
		}
?>
<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $Itemid; ?>" />
<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
<input type="<?php echo $in_type;?>" name="view" value="uploadcsv" />
<input type="<?php echo $in_type;?>" name="task" value="uploadcsv.startcsv" />
<input type="<?php echo $in_type;?>" name="layout" value="start" />
<?php echo JHtml::_('form.token'); ?>
<div class="form-actions">
<button type="submit" class="btn btn-primary"><span><?php echo JText::_('JATTACHMENT'); ?></span></button>
</div>
</form>
<div class="" id="attachmentFormDiv">
<div class="">
	<div class="alert alert-info"><h4>You can upload a csv with the following headings.</h4></div>
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
</div>
<br />
</div>
<?php 
$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "common",array("css"));
ClubregHelper::writeTabAssets($document, "uploadcsv",array("js"));
//ClubregHelper::writeTabAssets($document, "iFrameFormRequest",array("js"));
ClubregHelper::write_footer();