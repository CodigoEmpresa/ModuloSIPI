<?php

return array( 
 
  'conexion' => 'db_principal', 
   
  'modulo' => '38', 
  'seccion' => 'Personas', 
  'prefijo_ruta' => 'personas', 
  'prefijo_ruta_modulo' => 'actividad', 
 
  'modelo_persona' => 'Idrd\Usuarios\Repo\Persona', 
  'modelo_documento' => 'Idrd\Usuarios\Repo\Documento', 
  'modelo_pais' => 'Idrd\Usuarios\Repo\Pais', 
  'modelo_ciudad' => 'Idrd\Usuarios\Repo\Ciudad', 
  'modelo_departamento' => 'Idrd\Usuarios\Repo\Departamento', 
  'modelo_genero' => 'Idrd\Usuarios\Repo\Genero', 
  'modelo_etnia' => 'Idrd\Usuarios\Repo\Etnia', 
  'modelo_tipo' => 'Idrd\Usuarios\Repo\Tipo',
  'modelo_acceso' => 'Idrd\Usuarios\Repo\Acceso',
  'modelo_datos' => 'Idrd\Usuarios\Repo\Datos',
  'modelo_asim' => 'Idrd\Usuarios\Repo\ActividadesSim',
  
   
  //vistas que carga las vistas 
  'vista_lista' => 'list', 
 
  //lista 
  'lista'  => 'idrd.usuarios.lista', 
);