<?php
require_once '../Models/Login.php';
require_once '../header.php';

/* Login Form */
if (!empty($_POST['login'])) {
    $params['username'] = $_POST['username'];
    $params['password'] = $_POST['password'];

    if (
        strlen(trim($params['username'])) > 1 &&
        strlen(trim($params['password'])) > 1
    ) {
        $login->verify($params);
    }
}
?>
<div class="container">
    <div class="row center">
        <div class="col s12">
            <h1 class="jumbotron teal lighten-2 white-text center" >
                Yellducal
            </h1>
            <?php
                if (isset($_GET['msg'])) {
                    echo "<div class='col s12 center'>";
                    echo "<span class='bg-danger'>".$_GET['msg']."</span>";
                    echo "</div>";
                }
            ?>

            <div class="col s12">
                <form role="form" method="post" action="">
                    <div class="input-field">
                        <input id="username" name="username" type="text" class="validate">
                        <label for="username">Username</label>
                    </div>
                    <div class="input-field">
                        <input id="password" name="password" type="password" class="validate" type="password">
                        <label for="password">Password</label>
                    </div>
                    <input type="submit" class="btn waves-effect waves-light" name="login" value="login">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../footer.php';
?>