<?php
$servername = "localhost";
$username = "jouw_gebruikersnaam";
$password = "jouw_wachtwoord";
$dbname = "winkel";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Fout bij verbinding met de database: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product toevoegen</title>
</head>
<body>
    <h2>Voeg een nieuw product toe:</h2>
    <form action="insert.php" method="POST">
        <label>Productnaam:</label>
        <input type="text" name="product_naam" required><br><br>

        <label>Prijs per stuk:</label>
        <input type="number" name="prijs_per_stuk" step="0.01" required><br><br>

        <label>Omschrijving:</label>
        <textarea name="omschrijving" required></textarea><br><br>

        <input type="submit" value="Toevoegen">
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $productNaam = $_POST["product_naam"];
    $prijsPerStuk = $_POST["prijs_per_stuk"];
    $omschrijving = $_POST["omschrijving"];

    $sql = "INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving) VALUES (:product_naam, :prijs_per_stuk, :omschrijving)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_naam', $productNaam);
        $stmt->bindParam(':prijs_per_stuk', $prijsPerStuk);
        $stmt->bindParam(':omschrijving', $omschrijving);
        $stmt->execute();

        echo "Product succesvol toegevoegd.";
    } catch(PDOException $e) {
        echo "Fout bij toevoegen van het product: " . $e->getMessage();
    }
}
?>

