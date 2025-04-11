<?php
class cUpload {
    private $targetDir = "view/img/product/";
    private $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    private $maxSize = 5242880; // 5MB

    public function uploadImage($file, $productName = '') {
        if (!isset($file)) {
            return ['status' => false, 'message' => 'No file uploaded'];
        }

        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        
        // kiểm tra nếu không có file
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            return ['status' => false, 'message' => 'File is not an image'];
        }

        // Check file size
        if ($file["size"] > $this->maxSize) {
            return ['status' => false, 'message' => 'File is too large'];
        }

        // Check file type
        if (!in_array($imageFileType, $this->allowedTypes)) {
            return ['status' => false, 'message' => 'Only JPG, JPEG, PNG & GIF files are allowed'];
        }

        // Convert product name to filename
        if (!empty($productName)) {
            $fileName = $this->convertToFileName($productName);
        } else {
            $fileName = uniqid();
        }
        
        $fileName .= '.' . $imageFileType;
        $targetFile = $this->targetDir . $fileName;

        // Upload file
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return [
                'status' => true,
                'filename' => $fileName,
                'path' => 'view/img/product/' . $fileName
            ];
        }

        return ['status' => false, 'message' => 'Error uploading file'];
    }

    private function convertToFileName($str) {
        $str = trim($str);
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace('/[^a-zA-Z0-9\s]/', '', $str);
        $str = strtolower($str);
        $str = str_replace(' ', '-', $str);
        return $str;
    }
}
?>