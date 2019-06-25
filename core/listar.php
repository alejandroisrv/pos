<?php
// realiza la conexion
include 'conexion.php';

// obtiene los valores para realizar la paginacion
$limit = isset($_POST["limit"]) && intval($_POST["limit"]) > 0 ? intval($_POST["limit"])	: 10;
$offset = isset($_POST["offset"]) && intval($_POST["offset"])>=0	? intval($_POST["offset"])	: 0;
// array para devolver la informacion.
$json = array();
$data = array();
$numeroFilas = array();
//consulta que deseamos realizar a la db
$query = $con_pdo->prepare("SELECT `idproducto`,`producto`, `precioCosto`, `precioVenta`,`cantidad`,`ganancias` FROM  `productos` LIMIT ? OFFSET ?");
$query->bind_param("ii",$limit,$offset);
$query->execute();

// vincular variables a la sentencia preparada
$query->bind_result($idproducto, $producto,$precioCosto,$precioVenta,$cantidadd,$ganancias);

// obtener valores
while ($query->fetch()) {
	$data_json = array();
	$data_json["idproducto"] = $idproducto;
	$data_json["producto"] = $producto;
	$data_json["precioCosto"] = $precioCosto;
	$data_json["precioVenta"] = $precioVenta;
	$data_json["cantidad"] = $cantidadd;
	$data_json["ganancias"] = $ganancias;
	$data[]=$data_json;

}

// obtiene la cantidad de registros
$cantidad_consulta = $con_pdo->query("SELECT * FROM productos");
$numeroFilas['cantidad']=$cantidad_consulta->rowCount();
$json["lista"] = array_values($data);
$json["cantidad"] = array_values($numeroFilas);

// envia la respuesta en formato json
header("Content-type:application/json; charset = utf-8");
echo json_encode($json);

?>
