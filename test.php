<?php

	//Leyendo el archivo de entrada
	$fileLines = file('input.txt');
	$output = 'output.txt';
	//Borrar archivo de salida si ya existe.
	if(file_exists($output)){

		unlink($output);
	}

	foreach ($fileLines as $key => $line) {
	
		if($key != 0){

			$separatedLine = explode(" ", $line);
			$n = $separatedLine[0];
			$amount = $separatedLine[1];
			$coins = array();
			//Obteniendo las denominaciones de las monedas
			for ($i = 2; $i < ($amount + 2); $i++) {

				array_push($coins, ((int) $separatedLine[$i]));
			}

			$acumMin = 0;
			$max = 0;
			//1 <= N <= 100
			for ($i = $n; $i >=1; $i--) { 

				if(in_array($i, $coins)){

					$min = 1;
				}else{

						
					$min = minimusOpt($i, $amount, $coins);		
					
				}

				$acumMin += $min;
				if($max < $min){

					$max = $min;
				}

				//echo "Para " . $i . " el minimo es: " . $min1 . "<br>";
			}
			//echo "Para " . $i . " el minimo es: " . $min . "<br>";
			$lineOut = (number_format((float)($acumMin/$n), 2, '.', '')) . " " . $max . "\n";
			file_put_contents($output, $lineOut, FILE_APPEND);
			//var_dump($coins);
			//echo $n . " " . $amount; 
		}
	}

	//Funcion para calcular el minimo numero de monedas para armar una cantidad
	function minimus($x, $am, $coins){

		if(in_array($x, $coins)){

			$min = 1;
		}else{

			$aux = $x;
			$min = 0;
			for ($j = $am - 1; $j >=0 ; $j--) { 

				if($coins[$j] <= $aux){

					$rest = $aux - $coins[$j];
					$aux = $rest;
					$j++;
					$min++;
					if($aux == 0){

						break; 
					}
				}
						

			}			
		}
		return $min;
	}

	function minimusOpt($x, $am, $coins){
		
			$aux = $x;
			$min = minimus($x, $am, $coins);

			
			for ($j = $am - 1; $j >=0 ; $j--) { 

				$minAux = $min;
				if($coins[$j] > $aux){

					$rest = ($coins[$j] - $aux);
					$min = 1 + minimus($rest, $am, $coins);
					if($minAux < $min){

						$min = $minAux;
					}

				}else{

					for ($k = $am - 1; $k >=0 ; $k--) { 
						$auxCoin = $coins[$j];
						$minAux = $min;
						$cont = 1;
						while($auxCoin < $aux){
							$auxCoin = $auxCoin + $coins[$k];
							
							$cont++;
						}
						$rest = ($auxCoin - $aux);
						
						
						if($rest == 0 ){

							$min = $cont;
							//return $min;
						}else{
							$min = $cont + minimus($rest, $am, $coins);
						}

						if($minAux < $min){

							$min = $minAux;
						}
						
					}
					
					
					}


					/*$minAux = $min;
					$auxCoin = $coins[$j];
					$cont = 1;
					while($auxCoin < $aux){
						$auxCoin = $auxCoin + $auxCoin;
						$cont++;
					}
					$rest = ($auxCoin) - $aux;
					$min = $cont + minimus($rest, $am, $coins);*/
					/*if(($coins[$j] + $coins[$k]) > $aux){

						$rest = ($coins[$j] + $coins[$k]) - $aux;
						$min = 2 + minimus($rest, $am, $coins);
						
					}else{

						if(($coins[$j] + $coins[$k]) == $aux){

							$min = 2;

						}else{
							$min = minimus($x, $am, $coins);
						}					
					}

					if($minAux < $min){

						$min = $minAux;
					}*/
				
			}			
		
		return $min;
	}


?>