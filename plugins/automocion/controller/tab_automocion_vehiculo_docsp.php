<?php
/*
 * This file is part of FacturaScripts
 * Copyright (C) 2015-2016  Francesc Pineda Segarra  shawe.ewahs@gmail.com
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

require_model('vehiculo_documento_prov.php');
require_model('vehiculo_prov.php');
require_model('marca_vehiculo.php');
require_model('modelo_vehiculo.php');
require_model('pedido_proveedor.php');
require_model('albaran_proveedor.php');
require_model('factura_proveedor.php');

/**
 * El controlador tab_automocion_vehiculo_docsp se encarga de gestionar la lógica de 
 * las relaciones entre los vehiculos y los documentos en los que se asocian vehiculos.
 *
 * @author Francesc Pineda Segarra
 */
class tab_automocion_vehiculo_docsp extends fs_controller
{
   public $allow_delete;
   public $marca;
   public $modelo;
   public $vehiculo_documento_prov;
   public $vehiculos_documentos_prov;
   public $relacion;
   public $vehiculo;
   public $vehiculos;
   public $idpedido;
   public $idalbaran;
   public $idfactura;

   public function __construct()
   {
      parent::__construct(__CLASS__, 'vehiculo_documento_prov', 'automocion', FALSE, FALSE);
   }

   protected function private_core()
   {
      $this->allow_delete = $this->user->allow_delete_on(__CLASS__);

      $this->marca = new marca_vehiculo();
      $this->modelo = new modelo_vehiculo();
      $this->vehiculo_documento_prov = new vehiculo_documento_prov();
      $this->vehiculo = new vehiculo_prov();
      $this->vehiculos = array();
      $this->vehiculos_documentos_prov = array();
      $this->relacion = array();

      /* Para eliminar relaciones con todos los idDOCUMENTO a NULL */
      $this->vehiculo_documento_prov->clean_empty_ids();
      
      /* Buscar elemento usando AJAX */
      if( isset($_REQUEST[ 'buscar_matricula_vehiculo' ]) ) {
         $this->buscar_matricula_vehiculo();
      }
      
      /* Eliminar vehiculo de vehiculo_documento_prov */
      else if( isset($_REQUEST['delete']) ) {
         $veh0 = $this->vehiculo->get($_REQUEST['delete']);
         if( isset($_REQUEST['pedido']) ) {
            $docs_vehiculo = $this->vehiculo_documento_prov->get_pedidos_from_vehiculo($_REQUEST['delete']);
            foreach ($docs_vehiculo as $doc_vehiculo) {
               if( $doc_vehiculo->idpedido == $_REQUEST['id'] ) {
                  if( $doc_vehiculo->delete_from_pedido($_REQUEST['delete'],$_REQUEST['id']) ) {
                     $this->new_message("Veh&iacute;culo ".$veh0->matricula." eliminado del ".FS_PEDIDO);
                  } else {
                     $this->new_error_msg("Error al eliminar el veh&iacute;culo ".$veh0->matricula." del ".FS_PEDIDO);
                  }
               }
            }
         } else if( isset($_REQUEST['albaran']) ) {
            $docs_vehiculo = $this->vehiculo_documento_prov->get_albaranes_from_vehiculo($_REQUEST['delete']);
            foreach ($docs_vehiculo as $doc_vehiculo) {
               if( $doc_vehiculo->idalbaran == $_REQUEST['id'] ) {
                  if( $doc_vehiculo->delete_from_albaran($_REQUEST['delete'],$_REQUEST['id']) ) {
                     $this->new_message("Veh&iacute;culo ".$veh0->matricula." eliminado del ".FS_ALBARAN);
                  } else {
                     $this->new_error_msg("Error al eliminar el veh&iacute;culo ".$veh0->matricula." del ".FS_ALBARAN);
                  }
               }
            }
         } else if( isset($_REQUEST['factura']) ) {
            $docs_vehiculo = $this->vehiculo_documento_prov->get_facturas_from_vehiculo($_REQUEST['delete']);
            foreach ($docs_vehiculo as $doc_vehiculo) {
               if( $doc_vehiculo->idfactura == $_REQUEST['id'] ) {
                  if( $doc_vehiculo->delete_from_factura($_REQUEST['delete'],$_REQUEST['id']) ) {
                     $this->new_message("Veh&iacute;culo ".$veh0->matricula." eliminado de la ".FS_FACTURA);
                  } else {
                     $this->new_error_msg("Error al eliminar el veh&iacute;culo ".$veh0->matricula." de la ".FS_FACTURA);
                  }
               }
            }
         }
      }
      
      /* Modificar vehiculo_documento_prov */
      else if( isset($_POST['idvehiculo_editar']) ) {
         $veh0 = $this->vehiculo->get($_POST['idvehiculo_editar']);
         /* Modificar vehiculo_documento_prov pedido */
         if( isset($_REQUEST['pedido']) ) {
            $docs_vehiculo = $this->vehiculo_documento_prov->get_pedidos_from_vehiculo($_POST['idvehiculo_editar']);
            foreach ($docs_vehiculo as $doc_vehiculo) {
               if( $doc_vehiculo->idpedido == $_REQUEST['id'] ) {
                  $vehiculo_documento_prov = $doc_vehiculo;
                  if($vehiculo_documento_prov) {
                     $vehiculo_documento_prov->idvehiculo = $_REQUEST['idvehiculo_editar'];
                     $vehiculo_documento_prov->kilometraje = $_REQUEST['kilometraje'];
                     $vehiculo_documento_prov->idpedido= $_REQUEST['id'];

                     if( $vehiculo_documento_prov->save() ) {
                        $this->new_message("Veh&iacute;culo ".$veh0->matricula." modificado correctamente del ".FS_PEDIDO);
                     } else {
                        $this->new_error_msg("Error al modificar el veh&iacute;culo ".$veh0->matricula." del ".FS_PEDIDO);
                     }
                  } else {
                     $this->new_error_msg("Veh&iacute;culo ".$veh0->matricula." no encontrado en el ".FS_PEDIDO);
                  }
               }
            }
         }
         /* Modificar vehiculo_documento_prov albaran */
         else if( isset($_REQUEST['albaran']) ) {
            $docs_vehiculo = $this->vehiculo_documento_prov->get_albaranes_from_vehiculo($_POST['idvehiculo_editar']);
            foreach ($docs_vehiculo as $doc_vehiculo) {
               if( $doc_vehiculo->idalbaran == $_REQUEST['id'] ) {
                  $vehiculo_documento_prov = $doc_vehiculo;
                  if($vehiculo_documento_prov) {
                     $vehiculo_documento_prov->idvehiculo = $_REQUEST['idvehiculo_editar'];
                     $vehiculo_documento_prov->kilometraje = $_REQUEST['kilometraje'];
                     $vehiculo_documento_prov->idalbaran= $_REQUEST['id'];

                     if( $vehiculo_documento_prov->save() ) {
                        $this->new_message("Veh&iacute;culo ".$veh0->matricula." modificado correctamente del ".FS_ALBARAN);
                     } else {
                        $this->new_error_msg("Error al modificar el veh&iacute;culo ".$veh0->matricula." del ".FS_ALBARAN);
                     }
                  } else {
                     $this->new_error_msg("Veh&iacute;culo ".$veh0->matricula." no encontrado en el ".FS_ALBARAN);
                  }
               }
            }
         }
         /* Modificar vehiculo_documento_prov factura */
         else if( isset($_REQUEST['factura']) ) {
            $docs_vehiculo = $this->vehiculo_documento_prov->get_facturas_from_vehiculo($_POST['idvehiculo_editar']);
            foreach ($docs_vehiculo as $doc_vehiculo) {
               if( $doc_vehiculo->idfactura == $_REQUEST['id'] ) {
                  $vehiculo_documento_prov = $doc_vehiculo;
                  if($vehiculo_documento_prov) {
                     $vehiculo_documento_prov->idvehiculo = $_REQUEST['idvehiculo_editar'];
                     $vehiculo_documento_prov->kilometraje = $_REQUEST['kilometraje'];
                     $vehiculo_documento_prov->idfactura= $_REQUEST['id'];

                     if( $vehiculo_documento_prov->save() ) {
                        $this->new_message("Veh&iacute;culo ".$veh0->matricula." modificado correctamente de la ".FS_FACTURA);
                     } else {
                        $this->new_error_msg("Error al modificar el veh&iacute;culo ".$veh0->matricula." de la ".FS_FACTURA);
                     }
                  } else {
                     $this->new_error_msg("Veh&iacute;culo ".$veh0->matricula." no encontrado en la ".FS_FACTURA);
                  }
               }
            }
         }
      }
      
      /* Nuevo vehiculo_documento_prov */
      else if( isset($_POST['idvehiculo']) ) {
         $veh0 = $this->vehiculo->get($_POST['idvehiculo']);
         $this->vehiculo_documento_prov->idvehiculo = $_REQUEST['idvehiculo'];
         $this->vehiculo_documento_prov->kilometraje = $_REQUEST['kilometraje'];

         if( isset($_REQUEST['idpedido']) and !empty($_REQUEST['idpedido']) ) {
            $this->vehiculo_documento_prov->idpedido = $_REQUEST['idpedido'];
            $this->idpedido = $_REQUEST['idpedido'];
            
            $ped0 = new pedido_proveedor();
            $pedido = $ped0->get($this->vehiculo_documento_prov->idpedido);
            if($pedido) {
               if( $this->vehiculo_documento_prov->save() ) {
                  $this->new_message("Veh&iacute;culo ".$veh0->matricula." agregado correctamente al ".FS_PEDIDO);
               } else {
                  $this->new_error_msg("Error al agregar el veh&iacute;culo ".$veh0->matricula." al ".FS_PEDIDO);
               }
            }
         } else if( isset($_REQUEST['idalbaran']) and !empty($_REQUEST['idalbaran']) ) {
            $this->vehiculo_documento_prov->idalbaran = $_REQUEST['idalbaran'];
            $this->idalbaran = $_REQUEST['idalbaran'];
            /// Fase pedido
            $this->vehiculos = $this->vehiculo_documento_prov->get_from_pedido($this->vehiculo_documento_prov->idalbaran);

            $alb0 = new albaran_proveedor();
            $albaran = $alb0->get($this->vehiculo_documento_prov->idalbaran);
            if($albaran) {
               /* Buscamos vehiculos en la fase de pedido, un albaran puede ser una agrupacion de muchos pedidos */
               $idpedido = NULL;
               foreach($albaran->get_lineas() as $linea) {
                  /// El idpedido esta en las lineas del albaran
                  if( $linea->idpedido != $idpedido ) {
                     if ($this->vehiculo_documento_prov->idalbaran == $_REQUEST['idalbaran']) {
                        $this->vehiculo_documento_prov->idpedido= $linea->idpedido;
                     }
                     if( $this->vehiculo_documento_prov->save() ) {
                        $this->new_message("Veh&iacute;culo ".$veh0->matricula." agregado correctamente al ".FS_ALBARAN." desde ".FS_PEDIDOS);
                     } else {
                        $this->new_error_msg("Error al agregar el veh&iacute;culo ".$veh0->matricula." al ".FS_ALBARAN." desde ".FS_PEDIDOS);
                     }
                  }
               }
               if( $idpedido == NULL ) {
                  if( $this->vehiculo_documento_prov->save() ) {
                     $this->new_message("Veh&iacute;culo ".$veh0->matricula." agregado correctamente al ".FS_ALBARAN);
                  } else {
                     $this->new_error_msg("Error al agregar el veh&iacute;culo ".$veh0->matricula." al ".FS_ALBARAN);
                  }
               }
            }
         } else if( isset($_REQUEST['idfactura']) and !empty($_REQUEST['idfactura']) ) {
            $this->vehiculo_documento_prov->idfactura = $_REQUEST['idfactura'];
            $this->idfactura = $_REQUEST['idfactura'];
            /// Fase albaran
            $this->vehiculos = $this->vehiculo_documento_prov->get_from_albaran($this->vehiculo_documento_prov->idfactura);

            $fac0 = new factura_proveedor();
            $factura = $fac0->get($this->vehiculo_documento_prov->idfactura);
            if($factura) {
               /* Buscamos vehiculos en la fase de albaran, una factura puede ser una agrupacion de muchos albaranes */
               $idalbaran = NULL;
               foreach($factura->get_lineas() as $linea) {
                  /// El idalbaran esta en las lineas de la factura
                  if( $linea->idalbaran != $idalbaran ) {
                     if ($this->vehiculo_documento_prov->idfactura == $_REQUEST['idfactura']) {
                        $this->vehiculo_documento_prov->idalbaran = $linea->idalbaran;
                     }
                     if( $this->vehiculo_documento_prov->save() ) {
                        $this->new_message("Veh&iacute;culo ".$veh0->matricula." agregado correctamente a la ".FS_FACTURA." desde ".FS_ALBARANES);
                     } else {
                        $this->new_error_msg("Error al agregar el veh&iacute;culo ".$veh0->matricula." a la ".FS_FACTURA." desde ".FS_ALBARANES);
                     }
                  }
               }
               if( $idalbaran == NULL ) {
                  if( $this->vehiculo_documento_prov->save() ) {
                     $this->new_message("Veh&iacute;culo ".$veh0->matricula." agregado correctamente a la ".FS_FACTURA);
                  } else {
                     $this->new_error_msg("Error al agregar el veh&iacute;culo ".$veh0->matricula." a la ".FS_FACTURA);
                  }
               }
            }
         }
      }

      /* Cargamos datos por defecto para el id recibido en funcion del tipo de documento*/
      if( isset($_REQUEST['pedido']) and !empty($_REQUEST['id']) ) {
         foreach($this->vehiculo_documento_prov->get_from_pedido($_REQUEST['id']) as $vehiculo) {
            $this->vehiculos[] = $this->vehiculo->get($vehiculo->idvehiculo);
            $this->relacion[$vehiculo->idvehiculo] = $vehiculo->kilometraje;
         }
         $this->idpedido = $_REQUEST['id'];
      } else if( isset($_REQUEST['albaran']) and !empty($_REQUEST['id']) ) {
         foreach($this->vehiculo_documento_prov->get_from_albaran($_REQUEST['id']) as $vehiculo) {
            $this->vehiculos[] = $this->vehiculo->get($vehiculo->idvehiculo);
            $this->relacion[$vehiculo->idvehiculo] = $vehiculo->kilometraje;
         }
         $this->idalbaran = $_REQUEST['id'];
      } else if( isset($_REQUEST['factura']) and !empty($_REQUEST['id']) ) {
         foreach($this->vehiculo_documento_prov->get_from_factura($_REQUEST['id']) as $vehiculo) {
            $this->vehiculos[] = $this->vehiculo->get($vehiculo->idvehiculo);
            $this->relacion[$vehiculo->idvehiculo] = $vehiculo->kilometraje;
         }
         $this->idfactura = $_REQUEST['id'];
      }
      
      $this->share_extensions();
   }

   /**
    * Devuelve la URL de la pagina cargada haciendo referencia al documento concreto
    * 
    * @return type
    */
   public function url()
   {
      if( isset($_REQUEST['idpedido']) ) {
         return 'index.php?page='.__CLASS__.'&idpedido='.$_REQUEST['idpedido'];
      } else if( isset($_REQUEST['idalbaran']) ) {
         return 'index.php?page='.__CLASS__.'&idalbaran='.$_REQUEST['idalbaran'];
      } else if( isset($_REQUEST['idfactura']) ) {
         return 'index.php?page='.__CLASS__.'&idfactura='.$_REQUEST['idfactura'];
      } else {
         return parent::url();
      }
   }

   /**
    * Permite buscar la matrícula del vehiculo utilizando AJAX y devolviendo un JSON con los resultados
    */
   private function buscar_matricula_vehiculo()
   {
      /// desactivamos la plantilla HTML
      $this->template = false;

      $marca = new marca_vehiculo();
      $modelo = new modelo_vehiculo();

      $json = array();
      foreach ($this->vehiculo->search($_REQUEST[ 'buscar_matricula_vehiculo' ]) as $vehiculo) {
         $json[] = array(
                           'value' => $vehiculo->matricula,
                           'id' => $vehiculo->id,
                           'marca' => $marca->get($vehiculo->marca)->nombre,
                           'modelo' => $modelo->get($vehiculo->denominacion_comercial)->nombre,
                           'bastidor' => $vehiculo->bastidor);
      }

      header('Content-Type: application/json');
      echo json_encode(array('query' => $_REQUEST[ 'buscar_matricula_vehiculo' ],
         'suggestions' => $json, ));
   }

   private function share_extensions()
   {
      $extensiones = array(
         array(
             'name' => 'automocion_compras_pedido',
             'page_from' => __CLASS__,
             'page_to' => 'compras_pedido',
             'type' => 'tab',
             'text' => '<span class="fa fa-car" aria-hidden="true"></span><span class="hidden-xs">&nbsp; Veh&iacute;culo</span>',
             'params' => '&pedido=TRUE'
         ),
         array(
             'name' => 'automocion_compras_albaran',
             'page_from' => __CLASS__,
             'page_to' => 'compras_albaran',
             'type' => 'tab',
             'text' => '<span class="fa fa-car" aria-hidden="true"></span><span class="hidden-xs">&nbsp; Veh&iacute;culo</span>',
             'params' => '&albaran=TRUE'
         ),
         array(
             'name' => 'automocion_compras_factura',
             'page_from' => __CLASS__,
             'page_to' => 'compras_factura',
             'type' => 'tab',
             'text' => '<span class="fa fa-car" aria-hidden="true"></span><span class="hidden-xs">&nbsp; Veh&iacute;culo</span>',
             'params' => '&factura=TRUE'
         )
      );
      foreach($extensiones as $ext) {
         $fsext = new fs_extension($ext);
         if( !$fsext->save() ) {
            $this->new_error_msg('Imposible guardar los datos de la extensión '.$ext['name'].'.');
         }
      }
   }
}
?>
