<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <title>Framework:
        <?php if(isset($this->titulo)) {
        echo $this->titulo;
        }?>
    </title>

    <link rel="stylesheet" href="<?php echo APP_URL_CSS."index.css"; ?>">
    <link rel="stylesheet" href="<?php echo APP_URL_CSS."materialize.min.css"; ?>">
    <script type="text/javascript" src="<?php echo APP_URL_JS."materialize.min.js"; ?>"></script>
    
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems, {});
      });
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, {
            format: 'yyyy-mm-dd'
        });
        });
    </script>
        <script>        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.dropdown-trigger');
            var instances = M.Dropdown.init(elems, {});
          });
    </script>
    
    
</head>

<body>
   <div class="row">
       <nav>
        <div class="nav-wrapper">
         <div class="container">
             <a href="<?php echo APP_URL."pages"; ?>" class="brand-logo"><i class="material-icons">home</i></a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="<?php echo APP_URL."transacciones"; ?>">Transaccion</a></li>
                <li><a href="<?php echo APP_URL."cuentas"; ?>">Cuenta</a></li>
                <li><a href="<?php echo APP_URL."categorias"; ?>">Categoria</a></li>
              </ul>
         </div>
        </div>
      </nav>
   </div>
    <?php if (isset($this->flashMessage)) {
        echo "<h3>".$this->flashMessage."</h3>";
    } ?>
	<div class="container">
