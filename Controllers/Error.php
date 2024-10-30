<?php

namespace Controllers;

use \library\core\Controller;

class Error extends Controller {
	
	public function indexAction() {
		http_response_code(404);
		$this->setDataView([]);
	}
}