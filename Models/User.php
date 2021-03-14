<?php

/**
 * @property Connection connection
 */
class User
{
    public  $id;
    public  $username;
    public  $password;
    public  $email;
    public  $name;
    public  $deleted;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    public static function table()
    {
       return 'users' ;
    }

    /**
     * @return $this
     */
    public function auth(): \User
    {
        if (isset($_SESSION)) {
            $this->setAttributes($_SESSION);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $query = "SELECT *
                  FROM users
                  WHERE deleted = 0;
                 ";
        $query = $this->connection->query($query);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function one(int $id): User
    {
        $query = "SELECT *
                  FROM users
                  WHERE deleted = 0
                  AND  id = $id;
                 ";
        $query = $this->connection->query($query);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $this->setAttributes($result);

        return $this;
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function findOneBy(array $criteria)
    {
        $sql = "SELECT *
                FROM users
                WHERE deleted = 0";

        foreach ($criteria as $key => $item) {
            $sql.=" AND {$key} = '{$item}' ";
        }

        $query = $this->connection->query($sql);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $username
     * @return bool
     */
    public function exist($username): bool
    {
        $user = $this->findOneBy(["username" => $username]);

        return !empty($user);
    }

    /**
     * @param array $params
     * @return $this|false
     */
    public function store(array $params)
    {
        $this->setAttributes($params);
        if ($this->exist($_POST['username'])) {
            $_GET['msg'] = "El usuario {$_POST['username']} ya existe";
            return false;
        }

        try {
            $query =  $this->connection
                ->prepare("
                INSERT INTO users(username,email, password, name) 
                VALUES (:username,:email,:password,:name)
            ");

            $query->bindParam("username", $this->username,PDO::PARAM_STR) ;
            $query->bindParam("email", $this->email,PDO::PARAM_STR) ;
            $query->bindParam("password", $this->password,PDO::PARAM_STR) ;
            $query->bindParam("name", $this->name,PDO::PARAM_STR) ;
            $query->execute();

            $this->id = $this->connection->lastInsertId();
            $_GET['msg'] = "{$_POST['username']} creado con éxito.";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this;
    }

    /**
     * @param $params
     * @return $this
     */
    public function update($params)
    {
        $this->setAttributes($params);
        try {
            $query =  $this->connection
                ->prepare("
                    UPDATE users 
                    SET email =:email, password=:password, name=:name
                    WHERE id =:id");

            $query->bindParam("id", $this->id,PDO::PARAM_INT) ;
            $query->bindParam("email", $this->email,PDO::PARAM_STR) ;
            $query->bindParam("password", $this->password,PDO::PARAM_STR) ;
            $query->bindParam("name", $this->name,PDO::PARAM_STR) ;
            $query->execute();

            $_GET['msg'] = "Usuario {$this->id} modificado con éxito.";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this;
    }

    public function destroy($id)
    {
        $sql = "UPDATE users 
                SET deleted = true
                WHERE id =:id";
        try {
            $query =  $this->connection->prepare($sql);
            $query->bindParam("id", $id,PDO::PARAM_INT) ;
            $query->execute();
            $msg = "Usuario {$id} eliminado con éxito.";
            header('Location: http://'.$_SERVER['SERVER_NAME'].'/prueba_yellducal/views/users?msg='.$msg);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    /**
     * @param $attributes
     * @return $this
     */
    public function setAttributes($attributes): \User
    {
        if (isset($attributes['id'])) {
            $this->id = $attributes['id'];
        }

        if (isset($attributes['username'])) {
            $this->username = $attributes['username'];
        }

        if (isset($attributes['password'])) {
            $this->password = $attributes['password'];
        }

        if (isset($attributes['email'])) {
            $this->email = $attributes['email'];
        }

        if (isset($attributes['name'])) {
            $this->name = $attributes['name'];
        }

        if (isset($attributes['deleted'])) {
            $this->deleted = $attributes['deleted'];
        }

        return $this;
    }
}