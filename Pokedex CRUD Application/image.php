<!--
    Student Name: Alex Hulford
    Student Number: 041066068
    Date: April 2, 2023
    Description: Lab Assignment 2. This is the image page for the Pokedex application.
    It is displayed when the user wants to upload an image for a pokemon.
-->

<?php
include 'header.php';
require_once('./dao/pokemonDAO.php');
// create a new pokemonDAO object
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
            <h1 class="title is-3 mt-5">Add Pokemon Image File</h1>
            <span>Pokemon Name:</span>
            <span><b><?php echo $name ?></b></span><br>
            <span>Elemental Type:</span>
            <span><b><?php echo $type ?></b></span><br>
            <span>Current Level:</span>
            <span><b><?php echo $level ?></b></span><br>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="file has-name">
                    <label class="file-label" for="img">Pokemon Image File:
                        <div class="file-label">
                            <input class="file-input <?php echo (!empty($img_err)) ? 'is-danger' : ''; ?>" type="file" name="img" id="img" accept="image/jpg, image/png, image/jpeg" value="<?php echo $img; ?>">
                            <span class="file-cta file-label ml-2">Choose a File</span>
                            <span id="image-name" class="file-name has-text-grey">No File Uploaded</span>
                        </div>
                    </label>
                </div>
                <p class="has-text-danger">* After uploading your image to the server, update your pokemon with the image name and extension *</p>
                <input class="button is-success mt-5" type="submit" value="Submit" name="submit"></input>
                <a class="button is-info mt-5 ml-2" href="index.php">Cancel</a>
            </form>
        </div>
        <div class="column"></div>
    </div>
</div>



<?php
include 'footer.php';
?>