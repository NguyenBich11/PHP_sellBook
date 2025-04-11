<?php 
    include_once("controller/cType.php");
    $p = new cType();
?>

<h2 class="title-page">Thêm loại sản phẩm</h2>
<form action="#" method="POST" name="formAddType" class="form-main">
    <div class="form-input">
        <label>Tên loại sản phẩm</label>
        <input type="text" name="nameTypeProduct">
    </div>

    <div class="button-form">
        <input type="reset" class="btn btn-reset" name="btnReset" value="Đặt lại">
        <input type="submit" class="btn btn-submit" name="btnAddType" value="Thêm loại sản phẩm">
    </div>
</form>

<?php 
    if(isset($_POST['btnAddType'])){
        include_once("controller/cType.php");
        $addTypeProduct = $p->cAddTypeProduct($_POST['nameTypeProduct']);
        
        if($addTypeProduct) {
            echo "<script>alert('Thêm loại sản phẩm thành công')</script>";
        }else {
            echo "<script>alert('Thêm loại sản phẩm không thành công')</script>";
        }

        header("refresh:0.1;url=index.php?act=admin&func=addTypeProduct");
        exit();
    }
?>