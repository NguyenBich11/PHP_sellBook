<h2 class="title-page">Xem sản phẩm</h2>
<table class="table-product">
    <thead>
        <tr>
            <th>Số thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Giá bán</th>
            <th>Giá gốc</th>
            <th>Loại sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Năm xuất bản</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include_once("controller/cProduct.php");
            $p = new cProduct();
            $tblProduct = $p->cGetAllProduct();

            if(!$tblProduct) {
                echo "Không có dữ liệu";
            }elseif($tblProduct->num_rows > 0) {
                $i = 1;
                while($row = $tblProduct->fetch_assoc()) {
                    echo '
                    <tr>
                        <td>'.$i++.'</td>
                        <td>'.$row['nameProduct'].'</td>
                        <td>'.number_format($row['sellPrice']).'</td>
                        <td>'.number_format($row['costPrice']).'</td>
                        <td>'.$row['nameType'].'</td>
                        <td>
                            <img src="'.$row['image'].'" alt="'.$row['nameProduct'].'" class="product-image">
                        </td>
                        <td>'.$row['yearOfPublish'].'</td>
                        <td class="action-buttons">
                            <form action="index.php?act=admin&func=updateProduct" method="POST" name="formProduct">
                                <input type="hidden" name="idProduct" value="'.$row['idProduct'].'">
                                <button type="submit" class="btn-edit">Sửa</button>
                            </form>
                            <form action="#" method="POST" name="formDelete">
                                <input type="hidden" name="idProductDelete" value="'.$row["idProduct"].'">
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
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idProductDelete'])) {
        include_once("controller/cProduct.php");
        $p = new cProduct();
        $idProduct = $_POST['idProductDelete'];
        $resultDelete = $p->cDeleteProduct($idProduct);

        if($resultDelete == true) {
            echo "<script>
                alert('Xóa thành công sản phẩm');
                window.location.href = 'index.php?act=admin&func=viewProducts';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Xóa không thành công');
                window.location.href = 'index.php?act=admin&func=viewProducts';
            </script>";
            exit();
        }
    }
?>