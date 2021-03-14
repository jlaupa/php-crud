<?php
class Connection extends PDO
{
    private $tipo_de_base = 'mysql';
    private $host = '127.0.0.1';
    private $nombre_de_base = 'yellducal';
    private $usuario = 'root';
    private $contrasena = '';

    public function __construct()
    {
        try {
            @parent::__construct(
                $this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base,
                $this->usuario,
                $this->contrasena
            );
            @parent::query("SET NAMES 'utf8';");
        } catch (PDOException $e){
            echo json_encode('Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage());
            exit;
        }
    }
}