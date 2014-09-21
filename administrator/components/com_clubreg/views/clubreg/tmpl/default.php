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

?>
<style>
<!--
div.row-fluid{
line-height:24px;
}
-->
</style>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	
	<div id="j-main-container" class="span10">		
		<div class="well">
		<img src="<?php echo str_replace("administrator/", "", JURI::base()).CLUBREG_ASSETS; ?>/images/clublogo.png" width=256  class="pull-right"/>
		<h1>ClubReg Component for Joomla 3.0</h1>
		<h2>Thank you for choosing to install this component</h2>
		<div class="">
		# Author: Omokhoa Agbagbara<br />
		# Copyright: (C) 2013 applications.deltastateonline.com. All Rights Reserved.<br />
		# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL<br />
		# Website:- <a href="http://app.deltastateonline.com">http://app.deltastateonline.com</a><br />
		# Technical Support:  email - <a mailto="joomla@deltastateonline.com">joomla@deltastateonline.com</a><br />
		# Demo:  <a href="http://demo3.deltastateonline.com">http://demo3.deltastateonline.com</a><br />
		# Twitter: <a href="https://twitter.com/ejiroesiri">@ejiroesiri</a><br />
		
		</div>
		</div>
		<div class="row-fluid">
		<div class="span8 row-striped">		
			<div class="row-fluid">The Club Registration Component is an extension for Joomla 3.0. it can be used to manage almost any social/sporting club or group 
				which has team leaders(Coaches, Officials) , Team members (assistants) and club members (players, swimmers, driver, paying members etc).</div>
			<div class="row-fluid">The Team Leader and Team members are  made up of registered users of the joomla installation. These users have to be linked to this component for them to manage players within Clubreg</div>
			<div class="row-fluid">ClubReg uses a configurable list of form controls, to collect and render the details about <strong>Coaches , Assistants and Club Officials</strong>. These details can be updated by either the site administrator or the Club officials themselves</div>		
			<div class="row-fluid">ClubReg allows the club to take expression of interest from the public regarding joining the various groups or divisions within the club. These EOIs can then be converted into registered members or discarded.</div>
			<div class="row-fluid"><h3 class="alert alert-info">This Update. 3.0.12.</h3>
				<ol>
					<li>Add option to render eoi using tables as well as using bootstrap divs, because some joomla templates do not include bootstrap. This option can now be set on a per menu basis.</li>
				<ol>
			
			</div>
			<div class="row-fluid"><h3 class="alert alert-info">Key Features.</h3>
					<ul>
						<li>Accept Expression of interest for Junior or Senior Players</li>
						<li>Convert or Register EOIs to registered Players</li>
						<li><strong>Manage Registerd Players inlucding</strong>
						<ol>
							<li>Export a list of players</li>
							<li>Delete players</li>
							<li>Add New Players, Edit Player details</li>
							<li>Attach a guardian to a junior player</li>
							<li>Add notes to players, and mark these notes as private.</li>
							<li>Add Details about next of kin or emergency contacts</li>
							<li>Add extra configurable details</li>
							<li>Add simple payment details</li>
							<li>Add attachments to players and mark them as private.</li>
							<li>Add simple property details, to keep track of what items have been given to players</li>
						</ol>
						</li>
					</ul>			
			</div>
			<div class="row-fluid"><h3 class="alert alert-info">Getting Started.</h3>
					<ol>
						<li>Link System users to <?php echo JText::_('COM_CLUBREG3') ?> component.</li>
						<li>Grant Users permission to manage individual features.</li>
						<li>Add <?php echo JText::_('COM_CLUBREG_GROUPN_LABEL') ?> and <?php echo JText::_('COM_CLUBREG_SUBGROUPN_LABEL') ?> then  assign team members to groups</li>
						<li>Add <?php echo JText::_('COM_CLUBREG3') ?> menu option</li>
						<li>Customize your installation, using the Global Configuration menu.  Add or remove tabs, Change position of tab etc </li>
					
					</ol>
			</div>
		</div>
		</div>
</div>