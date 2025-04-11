<h2>Sản phẩm</h2>

<div class="search-container">
    <form action="" method="GET">
        <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" class="btn-search">Tìm kiếm</button>
    </form>
</div>

<div class="container-product">

    <?php 
        include_once("controller/cProduct.php");
        $p = new cProduct();
        
        if(isset($_GET['type'])) {
            $idType = $_GET['type'];
            $resultProduct = $p->cgetProductByType($idType);
        } elseif(isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $resultProduct = $p->cSearchProducts($searchTerm);
        } else {
            $resultProduct = $p->cGetAllProduct();
        }

        if($resultProduct && $resultProduct->num_rows > 0) {
            while($row = $resultProduct->fetch_assoc()) {
                echo '
                <div class="items">
                    <img src="'.$row['image'].'">
                    <span class="item-name">'.$row['nameProduct'].'</span>
                    <span class="item-sellingPrice">'.number_format($row['sellPrice']).' đ</span>
                    <span class="item-costPrice">'.number_format($row['costPrice']).' đ</span>
                    <span class="item-year">'.$row['yearOfPublish'].'</span>
                </div>
                ';
            }
        } else {
            echo "<p class='no-results'>Không tìm thấy sản phẩm</p>";
        }
    ?>
</div>