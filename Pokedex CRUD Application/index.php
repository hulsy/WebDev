<!--
    Student Name: Alex Hulford
    Student Number: 041066068
    Date: April 2, 2023
    Description: Lab Assignment 2. This is the index page for the Pokedex application.
    It displays all the pokemon in the database and has buttons linking to CRUD operations.
-->

<?php
include 'header.php';
require_once('./dao/pokemonDAO.php');
?>

<h1 class="title is-1 mt-5 has-text-centered">Pokedex</h1>
<h2 class="title is-5 has-text-centered">Feel free to add/update/delete to make it your own!</h2>


<div class="columns">
    <div class="column">
        <p> </p>
    </div>
    <div class="column is-four-fifths">
        <a href="create.php" class="button is-success is-small">Add a Pokemon</a>
        <?php
        //create a new pokemonDAO object
        $pokemonDAO = new pokemonDAO();
        //get all pokemon from the database
        $allPokemon = $pokemonDAO->getAllPokemon();
        //if there are pokemon in the database, display them in a table
        if ($allPokemon) {
            echo '<table class="table">';
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Type</th>";
            echo "<th>Level</th>";
            echo "<th>Image File</th>";
            echo "<th>Date</th>";
            echo '<th colspan="4">Action</th>';
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            //loop through all pokemon and display them in a table
            foreach ($allPokemon as $pokemon) {
                echo "<tr>";
                echo "<td>" . $pokemon->getId() . "</td>";
                echo "<td>" . $pokemon->getName() . "</td>";
                echo "<td>" . $pokemon->getType() . "</td>";
                echo "<td>" . $pokemon->getLevel() . "</td>";
                echo "<td>" . $pokemon->getImg() . "</td>";
                echo "<td>" . $pokemon->getDate() . "</td>";
                echo "<td>";
                echo '<a href="read.php?id=' . $pokemon->getId() . '" class="button is-info is-small" title="View Record">View</a>';
                echo "</td>";
                echo "<td>";
                echo '<a href="update.php?id=' . $pokemon->getId() . '" class="button is-dark is-small" title="Update Record">Update</a>';
                echo "</td>";
                echo "<td>";
                echo '<a href="image.php?id=' . $pokemon->getId() . '" class="button is-dark is-outlined is-small" title="Add Image">Add Image</a>';
                echo "</td>";
                echo "<td>";
                echo '<a href="delete.php?id=' . $pokemon->getId() . '" class="button is-danger is-small" title="Delete Record">Delete</a>';
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            $result->free();
        } else {
            echo '<div class=""><em>No records were found.</em></div>';
        }
        //close the database connection
        $pokemonDAO->getMysqli()->close();
        ?>
    </div>
    <div class="column">
        <p> </p>
    </div>
</div>

<?php include 'footer.php'; ?>