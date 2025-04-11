<?php 
    include_once("controller/cProduct.php");
    $p = new cProduct();
?>

<h2 class="title-page">Thêm sản phẩm</h2>
<form action="#" method="POST" name="formAdd" class="form-main" enctype="multipart/form-data">
    <div class="form-input">
        <label>Mã sản phẩm</label>
        <input type="text" name="idProduct" required>
    </div>

    <div class="form-input">
        <label>Tên sản phẩm</label>
        <input type="text" name="nameProduct" required>
    </div>

    <div class="form-input">
        <label>Giá bán</label>
        <input type="text" name="sellPrice" required>
    </div>

    <div class="form-input">
        <label>Giá gốc</label>
        <input type="text" name="costPrice" required>
    </div>

    <div class="form-input">
        <label>Loại sản phẩm</label>
        <select name="idTypeOfProduct" required>
            <option value="">-- Chọn loại sản phẩm --</option>
            <?php 
                include_once("controller/cType.php");
                $typeController = new cType();
                $types = $typeController->cgetAllType();
                
                if($types && $types->num_rows > 0) {
                    while($type = $types->fetch_assoc()) {
                        echo '<option value="'.$type['idType'].'">'.$type['nameType'].'</option>';
                    }
                }
            ?>
        </select>
    </div>

    <div class="form-input">
        <label>Hình ảnh</label>
        <input type="file" name="image" required accept="image/*">
    </div>

    <div class="form-input">
        <label>Năm xuất bản</label>
        <input type="text" name="yearOfPublish" name="yearOfPublish">
    </div>

    <div class="button-form">
        <input type="reset" class="btn btn-reset" name="btnReset" value="Đặt lại">
        <input type="submit" class="btn btn-submit" name="btnAdd" value="Thêm sản phẩm">
    </div>
</form>

<?php 
    if(isset($_POST['btnAdd'])){
        include_once("controller/cProduct.php");
        include_once("controller/cUpload.php");
        
        $upload = new cUpload();
        $uploadResult = $upload->uploadImage($_FILES['image'], $_POST['nameProduct']);
        
        if($uploadResult['status']) {
            $p = new cProduct();
            $addProduct = $p->cAddProduct(
                $_POST['idProduct'], 
                $_POST['nameProduct'], 
                $_POST['sellPrice'], 
                $_POST['costPrice'], 
                $_POST['idTypeOfProduct'], 
                $uploadResult['path'], 
                $_POST['yearOfPublish']
            );
            
            if($addProduct) {
                echo "<script>alert('Thêm sản phẩm thành công')</script>";
            } else {
                echo "<script>alert('Thêm sản phẩm không thành công')</script>";
            }
        } else {
            echo "<script>alert('Upload ảnh thất bại: " . $uploadResult['message'] . "')</script>";
        }

        header("refresh:0.1;url=index.php?act=admin&func=addProduct");
        exit();
    }
?>