<?php 
    class mConnect{
        public function mOpen() {
            $host = 'localhost';
            $username = '';
            $password = '';
            $db = '';

            return mysqli_connect($host, $username, $password, $db);
        }

        public function mClose($conn) {
            $conn->close();
        }
    }
?>