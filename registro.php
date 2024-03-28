<?php
// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de registro
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $isla = $_POST['isla'] ?? '';
    $turno = $_POST['turno'] ?? '';

    // Verificar que todos los campos requeridos estén presentes
    if (!empty($nombre) && !empty($apellido) && !empty($telefono) && !empty($isla) && !empty($turno)) {
        // Crear la nueva fila en formato CSV
        $nuevaFila = "$nombre;$apellido;$telefono;$isla;$turno\n";

        // Agregar la nueva fila al final del archivo CSV
        $archivo = fopen('BASEDIMSA.csv', 'a');
        fwrite($archivo, $nuevaFila);
        fclose($archivo);

        echo "¡Cambio registrado exitosamente!";
    } else {
        echo "Todos los campos son requeridos.";
    }
} else {
    echo "No se han recibido datos del formulario.";
}
?>
