<?php

namespace App\Models;

use CodeIgniter\Model;

class DataImages extends Model
{
    protected $table = 'imgapi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_img', 'width', 'height', 'description', 'urlfull', 'urlraw', 'urlregular', 'urlsmall', 'urlthumb', 'user_id', 'username', 'full_name', 'user_urlprotfolio'];

    // Các phương thức khác của model

}