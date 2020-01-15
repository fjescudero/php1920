<html>
<head><title>Practica 2 Bingo</title></head>
<body>
<?php 

//Metemos numeros a los cartones//

$jugador1=array();

for($x=0;$x<=14;$x++){

$jugador1[]=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

for($i=0;$i<=14;$i++){
 $atle=rand(1,60);
	if (in_array($atle,$aacum11)){
		$esta=true;
		do{
			if (!in_array($atle,$aacum11)){
				$esta=false;
			}
			$atle=rand(1,60);
		}while($esta==true);
	}
	 $aacum11[$i]=$atle;
	
}
	print_r $jugador1[$x];
}

$jugador2=array($array44,$array55,$array66);
$jugador3=array($array77,$array88,$array99);
$jugador4=array($array100,$array111,$array112);

//Definimos//
 
$cont1=0;
$cont2=0;
$cont3=0;
$cont4=0;
$cont5=0;
$cont6=0;
$cont7=0;
$cont8=0;
$cont9=0;
$cont10=0;
$cont11=0;
$cont12=0;
 
//Comienza el programa//

programa($cont1,$cont2,$cont3,$cont4,$cont5,$cont6,$cont7, $cont8, $cont9,$cont10,$cont11,$cont12,$array11,$array22,$array33,$array44,$array55,$array66,$array77,$array88,$array99,$array100,$array111,$array112);

function programa ($cont1,$cont2,$cont3,$cont4,$cont5,$cont6,$cont7, $cont8, $cont9,$cont10,$cont11,$cont12,$array11,$array22,$array33,$array44,$array55,$array66,$array77,$array88,$array99,$array100,$array111,$array112) {

echo "Bienvenidos al Bingo online. Va a dar comienzo la partida. </br>";

echo "Cada jugador contara con 3 cartones. </br>";

echo "Buena suerte.</br>";
 
$contnums=0; 
$arraynums=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$long=count($arraynums);
echo $long."</br>";
 
do{
$long=count($arraynums);

$numaleat=rand(1,$long);

$arraynums[$numaleat]=$numaleat;

echo $numaleat." ";

for($x = 0; $x<14; $x++) {
    if($array11[$x]==$numaleat){
		$cont1++;
	}
}

for($x1 = 0; $x1<14; $x1++) {
     if($array22[$x1]==$numaleat){
		$cont2++;
	}
}

for($x2 = 0; $x2<14; $x2++) {
     if($array33[$x2]==$numaleat){
		$cont3++;
	}
}

 for($x3 = 0; $x3<14; $x3++) {
    if($array44[$x3]==$numaleat){
		$cont4++;
	}
}

for($x4 = 0; $x4<14; $x4++) {
     if($array55[$x4]==$numaleat){
		$cont5++;
	}
}

for($x5 = 0; $x5<14; $x5++) {
     if($array66[$x5]==$numaleat){
		$cont6++;
	}
}

for($x6 = 0; $x6<14; $x6++) {
     if($array77[$x6]==$numaleat){
		$cont7++;
	}
}

 for($x7 = 0; $x7<14; $x7++) {
    if($array88[$x7]==$numaleat){
		$cont8++;
	}
}

for($x8 = 0; $x8<14; $x8++) {
     if($array99[$x8]==$numaleat){
		$cont9++;
	}
}

for($x9 = 0; $x9<14; $x9++) {
     if($array100[$x9]==$numaleat){
		$cont10++;
	}
}

for($x10 = 0; $x10<14; $x10++) {
     if($array111[$x10]==$numaleat){
		$cont11++;
	}
}

 for($x11 = 0; $x11<14; $x11++) {
    if($array112[$x11]==$numaleat){
		$cont12++;
	}
}



}while($cont1<15 && $cont2<15 && $cont3<15 && $cont4<15 && $cont5<15 && $cont6<15 && $cont7<15 && $cont8<15 && $cont9<15 && $cont10<15 && $cont11<15 && $cont12<15);

//Quien gana//

if($cont1==15 || $cont2==15 || $cont3==15){
	echo "</br> Bingo. Jugador 1 gana. </br>";
}

if($cont4==15 || $cont5==15 || $cont6==15){
	echo "</br> Bingo. Jugador 2 gana. </br>";
}

if($cont7==15 || $cont8==15 || $cont9==15){
	echo "</br> Bingo. Jugador 3 gana. </br>";
}

if($cont10==15 || $cont11==15 || $cont12==15){
	echo "</br> Bingo. Jugador 4 gana. </br>";
}

}

?>
</body>
</html>