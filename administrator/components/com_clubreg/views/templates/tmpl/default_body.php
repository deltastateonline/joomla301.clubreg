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
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

	$listOrder	= $this->escape($this->state->get('list.ordering'));
	$listDirn	= $this->escape($this->state->get('list.direction'));
	$archived   = $this->state->get('filter.published') == 2 ? true : false;
	$trashed    = $this->state->get('filter.published') == -2 ? true : false;
	
	$user       = JFactory::getUser();
		
	$rows = $this->items;
	$k = 0; $n=count($rows); 
	$lists['rt'] ="";
		if($n > 0 ){
			
			$canEdit    = $user->authorise('core.edit','com_clubreg');
			$ordering	= ($listOrder == 'a.ordering');
			$saveOrder = false; $canCheckin = true;
			for ($i=0; $i < $n; $i++) {
				$row = $rows[$i];			
					
				$canChange = true;			
				$link 		= JRoute::_('index.php?option=com_clubreg&task=template.edit&template_id='.$row->template_id );				
				?>
				<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $row->template_id?>">
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
						<?php echo JHtml::_('grid.id', $i, $row->template_id); ?>
					</td>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $row->published, $i, 'templates.', $canChange);?>
					</td>				
					
					<td class="nowrap has-context">
						<?php if ($row->checked_out) : ?>
							<?php echo JHtml::_('jgrid.checkedout', $i, "Somebody", $row->checked_out_time, 'templates.', $canCheckin); ?>
						<?php endif; ?>
						<?php if($canEdit) {?>
						<a href="<?php echo $link; ?>">
							<?php echo $row->template_name;?>
						</a>
						<?php }else{ ?>
								<?php echo $row->template_name;?>
						<?php } ?><br />
						<a href="index.php?option=com_clubreg&view=template&tmpl=component&layout=modal&template_id=<?php echo $row->template_id?>" class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 450}}"><span class="label label-info pull-right"><i class="icon-drawer-2"></i>Preview</span></a>							
					</td>					
					<td>
						<?php echo $row->name; ?>
					</td>
					<td>
						<?php echo $row->template_status; ?>
					</td>
					<td>
						<?php echo $row->template_access; ?>
					</td>
					<td>
						<?php echo $row->template_type; ?>
					</td>
					<td>
						<?php echo $row->created_on; ?>
					</td>
					<td>
						<?php echo $row->template_id; ?>
					</td>					
				</tr>				
				<?php 				
			}
			
		}