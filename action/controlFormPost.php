<link rel="stylesheet"  type="text/css" href="<?php echo ArcForm; ?>/css/bootstrap.min.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="<?php echo ArcForm; ?>/js/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet"  type="text/css" href="<?php echo ArcForm; ?>/js/DataTables-1.10.20/css/dataTables.bootstrap4.css">
    <style type="text/css">
      table tr {
        text-align: center;
      }
    </style>
    <?php
        global $wpdb;
        $lista  = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "fp_contacformpost");
        $fpmail = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "fp_phpmailer where id=1");
        $fpstyle = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "fp_styleform where id=1");
     ?>
    <br>
    <br>
    <div class="container">
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    	<button type="button" class="btn btn-default navbar-btn" data-toggle="modal" id="btnfpmailer" data-target="#Modalfpmailer">Ajustar Email: <?php if (isset($fpmail->setfrom)) {
     echo $fpmail->setfrom;
   } ?></button>
    	<button type="button" class="btn btn-default navbar-btn" id="fpstyleM" data-toggle="modal" data-target="#Modalfpstyle">Style del Formulario</button>
    </div>
  </div>
</nav>
<div class="row">
      <div class="col-lg-12">
       <div class="table-responsive">
        <table id="datatablecontrolformpost" class="table table-striped table-bordered"  style="width:100%">
         <thead>
          <tr>
           <th scope="col">Nombre</th>
           <th scope="col">Email</th>
           <th scope="col">Pregunta</th>
           <th scope="col">Numero</th>
           <th scope="col">Fecha</th>
           <th scope="col">Hora</th>
           <th scope="col">Url</th>
           <th scope="col">Eliminar</th>
         </tr>
       </thead>
       <tbody id="listbusqueda">
        <?php
        foreach ($lista as $contactosformpost) {
         ?>
         <tr id="listfp">
          <td><?php echo $contactosformpost->nombre; ?></td>
          <td><?php echo $contactosformpost->email; ?></td>
          <td><?php echo $contactosformpost->pregunta; ?></td>
          <td><?php echo $contactosformpost->numero; ?></td>
          <td><?php echo $contactosformpost->fecha; ?></td>
          <td><?php echo $contactosformpost->hora; ?></td>
          <td><?php echo '<a href="'.$contactosformpost->url.'" target="_blank">'.$contactosformpost->url.'</a>'; ?></td>
          <td><span data-namefp='<?php echo $contactosformpost->nombre; ?>' class='text-danger btn deletfp glyphicon glyphicon-trash' data-idfp='<?php echo $contactosformpost->id_cfp; ?>' id='deletfp<?php echo $contactosformpost->id_cfp; ?>' title='Eliminar' data-toggle='modal' data-target='#Modaldeletfp'></span>
          	<span data-toggle='modal' data-target='#Modaldeletfp'></span></td>
        </tr>
      <?php }?>
    </tbody>
  </table>
</div>
</div>


<div class="modal fade" id="Modaldeletfp" role="dialog">
  <div class="modal-dialog modal-md">
   <div class="modal-content">
    <div class="modal-header">

     <h4 class="modal-title" id="titlemsjdeletfp"></h4>
   </div>
   <div class="modal-body text-center" id="imp1">
     <p id="mensajedeletfp"></p>
   </div>
   <div class="modal-footer">
     <button type="button" class="close mr-5" data-dismiss="modal">Cerrar</button>
     <div id="btnmodaldeletfp"></div>
   </div>
 </div>
</div>
</div>

<div class="modal fade" id="Modalfpstyle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Ajuste de Style</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formstylefp">
      <div class="modal-body">
        <div class="form-horizontal">
       <div class="form-group">
         <label for="fpcolorfondo" class="col-md-5 control-label">Color de Fondo:</label>
         <div class="col-md-7">
          <input type="color" class="form-control" id="fpcolorfondo" name="fpcolorfondo" value="<?php if (isset($fpstyle->colorfondo)) {
           echo $fpstyle->colorfondo;
         }
         ?>" required>
       </div>
     </div>
     <div class="form-group">
         <label for="fpcolorfondo" class="col-md-5 control-label">Color de Fondo Input:</label>
         <div class="col-md-7">
          <input type="color" class="form-control" id="fpcolorfondoinput" name="fpcolorfondoinput" value="<?php if (isset($fpstyle->colorfondoinput)) {
           echo $fpstyle->colorfondoinput;
         }
         ?>" required>
       </div>
     </div>
     <div class="form-group">
       <label for="fpcolortext" class="col-md-5 control-label">Color de Texto</label>
       <div class="col-md-7">
        <input type="color" class="form-control" id="fpcolortext" name="fpcolortext" value="<?php if (isset($fpstyle->colortext)) {
         echo $fpstyle->colortext;
       }
       ?>" required>
     </div>
   </div>
   <div class="form-group">
     <label for="fpcolorbtn" class="col-md-5 control-label">Color de Boton</label>
     <div class="col-md-7">
      <input type="color" class="form-control" id="fpcolorbtn" name="fpcolorbtn" value="<?php if (isset($fpstyle->colorbtn)) {
         echo $fpstyle->colorbtn;
       }
       ?>" required>
    </div>
  </div>

  <div class="form-group">
   <label for=fptipoletra class="col-md-5 control-label">Tipo de lentra</label>
   <div class="col-md-7">
    <input type="text" class="form-control" id="fptipoletra" name="fptipoletra" placeholder="Tipo de letra" value="<?php if (isset($fpstyle->tipoletra)) {
     echo $fpstyle->tipoletra;
   }
   ?>" required>
 </div>
</div>
<div class="form-group">
   <label for=fpposition class="col-md-5 control-label">Posición</label>
   <div class="col-md-7">
    <input type="number" class="form-control" id="fpposition" name="fpposition" onkeyUp="return ValNumero(this);" value="<?php if (isset($fpstyle->position)) {
     echo $fpstyle->position;
   }
   ?>" required>
 </div>
</div>

</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="fpsqlstyle" class="btn btn-primary">GUARDAR</button>
        <img style="display: none;" src="<?php echo ArcForm; ?>img/carga.gif" id="fpcargarstyle" width="100px" height="60px">
      </div>
    </div>
  </div>
  </form>
</div>


<div class="modal fade" id="Modalfpmailer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Ajuste del Correo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formphpmailerfp">
      <div class="modal-body">
        <div class="form-horizontal">

  <div class="form-group">
   <label for="fpsetfrom" class="col-md-5 control-label">Email que recibe</label>
   <div class="col-md-7">
    <input type="email" class="form-control" id="fpsetfrom" name="setfrom" placeholder="Correo que recibe" value="<?php if (isset($fpmail->setfrom)) {
     echo $fpmail->setfrom;
   }
   ?>" required autocomplete="off">
 </div>
</div>

</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="fpsqlphpmailer" class="btn btn-primary">GUARDAR</button>
        <img style="display: none;" src="<?php echo ArcForm; ?>img/carga.gif" id="fpcargarmailer" width="100px" height="60px">
      </div>
    </div>
    </form>
  </div>
</div>

<script>
  function Solo_Numerico(variable){
      Numer=parseInt(variable);
      if (isNaN(Numer)){
          return "";
      }
      return Numer;
  }
  function ValNumero(Control){
      Control.value=Solo_Numerico(Control.value);
  }
</script>




<script type="text/javascript" src="<?php echo ArcForm; ?>js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo ArcForm; ?>js/maindatatable.js"></script>