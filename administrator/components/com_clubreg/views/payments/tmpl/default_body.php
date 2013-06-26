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
	
	$saveOrder	= $listOrder == 'a.ordering'; // do not allow sorting of the parent
	if ($saveOrder)
	{
		$saveOrderingUrl = 'index.php?option=com_clubreg&task=payments.saveOrderAjax&tmpl=component';
		JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
	}	
		
	$rows = $this->items;
	$k = 0; $n=count($rows); 

		if($n > 0  && is_array($rows)){
			
			$canEdit    = $user->authorise('core.edit','com_clubreg');
			
			$canCheckin = true;
			for ($i=0; $i < $n; $i++) {
				$row = $rows[$i];	
							
				$canChange = true;			
				$link 		= JRoute::_('index.php?option=com_clubreg&task=payment.edit&product_id='.$row->product_id );				
				?>
				<tr class="row<?php echo $i % 2; ?>" >
					
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $row->product_id); ?>
					</td>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $row->published, $i, 'payments.', $canChange);?>
					</td>				
					
					<td class="nowrap has-context">
						<?php if (isset($row->checked_out) && $row->checked_out) : ?>
							<?php echo JHtml::_('jgrid.checkedout', $i, "Somebody", $row->checked_out_time, 'payments.', $canCheckin); ?>
						<?php endif; ?>
						<?php if($canEdit) {?>
						<a href="<?php echo $link; ?>">
							<?php echo $row->product_name;?>
						</a>
						<?php }else{ ?>
								<?php echo $row->product_name;?>
						<?php } ?>
					</td>
					<td>
						<?php echo $row->validfrom_str; ?><br />
						<?php echo $row->validto_str; ?>
					</td>					
					
		
					<td nowrap>					
						<?php ClubRegHelper::renderParams($row->params,"payment"); ?>
					</td>
					<td>
						<?php echo $row->name; ?>
					</td>					
					<td>
						<?php echo $row->created_on; ?>
					</td>
					<td>
						<?php echo $row->product_id; ?>
					</td>					
				</tr>				
				<?php 				
			}			
		}