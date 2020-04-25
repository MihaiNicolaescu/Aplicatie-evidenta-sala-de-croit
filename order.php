<?php


class order
{
    private $idOrder, $idUser, $region, $initSizes, $completed, $name, $restSizes;
    function __construct($idOrder, $idUser, $region, $initSizes, $completed, $name, $restSizes)
    {
        $this->idOrder = $idOrder;
        $this->idUser = $idUser;
        $this->region = $region;
        $this->initSizes = $initSizes;
        $this->completed = $completed;
        $this->name = $name;
        $this->restSizes = $restSizes;
    }

    public function getOrder(){
        return $this->idOrder;
    }
    public function getUser(){
        return $this->idUser;
    }
    public function getRegion(){
        return $this->region;
    }
    public function getSizes(){
        return $this->initSizes;
    }
    public function getComplete(){
        return $this->completed;
    }
    public function getName(){
        return $this->name;
    }
    public function getRestSizes(){
        return $this->restSizes;
    }
    public function echoOrder(){
        echo $this->idOrder . " " . $this->idUser . " " . $this->region . " " . $this->initSizes . " " . $this->completed . " " . $this->name;
    }
}