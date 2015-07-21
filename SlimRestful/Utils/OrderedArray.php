<?php

namespace SlimRestful\Utils;

class OrderedArray{

    private $order;
    private $elements;

    public function __construct(){
        $this->order = array();
        $this->elements = array();
    }

    public function getElements(){
        return $this->elements;
    }
    
    public function getElement($index){
        return (isset($this->elements[$index]) ? $this->elements[$index] : null);
    }

    public function addElement($index, $element){
        $this->addSimpleElement($index, $element);
        $this->order[] = $index;
    }
    
    public function updateOrderIndex($oldOrderIndex, $newOrderIndex){
        foreach($this->order as $i => $index){
            if($index == $oldOrderIndex){
                $order[$i] = $newOrderIndex;
                return;
            }
        }
    }
    
    public function addSimpleElement($index, $element){
        $this->elements[$index] = $element;
    }
    
    public function removeElement($index){
        unset($this->elements[$index]);
    }
}
