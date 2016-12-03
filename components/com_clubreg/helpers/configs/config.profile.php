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
class ClubRegProfileConfig extends JObject
{
	/**
	 * @desc
	 * 		array index for the headings array
	 * 				label     => Label to render
	 * 				csvonly	  => Render this label in csv file only
	 * 				transform => apply a simple string function to the values
	 * 				cols 	  =>
	 * @param string $playerType
	 */
	public function getConfig($playerType){
		
		$method = 'get'.ucwords($playerType);
		$filterConfig = array();		
		if(method_exists($this, $method)){			
			$headings = array(); // will have to use some form of ordering
			$headings["idx"] = array("label"=>JText::_('#'),'csvonly'=>TRUE);
			$headings["surname"] = array("label"=>JText::_('COM_CLUBREG_PLAYERNAME_LABEL'),'csvonly'=>TRUE); // set default values			
			
			$filterConfig =  $this->$method($headings);					
			
			$headings["reg_details"]["reg_created_date"] = array("label"=>JText::_('COM_CLUBREG_REGISTERED_LABEL'),'csvonly'=>TRUE);	
			$headings["reg_details"]["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
			$filterConfig["headings"] = $headings;			
		}		
		return $filterConfig;
		
	}
					 
	private function getGuardian(&$headings = array()){		
			
		$headings["bio"]["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'));
		$headings["bio"]["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>"/", "clearfix"=>true);
		$headings["bio"]["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);
		$headings["bio"]["postal_address"] = array("label"=>JText::_('COM_CLUBREG_POSTAL_ADDRESS'), "clearfix"=>true,'transform'=>"nl2br");
		$headings["bio"]["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "clearfix"=>true, 'transform'=>"sendnews"); // use array
		
		$headings["children"] = array("label"=>JText::_('COM_CLUBREG_JUNIOR_LABEL'));	
		
		$headings["other"]["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
		$headings["other"]["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "clearfix"=>true, 'transform'=>"sendnews"); // use array
		
		
		$headings["children_p"]["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst");
		$headings["children_p"]["dob"] = array("label"=>JText::_('COM_CLUBREG_DOB_LABEL'),'label_class'=>'reg-label1'); // two per line				
		$headings["children_p"]["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
		$headings["children_p"]["member_level"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_MEMBERLEVEL'),'label_class'=>'reg-label1');
		$headings["children_p"]["reg_group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'));
		$headings["children_p"]["reg_subgroup"] = array("label"=>JText::_('COM_CLUBREG_SUBGROUPN_LABEL'),'label_class'=>'reg-label1'); // two per line
		
		$headings["children_p"]["groupleader"] = array("label"=>JText::_('CLUBREG_OFFICIALS_PROFILE_LEADER'));		
		$headings["children_p"]["year_registered"] = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL'), "clearfix"=>true,'label_class'=>'reg-label1'); // one per line
		
		$all_tabs = $this->all_tabs();
		$headings["tab"] = $this->configuredTabs("guardian",$all_tabs);
		
		$headings["javascript"] = array("clubreggroups"=>array("js"));
		return ;
	}
	
	private function getSenior(&$headings = array()){	
		
		$headings["bio"]["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'));
		$headings["bio"]["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>" / ", "clearfix"=>true);		
		$headings["bio"]["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst", "clearfix"=>true);	
		$headings["bio"]["dob"] = array("label"=>JText::_('COM_CLUBREG_DOB_LABEL')); // two per line
		$headings["bio"]["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);
		$headings["bio"]["postal_address"] = array("label"=>JText::_('COM_CLUBREG_POSTAL_ADDRESS'), "clearfix"=>true,'transform'=>"nl2br");
		$headings["bio"]["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "clearfix"=>true, 'transform'=>"sendnews"); // use array
		
		$headings["club"]["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
		$headings["club"]["joining_date"] = array("label"=>JText::_('COM_CLUBREG_JOINING_LABEL'),'transform'=>"clubregdate");
		$headings["club"]["memberid"] = array("label"=>JText::_('COM_CLUBREG_MEMBERNO'));
		$headings["club"]["member_level"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_MEMBERLEVEL'));
		$headings["club"]["reg_group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'));
		$headings["club"]["reg_subgroup"] = array("label"=>JText::_('COM_CLUBREG_SUBGROUPN_LABEL'), "clearfix"=>true);	
		
		$headings["club"]["groupleader"] = array("label"=>JText::_('CLUBREG_OFFICIALS_PROFILE_LEADER'), "clearfix"=>true);
		$headings["club"]["groupofficial"] = array("label"=>JText::_('CLUBREG_OFFICIALS_PROFILE_MEMBER'), "clearfix"=>true);
		
		$headings["club"]["year_registered"] = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL'));		
		
		$headings["other"]["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), 'transform'=>"sendnews"); // use array

		$attr = " width='16' hspace='1' border='0'";
		
		$all_tabs = $this->all_tabs();		
		$headings["tab"] = $this->configuredTabs("senior",$all_tabs);
		return ;
	}
	private function getJunior(&$headings = array()){		
		
		$headings["bio"]["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst");
		$headings["bio"]["dob"] = array("label"=>JText::_('COM_CLUBREG_DOB_LABEL')); // two per line
			
		$headings["club"]["memberid"] = array("label"=>JText::_('COM_CLUBREG_MEMBERNO'));
		$headings["club"]["joining_date"] = array("label"=>JText::_('COM_CLUBREG_JOINING_LABEL'),'transform'=>"clubregdate");
		$headings["club"]["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
		$headings["club"]["member_level"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_MEMBERLEVEL'));
		$headings["club"]["reg_group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'));
		$headings["club"]["reg_subgroup"] = array("label"=>JText::_('COM_CLUBREG_SUBGROUPN_LABEL')); // two per line

		$headings["club"]["groupleader"] = array("label"=>JText::_('CLUBREG_OFFICIALS_PROFILE_LEADER'));
		$headings["club"]["groupofficial"] = array("label"=>JText::_('CLUBREG_OFFICIALS_PROFILE_MEMBER'));
		
		$headings["club"]["year_registered"] = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL'), "clearfix"=>true); // one per line
					
		$headings["assets"] = array("guardian","notes","payments","other","attachments","property");
		$all_tabs = $this->all_tabs();
		$headings["tab"] = $this->configuredTabs("junior",$all_tabs);
			
		return ;
	}
	
	private function getChildguardian(&$headings = array()){	
		
		$headings["bio"]["gsurname"] = array("label"=>JText::_('COM_CLUBREG_GUARDIAN_LABEL'));
		$headings["bio"]["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'));
		$headings["bio"]["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>" / ", "clearfix"=>true);
		$headings["bio"]["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);
		$headings["bio"]["postal_address"] = array("label"=>JText::_('COM_CLUBREG_POSTAL_ADDRESS'), "clearfix"=>true);
		$headings["bio"]["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "clearfix"=>true, 'transform'=>"sendnews"); // use array
		
	}
	public function  all_tabs(){
		
		$attr = " width='16' hspace='1' border='0'";
		
		$tabs["children"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_CHILDREN'),"css"=>"class='active'",'default'=>TRUE,'img'=>array('fname'=>'groups.png','attr'=>$attr), 'applies'=>array("guardian"));			
		$tabs["guardian"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_GUARDIAN'),"css"=>"class='active'",'default'=>TRUE,'img'=>array('fname'=>'parentsicon.png','attr'=>$attr), 'applies'=>array("junior"));
		$tabs["emergency"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_EMERGENCY'),"css"=>"class='active'",'default'=>TRUE,'img'=>array('fname'=>'emergency.png','attr'=>$attr), 'applies'=>array("senior","junior"));
		$tabs["contactlist"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_CONTACTLIST'),"css"=>"class='active'",'default'=>TRUE,'img'=>array('fname'=>'contactlist.png','attr'=>$attr), 'applies'=>array("senior","junior"));
		
		$tabs["notes"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_NOTES'),'img'=>array('fname'=>'notes.png','attr'=>$attr), 'applies'=>array("senior","junior","guardian"));
	//	$tabs["stats"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_STATS'),'img'=>array('fname'=>'stats.png','attr'=>$attr), 'applies'=>array("senior","junior"));
		$tabs["payments"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_PAYMENTS'),'img'=>array('fname'=>'payment.png','attr'=>$attr), 'applies'=>array("senior","junior"));
		$tabs["other"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_OTHER'),'img'=>array('fname'=>'other.png','attr'=>$attr), 'applies'=>array("senior","junior"));
		$tabs["attachments"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_ATTACHMENTS'),'img'=>array('fname'=>'attachments.png','attr'=>$attr), 'applies'=>array("senior","junior"));
		$tabs["property"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_PROPERTYS'),'img'=>array('fname'=>'property.png','attr'=>$attr) , 'applies'=>array("senior","junior"));
			
		return $tabs;		
	}
	private function configuredTabs($player_type = NULL, $all_tabs){
		
		$return_data = array();
		
			if(isset($player_type)){
		
				$params = JComponentHelper::getParams('com_clubreg');
				$configureTabs = (array)$params->get("tab".$player_type);
				if(count($configureTabs) > 0){
					foreach($configureTabs as $config_key => $config_value){
						if(intval($config_value) == 1){
							$return_data[$config_key]  = $all_tabs[$config_key];
						}
					}
				}
			}
			
			return $return_data ;
		
	}
}