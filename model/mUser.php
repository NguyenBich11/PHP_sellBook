<?php 
    include_once("mConnect.php");
    class mUser{
        public function mLogin($username, $password) {
            $p = new mConnect();
            $conn = $p->mOpen();
            $sqlLogin = "SELECT * FROM user WHERE username = '$username' and password = '$password'";

            if($conn) {
                return $conn->query($sqlLogin);
            }else {
                return false; //khong ket noi duoc voi csdl
            }

            $p->mClose();
        }

        public function mRegister($username, $password) {
            $p = new mConnect();
            $conn = $p->mOpen();
            $selectSQl = "SELECT * FROM user WHERE username = '$username'";
            $rsSelect = $conn->query($selectSQl);

            if($rsSelect->num_rows > 0) {
                return 2; //đã co người dùng
            }else {
                $insertSQl = "INSERT INTO user(username, password, idRole) VALUES('$username', '$password', '3')";
                $rs = $conn->query($insertSQl);

                if($rs) {
                    return 4; //đăng ký thành công
                }else {
                    return 5; //đăng ký không thành công
                }
            }

            $conn->nClose($conn);
        }

    }
?>