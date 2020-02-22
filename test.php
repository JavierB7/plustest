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
				
				$aux = $i;
				$min = 0;
				for ($j = $amount - 1; $j >=0 ; $j--) { 

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
				$acumMin += $min;
				if($max < $min){

					$max = $min;
				}
				echo "Para " . $i . " el minimo es: " . $min . "<br>";
			}
			//echo "Para " . $i . " el minimo es: " . $min . "<br>";
			$lineOut = (number_format((float)($acumMin/$n), 2, '.', '')) . " " . $max . "\n";
			file_put_contents($output, $lineOut, FILE_APPEND);
			//var_dump($coins);
			//echo $n . " " . $amount; 
		}
	}
?>