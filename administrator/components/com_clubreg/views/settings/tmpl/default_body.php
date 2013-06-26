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
	if ($saveOrder && !$this->state->has_children)
	{
		$saveOrderingUrl = 'index.php?option=com_clubreg&task=settings.saveOrderAjax&tmpl=component';
		JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
	}	
		
	$rows = $this->items;
	$k = 0; $n=count($rows); 

		if($n > 0 ){
			
			$canEdit    = $user->authorise('core.edit','com_clubreg');
			$ordering	= ($listOrder == 'a.ordering');
			$canCheckin = true;
			for ($i=0; $i < $n; $i++) {
				$row = $rows[$i];	
				$ordering  = ($listOrder == 'a.ordering');					
				$canChange = true;			
				$link 		= JRoute::_('index.php?option=com_clubreg&task=setting.edit&config_id='.$row->config_id );				
				?>
				<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $row->which_config?>">
					<td class="order nowrap center hidden-phone">
						<?php if ($canChange) :
							$disableClassName = '';
							$disabledLabel	  = '';
							if (!$saveOrder) :
								$disabledLabel    = JText::_('JORDERINGDISABLED');
								$disableClassName = 'inactive tip-top';
							endif; ?>
							<span class="sortable-handler hasTooltip<?php echo $disableClassName?>" title="<?php echo $disabledLabel?>">
								<i class="icon-menu"></i>
							</span>
							<input type="text" style="display:none" name="order[]" size="5"
							value="<?php echo isset($row->ordering)?$row->ordering:"";?>" class="width-20 text-area-order " />
						<?php else : ?>
							<span class="sortable-handler inactive" >
								<i class="icon-menu"></i>
							</span>
						<?php endif; ?>
					</td>
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $row->config_id); ?>
					</td>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $row->published, $i, 'settings.', $canChange);?>
					</td>				
					
					<td class="nowrap has-context">
						<?php if (isset($row->checked_out) && $row->checked_out) : ?>
							<?php echo JHtml::_('jgrid.checkedout', $i, "Somebody", $row->checked_out_time, 'settings.', $canCheckin); ?>
						<?php endif; ?>
						<?php if($canEdit) {?>
						<a href="<?php echo $link; ?>">
							<?php echo $row->config_name;?>
						</a>
						<?php }else{ ?>
								<?php echo $row->config_name;?>
						<?php } ?>
					</td>
					<td>
						<?php echo $row->config_short; ?>
					</td>					
					
					<?php if($this->state->has_children){ ?>
					<td>
						<?php echo $row->children; ?>
					</td>
					<?php } ?>
					<td nowrap>					
						<?php ClubRegHelper::renderParams($row->params,"setting"); ?>
					</td>
					<td>
						<?php echo $row->name; ?>
					</td>					
					<td>
						<?php echo $row->created_on; ?>
					</td>
					<td>
						<?php echo $row->config_id; ?>
					</td>					
				</tr>				
				<?php 				
			}			
		}