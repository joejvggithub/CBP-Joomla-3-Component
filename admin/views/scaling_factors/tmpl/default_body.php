<?php
/*----------------------------------------------------------------------------------|  www.giz.de  |----/
	Deutsche Gesellschaft für International Zusammenarbeit (GIZ) Gmb 
/-------------------------------------------------------------------------------------------------------/

	@version		@update number 21 of this MVC
	@build			16th August, 2016
	@created		8th July, 2015
	@package		Cost Benefit Projection
	@subpackage		default_body.php
	@author			Llewellyn van der Merwe <http://www.vdm.io>	
	@owner			Deutsche Gesellschaft für International Zusammenarbeit (GIZ) Gmb
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
/-------------------------------------------------------------------------------------------------------/
	Cost Benefit Projection Tool.
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access'); 

$edit = "index.php?option=com_costbenefitprojection&view=scaling_factors&task=scaling_factor.edit";

?>
<?php foreach ($this->items as $i => $item): ?>
	<?php
		$canCheckin = $this->user->authorise('core.manage', 'com_checkin') || $item->checked_out == $this->user->id || $item->checked_out == 0;
		$userChkOut = JFactory::getUser($item->checked_out);
		$canDo = CostbenefitprojectionHelper::getActions('scaling_factor',$item,'scaling_factors');
	?>
	<tr class="row<?php echo $i % 2; ?>">
		<td class="order nowrap center hidden-phone">
		<?php if ($canDo->get('scaling_factor.edit.state')): ?>
			<?php
				if ($this->saveOrder)
				{
					$iconClass = ' inactive';
				}
				else
				{
					$iconClass = ' inactive tip-top" hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
				}
			?>
			<span class="sortable-handler<?php echo $iconClass; ?>">
				<i class="icon-menu"></i>
			</span>
			<?php if ($this->saveOrder) : ?>
				<input type="text" style="display:none" name="order[]" size="5"
				value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
			<?php endif; ?>
		<?php else: ?>
			&#8942;
		<?php endif; ?>
		</td>
		<td class="nowrap center">
		<?php if ($canDo->get('scaling_factor.edit')): ?>
				<?php if ($item->checked_out) : ?>
					<?php if ($canCheckin) : ?>
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					<?php else: ?>
						&#9633;
					<?php endif; ?>
				<?php else: ?>
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				<?php endif; ?>
		<?php else: ?>
			&#9633;
		<?php endif; ?>
		</td>
		<td class="nowrap">
			<?php if ($canDo->get('scaling_factor.edit')): ?>
				<div class="name">
					<a href="<?php echo $edit; ?>&id=<?php echo $item->id; ?>"><?php echo $this->escape($item->causerisk_name); ?></a>
					<?php if ($item->checked_out): ?>
						<?php echo JHtml::_('jgrid.checkedout', $i, $userChkOut->name, $item->checked_out_time, 'scaling_factors.', $canCheckin); ?>
					<?php endif; ?>
				</div>
			<?php else: ?>
				<div class="name"><?php echo $this->escape($item->causerisk_name); ?></div>
			<?php endif; ?>
		</td>
		<td class="nowrap">
			<?php if ($this->user->authorise('company.edit', 'com_costbenefitprojection.company.' . (int)$item->company)): ?>
				<div class="name">
					<a href="index.php?option=com_costbenefitprojection&view=companies&task=company.edit&id=<?php echo $item->company; ?>&ref=scaling_factors"><?php echo $this->escape($item->company_name); ?></a>
				</div>
			<?php else: ?>
				<div class="name"><?php echo $this->escape($item->company_name); ?></div>
			<?php endif; ?>
		</td>
		<td class="hidden-phone">
			<?php echo $this->escape($item->yld_scaling_factor_males); ?>
		</td>
		<td class="hidden-phone">
			<?php echo $this->escape($item->yld_scaling_factor_females); ?>
		</td>
		<td class="hidden-phone">
			<?php echo $this->escape($item->mortality_scaling_factor_males); ?>
		</td>
		<td class="hidden-phone">
			<?php echo $this->escape($item->mortality_scaling_factor_females); ?>
		</td>
		<td class="hidden-phone">
			<?php echo $this->escape($item->presenteeism_scaling_factor_males); ?>
		</td>
		<td class="hidden-phone">
			<?php echo $this->escape($item->presenteeism_scaling_factor_females); ?>
		</td>
		<td class="center">
		<?php if ($canDo->get('scaling_factor.edit.state')) : ?>
				<?php if ($item->checked_out) : ?>
					<?php if ($canCheckin) : ?>
						<?php echo JHtml::_('jgrid.published', $item->published, $i, 'scaling_factors.', true, 'cb'); ?>
					<?php else: ?>
						<?php echo JHtml::_('jgrid.published', $item->published, $i, 'scaling_factors.', false, 'cb'); ?>
					<?php endif; ?>
				<?php else: ?>
					<?php echo JHtml::_('jgrid.published', $item->published, $i, 'scaling_factors.', true, 'cb'); ?>
				<?php endif; ?>
		<?php else: ?>
			<?php echo JHtml::_('jgrid.published', $item->published, $i, 'scaling_factors.', false, 'cb'); ?>
		<?php endif; ?>
		</td>
		<td class="nowrap center hidden-phone">
			<?php echo $item->id; ?>
		</td>
	</tr>
<?php endforeach; ?>