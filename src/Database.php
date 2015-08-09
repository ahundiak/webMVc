<?php
namespace SkooppaOS\webMVc;

/**
 * Our database class for connecting to sqlite.
 */

use \PDO;
use \PDOException;

class Database{

    private $dbname    = 'testdb';
    private $fileLocation = '/opt/testdata/';

    private $db;
    public  $error;
    private $statement;

    /**
     * Our constructor.
     */
    public function __construct()
    {
        // Set DSN
        $dsn = 'sqlite:'.$this->fileLocation.$this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instance
        $this->db = new PDO($dsn);
        try{
            $this->db = new PDO($dsn);
            $this->db->setAttribute(PDO::ATTR_ERRMODE,
                            PDO::ERRMODE_EXCEPTION);

        }
            // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    /**
     * This function sets up the SQL statement to be executed.
     * @param $query
     */
    public function query($query)
    {
        $this->statement = $this->db->prepare($query);
    }

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
        $this->statement->bindParam($param, $value, $type);
    }

    /**
     * Executes the SQL statement.
     * @return mixed
     */
    public function execute()
    {
        return $this->statement->execute();
    }

    /**
     * Returns the results found by a query.
     * @return mixed
     */
    public function resultset()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Returns a single result found by a query.
     * @return mixed
     */
    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Returns the id, when a record has been created.
     * @return string
     */
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    /**
     * This is a debug method, to help solve query problems.
     * @param $query
     * @return bool
     */
    public function debugQuery($query)
    {
        return $this->db->query($query)->debugDumpParams();
    }
}