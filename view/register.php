<div class="auth-container">
    <h2>Đăng ký</h2>
    <form action="#" method="POST" name="formRegister">
        <div class="input-form">
            <label>Tên đăng ký</label>
            <input type="text" name="username">
        </div>

        <div class="input-form">
            <label>Mật khẩu</label>
            <input type="password" name="password">
        </div>

        <div class="input-form">
            <label>Nhập lại mật khẩu</label>
            <input type="password" name="repassword">
        </div>

        <div class="button-group">
            <input type="reset" value="Đặt lại">
            <input type="submit" value="Đăng ký" name="btnRgister">
        </div>
    </form>
</div>

<?php 
    // echo "<script>alert('kiểm tra register')</script>";
    if(isset($_REQUEST['btnRgister'])) {
        include("controller/cUser.php");
        // echo "<script>alert('sau khi includeS')</script>";
        $p = new cUser();
        $result = $p->cRegister($_POST['username'], $_POST['password']);
    }
?>