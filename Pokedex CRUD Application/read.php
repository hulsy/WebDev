<!--
    Student Name: Alex Hulford
    Student Number: 041066068
    Date: April 2, 2023
    Description: Lab Assignment 2. This is the read page for the Pokedex application.
    It allows the user to view a Pokemon's details and image.
-->

<?php
include 'header.php';
require_once('./dao/pokemonDAO.php');
//Create a new pokemonDAO object
$pokemonDAO = new pokemonDAO();

// if id is not empty, get the pokemon with the id
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id =  trim($_GET["id"]);
    $pokemon = $pokemonDAO->getPokemon($id);

    if ($pokemon) {
        $name = $pokemon->getName();
        $type = $pokemon->getType();
        $level = $pokemon->getLevel();
        $img = $pokemon->getImg();
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

?>

<div class="container">
    <div class="columns card">
        <div class="column">
            <p> </p>
        </div>
        <div class="column">
            <h1 class="title is-3 mt-5">View Pokedex Entry</h1>
            <span>Pokemon Name:</span>
            <span><b><?php echo $name ?></b></span><br>
            <span>Elemental Type:</span>
            <span><b><?php echo $type ?></b></span><br>
            <span>Current Level:</span>
            <span><b><?php echo $level ?></b></span><br>
            <p><a href="index.php" class="button is-warning mt-5">Go Back</a></p>
        </div>
        <div class="column mt-5">
            <img class="image is-128x128 mt-5" src="./image/<?php echo $img ?>" alt="<?php echo $name ?> has no image file uploaded">
        </div>
    </div>
</div>



<?php
include 'footer.php';
?>