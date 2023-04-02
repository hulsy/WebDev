<!--
 Student Name: Alex Hulford
 Student Number: 041066068
 Date: April 2, 2023
 Description: Lab Assignment 2. This is the pokemon class for the Pokedex application.
 It contains the properties and methods for the Pokemon objects.
-->

<?php

// Pokemon class for creating Pokemon objects, contains getters and setters for each property and a constructor
class Pokemon
{
    //properties for Pokemon
    private $id;
    private $name;
    private $type;
    private $level;
    private $img;
    private $date;
    //constructor for Pokemon
    function __construct($id, $name, $type, $level, $img, $date)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setType($type);
        $this->setLevel($level);
        $this->setImg($img);
        $this->setDate($date);
    }
    //getters and setters for Pokemon properties
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

    public function getImg()
    {
        return $this->img;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
