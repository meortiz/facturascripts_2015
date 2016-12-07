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

/*
 * https://www.google.com/fusiontables/DataSource?docid=1N7y2t1ZH4JhjjlkYWfil_MTUcKIU55aPo_5cFNQF
 * http://ec.europa.eu/enterprise/tbt/tbt_repository/QAT11_EN_1_1.pdf
 * http://www.autocalculator.org/VIN/WMI.aspx
 */

require_model('wmi_vehiculo.php');
require_model('marca_vehiculo.php');

class automocion_wmi_vehiculos extends fs_controller
{
   public $listado;
   public $marca_vehiculo;
   public $editar_wmi_vehiculo;
   public $wmi_vehiculo;

   public function __construct()
   {
      parent::__construct(__CLASS__, 'Marcas WMIs', 'Automoción', false, false);
      //parent::__construct(__CLASS__, 'Relación de WMIs', 'Automoción');
   }

   protected function private_core()
   {
      $this->show_fs_toolbar = false;
      $this->editar_wmi_vehiculo = false;

      $this->marca_vehiculo = new marca_vehiculo();
      $this->wmi_vehiculo = new wmi_vehiculo();

   /* Modificar un elemento existente */
   if (isset($_POST[ 'id' ])) {
      $this->modificar_wmi();
   }
   /* Insertamos elemento nuevo */
   elseif (isset($_POST[ 'nombre' ])) {
      $this->insertar_wmi();
   }
   /* Obtenemos elemento recibido */
   elseif (isset($_GET[ 'id' ])) {
      $this->editar_wmi_vehiculo = $this->wmi_vehiculo->get($_GET[ 'id' ]);
   }
   /* Eliminamos un elemento existente */
   elseif (isset($_GET[ 'delete' ])) {
      $this->eliminar_wmi();
   }

   /* Mostraremos siempre el listado en la pestaña Listado */
   $this->listado = $this->wmi_vehiculo->all();
   }

   protected function modificar_wmi()
   {
      $this->editar_wmi_vehiculo = $this->wmi_vehiculo->get($_POST[ 'id' ]);

      if ($this->editar_wmi_vehiculo) {
         $this->editar_wmi_vehiculo->nombre = $_POST[ 'nombre' ];
         $this->editar_wmi_vehiculo->id_marca = $_POST[ 'id_marca' ];
         $this->editar_wmi_vehiculo->wmi = $_POST[ 'wmi' ];
         $this->editar_wmi_vehiculo->pais = $_POST[ 'pais' ];

         if ($this->editar_wmi_vehiculo->save()) {
            $this->new_message('Se ha modificado el WMI del fabricante correctamente.');
            $this->editar_wmi_vehiculo = $this->wmi_vehiculo->get($_POST[ 'id' ]);
         } else {
            $this->new_error_msg('Ha ocurrido un error modificando el WMI del fabricante.');
         }
      }
   }

   protected function insertar_wmi()
   {
      $this->wmi_vehiculo->nombre = $_POST[ 'nombre' ];
      $this->wmi_vehiculo->id_marca = $_POST[ 'id_marca' ];
      $this->wmi_vehiculo->wmi = $_POST[ 'wmi' ];
      $this->wmi_vehiculo->pais = $_POST[ 'pais' ];

      if ($this->wmi_vehiculo->save()) {
         $this->new_message('Se ha insertado el WMI del fabricante correctamente.');
      } else {
         $this->new_error_msg('Ha ocurrido un error guardando el WMI del fabricante.');
      }
   }

   protected function eliminar_wmi()
   {
      $delete_wmi_vehiculo = $this->wmi_vehiculo->get($_GET[ 'delete' ]);

      if ($delete_wmi_vehiculo) {
         if ($delete_wmi_vehiculo->delete()) {
            $this->new_message('Se ha eliminado el WMI del fabricante correctamente.');
         } else {
            $this->new_error_msg('Ha ocurrido un error eliminando el WMI del fabricante.');
         }
      } else {
         $this->new_error_msg('WMI del fabricante encontrado.');
      }
   }
}
