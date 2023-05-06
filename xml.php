<?php

include('conexion.php');

$file_factura = $_FILES["input_factura"];

$xml_content = file_get_contents($file_factura["tmp_name"]);

$xml_content = str_replace("<tfd:", "<cfdi:", $xml_content);
$xml_content = str_replace("<cfdi:", "<", $xml_content);
$xml_content = str_replace("</cfdi:", "</", $xml_content);
$xml_content = str_replace("@attributes" , "attributes", $xml_content);

$xml_content = simplexml_load_string($xml_content);



$xml_content = (array) $xml_content;

print_r($xml_content); exit;

// XML DATA
$xml_content["Addenda"] = (array) $xml_content["Addenda"];
$xml_content["Addenda"]["GrupoAPMM"] = (array) $xml_content["Addenda"]["GrupoAPMM"];
$xml_content["Addenda"]["GrupoAPMM"]["ReferenciaOperativa"] =(array) $xml_content["Addenda"]["GrupoAPMM"]["ReferenciaOperativa"];

$xml_data["referencia"] = $xml_content["Addenda"]["GrupoAPMM"]["ReferenciaOperativa"]["@attributes"];
$xml_data["NumeroContenedor"] = $xml_content["Addenda"]["GrupoAPMM"]["ReferenciaOperativa"];


print_r($xml_data); exit;

?>