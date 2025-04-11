<h2 class="title-page">Xem loại sản phẩm</h2>
<table class="table-product">
    <thead>
        <tr>
            <th>Số thứ tự</th>
            <th>Tên loại sản phẩm</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include_once("controller/cType.php");
            $p = new cType();
            $tblProduct = $p->cgetAllType();

            if(!$tblProduct) {
                echo "Không có dữ liệu";
            }elseif($tblProduct->num_rows > 0) {
                $i = 1;
                while($row = $tblProduct->fetch_assoc()) {
                    echo '
                    <tr>
                        <td>'.$i++.'</td>
                        <td>'.$row['nameType'].'</td>
                        <td class="action-buttons">
                            <form action="index.php?act=admin&func=updateTypeProduct" method="POST" name="formType">
                                <input type="hidden" name="idType" value="'.$row['idType'].'">
                                <button type="submit" class="btn-edit">Sửa</button>
                            </form>
                            <form action="#" method="POST" name="formDeleteType">
                                <input type="hidden" name="idTypeDelete" value="'.$row["idType"].'">
                                <button type="submit" class="btn-delete" onClick="return confirm(\'Bạn có chắc muốn xóa\')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>';
                }
            }
        ?>
    </tbody>
</table>
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idTypeDelete'])) {
        include_once("controller/cType.php");
        $p = new cType();
        $idType = $_POST['idTypeDelete'];
        $resultDelete = $p->cDeleteType($idType);

        if($resultDelete === -1) {
            echo "<script>
                    alert('Không thể xóa loại sản phẩm này vì đang có sản phẩm thuộc loại này!');
                    
                </script>";
        } elseif($resultDelete === true) {
            echo "<script>alert('Xóa thành công loại sản phẩm')</script>";
        } else {
            echo "<script>alert('Xóa không thành công')</script>";
        }

        echo '<script>window.location.href = \'index.php?act=admin&func=viewTypeProducts\';</script>';
    }
?>