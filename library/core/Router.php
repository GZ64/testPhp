<?php

namespace library\core;

class Router {
	private static $instance;
	
	
	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	public static function getActionName($name) {
		return strTolower($name) . 'Action';
	}
	
	public static function getControllerName($name) {
		return '\Controllers\\' . ucfirst(strtolower($name));
	}
	
	public static function getControllerPath($name) {
		return APP_ROOT . 'Controllers' . DS . ucfirst(strtolower($name)) . '.php';
	}
	public static function dispatchPage($url, $param)
	{
		$urlData = explode('/', $url);
		if (!empty($urlData[0])) {
			if (file_exists(self::getControllerPath($urlData[0])) && class_exists(self::getControllerName($urlData[0]))) {
				$controller = self::getControllerName($urlData[0]);
				array_splice($urlData, 0, 1);
			} else {
				$controller = self::getControllerName('error');
			}
		} else { // si il n'y a pas de chemin
			$controller = self::getControllerName('accueil');
		}
		
		$iController = new $controller;
		
		if (!empty($urlData[0])) {
			if (method_exists($iController, self::getActionName($urlData[0]))) {
				$action = self::getActionName($urlData[0]);
				array_splice($urlData, 0, 1);
			} else { // si une erreur dans l'url
				$action = self::getActionName('index');
			}
		} else {
			$action = self::getActionName('index');
		}
		call_user_func_array(array($iController, $action), array($param));
		call_user_func_array(array($iController, 'renderView'), array($controller, $action));
	}
}