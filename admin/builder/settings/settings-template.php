<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

$sppb_addons = SpAddonsConfig::$addons;

$addons_category = array();

$addons_category[] = JText::_('COM_SPPAGEBUILDER_GLOBAL_ALL');

foreach ($sppb_addons as $value) {

	if(!isset($value['category'])) {
		$value['category'] = 'General';
	}

	$addons_category[] 	= strtolower( $value['category'] );
}

$addons_category = array_unique($addons_category);

?>
<div class="hidden">
	<div class="column-settings">
		<?php
		foreach( $sp_builder_col_ops['attr'] as $name => $col_attr )
		{
			echo SpPgaeBuilder::getInputElements( $name, $col_attr );
		}
		?>
	</div>
</div>

<div class="hidden">
	<div class="row-settings">
		<?php
		foreach( $sp_builder_row_ops['attr'] as $name=>$row_attr )
		{
			echo SpPgaeBuilder::getInputElements( $name, $row_attr );
		}
		?>
	</div>
</div>

<!--generated column-->
<div class="hidden">
	<div class="col-sm">
		<div class="column column-empty"></div>
		<div class="col-settings">
			<a class="add-addon" href="javascript:void(0)"><i class="fa fa-plus-circle"></i> <?php echo JText::_('COM_SPPAGEBUILDER_ADDON'); ?></a>
			<a class="column-options" href="javascript:void(0)"><i class="fa fa-cog"></i> <?php echo JText::_('COM_SPPAGEBUILDER_OPTIONS'); ?></a>
		</div>
	</div>
</div>

<!-- Row Options Modal -->
<div class="sp-modal fade" id="modal-row" role="dialog" aria-labelledby="modal-row-label" aria-hidden="true">
	<div class="sp-modal-dialog">
		<div class="sp-modal-content">
			<div class="sp-modal-header">
				<button type="button" class="close" data-dismiss="spmodal" aria-hidden="true">&times;</button>
				<h3 class="sp-modal-title" id="modal-row-label"><?php echo JText::_('COM_SPPAGEBUILDER_ROW_OPTIONS'); ?></h3>
			</div>
			<div class="sp-modal-body">

			</div>
			<div class="sp-modal-footer clearfix">
				<a href="javascript:void(0)" class="sppb-btn sppb-btn-success pull-left" id="save-row" data-dismiss="spmodal"><?php echo JText::_('COM_SPPAGEBUILDER_APPLY'); ?></a>
				<button class="sppb-btn sppb-btn-danger pull-left" data-dismiss="spmodal" aria-hidden="true"><?php echo JText::_('COM_SPPAGEBUILDER_CANCEL'); ?></button>
			</div>
		</div>
	</div>
</div>

<!-- Column Options Modal -->
<div class="sp-modal fade" id="modal-column" role="dialog" aria-labelledby="modal-column-label" aria-hidden="true">
	<div class="sp-modal-dialog">
		<div class="sp-modal-content">
			<div class="sp-modal-header">
				<button type="button" class="close" data-dismiss="spmodal" aria-hidden="true">&times;</button>
				<h3 class="sp-modal-title" id="modal-column-label"><?php echo JText::_('COM_SPPAGEBUILDER_COLLUMN_OPTIONS'); ?></h3>
			</div>
			<div class="sp-modal-body">

			</div>
			<div class="sp-modal-footer clearfix">
				<a href="javascript:void(0)" class="sppb-btn sppb-btn-success pull-left" id="save-column" data-dismiss="spmodal"><?php echo JText::_('COM_SPPAGEBUILDER_APPLY'); ?></a>
				<button class="sppb-btn sppb-btn-danger pull-left" data-dismiss="spmodal" aria-hidden="true"><?php echo JText::_('COM_SPPAGEBUILDER_CANCEL'); ?></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="sp-modal fade" id="modal-addons" role="dialog" aria-labelledby="modal-addons-label" aria-hidden="true">
	<div class="sp-modal-dialog sp-modal-xlg">
		<div class="sp-modal-content">
			<div class="sp-modal-header">
				<button type="button" class="close" data-dismiss="spmodal" aria-hidden="true">&times;</button>
				<h3 class="sp-modal-title" id="modal-addons-label"><?php echo JText::_('COM_SPPAGEBUILDER_ADDONS'); ?></h3>
				<div class="addon-filter">
					<ul>
						<?php foreach ($addons_category as $key=>$addon_category) { ?>
							<li <?php echo ($key==0)?'class="active"':''; ?> data-category="<?php echo strtolower( $addon_category ); ?>"><a href='javascript:void(0)'><?php echo ucfirst($addon_category); ?></a></li>
						<?php } ?>
					</ul>
				</div>

				<input type="text" id="search-addon" placeholder="<?php echo JText::_('COM_SPPAGEBUILDER_SEARCH_ADDON'); ?>">

			</div>
			<div class="sp-modal-body">

			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="sp-modal fade" id="modal-addon" role="dialog" aria-labelledby="modal-addon-label" aria-hidden="true">
	<div class="sp-modal-dialog sp-modal-lg">
		<div class="sp-modal-content">
			<div class="sp-modal-header">
				<button type="button" class="close" data-dismiss="spmodal" aria-hidden="true">&times;</button>
				<h3 class="sp-modal-title" id="modal-addon-label"></h3>
			</div>
			<div class="sp-modal-body">

			</div>
			<div class="sp-modal-footer clearfix">
				<a href="javascript:void(0)" class="sppb-btn sppb-btn-success pull-left" id="save-change" data-dismiss="spmodal"><?php echo JText::_('COM_SPPAGEBUILDER_SAVE'); ?></a>
				<button class="sppb-btn sppb-btn-danger pull-left" data-dismiss="spmodal" aria-hidden="true"><?php echo JText::_('COM_SPPAGEBUILDER_CANCEL'); ?></button>
			</div>
		</div>
	</div>
</div>

<div class="pagebuilder-addons-wrapper">
	<ul class="pagebuilder-addons clearfix">

		<?php

		$output = '';

		$i = 0;

	 	// print_r($sp_builder_elements);

		foreach( $sppb_addons as $key => $addon )
		{
			if (isset($addon['title'])) {
				$title = $addon['title'];
			}else{
				$title = substr($addon['addon_name'],3);
			}

			if(!isset($addon['category'])) {
				$addon['category'] = 'General';
			}

			$admin_label = '';
			if ( isset($addon['attr']['admin_label']['std']) && $addon['attr']['admin_label']['std'] ) {
				$admin_label = $addon['attr']['admin_label']['std'];
			} else if( isset($addon['attr']['title']['std']) && $addon['attr']['title']['std'] ) {
				$admin_label = $addon['attr']['title']['std'];
			}

			$output .= '<li class="addon-cat-'.strtolower($addon['category']).'">';
			$output .= '<a id="addon_' . $key . '" data-tag="' . $key . '" class="addon-title" href="javascript:void(0)"><img class="image-left" src="' . $builder->getIcon(  str_replace('sp_', '', $key) ) . '" alt="' . $title . '" width="32" /> <span class="element-title">' . $title . '</span><span class="element-description">'.$addon['desc'].'</span></a>';
			$output .= '<div class="generated" data-addon="'.$addon['type'].'">';
			$output .= '<div class="generated-items">';
			$output .= '<div class="generated-item clearfix">';
			$output .= '<img class="item-image" src="' . $builder->getIcon(  str_replace('sp_', '', $key) ) . '" alt="' . $title . '" width="24" />';
			$output .= '<h3 data-name="'.substr($addon['addon_name'],3).'">' . $title . '</h3>';

			$output .= '<div class="action">';
			$output .= '<a class="addon-edit" href="javascript:void(0)"><i class="fa fa-pencil"></i></a>';
			$output .= '<a class="addon-duplicate" href="javascript:void(0)"><i class="fa fa-files-o"></i></a>';
			$output .= '<a class="remove-addon" href="javascript:void(0)"><i class="fa fa-times"></i></a>';
			$output .= '</div>';

			$output .= '<p class="addon-input-title">' . $admin_label . '</p>';

			$output .= '<div class="item-inner">';

			if( !empty($addon['attr']) )
			{

				foreach( $addon['attr'] as $name => $addon_attr )
				{

					if( $addon_attr['type'] == 'repeatable' )
					{
						$rep_addon_name = '';

						if (isset($addon['attr']['repetable_item']['addon_name'])) {
							$rep_addon_name = $addon['attr']['repetable_item']['addon_name'];
						}

						$output .='<div class="repeatable-items">';
						$output .= '<a href="javascript:void(0)" class="clone-repeatable sppb-btn sppb-btn-primary"><i class="fa fa-plus"></i> ' . JText::_('COM_SPPAGEBUILDER_ADD_NEW') . '</a>';
						$output .='<div class="accordion">';
						$output .='<div class="accordion-group" data-inner_base="'.$rep_addon_name.'">';

						$output .= '<div class="accordion-heading">';
						$output .= '<a href="javascript:void(0)" class="action-move"><i class="fa fa-ellipsis-v"></i></a>';
						$output .= '<a class="accordion-toggle" data-toggle="collapse">';
						$output .= '<i></i> <span>' . $addon['title'] . '</span>';
						$output .= '</a>';
						$output .= '<a href="javascript:void(0)" class="action-remove"><i class="fa fa-times"></i></a>';
						$output .= '<a href="javascript:void(0)" class="action-duplicate"><i class="fa fa-copy"></i></a>';
						$output .= '</div><!--/.accordion-heading-->';

						$output .='<div class="accordion-body collapse">';
						$output .='<div class="accordion-inner">';

						foreach( $addon_attr['attr'] as $key => $attr )
						{
							$output .= SpPgaeBuilder::getInputElements( $key, $attr );
						}

						$output .='</div><!--/.accordion-inner-->';
						$output .='</div><!--/.accordion-body-->';


						$output .='</div><!--/.accordion-group-->';
						$output .='</div><!--/.accordion-->';
						$output .='</div><!--/.repeatable-items-->';

					}
					else
					{
						$output .= SpPgaeBuilder::getInputElements( $name, $addon_attr );
					}
				}
			}

			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</li>';

			$i++;
		}

		echo $output;
		?>

	</ul>
</div>
