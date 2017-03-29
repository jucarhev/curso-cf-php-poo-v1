<?php namespace Helpers;

/**
* Clase para realizar Token de seguridad
*
* Una clase que genera tokens de seguridad
* 
* @author     www.notas-programacion.com
*  
*/

class Token
{
	
	function __construct(){
		# code...
	}

	function obtenCaracterAleatorio($arreglo){
		$clave_aleatoria = array_rand($arreglo, 1);	//obtén clave aleatoria
		return $arreglo[ $clave_aleatoria ];	//devolver ítem aleatorio
	}
 
	function obtenCaracterMd5($car){
		$md5Car = md5($car.Time());	//Codificar el carácter y el tiempo POSIX (timestamp) en md5
		$arrCar = str_split(strtoupper($md5Car));	//Convertir a array el md5
		$carToken = obtenCaracterAleatorio($arrCar);	//obtén un ítem aleatoriamente
		return $carToken;
	}
 
	function obtenToken($longitud) {
		//crear alfabeto
		$mayus = "ABCDEFGHIJKMNPQRSTUVWXYZ";
		$mayusculas = str_split($mayus);	//Convertir a array
		//crear array de numeros 0-9
		$numeros = range(0,9);
		//revolver arrays
		shuffle($mayusculas);
		shuffle($numeros);
		//Unir arrays
		$arregloTotal = array_merge($mayusculas,$numeros);
		$newToken = "";
		
		for($i=0;$i<=$longitud;$i++) {
				$miCar = obtenCaracterAleatorio($arregloTotal);
				$newToken .= obtenCaracterMd5($miCar);
		}
		return $newToken;
	}
}
?>