<?php require_once ('header.php'); ?>

<table class="w3-table">
<tr>
  <th>Email</th>
  <th>Rol</th>
  <th></th>
</tr>
<tr>
  <td><?php echo $_SESSION['usuario']['usuario'] ?></td>
  <td><?php echo $_SESSION['usuario']['rol'] ?></td>
  <td><a href="cerrar.php" class="w3-button w3-red">Cerrar Sesion</a></td>
</tr>
</table>
