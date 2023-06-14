<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DataImgAjaxSearch;

class GetImagesDB extends BaseController
{
    public function indexImg()
    {
        $model = new DataImgAjaxSearch();
        $data['urlimgsearch'] = $model->findAll();

        if (!empty($data)) {
            // render dữ liệu vô view
            return view('index_img', $data);
        } else {
            return view('index_img');
        }
    }
    public function getDataSearch()
    {
        if ($this->request->isAJAX()) {
            $data = $_POST['urlImg'];
            if (!empty($data)) {
                $model = new DataImgAjaxSearch();
                print_r($data);
                $model->truncate();
                $model->insertBatch($data);
                $response = [
                    'success' => 'success',
                    'message' => 'insertData successfully'
                ];
                return $this->response->setJSON($response);
            }
        }
    }
}
