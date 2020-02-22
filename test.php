<?php

	//Leyendo el archivo
	$fileLines = file('entrada.txt');
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
				echo "Para " . $i . " el minimo es: " . $min . "<br>";
			}
			echo "Promedio:  " . ($acumMin/$n) . "<br>";
			//var_dump($coins);
			//echo $n . " " . $amount; 
		}
	}
?>