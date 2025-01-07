<?php
	spl_autoload_register(function ($classname) {
	$classname = strtolower($classname);
	require 'class/'.$classname.'.class.php';
});

