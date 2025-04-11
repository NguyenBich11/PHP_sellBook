<?php 
    include("model/mProduct.php");
    class cProduct{
        public function cgetProductByType($idType) {
            $p = new mProduct();
            $tblProductByType = $p->mgetProductByType($idType);

            if(!$tblProductByType) {
                return false; //không có sản phẩm
            }
            
            return $tblProductByType;
        }

        public function cGetAllProduct() {
            $p = new mProduct();
            $tblAllProduct = $p->mGetAllProduct();

            if(!$tblAllProduct) {
                return false;
            }

            return $tblAllProduct;
        }

        public function cGetProductById($idProduct) {
            $p = new mProduct();
            $tblProduct = $p->mGetProductById($idProduct);

            if(!$tblProduct) {
                return false;
            }

            return $tblProduct;
        }

        public function cUpdateProduct($idProduct, $nameProduct, $sellPrice, $costPrice, $idTypeOfProduct, $image, $yearOfPublish) {
            $p = new mProduct();
            $resultUpdate = $p->mUpdateProduct($idProduct, $nameProduct, $sellPrice, $costPrice, $idTypeOfProduct, $image, $yearOfPublish);

            if(!$resultUpdate) {
                return false;
            }

            return true;
        }

        public function cAddProduct($idProduct, $nameProduct, $sellPrice, $costPrice, $idTypeOfProduct, $image, $yearOfPublish) { 
            $p = new mProduct();
            $resultAddProduct = $p->mAddProduct($idProduct, $nameProduct, $sellPrice, $costPrice, $idTypeOfProduct, $image, $yearOfPublish);

            if(!$resultAddProduct) {
                return false;
            }

            return true;
        }

        public function cDeleteProduct($idProduct) {
            $p = new mProduct();
            $resultDelete = $p->mDeleteProduct($idProduct);

            if(!$resultDelete) {
                return false;
            }

            return true;
        }

        public function cSearchProducts($searchTerm) {
            $p = new mProduct();
            $tblProduct = $p->mSearchProducts($searchTerm);
            
            if(!$tblProduct) {
                return false;
            }
            return $tblProduct;
        }
    }
?>