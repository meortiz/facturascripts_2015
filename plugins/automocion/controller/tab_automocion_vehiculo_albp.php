<?php
/*
 * This file is part of FacturaScripts
 * Copyright (C) 2016  Francesc Pineda Segarra  shawe.ewahs@gmail.com
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
require_model('albaran_proveedor.php');

/**
 * Description of tab_automocion_vehiculo_albp
 *
 * @author Francesc Pineda Segarra
 */
class tab_automocion_vehiculo_albp extends fs_controller
{
   public $allow_delete;
   public $marca;
   public $modelo;
   public $vehiculo_documento_prov;
   public $vehiculos_documentos_prov;
   public $relacion;
   public $vehiculo;
   public $id_vehiculo;
   public $vehiculos;
   public $documento;
   public $total;

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
      $this->vehiculos_documentos = array();
      $this->relacion = array();
      $this->documento = new albaran_proveedor();
      $this->documentos = array();

      if( isset($_REQUEST['id']) ){
         $this->id_vehiculo = $_REQUEST['id'];
      } else {
         $this->id_vehiculo = NULL;
      }
      /* Cargamos datos por defecto */
      foreach($this->vehiculo_documento_prov->get_albaranes_from_vehiculo($this->id_vehiculo) as $vehiculo) {
         $this->vehiculos[$vehiculo->idalbaran] = $this->vehiculo->get($vehiculo->idvehiculo);
         $this->relacion[$vehiculo->idalbaran] = array($vehiculo->idvehiculo, $vehiculo->kilometraje);
         $this->documentos[$vehiculo->idalbaran] = $this->documento->get($vehiculo->idalbaran);
      }

      $this->total = count($this->vehiculo_documento_prov->get_albaranes_from_vehiculo($this->id_vehiculo));
   }

   public function url()
   {
      if( isset($_REQUEST['id']) ) {
         return 'index.php?page='.__CLASS__.'&id='.$_REQUEST['id'];
      } else {
         return parent::url();
      }
   }
}
?>
