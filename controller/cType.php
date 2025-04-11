<?php 
    include("model/mType.php");

    class cType{
        public function cgetAllType() {
            $p = new mType();
            $tblType = $p->mGetAllType();

            if(!$tblType) {
                return false;
            }

            return $tblType;
        }

        public function cgetTypeByID($idType) {
            $p = new mType();
            $tblType = $p->mGetTypeByID($idType);

            if(!$tblType) {
                return false;
            }

            return $tblType;
        }

        public function cUpdateType($idType, $nameType) {
            $p = new mType();
            $resultUpdate = $p-> mUpdateType($idType, $nameType);

            if(!$resultUpdate) {
                return false;
            }

            return true;
        }
        
        public function cDeleteType($idType) {
            $p = new mType();
            $resultDelete = $p->mDeleteType($idType);
            return $resultDelete; // Will return -1, true, or false
        }

        public function cAddTypeProduct($nameType) {
            $p = new mType();
            $resultAdd = $p->mAddTypeProduct($nameType);

            if(!$resultAdd) {
                return false;
            }

            return true;
        }
    }
?>