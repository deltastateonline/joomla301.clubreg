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
require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.php';
class ClubRegRenderTablesCSVHelper extends ClubRegRenderTablesHelper
{

	function __construct(){
		parent::__construct();
	}
	protected function renderHead($viewObject){
		
		$this->headings =  $viewObject->entity_filters["headings"];
		$csv = array();
		
		foreach($this->headings as $akey=>$aheading){
			$csv[] =   $aheading["label"];
		}
		echo "\"".implode("\",\"",$csv)."\"\n";
	}
	public function render($viewObject){		
		$i = 1;
		
		if(count($viewObject->items) > 0){
			
			$this->renderHead($viewObject);
			foreach($viewObject->items as $an_item){
				$an_item->t_address = "";$t_phone =  array();
				$an_item->idx = $i++;
				if($an_item->address){
					$an_item->t_address = ucwords($an_item->address)." ;";
				}
				if($an_item->suburb || $an_item->postcode){
					$an_item->t_address = $an_item->t_address.ucwords($an_item->suburb)." ";
				}
				if($an_item->postcode){
					$an_item->t_address = $an_item->t_address.$an_item->postcode;
				}
				if($an_item->phoneno){
					$t_phone[] = $an_item->phoneno;
				}
				if($an_item->mobile){
					$t_phone[] = $an_item->mobile;
				}
				$an_item->t_phone = $t_phone;
				
				$this->rendererItems($an_item);				
			}
		}
	}
	protected function rendererItems($an_item){
		$csv = array();
		foreach($this->headings as $akey=>$aheading){
			ob_start();	
			
			
			if( is_array($an_item->$akey)) { // phone numbers
				$aheading["sep"] = isset($aheading["sep"])?$aheading["sep"]:"<br />";
				echo implode($aheading["sep"],$an_item->$akey);
			}else{
				if($akey == "send_news"){
					echo isset($this->send_news[$an_item->send_news])?$this->send_news[$an_item->send_news]:"No";
				}else if($akey =="my_children"){
					$t_string = strip_tags($an_item->$akey,"<li>");
					echo str_replace(array("<li>","</li>"),array("",";"), $t_string);					
				} 
				else { if(isset($aheading["transform"])){ $an_item->$akey = call_user_func($aheading["transform"],$an_item->$akey); } echo $an_item->$akey; }
			} 
			$csv[] = ob_get_contents();
			ob_end_clean();
		} 
		
		echo "\"".implode("\",\"",$csv)."\"\n";
		
	}
	
}