<?php
	

namespace SlimRestful;	

class SlimRestfulRunner{
	
	public function run($srInstance){
		$slimApp = $srInstance->getSlimApp();
		$allPrefixes = $srInstance->getPrefixes();
		foreach($allPrefixes as $prefix){
			$this->handlePrefix($prefix);
		}
	}
	
	private function handlePrefix($prefix){
		
	}
	
}