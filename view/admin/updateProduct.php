<?php 
    include_once("controller/cProduct.php");
    $p = new cProduct();
?>
<h2 class="title-page">Trang sửa sản phẩm</h2>

<form action="#" method="POST" name="formUpdate" class="form-main" enctype="multipart/form-data">
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idProduct'])) {
            $idProduct = $_POST['idProduct'];
            $updateSQL = $p->cGetProductById($idProduct);

            if($updateSQL && $updateSQL->num_rows > 0) {
                while($row = $updateSQL->fetch_assoc()) {
                    echo '
                        <div class="form-input">
                            <label>Mã sản phẩm</label>
                            <input type="text" name="idProduct" value="'.$row['idProduct'].'">
                        </div>

                        <div class="form-input">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="nameProduct" value="'.$row['nameProduct'].'">
                        </div>

                        <div class="form-input">
                            <label>Giá bán</label>
                            <input type="text" name="sellPrice" value="'.$row['sellPrice'].'">
                        </div>

                        <div class="form-input">
                            <label>Giá gốc</label>
                            <input type="text" name="costPrice" value="'.$row['costPrice'].'">
                        </div>

                        <div class="form-input">
                            <label>Loại sản phẩm</label>
                            <input type="text" name="idTypeOfProduct" value="'.$row['idTypeOfProduct'].'">
                        </div>

                        <div class="form-input">
                            <label>Hình ảnh</label>
                            <div class="image-upload-container">
                                <img src="'.$row['image'].'" alt="Current image" class="current-image">
                                <input type="file" name="new_image" accept="image/*">
                                <input type="hidden" name="current_image" value="'.$row['image'].'">
                            </div>
                        </div>

                        <div class="form-input">
                            <label>Năm xuất bản</label>
                            <input type="text" name="yearOfPublish" value="'.$row['yearOfPublish'].'">
                        </div>

                        <div class="button-form">
                            <input type="reset" class="btn btn-reset" name="btnReset" value="Đặt lại">
                            <input type="submit" class="btn btn-submit" name="btnUpdate" value="Cập nhật">
                        </div>
                    ';
                }
            }
        }
    ?>
</form>

<?php 
    if(isset($_POST['btnUpdate'])){
        include_once("controller/cProduct.php");
        include_once("controller/cUpload.php");
        
        $imagePath = $_POST['current_image'];

        if(isset($_FILES['new_image']) && $_FILES['new_image']['size'] > 0) {
            $upload = new cUpload();
            $uploadResult = $upload->uploadImage($_FILES['new_image'], $_POST['nameProduct']);
            
            if($uploadResult['status']) {
                $imagePath = $uploadResult['path'];
            } else {
                echo "<script>alert('Upload ảnh thất bại: " . $uploadResult['message'] . "')</script>";
                header("refresh:0.1;url=index.php?act=admin&func=updateProduct");
                exit();
            }
        }

        $update = $p->cUpdateProduct(
            $_POST['idProduct'], 
            $_POST['nameProduct'], 
            $_POST['sellPrice'], 
            $_POST['costPrice'], 
            $_POST['idTypeOfProduct'], 
            $imagePath, 
            $_POST['yearOfPublish']
        );
        
        if($update == true) {
            echo "<script>alert('Cập nhật thông tin sản phẩm thành công')</script>";
            header("refresh:0.1;url=index.php?act=admin&func=viewProducts");
            exit();
        } else {
            echo "<script>alert('Cập nhật thông tin không thành công')</script>";
            header("refresh:0.1;url=index.php?act=admin&func=updateProduct");
            exit();
        }
    }
?>