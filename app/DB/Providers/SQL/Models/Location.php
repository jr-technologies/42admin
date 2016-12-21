<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models;

class Location {

    public $id = 0;
    public $cityId = "";
    public $location = "";
    public $path ="";
    public $lat ="";
    public $long ="";
    public $title="";
    public $keyword="";
    public $description="";
    public $index="";
    public $priority =0;
    public $slug="";
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct()
    {
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }

} 

