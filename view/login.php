<div class="auth-container">
    <h2>Đăng nhập</h2>
    <form action="#" method="POST" name="formLogin">
        <div class="input-form">
            <label>Tên đăng nhập</label>
            <input type="text" name="username">
        </div>

        <div class="input-form">
            <label>Mật khẩu</label>
            <input type="password" name="password">
        </div>

        <div class="button-group">
            <input type="reset" value="Đặt lại">
            <input type="submit" value="Đăng nhập" name="btnLogin">
        </div>
    </form>
</div>

<?php 
    if(isset($_POST['btnLogin'])) {
        include("controller/cUser.php");
        $p = new cUser();
        $resultLogin = $p->cLogin($_POST['username'], $_POST['password']);

        
    }
?>