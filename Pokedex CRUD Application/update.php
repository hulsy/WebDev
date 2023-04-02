<!--
    Student Name: Alex Hulford
    Student Number: 041066068
    Date: April 2, 2023
    Description: Lab Assignment 2. This is the update page for the Pokedex application.
    It allows the user to update a Pokemon's details and image file path.
-->

<?php
require_once('./dao/pokemonDAO.php');

// Define variables and initialize with empty values
$name = $type = $level = $img = $date = "";
$name_err = $type_err = $level_err = $date_err = "";
//Create a new pokemonDAO object
$pokemonDAO = new pokemonDAO();

// if id is not empty, allow the user to update the Pokemon's details
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    // Validate name (between 3-11 characters)
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter your Pokemon's name.";
    } elseif (strlen($input_name) < 3 || strlen($input_name) > 11) {
        $name_err = "Please enter a valid name between 3-11 characters.";
    } else {
        $name = $input_name;
    }
    // Validate type (elemental type)
    $input_type = trim($_POST["type"]);
    if (empty($input_type)) {
        $type_err = "Please enter the elemental type of your Pokemon.";
    } else {
        $type = $input_type;
    }
    // Validate level (between 1-100)
    $input_level = trim($_POST["level"]);
    if (empty($input_level)) {
        $level_err = "Please enter the current level of your Pokemon.";
    } elseif ($input_level < 1 || $input_level > 100) {
        $level_err = "Please enter a level between 1 - 100.";
    } else {
        $level = $input_level;
    }
    // Validate img (image url)
    $input_img = trim($_POST["img"]);
    if (!empty($input_img)) {
        $img = $input_img;
    }
    // Validate date (after Feb 27, 1996)
    $input_date = trim($_POST["date"]);
    if (empty($input_date)) {
        $date = date("Y-m-d");
    } elseif ($input_date < "1996-02-27") {
        $date_err = "Please enter a date after Feb 27, 1996 (Pokemon release date).";
    } else {
        $date = $input_date;
    }
    // Check input errors before updating the database
    if (empty($name_err) && empty($type_err) && empty($level_err) && empty($date_err)) {
        $pokemon = new Pokemon($id, $name, $type, $level, $img, $date);
        $result = $pokemonDAO->updatePokemon($pokemon);
        header("refresh:2; url=index.php");
        echo '<br><h6 class="has-text-centered">' . $result . '</h6>';
        $pokemonDAO->getMysqli()->close();
    }
} else {

    //if id is not empty, get the pokemon's details
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id =  trim($_GET["id"]);
        $pokemon = $pokemonDAO->getPokemon($id);

        if ($pokemon) {
            $name = $pokemon->getName();
            $type = $pokemon->getType();
            $level = $pokemon->getLevel();
            $img = $pokemon->getImg();
            $date = $pokemon->getDate();
        } else {
            header("location: error.php");
            exit();
        }
    } else {
        header("location: error.php");
        exit();
    }
    // Close connection
    $pokemonDAO->getMysqli()->close();
}

include 'header.php';
?>
<h2 class="mt-5 mb-3 title has-text-centered">Update Pokedex Entry</h2>
<div class="columns">
    <div class="column">
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="POST">
            <div class="field mt-5">
                <label class="label" for="name">Pokemon Name:</label>
                <div class="control">
                    <input class="input <?php echo (!empty($name_err)) ? 'is-danger' : ''; ?>" type="text" name="name" id="name" placeholder="Pikachu..." value="<?php echo $name; ?>">
                    <span class="help is-danger"><?php echo $name_err; ?></span>
                </div>
            </div>
            <div class="field">
                <label class="label" for="type">Elemental Type:</label>
                <div class="control">
                    <input class="input <?php echo (!empty($type_err)) ? 'is-danger' : ''; ?>" type="text" name="type" id="type" placeholder="Electric..." value="<?php echo $type; ?>">
                    <span class="help is-danger"><?php echo $type_err; ?></span>
                </div>
            </div>
            <div class="field">
                <label class="label" for="level">Pokemon Level:</label>
                <div class="control">
                    <input class="input <?php echo (!empty($level_err)) ? 'is-danger' : ''; ?>" type="number" name="level" id="level" placeholder="1-100" value="<?php echo $level; ?>">
                    <span class="help is-danger"><?php echo $level_err; ?></span>
                </div>
            </div>
            <div class="field">
                <label class="label" for="level">Image File Name:</label>
                <div class="control">
                    <input class="input" type="text" name="img" placeholder="eg. pikachu.jpg" value="<?php echo $img; ?>">
                </div>
            </div>
            <div class="field">
                <label class="label" for="level">Date:</label>
                <div class="control">
                    <input class="input <?php echo (!empty($date_err)) ? 'is-danger' : ''; ?>" type="text" name="date" placeholder="YYYY-MM-DD" id="date" value="<?php echo $date; ?>">
                    <span class="help is-danger"><?php echo $date_err; ?></span>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input class="button is-success mt-5" name="submit" type="submit" value="Submit"></input>
            <a class="button is-info mt-5 ml-2" href="index.php">Cancel</a>
        </form>
    </div>
</div>

<?php
include 'footer.php'
?>