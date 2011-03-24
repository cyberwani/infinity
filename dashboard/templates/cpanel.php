<div class="wrap nosubsub">
	<div class="icon32"><img src="<?php print infinity_dashboard_image( 'icon_32.png' ) ?>" /></div>
	<h2><?php _e( 'Infinity Theme', INFINITY_TEXT_DOMAIN ) ?></h2>
	<?php
		$actions = infinity_dashboard_cpanel_actions();
		$current_action = infinity_dashboard_cpanel_action();
	?>
	<div id="infinity-cpanel">
		<div id="infinity-cpanel-toolbar" class="ui-widget-header ui-corner-all">
			<a id="infinity-cpanel-toolbar-menu" title="<?php _e( 'Infinity', INFINITY_TEXT_DOMAIN ) ?>"><?php _e( 'Infinity', INFINITY_TEXT_DOMAIN ) ?></a>
			<?php foreach ( $actions as $action_slug => $action_title ): ?>
				<a id="infinity-cpanel-toolbar-<?php print $action_slug ?>" class="infinity-cpanel-opentab" href="#infinity-cpanel-content-tab-<?php print $action_slug ?>" title="<?php print $action_title ?>"></a>
			<?php endforeach; ?>
		</div>
		<div id="infinity-cpanel-content">
			<ul>
				<li><a href="#infinity-cpanel-content-tab-start"><?php _e( 'Start', INFINITY_TEXT_DOMAIN ) ?></a></li>
			</ul>
			<div id="infinity-cpanel-content-tab-start">
				<?php infinity_dashboard_cpanel_start_content() ?>
			</div>
		</div>
	</div>
</div>
