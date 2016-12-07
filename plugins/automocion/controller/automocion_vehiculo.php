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

require_model('vehiculo.php');
require_model('modelo_vehiculo.php');
require_model('marca_vehiculo.php');
require_model('cliente.php');
require_model('vehiculo_documento.php');

class automocion_vehiculo extends fs_controller
{
   public $allow_delete;
   public $id;
   public $editar_vehiculo;
   public $vehiculo;
   public $cliente;

   public $marca_vehiculo;
   public $modelo_vehiculo;
   public $search_list;
   public $count_search_list;
   public $count_presupuestos;

   public $vehiculo_documento;
   public $total_resultados;
   public $offset;
   public $query;

   public function __construct()
   {
      parent::__construct(__CLASS__, 'Veh&iacute;culos de clientes', 'Automoción', false, false);
   }

   protected function private_core()
   {
      $this->allow_delete = $this->user->allow_delete_on(__CLASS__);
      $this->show_fs_toolbar = false;
      $this->share_extensions();

      /* Controlamos el offset de la paginacion */
      if( isset($_REQUEST['offset']) ) {
         $this->offset = intval($_REQUEST['offset']);
      } else {
         $this->offset = 0;
      }

      // AÑADIR EXTENSION EN CLIENTES
      $this->editar_vehiculo = FALSE;
      $this->vehiculo = new vehiculo();
      $this->vehiculo_documento = new vehiculo_documento();
      $this->cliente = new cliente();
      $this->marca_vehiculo = new marca_vehiculo();
      $this->modelo_vehiculo = new modelo_vehiculo();

      /* Buscar elemento usando AJAX */
      if (isset($_REQUEST[ 'buscar_marca_vehiculo' ])) {
         $this->buscar_marca_vehiculo();
      } elseif (isset($_REQUEST[ 'buscar_modelo_vehiculo' ])) {
         $this->buscar_modelo_vehiculo($_REQUEST[ 'marca_vehiculo' ]);
      } elseif (isset($_REQUEST[ 'buscar_vehiculo' ])) {
         $this->buscar_vehiculo($_REQUEST[ 'vehiculo' ]);
      } elseif (isset($_REQUEST[ 'buscar_cliente' ])) {
         $this->buscar_cliente();
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
         $this->id = $_GET[ 'id' ];
         $this->editar_vehiculo = $this->vehiculo->get($this->id);
         $this->count_presupuestos = $this->count_presupuestos($this->id);
         $this->count_pedidos = $this->count_pedidos($this->id);
         $this->count_servicios = $this->count_servicios($this->id);
         $this->count_albaranes = $this->count_albaranes($this->id);
         $this->count_facturas = $this->count_facturas($this->id);
      }
      /* Eliminamos un elemento existente */
      elseif (isset($_GET[ 'delete' ])) {
         $this->eliminar_vehiculo();
      }
      /* Buscamos coincidencias existentes */
      elseif (isset($_POST[ 'query' ])) {
         /* Indicamos a la paginacion que vamos a buscar */
         $this->query = $_REQUEST[ 'query' ];
         $this->search_list = $this->vehiculo->search_limit($this->query, $this->offset);
         $this->count_search_list = count($this->vehiculo->search($this->query, $this->offset));
      }
      /* Para ver los vehiculos de un cliente */
      else if( isset($_GET['codcliente']) )
      {
         $this->template = 'extension/automocion_vehiculos_cliente';

         $cliente = new cliente();
         $this->cliente = $cliente->get($_GET['codcliente']);
         $this->resultados = $this->vehiculo->all_from_cliente($_GET['codcliente'], $this->offset);
      }

      if($this->editar_vehiculo) {
         $this->page->title = "Veh&iacute;culo " . $this->editar_vehiculo->matricula;
      } else {
         $this->new_error_msg("¡Veh&iacute;culo no encontrado!");
      }
   }

   public function anterior_url()
   {
      $url = '';
      $extra = '';

      if( isset($_GET['codagente']) ) {
         $extra .= '&codagente=' . $_GET['codagente'];
      } else if( isset($_GET['codcliente']) ) {
         $extra .= '&codcliente=' . $_GET['codcliente'];
      } else if( isset($_GET['ref']) ) {
         $extra .= '&ref=' . $_GET['ref'];
      }

      if($this->query != '' AND $this->offset > '0') {
         $url = $this->url() . "&query=" . $this->query . "&offset=" . ($this->offset - FS_ITEM_LIMIT) . $extra;
      } else if($this->query == '' AND $this->offset > '0') {
         $url = $this->url() . "&offset=" . ($this->offset - FS_ITEM_LIMIT) . $extra;
      }

      return $url;
   }

   public function siguiente_url()
   {
      $url = '';
      $extra = '';

      if( isset($_GET['codagente']) ) {
         $extra .= '&codagente=' . $_GET['codagente'];
      } else if( isset($_GET['codcliente']) ) {
         $extra .= '&codcliente=' . $_GET['codcliente'];
      } else if( isset($_GET['ref']) ) {
         $extra .= '&ref=' . $_GET['ref'];
      }

      if($this->query != '' AND count($this->resultados) == FS_ITEM_LIMIT) {
         $url = $this->url() . "&query=" . $this->query . "&offset=" . ($this->offset + FS_ITEM_LIMIT) . $extra;
      } else if($this->query == '' AND count($this->resultados) == FS_ITEM_LIMIT) {
         $url = $this->url() . "&offset=" . ($this->offset + FS_ITEM_LIMIT) . $extra;
      }

      return $url;
   }

   protected function modificar_vehiculo()
   {
      $this->editar_vehiculo = $this->vehiculo->get($_POST[ 'id' ]);

      if ($this->editar_vehiculo) {
         $this->editar_vehiculo->codcliente = $_POST[ 'codcliente' ];
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
            $this->new_message('Se ha modificado el veh&iacute;culo '.$_POST[ 'matricula' ].' correctamente.');
            $this->editar_vehiculo = $this->vehiculo->get($_POST[ 'id' ]);
         } else {
            $this->new_error_msg('Ha ocurrido un error modificando el veh&iacute;culo '.$_POST[ 'matricula' ]);
         }
      }
   }

   protected function insertar_vehiculo()
   {
      $this->vehiculo->codcliente = $_POST[ 'codcliente' ];
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
         $this->new_message('Se ha insertado el veh&iacute;culo '.$_POST[ 'matricula' ].' correctamente.');
      } else {
         $this->new_error_msg('Ha ocurrido un error guardando el veh&iacute;culo '.$_POST[ 'matricula' ]);
      }
   }

   protected function eliminar_vehiculo()
   {
      $delete_vehiculo = $this->vehiculo->get($_GET[ 'delete' ]);

      if ($delete_vehiculo) {
         if ($delete_vehiculo->delete()) {
            $this->new_message('Se ha eliminado el veh&iacute;culo '.$this->vehiculo->matricula.' correctamente.');
         } else {
            $this->new_error_msg('Ha ocurrido un error eliminando el veh&iacute;culo '.$this->vehiculo->matricula);
         }
      } else {
         $this->new_error_msg('Veh&iacute;culo no encontrado.');
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

   private function buscar_cliente()
   {
      /// desactivamos la plantilla HTML
      $this->template = false;

      $cli0 = new cliente();
      $json = array();
      foreach ($cli0->search($_REQUEST['buscar_cliente']) as $cli) {
         $json[] = array('value' => $cli->nombre, 'data' => $cli->codcliente);
      }

      header('Content-Type: application/json');
      echo json_encode(array('query' => $_REQUEST['buscar_cliente'], 'suggestions' => $json));
   }

   public function share_extensions()
   {
      $items = '<script type="text/javascript" src="view/js/jquery.validate.min.js"></script>';

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
      $data = $this->db->select('SELECT COUNT(id) AS total FROM automocion_vehiculos;');
      if ($data) {
         return intval($data[0]['total']);
      } else {
         return 0;
      }
   }
   
   public function count_presupuestos($id) {
      return count($this->vehiculo_documento->get_presupuestos_from_vehiculo($id));
   }
   
   public function count_pedidos($id) {
      return count($this->vehiculo_documento->get_pedidos_from_vehiculo($id));
   }
   
   public function count_servicios($id) {
      return count($this->vehiculo_documento->get_servicios_from_vehiculo($id));
   }
   
   public function count_albaranes($id) {
      return count($this->vehiculo_documento->get_albaranes_from_vehiculo($id));
   }
   
   public function count_facturas($id) {
      return count($this->vehiculo_documento->get_facturas_from_vehiculo($id));
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
