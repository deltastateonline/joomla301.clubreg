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

define('CLUB_MEMBERS_TABLE','#__clubreg_teammembers'); // Club Officials who are linked
define('CLUB_GROUPS_TABLE','#__clubreg_groups'); // club groups.
define('CLUB_MEMBERSGROUPS_TABLE','#__clubreg_teammembers_groups'); // Club Officials grouping table
define('CLUB_MEMBERSDETAILS_TABLE','#__clubreg_teammembers_details'); // key value pair table for Club Officials
define('CLUB_TEMPLATE_TABLE','#__clubreg_templates');  // the template table
define('CLUB_ATTACHMENTS_TABLE','#__clubreg_attachments');  // the template table

define('CLUB_CONFIG_TABLE','#__clubreg_configs'); // configuration table

define('DESIGNED_BY','app.deltastateonline.com');
define('OUR_WEBSITE','app.deltastateonline.com');


define('CLUB_EOIMEMBERS_TABLE','#__clubreg_eoimembers'); // eoi members
define('CLUB_REGISTEREDMEMBERS_TABLE','#__clubreg_registeredmembers'); // registered members 

define('CLUB_AUDIT_TABLE','#__clubreg_details_audit'); // audit details  

define('CLUB_PAYMENTS_SETUP_TABLE','#__clubreg_payments_setup'); // payments setup details
define('CLUB_PAYMENTS_TABLE','#__clubreg_payments'); // payments details
define('CLUB_NOTES_TABLE','#__clubreg_notes'); // notes details

define('CLUB_SACCOUNTS_TABLE','#__clubreg_saccounts'); // accounts details
define('CLUB_SACCOUNTS_ITEMS_TABLE','#__clubreg_saccounts_items'); // account items details

define('CLUB_TAG_TABLE','#__clubreg_tags'); // tag table
define('CLUB_TAGPLAYER_TABLE','#__clubreg_tags_players'); // player tag link

define('CLUB_SAVEDCOMMS_TABLE','#__clubreg_saved_comms'); // communication table
define('CLUB_SAVEDCOMMS_GROUP_TABLE','#__clubreg_saved_comms_groups');
define('CLUB_CONTACT_TABLE','#__clubreg_contact_details'); // contact  table
define('CLUB_STATS_TABLE','#__clubreg_stats_details'); // Stats  table

define('CLUB_PROPERTY_TABLE','#__clubreg_property_sheet'); // Property sheet  table
define('CLUB_CONTACTLIST_TABLE','#__clubreg_contactlist'); // Contact List  table

define('CLUB_ALERTS_TABLE','#__clubreg_alerts'); // Alert List  table


define('GROUP','Division'); 
define('GROUPS','Divisions'); 

define('SUBGROUP','Sub-Division'); 
define('SUBGROUPS','Sub-Divisions'); 

define('SEASON','Season'); 
define('CURRENCY','$');
define('FACTOR',100);

define('TAGS','Keywords');
define('TAG','Keyword');

define('PLAYERS','Players');
define('PLAYER','Swimmers');

define('EMERGENCY','Emergency Contact');
define('GIVENNAME','Firstname');
define('NEXTOFKIN','Next of Kin');
define('STATS','Stats');
define('TOPMOST','TOPMOST');

/** 
 * 
 * config shorts
 */

define('CLUB_MEMBER_WHICH','club_official_details'); // the tag to extract config details
define('CLUB_PLAYER_LEVEL','club_player_level'); // the tag to extract config details
define('CLUB_GUARDIAN_WHICH','club_guardian_details');
define('CLUB_PLAYER_DETAILS','club_player_details');
define('CLUB_PLAYER_STATS','club_stats');
define('CLUB_GROUPTYPE','club_grouptype');
define('CLUB_DOCUMENTS_WHICH','club_documents');
define('CLUB_SCHOOLTERMS','school_term');

define('CLUB_JUNIORCOUNT',4);
define('COM_CLUBREG_DIVRIGHT',"700");
define('COM_CLUBREG_TABPOSITION',"left");

define('CLUBREG_ADMINPATH',JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_clubreg'.DIRECTORY_SEPARATOR);

define('CLUBREG_COMPONENTS','components/com_clubreg/');
define('CLUBREG_ASSETS',CLUBREG_COMPONENTS.'assets');
define('CLUBREG_CONFIGS',CLUBREG_COMPONENTS.'helpers'.DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR);

global $clubreg_params;
$clubreg_params["setting"]["control_width"]= array("label"=>"Inline Style");
$clubreg_params["setting"]["control_class"]= array("label"=>"CSS Style");
$clubreg_params["setting"]["default_value"]= array("label"=>"Default Value");
$clubreg_params["setting"]["control_type"]= array("label"=>"Input Type");
$clubreg_params["setting"]["sort_list_by"]= array("label"=>"Order List By");
$clubreg_params["setting"]["config_type"]= array("label"=>"Setting Type");
$clubreg_params["setting"]["is_email"]= array("label"=>"Email Validation");
$clubreg_params["setting"]["taxrate"]= array("label"=>"Tax Rate");
$clubreg_params["setting"]["assign_to"]= array("label"=>"Applies To");
$clubreg_params["payment"]["assign_to"]= array("label"=>"Applies To");

define('LIVE_SITE',TRUE);
define('ATTACHMENT_LIMIT',5);
define('CLUBREG_COMM_SENTSTATUS', 30);
define('CLUBREG_COMM_DELETESTATUS', 99);
define('COM_CLUBREG_COMMERCIAL',FALSE);

include_once("debugger.php");