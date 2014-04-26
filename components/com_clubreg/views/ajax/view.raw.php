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

jimport( 'joomla.application.component.view');

class ClubRegViewAjax extends JViewLegacy
{

	
	function display($tpl = null)
	{	
		
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$renderer =  $this->getLayout();
		$proceed = FALSE;
		
		if(method_exists($this, $renderer)){			
			$proceed =  $this->$renderer();			
		}	
		
		if($proceed){
			parent::display($tpl);
		}else{
			ClubRegUnAuthHelper::unAuthorised();
		}
	}
/**
 * 
 * @return boolean
 */
		
	private function anactivity(){
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
		
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		
			$proceed = TRUE;
			$key_data = new stdClass();
		
			$this->item_key = $key_data->full_key = $app->input->post->getString('item_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
		
			$this->which = $app->input->post->getString('which', null);
			
			
			switch($this->which){
				case "payments":
					$current_model = JModelLegacy::getInstance('payments', 'ClubregModel', array('ignore_request' => true));
					
					$current_model->setState('com_clubreg.payments.full_key',$key_data->full_key); // use the key in the model
					$current_model->setState('com_clubreg.payments.payment_key',$key_data->string_key); // use the key in the model
					$current_model->setState('com_clubreg.payments.payment_id',$key_data->pk_id); // use the key in the model
					
					$this->items = $current_model->getPayments($user->get('id'));					
					
					require_once CLUBREG_CONFIGS.'config.payments.php';
					require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.payments.php';
					
					$configObj = new ClubRegPaymentsConfig();
					$paymentsConfigs =  $configObj->getConfig("payments"); // return headings and filters					
					
					$tmp_filters["filter_heading"] = $paymentsConfigs["filters"];
					$tmp_filters["group_where"] = $paymentsConfigs["group_where"];
					$tmp_filters["headings"] = $paymentsConfigs["headings"];
					$tmp_filters["otherconfigs"] = $paymentsConfigs["otherconfigs"];
					$this->entity_filters = $tmp_filters;
					
					unset($configObj);
					unset($tmp_filters);
					
				break;
				
				case "notes":
					
					$current_model = JModelLegacy::getInstance('note', 'ClubregModel', array('ignore_request' => true));					
					$current_model->setState('com_clubreg.note.note_key',$key_data->full_key);
					$this->itemForm =  $current_model->getForm();
					
				break;
				case "files":					
					$app			= JFactory::getApplication();					
					$d_url = sprintf("index.php?option=com_clubreg&Itemid=%s&view=ajax&layout=viewattachment&tmpl=component&format=raw&attachment_key=%s",
						$clubreg_Itemid	,$key_data->full_key);					
					$app->redirect($d_url);						
					return ;
				break;
				case "assets":
					
					$current_model = JModelLegacy::getInstance('propertys', 'ClubregModel', array('ignore_request' => true));
						
					$current_model->setState('com_clubreg.propertys.full_key',$key_data->full_key); // use the key in the model
					$current_model->setState('com_clubreg.propertys.property_key',$key_data->string_key); // use the key in the model
					$current_model->setState('com_clubreg.propertys.property_id',$key_data->pk_id); // use the key in the model
						
					$this->items = $current_model->getPropertys($user->get('id'));
					
					require_once CLUBREG_CONFIGS.'config.propertys.php';
					require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.propertys.php';
						
					$configObj = new ClubRegPropertysConfig();
					$propertysConfigs =  $configObj->getConfig("propertys"); // return headings and filters
						
					$tmp_filters["filter_heading"] = $propertysConfigs["filters"];
					$tmp_filters["group_where"] = $propertysConfigs["group_where"];
					$tmp_filters["headings"] = $propertysConfigs["headings"];
					$tmp_filters["otherconfigs"] = $propertysConfigs["otherconfigs"];
					$this->entity_filters = $tmp_filters;
						
					unset($configObj);
					unset($tmp_filters);
						
					
				break;
				
			}
		
		
			$proceed = TRUE;
		}
		
		return $proceed;
		
	}
	private function bday(){
		
		$proceed = FALSE;
		
		$user		= JFactory::getUser();	
		
		if($user->get('id') > 0){
			
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
				
			if($current_model->getPermissions('showbday') ){
				unset($current_model);
			
				require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
				$this->uKeyObject = new ClubRegUniqueKeysHelper();
				$current_model = JModelLegacy::getInstance('activity', 'ClubregModel', array('ignore_request' => true));
				$this->birthdays = $current_model->getBirthdays();
				$proceed = TRUE;
				
				unset($current_model);
			}
		}
		
		return $proceed;
	}
	
	
}