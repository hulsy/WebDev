<!--
    Student Name: Alex Hulford
    Student Number: 041066068
    Date: April 2, 2023
    Description: Lab Assignment 2. This is the pokemonDAO class for the Pokedex application.
    It contains methods for retrieving and updating pokemon data.
-->

<?php
require_once('abstractDAO.php');
require_once('./model/pokemon.php');

//pokemonDAO class extends abstractDAO, defines methods for retrieving and updating pokemon data
class pokemonDAO extends abstractDAO
{
    //constructor for pokemonDAO
    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }
    //method for getting a pokemon by id from the database using SELECT query
    public function getPokemon($pokemonId)
    {
        $query = 'SELECT * FROM my_pokemon WHERE id = ?';
        //prepared statement
        $stmt = $this->mysqli->prepare($query);
        //bind parameter to an integer value
        $stmt->bind_param('i', $pokemonId);
        $stmt->execute();
        $result = $stmt->get_result();
        //if there is a result, create a new pokemon object and return it
        if ($result->num_rows == 1) {
            $temp = $result->fetch_assoc();
            $pokemon = new Pokemon($temp['id'], $temp['name'], $temp['type'], $temp['level'], $temp['img'], $temp['date']);
            $result->free();
            return $pokemon;
        }
        $result->free();
        return false;
    }

    //method for getting all pokemon from the database using SELECT * query and putting them into an array
    public function getAllPokemon()
    {
        $result = $this->mysqli->query('SELECT * FROM my_pokemon');
        $allPokemon = array();

        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                $pokemon = new Pokemon($row['id'], $row['name'], $row['type'], $row['level'], $row['img'], $row['date']);
                $allPokemon[] = $pokemon;
            }
            $result->free();
            return $allPokemon;
        }
        $result->free();
        return false;
    }
    //method for adding a pokemon to the database using INSERT query
    public function addPokemon($pokemon)
    {
        //if there is no error connecting to the database
        if (!$this->mysqli->connect_errno) {
            //query to insert a new pokemon into the database
            $query = 'INSERT INTO my_pokemon (name, type, level, img, date) VALUES (?,?,?,?,?)';
            //prepared statement
            $stmt = $this->mysqli->prepare($query);
            if ($stmt) {
                $name = $pokemon->getName();
                $type = $pokemon->getType();
                $level = $pokemon->getLevel();
                $img = $pokemon->getImg();
                //if the date is null, set it to the current date
                if ($pokemon->getDate() == null) {
                    $date = date('Y-m-d');
                } else {
                    $date = $pokemon->getDate();
                }
                //bind parameters to the query
                $stmt->bind_param(
                    'ssiss',
                    $name,
                    $type,
                    $level,
                    $img,
                    $date
                );
                $stmt->execute();
                //if there is an error, return the error, otherwise return a success message
                if ($stmt->error) {
                    return $stmt->error;
                } else {
                    return $pokemon->getName() . ' added successfully!';
                }
            } else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error;
                return $error;
            }
        } else {
            return 'Could not connect to Database.';
        }
    }
    //method for updating a pokemon in the database using UPDATE query
    public function updatePokemon($pokemon)
    {
        //if there is no error connecting to the database
        if (!$this->mysqli->connect_errno) {
            //query to update a pokemon in the database where the id matches the id of the pokemon passed in
            $query = "UPDATE my_pokemon SET name=?, type=?, level=?, img=?, date=? WHERE id=?";
            //prepared statement
            $stmt = $this->mysqli->prepare($query);
            if ($stmt) {
                $id = $pokemon->getId();
                $name = $pokemon->getName();
                $type = $pokemon->getType();
                $level = $pokemon->getLevel();
                $img = $pokemon->getImg();
                //if the date is null, set it to the current date
                if ($pokemon->getDate() == null) {
                    $date = date('Y-m-d');
                } else {
                    $date = $pokemon->getDate();
                };
                //bind parameters to the query
                $stmt->bind_param(
                    'ssissi',
                    $name,
                    $type,
                    $level,
                    $img,
                    $date,
                    $id
                );
                //Execute the statement
                $stmt->execute();

                if ($stmt->error) {
                    return $stmt->error;
                } else {
                    return $pokemon->getName() . ' updated successfully!';
                }
            } else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error;
                return $error;
            }
        } else {
            return 'Could not connect to Database.';
        }
    }
    //method for deleting a pokemon from the database using DELETE query
    public function deletePokemon($pokemonId)
    {
        //if there is no error connecting to the database
        if (!$this->mysqli->connect_errno) {
            //query to delete a pokemon from the database where the id matches the id of the pokemon passed in
            $query = 'DELETE FROM my_pokemon WHERE id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $pokemonId);
            $stmt->execute();
            if ($stmt->error) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
