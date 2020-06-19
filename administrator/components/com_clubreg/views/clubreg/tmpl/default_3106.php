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

echo JHtml::_('bootstrap.addSlide', 'slide-updates', JText::_('This Update. 3.1.6 - Commercial Release'), 'version-3106'); ?>
This is an update of the commercial version of clubreg 3. This release doesn't contain any google ads. This Update Includes
<ul>
	<li><a href="http://app.deltastateonline.com/index.php/featured-articles" target="_blank">Zapier Integration.</a> 
		<br />Zapier allows different applications to integrate and interact with each other. for example, you can send customized emails to each member, 
		<br>The data from the clubreg can be exported and used to populate an google spread sheet. The integration possibilites are numerous. 
		<br/>Set up the zapier integration by following these steps.
		<ol>
			<li>Sign up for Zapier</li>
			<li>Create Zap with webhooks</li>
			<li>Copy Webhook url</li>
			<li>Navigate to Clubreg in the administrator panel.</li>
			<li>Click on Config Setting menu option</li>
			<li>On the menu / toolbar click on the options button</li>
			<li>Scroll down to the bottom of the general configuration panel and past the zapier webhook url.</li>
			<li>The send to zapier button should now appear on the member profile.</li>		
		</ol>
		<br /><span style="font-weight: bold; font-size:1.2em">For help setting up your zaps contact us <a mailto="joomla@deltastateonline.com">joomla@deltastateonline.com</a></span>
	</li>
	
</ul>
<?php echo JHtml::_('bootstrap.endSlide'); ?>