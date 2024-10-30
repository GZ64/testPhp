<?php

namespace library\loader;

class Autoloader {
	private static $instance;
	private static $basePath;
	
	private function __construct() {
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}
	
	public static function setBasePath($value) {
		if (is_string($value)) {
			self::$basePath = $value;
		}
	}
	
	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	protected static function autoload($className) {
		$path = self::$basePath . str_replace('\\', '/', $className) . '.php';
		if (!file_exists($path)) { // si la classe n'existe pas
			throw new \Exception("Error namespace file not found : '$path'");
		}
		// on inclu la classe
		require($path);
	}
}

?>