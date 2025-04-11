<?php 
    include_once("mConnect.php");
    class mProduct {
        public function mgetProductByType($idType) {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $strGetProduct = "SELECT * FROM product p JOIN typeproduct top on p.idTypeOfProduct = top.idType WHERE top.idType = '$idType'";
                $resultGet = $conn->query($strGetProduct);

                if($resultGet) {
                    return $resultGet;
                }else {
                    return false;
                }
            }else {
                return false;
            }

            $p->mClose($conn);
        }

        public function mGetAllProduct() {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $strSelectAllProduct = "SELECT * FROM product p JOIN typeproduct tp ON p.idTypeOfProduct = tp.idType";
                $tblProduct = $conn->query($strSelectAllProduct);

                if($tblProduct) {
                    return $tblProduct;
                }else {
                    return false;
                }
            }else {
                return false;
            }

            $p->mClose($conn);
        }

        public function mGetProductById($idProduct) {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $sqlSelect = "SELECT * FROM product WHERE idProduct = '$idProduct'";
                $tableProduct = $conn->query($sqlSelect);

                if($tableProduct) {
                    return $tableProduct;
                }else {
                    return false;
                }
            }else {
                return false;
            }

            $conn->mClose($conn);
        }

        public function mUpdateProduct($idProduct, $nameProduct, $sellPrice, $costPrice, $idTypeOfProduct, $image, $yearOfPublish) {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $sqlUpdate = "UPDATE product SET idProduct='$idProduct',nameProduct='$nameProduct',
                sellPrice='$sellPrice',costPrice='$costPrice',idTypeOfProduct='$idTypeOfProduct',image='$image',
                yearOfPublish='$yearOfPublish' WHERE idProduct = '$idProduct'";
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

        public function mAddProduct($idProduct, $nameProduct, $sellPrice, $costPrice, $idTypeOfProduct, $image, $yearOfPublish) {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $sqlAddProduct = "INSERT INTO product(idProduct, nameProduct, sellPrice, costPrice, idTypeOfProduct, image, yearOfPublish) 
                VALUES ('$idProduct','$nameProduct','$sellPrice','$costPrice','$idTypeOfProduct','$image','$yearOfPublish')";
                $resultAddProduct = $conn->query($sqlAddProduct);

                if($resultAddProduct) {
                    return $resultAddProduct;
                }else {
                    return false;
                }
            }else {
                return false;
            }

            $p->mClose($conn);
        }

        public function mDeleteProduct($idProduct) {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $sqlDelete = "DELETE FROM product WHERE idProduct = '$idProduct'";
                $resultDelete = $conn->query($sqlDelete);

                if($resultDelete){
                    return true;
                }else {
                    return false;
                }
            }else {
                return false;
            }

            $p->mClose($conn);
        }

        public function mSearchProducts($searchTerm) {
            $p = new mConnect();
            $conn = $p->mOpen();

            if($conn) {
                $searchTerm = $conn->real_escape_string($searchTerm);
                $sql = "SELECT * FROM product WHERE 
                       nameProduct LIKE '%$searchTerm%' OR 
                       yearOfPublish LIKE '%$searchTerm%'";
                
                $tblProduct = $conn->query($sql);
                
                if($tblProduct->num_rows > 0) {
                    return $tblProduct;
                }
            }
            return false;
        }
    }
?>