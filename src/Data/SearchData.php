<?php

namespace App\Data;

use App\Entity\CategoryIngredient;

class SearchData
{
    /**
     * @var int
     */
    public $page = 1;
    
    /**
     * @var string
     */
    public $q = '';

    /**
     * @var CategoryIngredient[]
     */
    public $categoryIngredient = [];

}