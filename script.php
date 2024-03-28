<?php
$csvFileName = "BASEDIMSA.csv";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["direccion1"]) && isset($_POST["direccion2"])) {
    // Procesar la solicitud del formulario
    $direccion1 = $_POST["direccion1"];
    $direccion2 = $_POST["direccion2"];

    // Cargar los datos del archivo CSV
    $data = [];
    if (($handle = fopen($csvFileName, "r")) !== false) {
        while (($row = fgetcsv($handle, 1000, ";")) !== false) {
            // Verificar si la fila cumple con los criterios de ambos formularios
            if (isset($row[3]) && isset($row[4]) && $row[3] === $direccion1 && $row[4] === $direccion2) {
                $data[] = $row;
            }
        }
        fclose($handle);
    }

    // Manejar el resultado
    if (!empty($data)) {
        echo "<h2>Resultados:</h2>";
        echo "<ul>";
        foreach ($data as $row) {
            // Mostrar cada fila
            echo "<li>Nombre: " . $row[0] . ", Dirección: " . $row[1] . ", Teléfono: " . $row[2] . ", Isla: " . $row[3] . ", Turno: " . $row[4] . " <button onclick=\"window.open('https://wa.me/{$row[2]}?text=Hola%20confirmas%20el%20cambio%3F', '_blank')\">Confirmar</button></li>";


        }
        echo "</ul>";
    } else {
        echo "No se encontraron resultados para las selecciones proporcionadas.";
    }
} else {
    echo "No se recibieron las selecciones válidas de los formularios.";
}
?>
