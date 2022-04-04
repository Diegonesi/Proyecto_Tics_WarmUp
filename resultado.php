<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $a = $_POST;
    // verificar si contiene un numero o es 0, SUMATORIA
    $SI=0;
    $IRSI=0;
    $HB=0;
    $IRHB=0;

    $GSI=0;
    $GIRSI=0;
    $GHB=0;
    $GIRHB=0;

    for($i=1; $i<=12; $i++){
      if((int)$a[$i]!=0){                 // Sumatoria de SI 
          $SI = $SI+(int)$a[$i];
          $GSI=(int)$a[$i];
      }elseif((int)$a[$i]==0){            // Si el cliente no rellena un numero se utiliza el anterior registrado antes de eso no hay datos (no importan los anteriores)
          $SI = $SI+$GSI;   
      }
      if((int)$a[$i+12]!=0){              // sumatoria de IRSI   
          $IRSI = $IRSI+(int)$a[$i+12]; 
          $GIRSI =(int)$a[$i+12]; 
      }elseif((int)$a[$i+12]==0){         //Si el cliente no rellena un numero se utiliza el anterior registrado antes de eso no hay datos
          $IRSI = $IRSI+$GIRSI;
      }
      if((int)$a[$i+24]!=0){              // Sumatoria de HB
          $HB = $HB+(int)$a[$i+24];
          $GHB = (int)$a[$i+24];
      }elseif((int)$a[$i+24]==0){         //Si el cliente no rellena un numero se utiliza el anterior registrado antes de eso no hay datos
          $HB = $HB+$GHB;
      }
      if((int)$a[$i+32]!=0){              // Sumatoria de IRHB
          $IRHB = $IRHB+(int)$a[$i+32];
          $GIRHB = (int)$a[$i+32];
      }elseif((int)$a[$i+32]==0){         //Si el cliente no rellena un numero se utiliza el anterior registrado antes de eso no hay datos
          $IRHB = $IRHB+$GIRHB;
      }
    }

    // Calculos antes de lo importante
    if($HB <= 9750780){           // calculo de gastos presuntos
      $GP = 0.3*$HB;   
    }else{
      $GP = 9750780;              // el maximo gasto presunto q puede tener una persona
    }       

    $Tabla =  $SI + $HB - $GP;    // Ingreso total el cual va hacia la tabla

    $ITR = $IRSI + $IRHB;         // Impuesto total retenido (se compara con el proyectado al final)

    // CALCULO DE LA tabla
    $ITP=0;                       // Impuesto total proyectado 
    
    // valores fijos que tiene la tabla
    if ($Tabla <= 8775702) {
      $ITP = 0;
    }elseif ($Tabla <= 19501560) {
      $ITP = 0 + (($Tabla-8775702.01)*0.04)-351028.08;
    }elseif ($Tabla <= 32502600) {
      $ITP = 429034.32 + (($Tabla-19501560.01)*0.08)-1131090.48;
    }elseif ($Tabla <= 45503640) {
      $ITP = 1898151.84 + (($Tabla-32502600.01)*0.135)-2918733.48;
    }elseif ($Tabla <= 58504680) {
      $ITP = 5122409.76 +(($Tabla-45503640.01)*0.23)-7241579.28;
    }elseif ($Tabla <= 78006240) {
      $ITP = 11336906.88 +(($Tabla-58504680.01)*0.304)-11570925.60;
    }elseif ($Tabla <= 201516120) {
      $ITP = 23479878.27 +(($Tabla-78006240.01)*0.35)-15159212.64;
    }else {
      $ITP = 77528307.63 +(($Tabla-201516120.01)*0.4)-25235018.64;
    }

    //Parte final comparar el impuesto proyectado con el impuesto real que se tiene
    $resultado = $ITP - $ITR;

  }else{
  echo "error en la pagina";
}
?>

<!DOCTYPE html>
<html lang="eng">
  <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    
   <title>Tax Help</title>
  </head>

  <body>
   <header style="background-color:#6D071A" class="d-flex justify-content-center py-3 ">
    <ul class="nav nav-pills">
     <li class="nav-item"><a href="/" class="nav-link text-white">Home</a></li>
    </ul>
   </header>

   <div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
     <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">

  <?php
    if($resultado > 0){
  ?>

      <h1 class="display-4 fw-bold lh-1">¡Lo lamento! Te corresponde pagar $<?php echo round($ITP-$ITR)?> de impuestos</h1> 

  <?php  
    }elseif($resultado < 0){
  ?>

      <h1 class="display-4 fw-bold lh-1">¡Enhorabuena! Te corresponde una devolución de $<?php echo round($ITR-$ITP)?></h1> 


  <?php
    }else{
  ?>

      <h1 class="display-4 fw-bold lh-1">Lo has hecho bien, no tienes que pagar ni te devolverán dinero :D</h1> 

  <?php
    }
  ?>

      <br><p class="lead">Para que cuentes con un mayor detalle te dejamos la siguiente información: </p>

  <?php
    if($HB!=0){
  ?> 

      <p class="lead">Tus gastos presuntos corresponden a: <?php echo $GP?></p>

  <?php
    }
  ?>

      <p class="lead">Tu ingreso total corresponden a: <?php echo $Tabla?></p>
      <p class="lead">Tu impuesto total retenido corresponde a: <?php echo $ITR?></p>
      <a href="https://homer.sii.cl/" target="_blank"class="nav-item nav-link text-black px-1 me-md-2">Puedes obtener mayor información haciendo click aquí</a></br>


     </div>
     <div class="col-lg-4 offset-lg-0 p-0 overflow-hidden shadow-lg">


  <?php
    if($resultado > 0){
  ?>

      <img class="rounded-lg-3" src="static/image/dinero-poco.gif" alt="" width="500"></img>

  <?php  
    }elseif($resultado < 0){
  ?>

      <img class="rounded-lg-3" src="static/image/dinero-mucho.gif" alt="" width="500"></img>


  <?php
    }else{
  ?>

      <img class="rounded-lg-3" src="static/image/ninguno.gif" alt="" width="400"></img>

  <?php
    }
  ?>        

     </div>
    </div>
   </div>   
  </body>
</html>