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
	$listOrder	= $this->escape($this->state->get('list.ordering'));
	$listDirn	= $this->escape($this->state->get('list.direction'));
	$archived   = $this->state->get('filter.published') == 2 ? true : false;
	$trashed    = $this->state->get('filter.published') == -2 ? true : false;
	
	$user       = JFactory::getUser();
	
	
		
	$rows = $this->items;
	$k = 0; $n=count($rows); 

		if($n > 0  && is_array($rows)){
			
			$canEdit    = $user->authorise('core.edit','com_clubreg');
			
			$canCheckin = true;
			for ($i=0; $i < $n; $i++) {
				$row = $rows[$i];	
							
				$canChange = true;			
				$link 		= JRoute::_('index.php?option=com_clubreg&task=clubgroup.edit&group_id='.$row->group_id );				
				?>
				<tr class="row<?php echo $i % 2; ?>" >
					
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $row->group_id); ?>
					</td>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $row->published, $i, 'clubgroups.', $canChange);?>
					</td>				
					
					<td class="nowrap has-context">						
						<?php if($canEdit) {?>
						<a href="<?php echo $link; ?>">
							<?php echo $row->group_name;?>
						</a>
						<?php }else{ ?>
								<?php echo $row->group_name;?>
						<?php } ?>
					</td>
					<td>
						<?php echo ucwords($row->group_type); ?>
					</td>
					
					<td>
						<?php echo $row->group_leadername; ?>
					</td>
					<td>
						<?php echo $row->group_members; ?>
					</td>	
					<td>
						<?php echo $row->sub_groups; ?>
					</td>					
					<td>
						<?php echo $row->group_id; ?>
					</td>					
				</tr>				
				<?php 				
			}			
		}