<?php

include('conexion.php');

$file_factura = $_FILES["input_factura"];

$xml_content = file_get_contents($file_factura["tmp_name"]);

$xml_content = str_replace("<tfd:", "<cfdi:", $xml_content);
$xml_content = str_replace("<cfdi:", "<", $xml_content);
$xml_content = str_replace("</cfdi:", "</", $xml_content);
$xml_content = str_replace("@attributes" , "attributes", $xml_content);

//CONVERTIR XML A OBJETO - simplexml_load_string;
$xml_content = simplexml_load_string($xml_content);

//COMPROBACION DE ESTADO DEL OBJETO
    //print_r($xml_content);
    //print_r( $xml_content->book[1]);

//CONVERTIR EL OBJETO A JSON - json_encode
$arch_json = json_encode($xml_content);

//COMPROBACION DE ESTADO JSON
//print_r($arch_json);

//OBTENCION DE INFORMACION
$decoded_arch_json = json_decode($arch_json,TRUE);

//INFORMACION DEL ARCHIVO
//Nombre
print_r("Factura: ");
print_r($file_factura["full_path"]);
print_r("\n");
print_r("\n");

//INFORMACION DE CLIENTE
// Nombre
print_r("INFORMACION DE CLIENTE");
print_r("\n");
print_r("\n");
if(isset($decoded_arch_json['Receptor']['@attributes']['Nombre'])){
    print_r("Cliente: ");
    print_r($decoded_arch_json['Receptor']['@attributes']['Nombre']);
}else{
    print_r("");
}
// RFC
if(isset($decoded_arch_json['Receptor']['@attributes']['Rfc'])){
    print_r("\n");
    print_r("RFC: ");
    print_r($decoded_arch_json['Receptor']['@attributes']['Rfc']);
}else{
    print_r("");
}
print_r("\n");
print_r("\n");
print_r("\n");
//INFORMACION DE ADENDA
// Validacion del campo Numero Proveedor
print_r("INFORMACION DE ADENDA");
print_r("\n");
print_r("\n");
if(isset($decoded_arch_json['Addenda']['GrupoAPMM']['NumeroProveedor'])){
    print_r("Numero Proveedor: ");
    print_r($decoded_arch_json['Addenda']['GrupoAPMM']['NumeroProveedor']);
}else{
    print_r("");
}

// Validacion del campo Referencia
if(isset($decoded_arch_json['Addenda']['GrupoAPMM']['ReferenciaOperativa']['@attributes']['referencia'])){
    print_r("\n");
    print_r("Referencia Operativa: ");
    print_r($decoded_arch_json['Addenda']['GrupoAPMM']['ReferenciaOperativa']['@attributes']['referencia']);
}else{
    print_r("");
}

// Validacion del campo Numero Contenedor
if(isset($decoded_arch_json['Addenda']['GrupoAPMM']['ReferenciaOperativa']['NumeroContenedor'])){
    print_r("\n");
    print_r("Numero Contenedor: ");
    print_r($decoded_arch_json['Addenda']['GrupoAPMM']['ReferenciaOperativa']['NumeroContenedor']);
}else{
    print_r("");
}

// Validacion del campo Referencia UUIID
if(isset($decoded_arch_json['Addenda']['GrupoAPMM']['ReferenciaUUID'])){
    print_r("\n");
    print_r("Referencia UUID: ");
    print_r($decoded_arch_json['Addenda']['GrupoAPMM']['ReferenciaUUID']);
}else{
    print_r("");
}
?>