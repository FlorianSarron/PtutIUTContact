<?php

namespace App\Data;

use App\Entity\Entreprise;

use App\Entity\Promotion;

class SearchData{


    /**
      * @var String
      */
      public $stringSearch='';

     /**
      * @var null|Entreprise 
      */
      public $entreprise=null;

      /**
      * @var null|Promotion 
      */
      public $promotion=null;


}