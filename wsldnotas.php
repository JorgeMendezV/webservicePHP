<?php
require 'vendor/autoload.php';

$server = new nusoap_server();
$server->configureWSDL('registronotas', 'urn:registronotas');

$server->wsdl->addComplexType(
    'notas',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'laboratorio1' => array('name' => 'laboratorio1', 'type' => 'xsd:float'),
        'laboratorio2' => array('name' => 'laboratorio2', 'type' => 'xsd:float'),
        'parcial' => array('name' => 'parcial', 'type' => 'xsd:float')
    )
);

$server->register(
    'registrar_notas',
    array(
        'nombre' => 'xsd:string',
        'laboratorio1' => 'xsd:float',
        'laboratorio2' => 'xsd:float',
        'parcial' => 'xsd:float'
    ),
    array('return' => 'tns:notas'),
    'urn:registronotas',
    'urn:registronotas#registrar_notas',
    'rpc',
    'encoded',
    'Registro de notas de estudiantes'
);

function registrar_notas($nombre, $laboratorio1, $laboratorio2, $parcial) {
    return array(
        'nombre' => $nombre,
        'laboratorio1' => $laboratorio1,
        'laboratorio2' => $laboratorio2,
        'parcial' => $parcial
    );
}

$server->service(file_get_contents('php://input'));
?>