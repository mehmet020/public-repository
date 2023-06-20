<?php

$servername = "localhost:3307";

$username = "root";

$password = "";

$dbname = "winkel";



try {

    $PDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Verbinding met de database tot stand gebracht.<br>";

} catch (PDOException $e) {

    echo "Fout bij het verbinden met de database: " . $e->getMessage();

}

$query = "SELECT * FROM producten";

$stmt = $PDO->query($query);


if ($stmt->rowCount() > 0) {


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $id = $row['id'];

        $naam = $row['naam'];

        $email = $row['email'];

        echo "ID: " . $id . "<br>";

        echo "Naam: " . $naam . "<br>";

        echo "Email: " . $email . "<br>";


        $_SESSION['geselecteerde_ids'][] = $id;




        echo "<br>";

    }



    if (isset($_SESSION['geselecteerde_ids'])) {

        echo "Geselecteerde ID's: ";

        foreach ($_SESSION['geselecteerde_ids'] as $selected_id) {

            echo $selected_id . ", ";

        }

    }

} else {

    echo "Geen resultaten gevonden in de tabel.";

}


$PDO = null;

?>