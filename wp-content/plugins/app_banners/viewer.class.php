<?php

	class Viewer
	{
		public static function view($name, $args)
		{
			$args = unserialize($args);
			$file = BANNERS__PLUGIN_DIR . 'views/'. $name . '.php';
			include( $file );
		}
	}