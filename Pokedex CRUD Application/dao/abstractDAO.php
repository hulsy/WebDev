<!--
    Student Name: Alex Hulford
    Student Number: 041066068
    Date: April 2, 2023
    Description: Lab Assignment 2. This is the abstractDAO class for the Pokedex application.
    It contains the database connection details and a constructor for the DAOs to extend.
-->

<?php

mysqli_report(MYSQLI_REPORT_STRICT);

// Abstract class for data access objects to extend with database connection details
class abstractDAO
{
    // Database connection details
    protected $mysqli;
    protected static $DB_HOST = "localhost";
    protected static $DB_PORT = 3306;
    protected static $DB_USERNAME = "appuser";
    protected static $DB_PASSWORD = "password";
    protected static $DB_DATABASE = "pokemon";

    // Constructor for abstractDAO
    function __construct()
    {
        try {
            $this->mysqli = new mysqli(
                self::$DB_HOST,
                self::$DB_USERNAME,
                self::$DB_PASSWORD,
                self::$DB_DATABASE,
                self::$DB_PORT
            );
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }
    //getter for mysqli
    public function getMysqli()
    {
        return $this->mysqli;
    }
}
