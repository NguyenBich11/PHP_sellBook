<?php 
    include("model/mUser.php");

    class cUser{
        public function cLogin($username, $password) {
            $p = new mUser();
            $password = md5($password);
            $tblUser = $p->mLogin($username, $password);

            if(!$tblUser) {
                echo "<script>alert('Lỗi kết nối')</script>";
            }elseif($tblUser->num_rows > 0) {
                echo "<script>alert('Đăng nhập thành công')</script>";

                if($row = $tblUser->fetch_assoc()) {
                    $_SESSION['login'] = true;
                    $_SESSION['role'] = $row['idRole'];

                    if($row['idRole'] == 1) {
                        header("refresh:0.1;url=index.php?act=admin");
                        exit();
                    }else {
                        header("refresh:0.1;url=index.php");
                        exit();
                    }
                }
            }else {
                echo "<script>alert('Sai thông tin đăng nhập')</script>";
            }
        }

        public function cRegister($username, $password) {
            $p = new mUser();
            $passw = md5($password);
            $checkUser = $p->mRegister($username, $passw);
            
            if($checkUser == 2) {
                echo "<script>alert('Đã có người dùng')</script>";
            }elseif($checkUser == 4) {
                echo "<script>alert('Đăng ký thành công')</script>";
            }else {
                echo "<script>alert('Đăng ký không thành công')</script>";
            }
        }
    }
?>