<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
a:link {
	color: #FFF;
}
a:visited {
	color: #FFF;
}
</style>

</head>

<?php

if(isset($_GET["reiniciar"]))
{
	session_destroy();
	header("location:index.php");
}

if($_SESSION["inicio"]==true)
{
	$_SESSION["color"]=1;
	$_SESSION["turno"]=0;	
	
	for($i=0;$i<$_SESSION["n"];$i++)
		for($j=0;$j<$_SESSION["m"];$j++)
			$_SESSION["matriz"][$i][$j]=0;
	
	$_SESSION["inicio"]=false;
}

if(isset($_GET["color"]))
{
	if($_GET["color"]==1)
		$_SESSION["color"]=1;
	if($_GET["color"]==2)
		$_SESSION["color"]=2;
	if($_GET["color"]==3)
		$_SESSION["color"]=3;
}

if(isset($_GET["fila"]) && isset($_GET["columna"]))
{
	if($_SESSION["turno"]==0)
	{
		$_SESSION["fila1"]=$_GET["fila"];
		$_SESSION["columna1"]=$_GET["columna"];	
		$_SESSION["turno"]=1;
	}
	else
	{	
		if($_GET["fila"]<$_SESSION["fila1"])
		{
			$_SESSION["fila2"]=$_SESSION["fila1"];
			$_SESSION["fila1"]=$_GET["fila"];
		}
		else
			$_SESSION["fila2"]=$_GET["fila"];
		
		if($_GET["columna"]<$_SESSION["columna1"])
		{
			$_SESSION["columna2"]=$_SESSION["columna1"];
			$_SESSION["columna1"]=$_GET["columna"];
		}
		else
		$_SESSION["columna2"]=$_GET["columna"];
		
		for($i=$_SESSION["fila1"];$i<$_SESSION["fila2"]+1;$i++)
			for($j=$_SESSION["columna1"];$j<$_SESSION["columna2"]+1;$j++)
			{
				if($_SESSION["matriz"][$i][$j]==0)
				{
					if($_SESSION["color"]==1)
						$_SESSION["matriz"][$i][$j]=1;
					if($_SESSION["color"]==2)
						$_SESSION["matriz"][$i][$j]=2;
					if($_SESSION["color"]==3)
						$_SESSION["matriz"][$i][$j]=3;		
				}
				else				
				if($_SESSION["matriz"][$i][$j]==1)
				{
					if($_SESSION["color"]==1)
						$_SESSION["matriz"][$i][$j]=1;
					if($_SESSION["color"]==2)
						$_SESSION["matriz"][$i][$j]=4;
					if($_SESSION["color"]==3)
						$_SESSION["matriz"][$i][$j]=5;		
				}
				else
				if($_SESSION["matriz"][$i][$j]==2)
				{
					if($_SESSION["color"]==1)
						$_SESSION["matriz"][$i][$j]=4;
					if($_SESSION["color"]==2)
						$_SESSION["matriz"][$i][$j]=2;
					if($_SESSION["color"]==3)
						$_SESSION["matriz"][$i][$j]=6;		
				}
				else
				if($_SESSION["matriz"][$i][$j]==3)
				{
					if($_SESSION["color"]==1)
						$_SESSION["matriz"][$i][$j]=5;
					if($_SESSION["color"]==2)
						$_SESSION["matriz"][$i][$j]=6;
					if($_SESSION["color"]==3)
						$_SESSION["matriz"][$i][$j]=3;		
				}
				else
				if($_SESSION["matriz"][$i][$j]==4 || $_SESSION["matriz"][$i][$j]==5 || $_SESSION["matriz"][$i][$j]==6)
				{					
						$_SESSION["matriz"][$i][$j]=7;						
				}
			}
			
		$_SESSION["turno"]=0;		
	}
}

$_SESSION["blancas"]=0;
$_SESSION["amarillas"]=0;
$_SESSION["azules"]=0;
$_SESSION["rojas"]=0;
$_SESSION["verdes"]=0;
$_SESSION["naranjas"]=0;
$_SESSION["moradas"]=0;
$_SESSION["marrones"]=0;

for($i=0;$i<$_SESSION["n"];$i++)
		for($j=0;$j<$_SESSION["m"];$j++)
		{
			if($_SESSION["matriz"][$i][$j]==0)
				$_SESSION["blancas"]++;
			if($_SESSION["matriz"][$i][$j]==1)
				$_SESSION["amarillas"]++;
			if($_SESSION["matriz"][$i][$j]==2)
				$_SESSION["azules"]++;
			if($_SESSION["matriz"][$i][$j]==3)
				$_SESSION["rojas"]++;
			if($_SESSION["matriz"][$i][$j]==4)
				$_SESSION["verdes"]++;
			if($_SESSION["matriz"][$i][$j]==5)
				$_SESSION["naranjas"]++;
			if($_SESSION["matriz"][$i][$j]==6)
				$_SESSION["moradas"]++;
			if($_SESSION["matriz"][$i][$j]==7)
				$_SESSION["marrones"]++;
		}
?>
<body>
<form id="form1" name="form1" method="get" action="">
<table border="1">
    <tr>
      <td colspan="3">Seleccione color</td>
      <td>Color activo</td>
    </tr>
    <tr>
      <td><a href="juego.php?color=1"><img width="25" heigth="25" src="Imagenes/amarillo.jpg"/></a></td>
      <td><a href="juego.php?color=2"><img width="25" heigth="25" src="Imagenes/azul.jpg"/></a></td>
      <td><a href="juego.php?color=3"><img width="25" heigth="25" src="Imagenes/rojo.jpg"/></a></td>
      <td><?php 
	  if($_SESSION["color"]==1) 
	  {?>
      	<center><img width="25" heigth="25" src="Imagenes/amarillo.jpg"/></center>
      <?php 
	  }
	  if($_SESSION["color"]==2) 
	  {?>
      	<center><img width="25" heigth="25" src="Imagenes/azul.jpg"/></center>
      <?php 
	  }
	  if($_SESSION["color"]==3) 
	  {?>
      	<center><img width="25" heigth="25" src="Imagenes/rojo.jpg"/></center>
      <?php
	  }
	  ?>
         </td>
    </tr>
  </table>
<table border="1">
<?php
  for($i=0;$i<$_SESSION["n"];$i++)
  {
  ?>
    <tr>
    <?php
	for($j=0;$j<$_SESSION["m"];$j++)
	{
		if($_SESSION["matriz"][$i][$j]==0)//blanco
		{
		?>
   	  <td><a href="juego.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/blanco.jpg"/></a></td>
        <?php
		}
		if($_SESSION["matriz"][$i][$j]==2)//azul
		{
		?>
   	  <td><a href="juego.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/azul.jpg"/></a></td>
        <?php
		}
		if($_SESSION["matriz"][$i][$j]==3)//rojo
		{
		?>
	  <td><a href="juego.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/rojo.jpg"/></a></td>
    	<?php
		}
		if($_SESSION["matriz"][$i][$j]==1)//amarillo
		{
		?>
	  <td><a href="juego.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/amarillo.jpg"/></a></td>
    	<?php
		}
		if($_SESSION["matriz"][$i][$j]==4)//verde
		{
		?>
   	  <td><a href="juego.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/verde.jpg"/></a></td>
        <?php
		}
		if($_SESSION["matriz"][$i][$j]==5)//naranja
		{
		?>
   	  <td><a href="juego.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/naranja.jpg"/></a></td>
        <?php
		}
		if($_SESSION["matriz"][$i][$j]==6)//morado
		{
		?>
   	  <td><a href="juego.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/morado.jpg"/></a></td>
        <?php
		}
		if($_SESSION["matriz"][$i][$j]==7)//marron
		{
		?>
   	  <td><a href="juego.php?fila=<?php echo $i;?>&columna=<?php echo $j;?>"><img width="25" heigth="25" src="Imagenes/marron.jpg"/></a></td>
        <?php
		}
	}
	?>
    </tr>
    <?php
  }
?>
</table>

  <p>Jugador: <?php echo $_SESSION["nombre"]; ?></p> 
  <p>cuadros blancos: <?php echo $_SESSION["blancas"]; ?></p>
  <p>cuadros amarillos: <?php echo $_SESSION["amarillas"]; ?></p>
  <p>cuadros azules: <?php echo $_SESSION["azules"]; ?></p>
  <p>cuadros rojos: <?php echo $_SESSION["rojas"]; ?></p>
  <p>cuadros verdes: <?php echo $_SESSION["verdes"]; ?></p>
  <p>cuadros naranja: <?php echo $_SESSION["naranjas"]; ?></p>
  <p>cuadros morados: <?php echo $_SESSION["moradas"]; ?></p>
  <p>cuadros marrones: <?php echo $_SESSION["marrones"]; ?></p>
  <p>
    <input type="submit" name="reiniciar" id="reiniciar" value="reiniciar" />
  </p>
  
</form>
</body>
</html>