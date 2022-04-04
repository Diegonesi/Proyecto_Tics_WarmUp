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

  <div class="container col-xxl-8 px-4 py-5">
   <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
     <img class="d-block" width="490" height="" src="static/image/sii.png"></img></br>
     <p class="lead">En la siguiente tabla debe ingresar el sueldo recibido en cada mes y/o el monto de su boleta honoraria, así también el impuesto que se le fue retenido mensualmente. Recuerde ingresar sólo valores numéricos y mayores a 0, evite el uso de puntos y comas o le contará como número decimal. En caso de no contar con la información deje el recuardo con el valor predeterminado.</p>
     <!--<p class="lead">Por favor ingrese el valor actual de la UTM en pesos chilenos, sin puntos ni comas.</p>
     <a href="https://www.sii.cl/valores_y_fechas/utm/utm2022.htm" target="_blank"class="nav-item nav-link text-black px-1 me-md-2">Si no sabes el valor actual de la UTM puedes averiguarlo haciendo click aquí</a></br>
     <input type="text" class="d-grid gap-2 d-md-flex justify-content-md-start" id="UTM" placeholder="$" requered></br>
     -->
    </div>
    <div class="col-lg-6">
     <h1 class="display-5 fw-bold lh-1 mb-3">Cálculo de Impuestos</h1>
     <div class="table-responsive">
      <form action="resultado.php" method="POST">
       <table class="table table-striped table-sm">
        <thead>
         <tr>
          <th scope="col">Meses</th><th></th>
          <th class="type=number" scope="col">Sueldo Imponible</th>
          <th scope="col">Impuestos Retenidos</th>
          <th scope="col">Honorarios Brutos</th>
          <th scope="col">Impuestos Retenidos</th>
         </tr>
        </thead>
        <tbody>
    <?php  
      $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']; 
      for($i=1; $i<=12; $i++){         
    ?>          
        
         <tr>
          <td><?php echo $meses[$i-1] ?></td>
          <td></td>
          <td><input type="number" value="0" min="0" class="form-control" name="<?php echo $i ?>" required></td>
          <td><input type="number" value="0" min="0" class="form-control" name="<?php echo $i+12 ?>" required></td> <!--impuesto retenido de sueldo-->
          <td><input type="number" value="0" min="0" class="form-control" name="<?php echo $i+24 ?>" required></td>
          <td><input type="number" value="0" min="0" class="form-control" name="<?php echo $i+36 ?>" required></td> <!--impuesto retenido de honorarios--> 
         </tr>

    <?php
      }
    ?>

        </tbody>
       </table>
       <button style="background-color:#80091f" type="submit" class="btn btn-lg px-4 me-md-2 text-white">Calcular</button>
      </form>
     </div>
    </div>
   </div>
  </div>     
 </body>
</html>