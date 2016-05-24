<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

include_once ( JPATH_COMPONENT .'/builder/settings/sp-addons-settings.php' );
include_once ( JPATH_COMPONENT .'/builder/builder.php' );
	
function builder_layout( $layout_data = null )
{
	$builder = new SpPgaeBuilder();

	$sp_builder_elements = SpAddonsConfig::$addons;
	$sp_builder_col_ops = SpAddonsConfig::getColumnConfig();
	$sp_builder_row_ops = SpAddonsConfig::getRowConfig();

	global $pageId;
	global $pageLayout;
	global $language;

	if ($language != '*') {
		$language = explode('-',$language);
		$languages ='&lang='.$language[0];
	}

	ob_start();

	?>
	<div class="clearfix">
		<ul class="page-builder-ops">
			<li><a id="add-row" class="sppb-btn sppb-btn-primary" href="javascript:void(0)"><i class="fa fa-plus"></i> <?php echo JText::_('COM_SPPAGEBUILDER_ADD_ROW'); ?></a></li>
			<li class="inner-options pull-right">
				<a id="add-template" class="sppb-btn sppb-btn-primary" href="javascript:void(0)"><i class="fa fa-plus"></i> Load Template</a>
				<ul id="pagebuilder-templates">
					<li><a target="_blank" href="http://www.joomshaper.com/page-builder#pricing">Availabe in Pro Version</a></li>
				</ul>
			</li>
			<li class="layout-options pull-right"><div class="checkbox"><label class="hasTooltip" title="<?php echo JText::_('COM_SPPAGEBUILDER_PAGE_FULL_WIDTH_DESC'); ?>"><input type="checkbox" name="jform[page_layout]" id="jform_page_layout" value="1" <?php if($pageLayout) echo 'checked'?>><?php echo JText::_('COM_SPPAGEBUILDER_PAGE_FULL_WIDTH'); ?></label></div></li>
			<?php if(!empty($pageId)){?>
			<li><a class="sppb-btn sppb-btn-success" href="<?php echo JURI::root().'index.php?option=com_sppagebuilder&view=page&id='.$pageId.((isset($languages))?$languages:''); ?>" target="_blank"><?php echo JText::_('COM_SPPAGEBUILDER_VIEW_PAGE'); ?></a></li>
			<?php } ?>
			<li><a class="sppb-btn sppb-btn-danger" target="_blank" href="https://www.joomshaper.com/page-builder#compare"><?php echo JText::_('COM_SPPAGEBUILDER_UPGRADE_PRO'); ?></a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
		<hr>

	<div id="sp-page-builder" class="clearfix">
		<?php
		if ($layout_data)
		{
			?>
			<div class="clearfix">
				<div class="page-builder-area">
					<?php 
					
					$output = '';

					foreach ($layout_data as $key => $row)
					{
						

						$row_setting = SpPgaeBuilder::getAddonRowColumnConfig( $row->settings );

						$output .= '<div class="pagebuilder-section" '.$row_setting.'>

						<div class="section-header clearfix">
							<div class="pull-left">
								<a class="move-row" href="javascript:void(0)"><i class="fa fa-arrows"></i></a>
								<div class="row-layout-container">
									<a class="add-column" href="javascript:void(0)"><i class="fa fa-plus"></i> Column</a>
									<ul>
										<li><a href="#" class="row-layout row-layout-12 sp-tooltip '.(( $row->layout == 12 )?'active':'').'" data-layout="12" data-toggle="tooltip" data-placement="top" data-original-title="1/1"></a></li>
										<li><a href="#" class="row-layout row-layout-66 sp-tooltip '.(( $row->layout == 66 )?'active':'').'" data-layout="6,6" data-toggle="tooltip" data-placement="top" data-original-title="1/2 + 1/2"></a></li>
										<li><a href="#" class="row-layout row-layout-444 sp-tooltip '.(( $row->layout == 444 )?'active':'').'" data-layout="4,4,4" data-toggle="tooltip" data-placement="top" data-original-title="1/3 + 1/3 + 1/3"></a></li>
										<li><a href="#" class="row-layout row-layout-3333 sp-tooltip '.(( $row->layout == 3333 )?'active':'').'" data-layout="3,3,3,3" data-toggle="tooltip" data-placement="top" data-original-title="1/4 + 1/4 + 1/4 + 1/4"></a></li>
										<li><a href="#" class="row-layout row-layout-48 sp-tooltip '.(( $row->layout == 48 )?'active':'').'" data-layout="4,8" data-toggle="tooltip" data-placement="top" data-original-title="1/3 + 3/4"></a></li>
										<li><a href="#" class="row-layout row-layout-39 sp-tooltip '.(( $row->layout == 39 )?'active':'').'" data-layout="3,9" data-toggle="tooltip" data-placement="top" data-original-title="1/4 + 3/4"></a></li>
										<li><a href="#" class="row-layout row-layout-363 sp-tooltip '.(( $row->layout == 363 )?'active':'').'" data-layout="3,6,3" data-toggle="tooltip" data-placement="top" data-original-title="1/4 + 1/2 + 1/4"></a></li>
										<li><a href="#" class="row-layout row-layout-264 sp-tooltip '.(( $row->layout == 264 )?'active':'').'" data-layout="2,6,4" data-toggle="tooltip" data-placement="top" data-original-title="1/6 + 1/2 + 1/3"></a></li>
										<li><a href="#" class="row-layout row-layout-210 sp-tooltip '.(( $row->layout == 210 )?'active':'').'" data-layout="2,10" data-toggle="tooltip" data-placement="top" data-original-title="1/6 + 5/6"></a></li>
										<li><a href="#" class="row-layout row-layout-57 sp-tooltip '.(( $row->layout == 57 )?'active':'').'" data-layout="5,7" data-toggle="tooltip" data-placement="left" data-original-title="5/12 + 7/12"></a></li>
									</ul>
								</div>
							</div>

							<div class="row-actions pull-right">
								<a class="add-rowplus sp-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-original-title="' . JText::_('COM_SPPAGEBUILDER_ADD_NEW_ROW') . '"><i class="fa fa-plus"></i></a>
								<a class="row-options sp-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-original-title="' . JText::_('COM_SPPAGEBUILDER_ROW_SETTINGS') . '"><i class="fa fa-cog"></i></a>
								<a class="duplicate-row sp-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-original-title="' . JText::_('COM_SPPAGEBUILDER_CLONE_ROW') . '"><i class="fa fa-files-o"></i></a>
								<a class="delete-row sp-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-original-title="' . JText::_('COM_SPPAGEBUILDER_DELETE_ROW') . '"><i class="fa fa-times"></i></a>
							</div>
						</div>

						<div class="row">';

							foreach ($row->attr as $key => $column)
							{

								$col_setting = SpPgaeBuilder::getAddonRowColumnConfig( $column->settings );

								$output .= '<div class="'.$column->class_name.'" '.$col_setting.'>';
									$output .= '<div class="column">';

									foreach ($column->attr as $key => $addon)
									{
										if(isset($addon->title)){
											$title = $addon->title;
										}else{
											$title = $addon->name;
										}

										$admin_label = '';
										if ( isset($addon->atts->admin_label) && $addon->atts->admin_label ) {
											$admin_label = $addon->atts->admin_label;
										} else if( isset($addon->atts->title) && $addon->atts->title ) {
											$admin_label = $addon->atts->title;
										}

										$output .= '<div class="generated">
										<div class="generated-items">
											<div class="generated-item clearfix">
												<img class="item-image" src="' . SpPgaeBuilder::getIcon($addon->name) . '" alt="' . $addon->name . '" width="24">';
												$output .= '<h3 data-name="'.$addon->name.'">' . $title . '</h3>';
												$output .= '<div class="action">
												<a class="addon-edit" href="javascript:void(0)">
													<i class="fa fa-pencil"></i>
												</a>
												<a class="addon-duplicate" href="javascript:void(0)">
													<i class="fa fa-files-o"></i>
												</a>
												<a class="remove-addon" href="javascript:void(0)">
													<i class="fa fa-times"></i>
												</a>
											</div>';
											
											$output .= '<p class="addon-input-title">' . $admin_label . '</p>';

											$output .= '<div class="item-inner">';

												foreach ( $addon->atts as $field => $value )
												{
													$sp_builder_elements['sp_'.$addon->name]['attr'][$field]['std'] = $value;
												}

												foreach ( $sp_builder_elements['sp_'.$addon->name]['attr'] as $name => $value )
												{
													$output .= SpPgaeBuilder::outputGenerate( $name, $value );
												}

												if (count($addon->scontent))
												{
													$output .='<div class="repeatable-items">';
													$output .= '<a href="javascript:void(0)" class="clone-repeatable sppb-btn sppb-btn-primary"><i class="fa fa-plus"></i> ' . JText::_('COM_SPPAGEBUILDER_ADD_ROW') . '</a>';
													$output .='<div class="accordion">';

													foreach ($addon->scontent as $key => $newaddon)
													{
														$rep_addon_name = '';

														if (isset($newaddon->name)) {
															$rep_addon_name = $newaddon->name;
														}

														$output .= '<div class="accordion-group" data-inner_base="'.$rep_addon_name.'">';

														$output .= '<div class="accordion-heading">
														<a href="javascript:void(0)" class="action-move"><i class="fa fa-ellipsis-v"></i></a>
														<a class="accordion-toggle" data-toggle="collapse"></a>
														<a href="javascript:void(0)" class="action-remove"><i class="fa fa-times"></i></a>
														<a href="javascript:void(0)" class="action-duplicate"><i class="fa fa-copy"></i></a>
													</div>';
													
													$output .= '<div class="accordion-body collapse">';
													$output .= '<div class="accordion-inner">';

													foreach ( $newaddon->atts as $field => $value )
													{
														$sp_builder_elements['sp_'.$addon->name]['attr']['repetable_item']['attr'][$field]['std'] = $value;
													}

													foreach ( $sp_builder_elements['sp_'.$addon->name]['attr']['repetable_item']['attr'] as $name => $values )
													{
														$output .= SpPgaeBuilder::outputGenerate( $name, $values );
													}

													$output .= '</div>';
													$output .= '</div>';

													$output .= '</div>';
												}

												$output .='</div>';
												$output .='</div>';
												
											}

											$output .= '</div>
										</div>
									</div>
								</div>';
							}

							$output .= '</div>';						
						
						$output .= '<div class="col-settings">
						<a class="add-addon" href="javascript:void(0)"><i class="fa fa-plus-circle"></i> '. JText::_('COM_SPPAGE_BUILDER_ADD_ADDON') .'</a>
						<a class="column-options" href="javascript:void(0)"><i class="fa fa-cog"></i> '. JText::_('COM_SPPAGE_BUILDER_COLUMN_OPTIONS') .'</a>
					</div>
				</div>';
			}	
			

			$output .= '</div>
		</div>';

	}

	echo $output;
	
	?>

</div>
</div>
<?php
}
else
{
	include_once ( JPATH_COMPONENT .'/builder/settings/builder-default-template.php' );
}
?>
</div>
<?php
include_once ( JPATH_COMPONENT .'/builder/settings/settings-template.php' );
return ob_get_clean();
}


function dataLayoutBuilder( $layout_data )
{
	$builder = new SpPgaeBuilder();

	$sp_builder_elements = SpAddonsConfig::$addons;
	$sp_builder_col_ops = SpAddonsConfig::getColumnConfig();
	$sp_builder_row_ops = SpAddonsConfig::getRowConfig();

	$output = '';
	$output .= '<div class="clearfix">';
	$output .= '<div class="page-builder-area">';

	foreach ($layout_data as $key => $row)
	{


		$row_setting = SpPgaeBuilder::getAddonRowColumnConfig( $row->settings );

		$output .= '<div class="pagebuilder-section" '.$row_setting.'>

		<div class="section-header clearfix">
			<div class="pull-left">
				<a class="move-row" href="javascript:void(0)"><i class="fa fa-arrows"></i></a>
				<div class="row-layout-container">
					<a class="add-column" href="javascript:void(0)"><i class="fa fa-plus"></i> Column</a>
					<ul>
						<li><a href="#" class="row-layout row-layout-12 sp-tooltip '.(( $row->layout == 12 )?'active':'').'" data-layout="12" data-toggle="tooltip" data-placement="top" data-original-title="1/1"></a></li>
						<li><a href="#" class="row-layout row-layout-66 sp-tooltip '.(( $row->layout == 66 )?'active':'').'" data-layout="6,6" data-toggle="tooltip" data-placement="top" data-original-title="1/2 + 1/2"></a></li>
						<li><a href="#" class="row-layout row-layout-444 sp-tooltip '.(( $row->layout == 444 )?'active':'').'" data-layout="4,4,4" data-toggle="tooltip" data-placement="top" data-original-title="1/3 + 1/3 + 1/3"></a></li>
						<li><a href="#" class="row-layout row-layout-3333 sp-tooltip '.(( $row->layout == 3333 )?'active':'').'" data-layout="3,3,3,3" data-toggle="tooltip" data-placement="top" data-original-title="1/4 + 1/4 + 1/4 + 1/4"></a></li>
						<li><a href="#" class="row-layout row-layout-48 sp-tooltip '.(( $row->layout == 48 )?'active':'').'" data-layout="4,8" data-toggle="tooltip" data-placement="top" data-original-title="1/3 + 3/4"></a></li>
						<li><a href="#" class="row-layout row-layout-39 sp-tooltip '.(( $row->layout == 39 )?'active':'').'" data-layout="3,9" data-toggle="tooltip" data-placement="top" data-original-title="1/4 + 3/4"></a></li>
						<li><a href="#" class="row-layout row-layout-363 sp-tooltip '.(( $row->layout == 363 )?'active':'').'" data-layout="3,6,3" data-toggle="tooltip" data-placement="top" data-original-title="1/4 + 1/2 + 1/4"></a></li>
						<li><a href="#" class="row-layout row-layout-264 sp-tooltip '.(( $row->layout == 264 )?'active':'').'" data-layout="2,6,4" data-toggle="tooltip" data-placement="top" data-original-title="1/6 + 1/2 + 1/3"></a></li>
						<li><a href="#" class="row-layout row-layout-210 sp-tooltip '.(( $row->layout == 210 )?'active':'').'" data-layout="2,10" data-toggle="tooltip" data-placement="top" data-original-title="1/6 + 5/6"></a></li>
						<li><a href="#" class="row-layout row-layout-57 sp-tooltip '.(( $row->layout == 57 )?'active':'').'" data-layout="5,7" data-toggle="tooltip" data-placement="left" data-original-title="5/12 + 7/12"></a></li>
					</ul>
				</div>
			</div>

			<div class="row-actions pull-right">
				<a class="add-rowplus sp-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-original-title="' . JText::_('COM_SPPAGEBUILDER_ADD_NEW_ROW') . '"><i class="fa fa-plus"></i></a>
				<a class="row-options sp-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-original-title="' . JText::_('COM_SPPAGEBUILDER_ROW_SETTINGS') . '"><i class="fa fa-cog"></i></a>
				<a class="duplicate-row sp-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-original-title="' . JText::_('COM_SPPAGEBUILDER_CLONE_ROW') . '"><i class="fa fa-files-o"></i></a>
				<a class="delete-row sp-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-original-title="' . JText::_('COM_SPPAGEBUILDER_DELETE_ROW') . '"><i class="fa fa-times"></i></a>
			</div>
		</div>

		<div class="row">';

			foreach ($row->attr as $key => $column)
			{

				$col_setting = SpPgaeBuilder::getAddonRowColumnConfig( $column->settings );

				$output .= '<div class="'.$column->class_name.'" '.$col_setting.'>';
				$output .= '<div class="column">';

				foreach ($column->attr as $key => $addon)
				{
					if(isset($addon->title)){
						$title = $addon->title;
					}else{
						$title = $addon->name;
					}

					$output .= '<div class="generated">
					<div class="generated-items">
						<div class="generated-item clearfix">
							<img class="item-image" src="' . SpPgaeBuilder::getIcon($addon->name) . '" alt="' . $addon->name . '" width="24">';
							$output .= '<h3 data-name="'.$addon->name.'">' . $title . '</h3>';
							$output .= '<div class="action">
							<a class="addon-edit" href="javascript:void(0)">
								<i class="fa fa-pencil"></i>
							</a>
							<a class="addon-duplicate" href="javascript:void(0)">
								<i class="fa fa-repeat"></i>
							</a>
							<a class="remove-addon" href="javascript:void(0)">
								<i class="fa fa-times"></i>
							</a>
						</div>
						<div class="item-inner">';

							foreach ( $addon->atts as $field => $value )
							{
								$sp_builder_elements['sp_'.$addon->name]['attr'][$field]['std'] = $value;
							}

							foreach ( $sp_builder_elements['sp_'.$addon->name]['attr'] as $name => $value )
							{
								$output .= SpPgaeBuilder::outputGenerate( $name, $value );
							}

							if (count($addon->scontent))
							{
								$output .='<div class="repeatable-items">';
								$output .= '<a href="javascript:void(0)" class="clone-repeatable sppb-btn sppb-btn-primary"><i class="fa fa-plus"></i> ' . JText::_('COM_SPPAGEBUILDER_ADD_ROW') . '</a>';
								$output .='<div class="accordion">';

								foreach ($addon->scontent as $key => $newaddon)
								{
									$rep_addon_name = '';

									if (isset($newaddon->name)) {
										$rep_addon_name = $newaddon->name;
									}

									$output .= '<div class="accordion-group" data-inner_base="'.$rep_addon_name.'">';

									$output .= '<div class="accordion-heading">
									<a href="javascript:void(0)" class="action-move"><i class="fa fa-ellipsis-v"></i></a>
									<a class="accordion-toggle" data-toggle="collapse"></a>
									<a href="javascript:void(0)" class="action-remove"><i class="fa fa-times"></i></a>
									<a href="javascript:void(0)" class="action-duplicate"><i class="fa fa-copy"></i></a>
								</div>';

								$output .= '<div class="accordion-body collapse">';
								$output .= '<div class="accordion-inner">';

								foreach ( $newaddon->atts as $field => $value )
								{
									$sp_builder_elements['sp_'.$addon->name]['attr']['repetable_item']['attr'][$field]['std'] = $value;
								}

								foreach ( $sp_builder_elements['sp_'.$addon->name]['attr']['repetable_item']['attr'] as $name => $values )
								{
									$output .= SpPgaeBuilder::outputGenerate( $name, $values );
								}

								$output .= '</div>';
								$output .= '</div>';

								$output .= '</div>';
							}

							$output .='</div>';
							$output .='</div>';

						}

						$output .= '</div>
					</div>
				</div>
			</div>';
		}

		$output .= '</div>';						

		$output .= '<div class="col-settings">
		<a class="add-addon" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
		<a class="column-options" href="javascript:void(0)"><i class="fa fa-cog"></i></a>
	</div>
</div>';
}	


$output .= '</div>
</div>';

}

$output .= '</div>';
$output .= '</div>';

echo $output;
}
