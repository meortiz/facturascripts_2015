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

class automocion_info_vehiculos extends fs_controller
{

   public function __construct()
   {
      parent::__construct(__CLASS__, 'Información vehículos', 'Automoción');
   }

   protected function private_core()
   {
      $this->show_fs_toolbar = false;
      $this->share_extensions();
   }

   public function share_extensions()
   {
      $items =
      '<link href="plugins/automocion/view/css/docs.min.css" type="text/css" rel="stylesheet" media="all" />
      <script src="plugins/automocion/view/js/docs.min.js" type="text/javascript"></script>';

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

}
