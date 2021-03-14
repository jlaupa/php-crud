<?php
require_once $_SERVER['DOCUMENT_ROOT'].'\prueba_yellducal\config\Connection.php';
class Login
{
    public function session()
    {
        session_start();
        if (!isset($_SESSION['username']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
            header('Location:http://'.$_SERVER['SERVER_NAME'].'/prueba_yellducal/views/login.php');
        }
    }

    /**
     * @param array $params
     */
    public function verify(array $params)
    {
        $connection = new Connection();
        $username = $_POST['username'];
        $password = $_POST['password'];
        //$password = sha1(md5($password));

        $query = "SELECT *
                  FROM users
                  WHERE username = '{$username}' 
                  AND password = '{$password}';
                 ";

        $query = $connection->query($query);
        $count = $query->rowCount();
        $result = $query->fetch(PDO::FETCH_OBJ);

        if ($count > 0) {
            $_SESSION = (array) $result;
            header('Location: http://'.$_SERVER['SERVER_NAME'].'/prueba_yellducal/views/users');
        } else {
            $_GET['msg'] = "¡Error al ingresar usuario y contraseña!";
        }

    }

    public function destroy()
    {
        session_destroy();
        header('Location:http://'.$_SERVER['SERVER_NAME'].'/prueba_yellducal/views/login.php');
    }
}