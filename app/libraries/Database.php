<?php

/**
 * PDO Database class.
 * Connects to database, create prepared statements, binds values, and return results.
 */
class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $password = DB_PASS;
  private $db_name = DB_NAME;
  private $dbh;
  private $stmt;
  private $error;

  public function __construct()
  {
    // Set the DSN
    $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
    $options = array(
      PDO::ATTR_PERSISTENT => true, // Keeps persistent connection
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Error handling title
    );

    // Create new PDO instance
    try {
      $this->dbh = new PDO($dns, $this->user, $this->password, $options);
    } catch (PDOException $error) {
      $this->error = $error->getMessage();
      echo $this->error;
    }
  }

  // Prepare statement with queries
  public function query($sql)
  {
    $this->stmt = $this->dbh->prepare($sql);
  }

  // Bind query values
  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  // Execute query
  public function execute_query()
  {
    return $this->stmt->execute();
  }

  // Get results as object
  public function result_set()
  {
    $this->execute_query();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Get a single result
  public function result_single()
  {
    $this->execute_query();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  // Get row count
  public function row_count()
  {
    return $this->stmt->rowCount();
  }
}
