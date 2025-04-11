<?php 
    include_once("controller/cType.php");
    $p = new cType();
?>
<h2 class="title-page">Sửa loại sản phẩm</h2>

<form action="#" method="POST" name="formUpdate" class="form-main">
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idType'])) {
            $idType = $_POST['idType'];
            $updateSQL = $p->cgetTypeByID($idType);

            if($updateSQL && $updateSQL->num_rows > 0) {
                while($row = $updateSQL->fetch_assoc()) {
                    echo '
                        <div class="form-input">
                            <label>Mã loại sản phẩm</label>
                            <input type="text" name="idType" value="'.$row['idType'].'">
                        </div>

                        <div class="form-input">
                            <label>Tên loại sản phẩm</label>
                            <input type="text" name="nameType" value="'.$row['nameType'].'">
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
        include_once("controller/cType.php");
        $update = $p->cUpdateType($_POST['idType'], $_POST['nameType']);

        if($update == true) {
            echo "<script>alert('Cập nhật thông tin loại sản phẩm thành công')</script>";
            header("refresh:0.1;url=index.php?act=admin&func=viewTypeProducts");
            exit();
        }else {
            echo "<script>alert('Cập nhật thông tin không thành công')</script>";
            header("refresh:0.1;url=index.php?act=admin&func=updateTypeProduct");
            exit();
        }
    }
?>