<!--
 Student Name: Alex Hulford
 Student Number: 041066068
 Date: April 2, 2023
 Description: Lab Assignment 2. This is the delete page for the Pokedex application.
 It allows the user to delete a Pokemon from the database.
-->


<?php
require_once('./dao/pokemonDAO.php');

// if id is not empty, delete the pokemon with the id
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $pokemonDAO = new pokemonDAO();
    $pokemonId = trim($_POST["id"]);
    $result = $pokemonDAO->deletePokemon($pokemonId);
    if ($result) {
        header("location: index.php");
        exit();
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}

include 'header.php';
?>


<div class="columns">
    <div class="column">
        <p> </p>
    </div>
    <div class="column">
        <h2 class="mt-5 mb-3 title has-text-centered">Delete Pokedex Entry</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="notification is-danger is-light">
                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                <p>You want to release this Pokemon back into the wild?!</p>
                <p>
                    <input type="submit" value="Yes" class="button is-danger mt-3">
                    <a href="index.php" class="button is-dark ml-2 mt-3">No</a>
                </p>
            </div>
        </form>
    </div>
    <div class="column">
        <p> </p>
    </div>
</div>
<?php include 'footer.php' ?>