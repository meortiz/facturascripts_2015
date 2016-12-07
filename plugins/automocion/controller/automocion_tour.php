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

class automocion_tour extends fs_controller {

   public function __construct() {
      parent::__construct(__CLASS__, 'Tour', 'Automoción', FALSE, FALSE);
   }

   protected function private_core() {
      $this->check_menu();
   }

   private function check_menu() {
      if (!$this->page->get('tour')) {
         if (file_exists(__DIR__)) {
            /// activamos las páginas del plugin
            foreach (scandir(__DIR__) as $f) {
               if (is_string($f) AND strlen($f) > 0 AND ! is_dir($f) AND $f != __CLASS__ . '.php') {
                  $page_name = substr($f, 0, -4);

                  require_once __DIR__ . '/' . $f;
                  $new_fsc = new $page_name();

                  if (!$new_fsc->page->save()) {
                     $this->new_error_msg("Imposible guardar la página " . $page_name);
                  }

                  unset($new_fsc);
               }
            }
         } else {
            $this->new_error_msg('No se encuentra el directorio ' . __DIR__);
         }

         $this->load_menu(TRUE);
      }
   }

}
