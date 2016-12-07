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

require_model('marca_vehiculo.php');

class automocion_marcas_vehiculos extends fs_controller
{
   public $listado;
   public $editar_marca_vehiculo;
   public $marca_vehiculo;

   public $search_list;
   public $count_search_list;

   public $total_resultados;
   public $offset;
   public $query;

   public function __construct()
   {
      parent::__construct(__CLASS__, 'Marcas vehículos', 'Automoción');
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

      $this->editar_marca_vehiculo = false;
      $this->marca_vehiculo = new marca_vehiculo();

      /* Mostraremos siempre el listado en la pestaña Listado */
      $this->listado = $this->marca_vehiculo->all($this->offset);

      /* Buscar elemento usando AJAX */
      if (isset($_REQUEST[ 'buscar_marca_vehiculo' ])) {
         $this->buscar_marca_vehiculo();
      }
      /* Modificar un elemento existente */
      elseif (isset($_POST[ 'id' ])) {
         $this->modificar_marca();
      }
      /* Insertamos elemento nuevo */
      elseif (isset($_POST[ 'nombre' ])) {
         $this->insertar_marca();
      }
      /* Obtenemos elemento recibido */
      elseif (isset($_GET[ 'id' ])) {
         $this->editar_marca_vehiculo = $this->marca_vehiculo->get($_GET[ 'id' ]);
      }
      /* Eliminamos un elemento existente */
      elseif (isset($_GET[ 'delete' ])) {
         $this->eliminar_marca();
      }
      /*Buscamos coincidencias existentes */
      elseif (isset($_REQUEST[ 'query' ])) {
         /* Indicamos a la paginacion que vamos a buscar */
         $this->query = $_REQUEST[ 'query' ];
         $this->search_list = $this->marca_vehiculo->search_limit($this->query, $this->offset);
         $this->count_search_list = count($this->marca_vehiculo->search($this->query, $this->offset));
      }
   }

   protected function modificar_marca()
   {
      $this->editar_marca_vehiculo = $this->marca_vehiculo->get($_POST[ 'id' ]);

      if ($this->editar_marca_vehiculo) {
         $this->editar_marca_vehiculo->nombre = $_POST[ 'nombre' ];
         $this->editar_marca_vehiculo->imagen = $_POST[ 'imagen' ];
         if ($this->editar_marca_vehiculo->save()) {
            $this->new_message('Se ha modificado el fabricante de vehículo correctamente.');
            $this->editar_marca_vehiculo = $this->marca_vehiculo->get($_POST[ 'id' ]);
         } else {
            $this->new_error_msg('Ha ocurrido un error modificando el fabricante de vehículo.');
         }
      }
   }

   protected function insertar_marca()
   {
      $this->marca_vehiculo->nombre = $_POST[ 'nombre' ];
      $this->marca_vehiculo->imagen = $_POST[ 'imagen' ];

      if ($this->marca_vehiculo->save()) {
         $this->new_message('Se ha insertado el fabricante de vehículo correctamente.');
      } else {
         $this->new_error_msg('Ha ocurrido un error guardando el fabricante de vehículo.');
      }
   }

   protected function eliminar_marca()
   {
      $delete_marca_vehiculo = $this->marca_vehiculo->get($_GET[ 'delete' ]);

      if ($delete_marca_vehiculo) {
         if ($delete_marca_vehiculo->delete()) {
            $this->new_message('Se ha eliminado el fabricante de vehículo correctamente.');
         } else {
            $this->new_error_msg('Ha ocurrido un error eliminando el fabricante de vehículo.');
         }
      } else {
         $this->new_error_msg('Fabricante de vehículo no encontrado.');
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
      $data = $this->db->select('SELECT COUNT(id) AS total FROM automocion_marcas_vehiculos;');
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
