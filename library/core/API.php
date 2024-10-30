<?php

namespace library\core;

class API {
	private static $instance;
	private static $results = [];
	
	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function setResults($data) {
		self::$results = $data;
	}
	
	public function getResults() {
		return self::$results;
	}
	
	public function connectAPI($url) {
		//  Initiate curl
		$ch = curl_init();
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL, $url);
		// Execute
		$result=json_decode(curl_exec($ch), true);
		// Closing
		curl_close($ch);
		$this->setResults($result);
	}
}