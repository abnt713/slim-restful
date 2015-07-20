<?php
	
namespace SlimRestful\Utils;	

/* As I said: Later xD */
final class ArrayUtils{
	
	public static function replaceKey($array, $oldKey, $newKey){
		if(!isset($array[$oldKey])){
			return $array;
		}
		
		$keys = array_keys($array);
		$keyPosition = array_search($oldKey, $keys);
		if($keyPosition == 0){
			$withIndexArray = array($newKey => $array[$oldKey]);
			if(count($array) == 1){
				return $withIndexArray;
			}
			
			$withoutIndexArray = array_slice($array, $keyPosition + 1);
			return array_merge($withIndexArray, $withoutIndexArray);
		}else if($keyPosition == (count($array) - 1)){
			
		}
	}
	
}