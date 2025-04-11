<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/style/style.css">
    <title>Nguyễn Thị Ngọc Bích - 22637851</title>
</head>
<body>
    <header class="header">
        <img src="view/img/header.jpg" alt="header">
    </header>
    <main class="main">
        <nav class="nav">
            <a href="index.php?act=home">Trang chủ</a> |
            <?php 
                if(isset($_SESSION['login'])) {
                    if($_SESSION['role'] == 1) {
                        echo '<a href="index.php?act=admin">Quản lí sản phẩm</a> |';
                    }
                    echo '<a href="index.php?act=logout" onClick="return confirm(\'Bạn có thực sự muốn đăng xuất?\')"> Đăng xuất</a>';
                }
                else {
                    echo '
                    <a href="index.php?act=register">Đăng ký</a> | 
                    <a href="index.php?act=login">Đăng nhập</a>';
                }
            ?>
        </nav>
        <section class="section">
            <?php 
                if(isset($_SESSION['login']) && $_SESSION['role'] == 1 && isset($_GET['act']) && $_GET['act'] == 'admin') { 
            ?>
            <nav class="type">
                <h2>Chức năng quản lý</h2>
                <a href="index.php?act=admin&func=viewProducts">Xem sản phẩm</a> <br>
                <a href="index.php?act=admin&func=viewTypeProducts">Xem loại sản phẩm</a> <br>
                <a href="index.php?act=admin&func=addProduct">Thêm sản phẩm</a> <br>
                <a href="index.php?act=admin&func=addTypeProduct">Thêm loại sản phẩm</a> <br>
            </nav>
            <main class="product">
                <?php
                    if(isset($_GET['func'])) {
                        switch($_GET['func']) {
                            case 'viewProducts': include("view/admin/viewProducts.php"); break;
                            case 'viewTypes': include("view/admin/viewTypes.php"); break;
                            case 'addProduct': include("view/admin/addProduct.php"); break;
                            case 'updateProduct': include("view/admin/updateProduct.php"); break;
                            case 'updateTypeProduct': include("view/admin/updateTypeProduct.php"); break;
                            case 'addTypeProduct': include("view/admin/addTypeProduct.php"); break;
                            case 'viewTypeProducts': include("view/admin/viewTypeProducts.php"); break;
                            default: echo 'Chào mừng đến với trang Quản trị sản phẩm'; break;
                        }
                    }
                ?>
            </main>
            <?php } else { ?>
                <nav class="type">
                    <h2>Loại sản phẩm</h2>
                    <?php 
                        include("controller/cType.php");
                        $p = new cType();
                        $tblType = $p->cgetAllType();

                        if($tblType) {
                            while($row = $tblType->fetch_assoc()) {
                                echo '<a href="index.php?type='.$row['idType'].'">'.$row['nameType'].'</a> <br>';
                            }
                        }
                    ?>
                </nav>
                <main class="product"> 
                    <?php 
                        $act = isset($_GET['act']) ? $_GET['act'] : 'home';
                        switch($act) {
                            case 'login': include("view/login.php"); break;
                            case 'register': include("view/register.php"); break;
                            case 'logout': include("view/logout.php"); break;
                            default: include("view/home.php"); break;
                        }
                    ?>
                </main>
            <?php } ?>
        </section>
    </main>
    <script>
        // Get current URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const currentFunc = urlParams.get('func');
        
        // Get all navigation links
        const navLinks = document.querySelectorAll('.type a');
        
        // Add active class to current page link
        navLinks.forEach(link => {
            const linkFunc = link.href.split('func=')[1];
            if (linkFunc === currentFunc) {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>