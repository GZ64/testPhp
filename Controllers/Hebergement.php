<?php

namespace Controllers;

use \Models\Hebergement as modelHebergement;
use \library\core\Controller;

class Hebergement extends Controller {

    private $ma = [];
    
    public function __construct(){
	    $api = \library\core\API::getInstance();
	    $api->connectAPI(
		    API_URL
	    );
	    $results = $api->getResults();
	
	    foreach ($results as $data) {
		    array_push($this->ma, new modelHebergement($data));
	    }
    }
    
    public function indexAction($param){
        $this->setDataView(array(
            'hebergements' => $this->ma,
	        'parameters' => $param
        ));
    }
}