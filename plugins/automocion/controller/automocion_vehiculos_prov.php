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

require_model('vehiculo_prov.php');
require_model('modelo_vehiculo.php');
require_model('marca_vehiculo.php');
require_model('proveedor.php');

class automocion_vehiculos_prov extends fs_controller
{
   public $listado;
   public $editar_vehiculo;
   public $vehiculo;
   public $proveedor;

   public $marca_vehiculo;
   public $modelo_vehiculo;
   public $search_list;
   public $count_search_list;

   public $total_resultados;
   public $offset;
   public $query;

   public function __construct()
   {
      parent::__construct(__CLASS__, 'Vehículos de la empresa', 'Automoción');
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

      // AÑADIR EXTENSION EN PROVEEDORES
      $this->editar_vehiculo = false;
      $this->vehiculo = new vehiculo_prov();
      $this->proveedor = new proveedor();
      $this->marca_vehiculo = new marca_vehiculo();
      $this->modelo_vehiculo = new modelo_vehiculo();

      /* Buscar elemento usando AJAX */
      if (isset($_REQUEST[ 'buscar_marca_vehiculo' ])) {
         $this->buscar_marca_vehiculo();
      } elseif (isset($_REQUEST[ 'buscar_modelo_vehiculo' ])) {
         $this->buscar_modelo_vehiculo($_REQUEST[ 'marca_vehiculo' ]);
      } elseif (isset($_REQUEST[ 'buscar_vehiculo' ])) {
         $this->buscar_vehiculo($_REQUEST[ 'vehiculo' ]);
      } elseif (isset($_REQUEST[ 'buscar_proveedor' ])) {
         $this->buscar_proveedor();
      }
      /* Modificar un elemento existente */
      elseif (isset($_POST[ 'id' ])) {
         $this->modificar_vehiculo();
      }
      /* Insertamos elemento nuevo */
      elseif (isset($_POST[ 'matricula' ])) {
         $this->insertar_vehiculo();
      }
      /* Obtenemos elemento recibido */
      elseif (isset($_GET[ 'id' ])) {
         $this->editar_vehiculo = $this->vehiculo->get($_GET[ 'id' ]);
      }
      /* Eliminamos un elemento existente */
      elseif (isset($_GET[ 'delete' ])) {
         $this->eliminar_vehiculo();
      }
      /*Buscamos coincidencias existentes */
      elseif (isset($_POST[ 'query' ])) {
         /* Indicamos a la paginacion que vamos a buscar */
         $this->query = $_REQUEST[ 'query' ];
         $this->search_list = $this->vehiculo->search_limit($this->query, $this->offset);
         $this->count_search_list = count($this->vehiculo->search($this->query, $this->offset));
      }
      else if( isset($_GET['codproveedor']) )
      {
         $this->template = 'extension/automocion_vehiculos_proveedor';

         $proveedor = new proveedor();
         $this->proveedor = $proveedor->get($_GET['codproveedor']);
         $this->resultados = $this->vehiculo->all_from_proveedor($_GET['codproveedor'], $this->offset);
      }

      /* Mostraremos siempre el listado en la pestaña Listado */
      $this->listado = $this->vehiculo->all($this->offset);
   }

   public function anterior_url()
   {
      $url = '';
      $extra = '';

      if( isset($_GET['codagente']) )
      {
         $extra .= '&codagente=' . $_GET['codagente'];
      }
      else if( isset($_GET['codproveedor']) )
      {
         $extra .= '&codproveedor=' . $_GET['codproveedor'];
      }
      else if( isset($_GET['ref']) )
      {
         $extra .= '&ref=' . $_GET['ref'];
      }

      if($this->query != '' AND $this->offset > '0')
      {
         $url = $this->url() . "&query=" . $this->query . "&offset=" . ($this->offset - FS_ITEM_LIMIT) . $extra;
      }
      else if($this->query == '' AND $this->offset > '0')
      {
         $url = $this->url() . "&offset=" . ($this->offset - FS_ITEM_LIMIT) . $extra;
      }

      return $url;
   }

   public function siguiente_url()
   {
      $url = '';
      $extra = '';

      if( isset($_GET['codagente']) )
      {
         $extra .= '&codagente=' . $_GET['codagente'];
      }
      else if( isset($_GET['codproveedor']) )
      {
         $extra .= '&codproveedor=' . $_GET['codproveedor'];
      }
      else if( isset($_GET['ref']) )
      {
         $extra .= '&ref=' . $_GET['ref'];
      }

      if($this->query != '' AND count($this->resultados) == FS_ITEM_LIMIT)
      {
         $url = $this->url() . "&query=" . $this->query . "&offset=" . ($this->offset + FS_ITEM_LIMIT) . $extra;
      }
      else if($this->query == '' AND count($this->resultados) == FS_ITEM_LIMIT)
      {
         $url = $this->url() . "&offset=" . ($this->offset + FS_ITEM_LIMIT) . $extra;
      }

      return $url;
   }

   protected function modificar_vehiculo()
   {
      $this->editar_vehiculo = $this->vehiculo->get($_POST[ 'id' ]);

      if ($this->editar_vehiculo) {
         $this->editar_vehiculo->codproveedor = $_POST[ 'codproveedor' ];
         $this->editar_vehiculo->matricula = $_POST[ 'matricula' ];
         $this->editar_vehiculo->bastidor = $_POST[ 'bastidor' ];
         $this->editar_vehiculo->marca = intval($_POST[ 'marca' ]);
         $this->editar_vehiculo->clase = $_POST[ 'clase' ];
         $this->editar_vehiculo->tipo = $_POST[ 'tipo' ];
         $this->editar_vehiculo->altura_total = intval($_POST[ 'altura_total' ]);
         $this->editar_vehiculo->variante = $_POST[ 'variante' ];
         $this->editar_vehiculo->anchura_total = intval($_POST[ 'anchura_total' ]);
         $this->editar_vehiculo->denominacion_comercial = intval($_POST[ 'denominacion_comercial' ]);
         $this->editar_vehiculo->via_anterior = intval($_POST[ 'via_anterior' ]);
         $this->editar_vehiculo->tara = intval($_POST[ 'tara' ]);
         $this->editar_vehiculo->longitud = intval($_POST[ 'longitud' ]);
         $this->editar_vehiculo->mtma = intval($_POST[ 'mtma' ]);
         $this->editar_vehiculo->voladizo_posterior = intval($_POST[ 'voladizo_posterior' ]);
         $this->editar_vehiculo->mtma1e = intval($_POST[ 'mtma1e' ]);
         $this->editar_vehiculo->distancia_eje_1_2 = intval($_POST[ 'distancia_eje_1_2' ]);
         $this->editar_vehiculo->mtma2e = intval($_POST[ 'mtma2e' ]);
         $this->editar_vehiculo->distancia_eje_2_3 = intval($_POST[ 'distancia_eje_2_3' ]);
         $this->editar_vehiculo->mtma3e = intval($_POST[ 'mtma3e' ]);
         $this->editar_vehiculo->distancia_eje_3_4 = intval($_POST[ 'distancia_eje_3_4' ]);
         $this->editar_vehiculo->mtma4e = intval($_POST[ 'mtma4e' ]);
         $this->editar_vehiculo->distancia_5_rueda = intval($_POST[ 'distancia_5_rueda' ]);
         $this->editar_vehiculo->mmr = intval($_POST[ 'mmr' ]);
         $this->editar_vehiculo->marca_motor = $_POST[ 'marca_motor' ];
         $this->editar_vehiculo->neumaticos = $_POST[ 'neumaticos' ];
         $this->editar_vehiculo->tipo_motor = $_POST[ 'tipo_motor' ];
         $this->editar_vehiculo->n_asientos = intval($_POST[ 'n_asientos' ]);
         $this->editar_vehiculo->cilindrada = intval($_POST[ 'cilindrada' ]);
         $this->editar_vehiculo->volumen_bodega = intval($_POST[ 'volumen_bodega' ]);
         $this->editar_vehiculo->potencia = $_POST[ 'potencia' ];
         $this->editar_vehiculo->homologaciones = $_POST[ 'homologaciones' ];
         $this->editar_vehiculo->fecha_matriculacion = $_POST[ 'fecha_matriculacion' ];

         if ($this->editar_vehiculo->save()) {
            $this->new_message('Se ha modificado el vehículo correctamente.');
            $this->editar_vehiculo = $this->vehiculo->get($_POST[ 'id' ]);
         } else {
            $this->new_error_msg('Ha ocurrido un error modificando el vehículo.');
         }
      }
   }

   protected function insertar_vehiculo()
   {
      $this->vehiculo->codproveedor  = $_POST[ 'codproveedor' ];
      $this->vehiculo->matricula = $_POST[ 'matricula' ];
      $this->vehiculo->bastidor = $_POST[ 'bastidor' ];
      $this->vehiculo->marca = intval($_POST[ 'marca' ]);
      $this->vehiculo->clase = $_POST[ 'clase' ];
      $this->vehiculo->tipo = $_POST[ 'tipo' ];
      $this->vehiculo->altura_total = intval($_POST[ 'altura_total' ]);
      $this->vehiculo->variante = $_POST[ 'variante' ];
      $this->vehiculo->anchura_total = intval($_POST[ 'anchura_total' ]);
      $this->vehiculo->denominacion_comercial = intval($_POST[ 'denominacion_comercial' ]);
      $this->vehiculo->via_anterior = intval($_POST[ 'via_anterior' ]);
      $this->vehiculo->tara = intval($_POST[ 'tara' ]);
      $this->vehiculo->longitud = intval($_POST[ 'longitud' ]);
      $this->vehiculo->mtma = intval($_POST[ 'mtma' ]);
      $this->vehiculo->voladizo_posterior = intval($_POST[ 'voladizo_posterior' ]);
      $this->vehiculo->mtma1e = intval($_POST[ 'mtma1e' ]);
      $this->vehiculo->distancia_eje_1_2 = intval($_POST[ 'distancia_eje_1_2' ]);
      $this->vehiculo->mtma2e = intval($_POST[ 'mtma2e' ]);
      $this->vehiculo->distancia_eje_2_3 = intval($_POST[ 'distancia_eje_2_3' ]);
      $this->vehiculo->mtma3e = intval($_POST[ 'mtma3e' ]);
      $this->vehiculo->distancia_eje_3_4 = intval($_POST[ 'distancia_eje_3_4' ]);
      $this->vehiculo->mtma4e = intval($_POST[ 'mtma4e' ]);
      $this->vehiculo->distancia_5_rueda = intval($_POST[ 'distancia_5_rueda' ]);
      $this->vehiculo->mmr = intval($_POST[ 'mmr' ]);
      $this->vehiculo->marca_motor = $_POST[ 'marca_motor' ];
      $this->vehiculo->neumaticos = $_POST[ 'neumaticos' ];
      $this->vehiculo->tipo_motor = $_POST[ 'tipo_motor' ];
      $this->vehiculo->n_asientos = intval($_POST[ 'n_asientos' ]);
      $this->vehiculo->cilindrada = $_POST[ 'cilindrada' ];
      $this->vehiculo->volumen_bodega = intval($_POST[ 'volumen_bodega' ]);
      $this->vehiculo->potencia = $_POST[ 'potencia' ];
      $this->vehiculo->homologaciones = $_POST[ 'homologaciones' ];
      $this->vehiculo->fecha_matriculacion = $_POST[ 'fecha_matriculacion' ];

      if ($this->vehiculo->save()) {
         $this->new_message('Se ha insertado el vehículo correctamente.');
      } else {
         $this->new_error_msg('Ha ocurrido un error guardando el vehículo.');
      }
   }

   protected function eliminar_vehiculo()
   {
      $delete_vehiculo = $this->vehiculo->get($_GET[ 'delete' ]);

      if ($delete_vehiculo) {
         if ($delete_vehiculo->delete()) {
            $this->new_message('Se ha eliminado el vehículo correctamente.');
         } else {
            $this->new_error_msg('Ha ocurrido un error eliminando el vehículo.');
         }
      } else {
         $this->new_error_msg('Vehículo no encontrado.');
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

   private function buscar_modelo_vehiculo()
   {
      /// desactivamos la plantilla HTML
      $this->template = false;

      $json = array();
      foreach ($this->modelo_vehiculo->search_model($_REQUEST[ 'buscar_modelo_vehiculo' ], $_REQUEST[ 'marca_vehiculo' ]) as $modelo) {
         $json[] = array('value' => $modelo->nombre, 'data' => $modelo->id);
      }

      header('Content-Type: application/json');
      echo json_encode(array('query' => $_REQUEST[ 'buscar_modelo_vehiculo' ],
      'suggestions' => $json, ));
   }

   private function buscar_proveedor()
   {
      /// desactivamos la plantilla HTML
      $this->template = false;

      $pro0 = new proveedor();
      $json = array();
      foreach ($pro0->search($_REQUEST['buscar_proveedor']) as $pro) {
         $json[] = array('value' => $pro->nombre, 'data' => $pro->codproveedor);
      }

      header('Content-Type: application/json');
      echo json_encode(array('query' => $_REQUEST['buscar_proveedor'], 'suggestions' => $json));
   }

   public function share_extensions()
   {
      $items =
      '<script type="text/javascript" src="view/js/jquery.validate.min.js"></script>';

      $extensions = array(
         array(
             'name' => 'automocion_vehiculos_prov',
             'page_from' => __CLASS__,
             'page_to' => 'compras_proveedor',
             'type' => 'button',
             'text' => '<span class="glyphicon glyphicon-list" aria-hidden="true"></span> &nbsp; Veh&iacute;culos',
             'params' => ''
         ),
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

      $data = $this->db->select('SELECT COUNT(id) AS total FROM automocion_vehiculos_prov;');
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
