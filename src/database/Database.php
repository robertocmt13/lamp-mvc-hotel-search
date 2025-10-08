<?php
/**
 * Clase Database
 * Encapsula la conexión a MySQL usando MySQLi.
 * Se asegura de usar siempre UTF-8 (utf8mb4).
 */
class Database {
  private $conn;

  public function __construct(Array $config)
  {
    // Crear conexión
    $this->conn = new mysqli(
      $config['db_host'],
      $config['db_user'],
      $config['db_pass'],
      $config['db_name']
    );

    // Manejar error de conexión
    if ($this->conn->connect_error) {
      die("Error de conexión: " . $this->conn->connect_error);
    }

    // Forzar UTF-8 completo para soportar idiomas internacionales
    $this->conn->set_charset("utf8mb4");
  }

  // Devuelve la conexión para que el controlador la use
  public function getConnection(): mysqli
  {
      return $this->conn;
  }
}