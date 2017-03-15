<?php

return array( 
 
  'conexion' => 'db_principal', 
   
  'modulo' => '38', 
  'seccion' => 'Personas', 
  'prefijo_ruta' => 'personas', 
  'prefijo_ruta_modulo' => 'actividad', 
 
  'modelo_persona' => 'App\Modelos\Persona', 
  'modelo_documento' => 'App\Modelos\Documento', 
  'modelo_pais' => 'App\Modelos\Pais', 
  'modelo_ciudad' => 'App\Modelos\Ciudad', 
  'modelo_departamento' => 'App\Modelos\Departamento', 
  'modelo_genero' => 'App\Modelos\Genero', 
  'modelo_etnia' => 'App\Modelos\Etnia', 
  'modelo_tipo' => 'App\Modelos\Tipo',  
   
  //vistas que carga las vistas 
  'vista_lista' => 'list', 
 
  //lista 
  'lista'  => 'idrd.usuarios.lista', 
);