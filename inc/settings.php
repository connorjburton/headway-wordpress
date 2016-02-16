<div class="wrap">
	<div id="icon-edit" class="icon32 icon32-base-template"><br></div>
	<h2><?php _e( "Headway Settings", 'headwaybase' ); ?></h2>
		
	<form id="dx-plugin-base-form" action="options.php" method="POST">
			<?php settings_fields( 'headway_setting' ); ?>
			<?php do_settings_sections( 'headway-plugin-base' ); ?>
			
			<input type="submit" value="<?php _e( "Save", 'dxbase' ); ?>" />
	</form> <!-- end of #dxtemplate-form -->
</div>