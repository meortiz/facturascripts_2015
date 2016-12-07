<?php

/*
 * This file is part of FacturaScripts
 * Copyright (C) 2014-2016  Francesc Pineda Segarra  shawe.ewahs@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_model('modelo_vehiculo.php');
require_model('marca_vehiculo.php');

class automocion_modelos_vehiculos extends fs_controller
{
   public $listado;
   public $editar_modelo_vehiculo;
   public $modelo_vehiculo;
   public $marca_vehiculo;

   public $search_list;
   public $count_search_list;

   public $total_resultados;
   public $offset;
   public $query;

   public function __construct()
   {
      parent::__construct(__CLASS__, 'Modelos vehículos', 'Automoción');
   }

   protected function private_core()
   {
      $this->show_fs_toolbar = false;
      $this->share_extensions();

      /* Controlamos el offset de la paginacion */
      if( isset($_REQUEST['offset']) ) {
         $this->offset = intval($_REQUEST['offset']);
      } else {
         $this->offset = 0;
      }

      $this->editar_modelo_vehiculo = false;
      $this->modelo_vehiculo = new modelo_vehiculo();
      $this->marca_vehiculo = new marca_vehiculo();

      /* Mostraremos siempre el listado en la pestaña Listado */
      $this->listado = $this->modelo_vehiculo->all($this->offset);

      /* Buscar elemento usando AJAX */
      if (isset($_REQUEST[ 'buscar_marca_vehiculo' ])) {
         $this->buscar_marca_vehiculo();
      }
      /* Modificar un elemento existente */
      elseif (isset($_POST[ 'id' ])) {
         $this->modificar_modelo();
      }
      /* Insertamos elemento nuevo */
      elseif (isset($_POST[ 'nombre' ])) {
         $this->insertar_modelo();
      }
      /* Obtenemos elemento recibido */
      elseif (isset($_GET[ 'id' ])) {
         $this->editar_modelo_vehiculo = $this->modelo_vehiculo->get($_GET[ 'id' ]);
      }
      /* Eliminamos un elemento existente */
      elseif (isset($_GET[ 'delete' ])) {
         $this->eliminar_modelo();
      }
      /*Buscamos coincidencias existentes */
      elseif (isset($_REQUEST[ 'query' ])) {
         $this->query = $_REQUEST[ 'query' ];
         $this->search_list = $this->modelo_vehiculo->search_limit($this->query, $this->offset);
         $this->count_search_list = count($this->modelo_vehiculo->search($this->query, $this->offset));
      }
   }

   private function buscar_marca_vehiculo()
   {
      /// desactivamos la plantilla HTML
      $this->template = false;

      $json = array();
      foreach ($this->marca_vehiculo->search($_REQUEST[ 'buscar_marca_vehiculo' ]) as $vehiculo) {
         $json[] = array('value' => $vehiculo->nombre, 'data' => $vehiculo->id);
      }

      header('Content-Type: application/json');
      echo json_encode(array('query' => $_REQUEST[ 'buscar_marca_vehiculo' ],
         'suggestions' => $json, ));
   }

   protected function modificar_modelo()
   {
      $this->editar_modelo_vehiculo = $this->modelo_vehiculo->get($_POST[ 'id' ]);

      if ($this->editar_modelo_vehiculo) {
         $this->editar_marca_vehiculo->id_marca = $_POST[ 'id_marca' ];
         $this->editar_modelo_vehiculo->nombre = $_POST[ 'nombre' ];
         $this->editar_modelo_vehiculo->imagen = $_POST[ 'imagen' ];

         if ($this->editar_modelo_vehiculo->save()) {
            $this->new_message('Se ha modificado el modelo de vehículo del fabricante correctamente.');
            $this->editar_modelo_vehiculo = $this->modelo_vehiculo->get($_POST[ 'id' ]);
         } else {
            $this->new_error_msg('Ha ocurrido un error modificando el modelo de vehículo del fabricante.');
         }
      }
   }

   protected function insertar_modelo()
   {
      $this->modelo_vehiculo->id_marca = $_POST[ 'id_marca' ];
      $this->modelo_vehiculo->nombre = $_POST[ 'nombre' ];
      $this->modelo_vehiculo->imagen = $_POST[ 'imagen' ];

      if ($this->modelo_vehiculo->save()) {
         $this->new_message('Se ha insertado el modelo de vehículo del fabricante correctamente.');
      } else {
         $this->new_error_msg('Ha ocurrido un error guardando el modelo de vehículo del fabricante.');
      }
   }

   protected function eliminar_modelo()
   {
      $delete_modelo_vehiculo = $this->modelo_vehiculo->get($_GET[ 'delete' ]);

      if ($delete_modelo_vehiculo) {
         if ($delete_modelo_vehiculo->delete()) {
            $this->new_message('Se ha eliminado el modelo de vehículo del fabricante correctamente.');
         } else {
            $this->new_error_msg('Ha ocurrido un error eliminando el modelo de vehículo del fabricante.');
         }
      } else {
         $this->new_error_msg('Modelo de vehículo del fabricante no encontrado.');
      }
   }

   public function share_extensions()
   {
      $items =
       '<script type="text/javascript" src="view/js/jquery.validate.min.js"></script>';

      $extensions = array(
       array(
         'name' => 'automocion',
         'page_from' => __CLASS__,
         'page_to' => __CLASS__,
         'type' => 'head',
         'text' => $items,
         'params' => '',
         ),
      );
      foreach ($extensions as $ext) {
         $fsext = new fs_extension($ext);
         $fsext->save();
      }
   }

   public function count()
   {
      $list = array();

      $data = $this->db->select('SELECT COUNT(id) AS total FROM automocion_modelos_vehiculos;');
      if ($data) {
         return intval($data[0]['total']);
      } else {
         return 0;
      }
   }

   private function total_registros()
   {
      return $this->count();
   }

   private function total_registros_busqueda()
   {
      return $this->count_search_list;
   }

   public function paginas_todo()
   {
      $paginas = array();
      $i = 0;
      $num = 0;
      $actual = 1;

      $url = $this->url();
      $total = $this->total_registros();

      /// añadimos todas la página
      while($num < $total) {
         $paginas[$i] = array(
             'url' => $url."&offset=".($i*FS_ITEM_LIMIT),
             'num' => $i + 1,
             'actual' => ($num == $this->offset)
         );

         if($num == $this->offset) {
            $actual = $i;
         }

         $i++;
         $num += FS_ITEM_LIMIT;
      }

      /// ahora descartamos
      foreach($paginas as $j => $value) {
         $enmedio = intval($i/2);

         /**
          * descartamos todo excepto la primera, la última, la de enmedio,
          * la actual, las 5 anteriores y las 5 siguientes
          */
         if( ($j>1 AND $j<$actual-5 AND $j!=$enmedio) OR ($j>$actual+5 AND $j<$i-1 AND $j!=$enmedio) ) {
            unset($paginas[$j]);
         }
      }

      return $paginas;
   }

   public function paginas_busqueda()
   {
      $paginas = array();
      $i = 0;
      $num = 0;
      $actual = 1;

      $total = $this->total_registros_busqueda();
      $url = $this->url()."&query=".$this->query;

      /// añadimos todas la página
      while($num < $total) {
         $paginas[$i] = array(
             'url' => $url."&offset=".($i*FS_ITEM_LIMIT),
             'num' => $i + 1,
             'actual' => ($num == $this->offset)
         );

         if($num == $this->offset) {
            $actual = $i;
         }

         $i++;
         $num += FS_ITEM_LIMIT;
      }

      /// ahora descartamos
      foreach($paginas as $j => $value) {
         $enmedio = intval($i/2);

         /**
          * descartamos todo excepto la primera, la última, la de enmedio,
          * la actual, las 5 anteriores y las 5 siguientes
          */
         if( ($j>1 AND $j<$actual-5 AND $j!=$enmedio) OR ($j>$actual+5 AND $j<$i-1 AND $j!=$enmedio) ) {
            unset($paginas[$j]);
         }
      }

      return $paginas;
   }
}
