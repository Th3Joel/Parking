<?php
include "model/planes.model.php";
require "controller/permiso.php";
$planes = ModelPlanes::Mostrar(null); 
?>

<table id="tablePlanes" class="table table-sm table-striped nowrap table-hover w-100">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="bodyPlanes">
                    
                    <?php

						foreach ($planes as $key => $value) {
							echo "<tr>
				                  <td>".($key + 1)."</td>
				                  <td>".$value["NombrePlan"]."</td>
				                  <td>".$value["PrecioPlan"]."</td>
				                  <td>
				                  '<button class='btn btn-primary' idEdit=".$value["Id_Planes"]." id='btnEdit'><i class='bi bi-pen'></i></button>'
				                  '<button class='btn btn-danger' idElim=".$value["Id_Planes"]." id='btnElim'><i class='bi bi-trash'></i></button>'
				                  </td>
				                </tr>";
						}
					?>
                </tbody>
              </table>
