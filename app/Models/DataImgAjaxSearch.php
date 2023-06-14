<?php

namespace App\Models;

use CodeIgniter\Model;

class DataImgAjaxSearch extends Model
{
    protected $table = 'urlimgsearch';
    protected $primaryKey = 'id';
    protected $allowedFields = ['url'];

    // Các phương thức khác của model

}
