<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de notas</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>

<?php
require 'vendor/autoload.php';

$resultado = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $url = "http://192.168.56.104/alumnos/wsldnotas.php?wsdl";
    $cliente = new nusoap_client($url, 'wsdl');

    $parametros = array(
        'nombre' => $_POST['nombre'] ?? "Juan Perez",
        'laboratorio1' => $_POST['laboratorio1'] ?? 10,
        'laboratorio2' => $_POST['laboratorio2'] ?? 10,
        'parcial' => $_POST['parcial'] ?? 10
    );

    $resultado = $cliente->call('registrar_notas', $parametros);
}
?>

<form method="post" style="padding: 100px;">
    <h2>Registro de notas</h2>
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="laboratorio1" placeholder="Laboratorio 1" required>
    <input type="text" name="laboratorio2" placeholder="Laboratorio 2" required>
    <input type="text" name="parcial" placeholder="Parcial" required>
    <button type="submit" id="ingresar_nota" style="background-color: cadetblue; border-radius: 5px; padding: 10px;">Ingresar nota</button>
</form>

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Laboratorio 1</th>
                <th scope="col" class="px-6 py-3">Laboratorio 2</th>
                <th scope="col" class="px-6 py-3">Parcial</th>
                <th scope="col" class="px-6 py-3">Promedio</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $resultado['nombre']; ?>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $resultado['laboratorio1']; ?>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $resultado['laboratorio2']; ?>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $resultado['parcial']; ?>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo (($resultado['laboratorio1'] * 0.25) + ($resultado['laboratorio2'] * 0.25) + ($resultado['parcial'] * 0.50)); ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
