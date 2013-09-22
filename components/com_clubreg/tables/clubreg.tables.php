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

class ClubregTableDefault extends JTable{
	
	protected  $_hex = array();	
	
	public function store($updateNulls = false){
		
		$db = JFactory::getDbo();		
		$pk = $this->_tbl_key;	
		
	// If a primary key exists update the object, otherwise insert it.
		if ($this->$pk){
			// Store the row
			parent::store($updateNulls);
		}
		else
		{		
			$this->$pk = NULL;
			// Iterate over the object variables to build the query fields and values.
			foreach (get_object_vars($this) as $k => $v){
					// Only process non-null scalars.
					if (is_array($v) or is_object($v) or $v === null){
						continue;
					}
		
					// Ignore any internal fields.
					if ($k[0] == '_'){
						continue;
					}
					
					if(in_array($k, $this->_hex)){
						// Prepare and sanitize the fields and values for the database query.
						$fields[] = $db->quoteName($k);
						$values[] = '0x'.$v;
						
					}else{		
						// Prepare and sanitize the fields and values for the database query.
						$fields[] = $db->quoteName($k);
						$values[] = $db->quote($v);
					}
				}
		
				// Create the base insert statement.
				$query = $db->getQuery(true)
					->insert($db->quoteName($this->_tbl))
					->columns($fields)
					->values(implode(',', $values));	

				$db->setQuery($query);

				if (!$db->execute())
				{					
					return false;
				}
				
				return true;
		}		
		
		
	}
}