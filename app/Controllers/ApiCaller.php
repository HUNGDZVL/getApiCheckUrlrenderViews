<?php

namespace App\Controllers;

use App\Models\DataImages;

use App\Controllers\BaseController;

class ApiCaller extends BaseController
{   // lấy dữ liệu từ api lưu vào db
    public function getImages()
    {
        $model = new DataImages(); // Khởi tạo một đối tượng DataImages

        $session = session();
        $callCount = $session->get('api_call_count', 0); // Lấy số lần gọi API từ session

        if ($callCount >= 50) {
            // Vượt quá giới hạn số lần gọi API, thay thế bằng lấy một URL ngẫu nhiên từ cơ sở dữ liệu
            $randomUrl = $this->getRandomImageUrlFromDatabase($model);
            if ($randomUrl) {
                return $this->outputImageFromUrl($randomUrl);
            } else {
                return "Không tìm thấy dữ liệu trong cơ sở dữ liệu";
            }
        }

        $id = $this->request->getVar('id'); // Lấy giá trị 'id' từ request
        $id_img = $this->request->getVar('id_img'); // Lấy giá trị 'id' từ request
        $size = $this->request->getVar('size'); // Lấy giá trị 'size' từ request

        $data = null;
        if ($id !== null) {
            $data = $model->where('id', $id)->first(); // Lấy dữ liệu từ cơ sở dữ liệu với id đã cho
        } elseif ($id_img !== null) {
            $data = $model->where('id_img', $id_img)->first(); // Lấy dữ liệu từ cơ sở dữ liệu với id_img đã cho
        }

        if ($id === null && $id_img === null) {
            // Lấy URL ngẫu nhiên với kích thước đã cho
            $randomUrl = $this->getImageUrlSize($model, $size);
            return $this->outputImageFromUrl($randomUrl); // Trả về ảnh từ URL ngẫu nhiên
        }

        if ($data) {
            $url = $this->getImageUrlBySize($data, $size); // Lấy URL ảnh dựa trên kích thước từ dữ liệu
            return $this->outputImageFromUrl($url); // Trả về ảnh từ URL
        }

        return $this->fetchRandomImageUrl($model); // Lấy ngẫu nhiên một URL ảnh từ API
    }

    //random hình ảnh theo size
    private function getImageUrlSize($model, $size)
    {
        $count = $model->countAll(); // Đếm số lượng bản ghi trong cơ sở dữ liệu

        if ($count > 0) {
            $randomIndex = mt_rand(1, $count); // Chọn một chỉ mục ngẫu nhiên từ 1 đến số lượng bản ghi
            $data = $model->find($randomIndex); // Lấy dữ liệu từ cơ sở dữ liệu dựa trên chỉ mục ngẫu nhiên

            // Lấy URL tương ứng với kích thước từ dữ liệu
            $urls = [
                $data['urlfull'],
                $data['urlraw'],
                $data['urlregular'],
                $data['urlsmall'],
                $data['urlthumb']
            ];

            if ($size >= 1 && $size <= count($urls)) {
                $sizeUrl = $urls[$size - 1]; // Lấy URL theo kích thước (chỉ mục bắt đầu từ 0)
                return $sizeUrl;
            } else {
                return "Kích thước không hợp lệ";
            }
        }
    }
    /**
     * Lấy URL ảnh dựa trên kích thước
     */
    private function getImageUrlBySize($data, $size)
    {
        if (
            $size !== null && $size >= 1 && $size <= 5
        ) {
            $url = '';

            switch ($size) {
                case 1:
                    $url = $data['urlraw'];
                    break;
                case 2:
                    $url = $data['urlregular'];
                    break;
                case 3:
                    $url = $data['urlsmall'];
                    break;
                case 4:
                    $url = $data['urlthumb'];
                    break;
                case 5:
                    $url = $data['urlfull'];
                    break;
            }
        } else {
            $urls = [
                $data['urlraw'],
                $data['urlregular'],
                $data['urlsmall'],
                $data['urlthumb'],
                $data['urlfull']
            ];
            $randomIndex = array_rand($urls); // Chọn ngẫu nhiên một chỉ mục từ mảng
            $url = $urls[$randomIndex]; // Lấy URL ngẫu nhiên từ mảng
        }

        return $this->outputImageFromUrl($url);
    }

    /**
     * Hiển thị ảnh từ URL
     */
    private function outputImageFromUrl($url)
    {
        $img = file_get_contents($url); // Lấy nội dung ảnh từ URL
        $headers = implode("\n", $http_response_header); // Lấy các header từ phản hồi HTTP

        if (preg_match_all("/^content-type\s*:\s*(.*)$/mi", $headers, $matches)) {
            $content_type = end($matches[1]);
            header("Content-Type: $content_type"); // Đặt Content-Type cho phản hồi HTTP
        }

        echo $img; // Hiển thị ảnh
        die(); // Dừng chương trình

        // $filename = $url; //<-- chỉ định tệp hình ảnh(đọc file hình ảnh bất kì)
        // if (file_exists($filename)) {
        //     $mime = mime_content_type($filename); //<-- xác định kiểu tệp
        //     header('Content-Length: ' . filesize($filename)); //<-- gửi tiêu đề kích thước tệp
        //     header("Content-Type: $mime"); //<-- gửi tiêu đề kiểu MIME
        //     header('Content-Disposition: inline; filename="' . $filename . '";'); //<-- gửi tiêu đề tên tệp
        //     readfile($filename); //<-- đọc và xuất tệp ra bộ đệm đầu ra
        //     exit(); // hoặc die()
        // }

        // $finfo = finfo_open(FILEINFO_MIME_TYPE); // trả về kiểu MIME dựa trên phần mở rộng của tệp
        // echo finfo_file($finfo, $filename) . "\n"; // in ra kiểu MIME của tệp
        // finfo_close($finfo); // đóng đối tượng finfo
        // echo exif_imagetype($filename); // xác định kiểu hình ảnh sử dụng exif_imagetype
        // return; // kết thúc hàm
    }

    /**
     * Lấy URL ngẫu nhiên từ API và lưu vào cơ sở dữ liệu
     */
    private function fetchRandomImageUrl($model)
    {
        $url = 'https://api.unsplash.com/photos/random?client_id=UVtAwJGs5CdLjXg5anu1BJEJJKKF2w8YjsuNIb4uCtg';
        $response = file_get_contents($url); // Gửi yêu cầu GET đến API và nhận phản hồi

        if ($response) {
            $data = json_decode($response); // Chuyển đổi phản hồi từ dạng JSON sang đối tượng PHP

            $id_img = $data->id; // Lấy giá trị 'id' từ phản hồi
            $width = $data->width; // Lấy giá trị 'width' từ phản hồi
            $height = $data->height; // Lấy giá trị 'width' từ phản hồi
            $description = $data->description; // Lấy giá trị 'width' từ phản hồi
            $urlFull = $data->urls->full; // Lấy giá trị 'full' từ phản hồi
            $urlRaw = $data->urls->raw; // Lấy giá trị 'raw' từ phản hồi
            $urlRegular = $data->urls->regular; // Lấy giá trị 'regular' từ phản hồi
            $urlSmall = $data->urls->small; // Lấy giá trị 'small' từ phản hồi
            $urlThumb = $data->urls->thumb; // Lấy giá trị 'thumb' từ phản hồi
            $user_id = $data->user->id;
            $username = $data->user->username;
            $full_name = $data->user->name;
            $user_urlprotfolio = $data->user->portfolio_url;

            // Thêm dữ liệu vào cơ sở dữ liệu
            $model->insert([
                'id_img' => $id_img,
                'width' => $width,
                'height' => $height,
                'description' => $description,
                'urlfull' => $urlFull,
                'urlraw' => $urlRaw,
                'urlregular' => $urlRegular,
                'urlsmall' => $urlSmall,
                'urlthumb' => $urlThumb,
                'user_id' => $user_id,
                'username' => $username,
                'full_name' => $full_name,
                'user_urlprotfolio' => $user_urlprotfolio
            ]);

            $urls = [
                $urlFull,
                $urlRaw,
                $urlRegular,
                $urlSmall,
                $urlThumb
            ];

            $randomIndex = array_rand($urls); // Chọn ngẫu nhiên một chỉ mục từ mảng
            $randomUrl = $urls[$randomIndex]; // Lấy URL ngẫu nhiên từ mảng

            return $this->outputImageFromUrl($randomUrl); // trả về hình ảnh của url
        } else {
            return "Lỗi: Không thể gọi API";
        }
    }

    private function getRandomImageUrlFromDatabase($model)
    {
        $count = $model->countAll(); // Đếm số lượng bản ghi trong cơ sở dữ liệu

        if ($count > 0) {
            $randomIndex = mt_rand(1, $count); // Chọn một chỉ mục ngẫu nhiên từ 1 đến số lượng bản ghi
            $data = $model->find($randomIndex); // Lấy dữ liệu từ cơ sở dữ liệu dựa trên chỉ mục ngẫu nhiên

            // Lấy một URL ngẫu nhiên từ dữ liệu
            $urls = [
                $data['urlfull'],
                $data['urlraw'],
                $data['urlregular'],
                $data['urlsmall'],
                $data['urlthumb']
            ];
            $randomUrl = $urls[array_rand($urls)];

            return $this->outputImageFromUrl($randomUrl);
        }

        return null; // Trả về null nếu không tìm thấy dữ liệu trong cơ sở dữ liệu
    }


    // check xem giá trị của session
    public function viewSession()
    {
        $session = session();

        // Sử dụng phương thức get() để lấy giá trị của session
        $apiCallCount = $session->get('api_call_count');

        // Hoặc truy cập trực tiếp vào mảng session
        $apiCallCount = $_SESSION['api_call_count'];

        // In giá trị của session
        echo "Giá trị của session api_call_count: " . $apiCallCount;
    }
    public function indexImg()
    {
        return view('index_img');
    }
}