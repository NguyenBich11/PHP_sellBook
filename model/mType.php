<?php 
    include_once("mConnect.php");
    class mType {
        public function mGetAllType() {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $sqlTypeOfProduct = "SELECT * FROM typeproduct";
                $tblTypeOfProduct = $conn->query($sqlTypeOfProduct);

                if($tblTypeOfProduct) {
                    return $tblTypeOfProduct; //co bang
                }else {
                    return null; //khong co du lieu
                }
            }else {
                return null; //loi ket noi
            }

            $p->mClose($conn);
        }

        public function mGetTypeByID($idType) {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $sqlType = "SELECT * FROM typeproduct WHERE idType = '$idType'";
                $tblType = $conn->query($sqlType);

                if($tblType) {
                    return $tblType; //co bang
                }else {
                    return false; //khong co du lieu
                }
            }else {
                return false; //loi ket noi
            }

            $p->mClose($conn);
        }


        public function mUpdateType($idType, $nameType) {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $sqlUpdate = "UPDATE typeproduct SET idType='$idType',nameType='$nameType' WHERE idType = '$idType'";
                $resultUpdate = $conn->query($sqlUpdate);

                if($resultUpdate) {
                    return $resultUpdate;
                }else {
                    return false;
                }
            }else {
                return false;
            }

            $p->mClose($conn);
        }

        public function mDeleteType($idType) {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                // First check if any products use this type
                $checkSQL = "SELECT COUNT(*) as count FROM product WHERE idTypeOfProduct = '$idType'";
                $checkResult = $conn->query($checkSQL);
                $row = $checkResult->fetch_assoc();
                
                if($row['count'] > 0) {
                    return -1; // Type is in use
                }

                // If no products use this type, proceed with deletion
                $sqlDelete = "DELETE FROM typeproduct WHERE idType = '$idType'";
                $resultDelete = $conn->query($sqlDelete);

                if($resultDelete){
                    return true;
                }
                return false;
            }
            return false;

            $p->mClose($conn);
        }

        public function mAddTypeProduct($nameType) {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $sqlAddTypeProduct = "INSERT INTO typeproduct(nameType) VALUES ('$nameType')";
                $resultAdd = $conn->query($sqlAddTypeProduct);
                
                if($resultAdd) {
                    return true;
                }else {
                    return false;
                }
            }else {
                return false;
            }

            $p->mClose($conn);
        }
    }
?>