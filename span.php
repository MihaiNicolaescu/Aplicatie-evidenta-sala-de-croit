<?php


class span
{
    private $id, $id_order, $nr_sheets, $length, $sizes, $loss, $plusSizes;
    public function __construct($id, $id_order, $nr_sheets, $length, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10, $loss, $ps1, $ps2, $ps3, $ps4, $ps5, $ps6, $ps7, $ps8, $ps9, $ps10)
    {
        $this->id = $id;
        $this->id_order = $id_order;
        $this->nr_sheets = $nr_sheets;
        $this->length = $length;
        $this->sizes[0] = $s1;
        $this->sizes[2] = $s2;
        $this->sizes[3] = $s3;
        $this->sizes[4] = $s4;
        $this->sizes[5] = $s5;
        $this->sizes[6] = $s6;
        $this->sizes[7] = $s7;
        $this->sizes[8] = $s8;
        $this->sizes[9] = $s9;
        $this->sizes[10] = $s10;
        $this->loss = $loss;
        $this->plusSizes[0] = $ps1;
        $this->plusSizes[2] = $ps2;
        $this->plusSizes[3] = $ps3;
        $this->plusSizes[4] = $ps4;
        $this->plusSizes[5] = $ps5;
        $this->plusSizes[6] = $ps6;
        $this->plusSizes[7] = $ps7;
        $this->plusSizes[8] = $ps8;
        $this->plusSizes[9] = $ps9;
        $this->plusSizes[10] = $ps10;
    }
    public function getId(){
        return $this->id;
    }
    public function getIdOrder(){
        return $this->id_order;
    }
    public function getNrSheets(){
        return $this->nr_sheets;
    }
    public function getLength(){
        return $this->length;
    }
    public function getSizes(){
        return $this->sizes;
    }
    public function getLoss(){
        return $this->loss;
    }
    public function getPlusSizes(){
        return $this->plusSizes;
    }
}