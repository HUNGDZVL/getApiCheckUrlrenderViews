<?php

namespace App\Models;

use CodeIgniter\Model;

class DataImages extends Model
{
    protected $table = 'imgapi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_img', 'width', 'urlfull', 'urlraw', 'urlregular', 'urlsmall', 'urlthumb'];

    // Các phương thức khác của model

}