<?php

namespace library\core;

abstract class Controller {
	private $layout = '';
	private $responseHeader = "text/html";
	private $dataView = array();
	
	protected function getLayoutPath() {
		return APP_ROOT . "Views/layout/" . $this->layout . ".phtml";
		
	}
	
	protected function setLayout($name) {
		$pathLayout = APP_ROOT . "Views/layout/{$name}.phtml";
		if (!empty($name) && file_exists($pathLayout)) {
			$this->layout = $name;
		}
	}
	
	protected function getResponseHeader() {
		return $this->responseHeader;
	}
	
	protected function setDataView(array $data) {
		$this->dataView = array_merge($this->dataView, $data);
	}
	
	public function renderView($controllerName, $actionName) {
		$controllerName = str_replace('\\', '/', $controllerName);
		header("content-type: " . $this->getResponseHeader() . "; charset=utf-8");
		$pathView = APP_ROOT . str_replace('/Controllers', 'Views', $controllerName)  . DS . str_replace('Action', '', lcfirst($actionName)) . '.phtml';
		$layout = explode('/', $controllerName)[2];
		ob_start();
		if (file_exists($pathView)) {
			extract($this->dataView);
			include($pathView);
		}
		
		$viewContent = ob_get_clean();
		ob_start();
		
		// choix du layout
		if ($layout === 'Error') $layout = 'Accueil';
		$this->setLayout($layout);
		include($this->getLayoutPath());
		$finalRender = ob_get_clean();
		echo $finalRender;
	}
}