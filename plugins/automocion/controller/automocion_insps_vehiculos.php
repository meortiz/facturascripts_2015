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

require_model('inspeccion_vehiculo.php');
require_model('vehiculo.php');
require_model('cliente.php');

class automocion_insps_vehiculos extends fs_controller
{
   public $listado;
   public $editar_inspeccion_vehiculo;
   public $inspeccion_vehiculo;
   public $cliente;

   public $search_list;
   public $count_search_list;

   public $total_resultados;
   public $offset;
   public $query;

   public function __construct()
   {
      parent::__construct(__CLASS__, 'Inspecciones vehículos', 'Automoción');
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

      // AÑADIR EXTENSION EN CLIENTES

      $this->editar_inspeccion_vehiculo = false;
      $this->inspeccion_vehiculo = new inspeccion_vehiculo();
      $this->vehiculo = new vehiculo();
      $this->cliente = new cliente();

      /* Buscar elemento usando AJAX */
      if (isset($_REQUEST[ 'buscar_matricula_vehiculo' ])) {
         $this->buscar_matricula_vehiculo();
      }
      /* Modificar un elemento existente */
      elseif (isset($_POST[ 'id' ])) {
         $this->modificar_inspeccion();
      }
      /* Insertamos elemento nuevo */
      elseif (isset($_POST[ 'id_vehiculo' ])) {
         $this->insertar_inspeccion();
      }
      /* Obtenemos elemento recibido */
      elseif (isset($_GET[ 'id' ])) {
         $this->editar_inspeccion_vehiculo = $this->inspeccion_vehiculo->get($_GET[ 'id' ]);
      }
      /* Eliminamos un elemento existente */
      elseif (isset($_GET[ 'delete' ])) {
         $this->eliminar_inspeccion();
      }
      /*Buscamos coincidencias existentes */
      elseif (isset($_REQUEST[ 'query' ])) {
         /* Indicamos a la paginacion que vamos a buscar */
         $this->query = $_REQUEST[ 'query' ];
         $this->search_list = $this->inspeccion_vehiculo->search_limit($this->query, $this->offset);
         $this->count_search_list = count($this->inspeccion_vehiculo->search($this->query, $this->offset));
      }
      else if( isset($_GET['codcliente']) )
      {
         $this->template = 'extension/automocion_insps_vehiculos_cliente';

         $cliente = new cliente();
         $this->cliente = $cliente->get($_GET['codcliente']);
         $this->resultados = $this->inspeccion_vehiculo->all_from_cliente($_GET['codcliente'], $this->offset);
      }

      /* Mostraremos siempre el listado en la pestaña Listado */
      $this->listado = $this->inspeccion_vehiculo->all($this->offset, "id DESC");
   }

   public function anterior_url()
   {
      $url = '';
      $extra = '';

      if( isset($_GET['codagente']) )
      {
         $extra .= '&codagente=' . $_GET['codagente'];
      }
      else if( isset($_GET['codcliente']) )
      {
         $extra .= '&codcliente=' . $_GET['codcliente'];
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
      else if( isset($_GET['codcliente']) )
      {
         $extra .= '&codcliente=' . $_GET['codcliente'];
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

   protected function modificar_inspeccion()
   {
      $this->editar_inspeccion_vehiculo = $this->inspeccion_vehiculo->get($_POST[ 'id' ]);

      if ($this->editar_inspeccion_vehiculo) {
         // Identificación vehículo
         $this->editar_inspeccion_vehiculo->id_vehiculo = $_POST[ 'id_vehiculo' ];
         $this->editar_inspeccion_vehiculo->kilometraje = $_POST[ 'kilometraje' ];
         $this->editar_inspeccion_vehiculo->fecha = $_POST[ 'fecha' ];
         // Profundidad neumáticos
         $this->editar_inspeccion_vehiculo->profundidad_neumatico_di = $_POST[ 'profundidad_neumatico_di' ];
         $this->editar_inspeccion_vehiculo->profundidad_neumatico_dd = $_POST[ 'profundidad_neumatico_dd' ];
         $this->editar_inspeccion_vehiculo->profundidad_neumatico_ti = $_POST[ 'profundidad_neumatico_ti' ];
         $this->editar_inspeccion_vehiculo->profundidad_neumatico_td = $_POST[ 'profundidad_neumatico_td' ];
         $this->editar_inspeccion_vehiculo->profundidad_neumatico_re = $_POST[ 'profundidad_neumatico_re' ];
         // Presión neumáticos
         $this->editar_inspeccion_vehiculo->presion_neumatico_di = $_POST[ 'presion_neumatico_di' ];
         $this->editar_inspeccion_vehiculo->presion_neumatico_dd = $_POST[ 'presion_neumatico_dd' ];
         $this->editar_inspeccion_vehiculo->presion_neumatico_ti = $_POST[ 'presion_neumatico_ti' ];
         $this->editar_inspeccion_vehiculo->presion_neumatico_td = $_POST[ 'presion_neumatico_td' ];
         $this->editar_inspeccion_vehiculo->presion_neumatico_re = $_POST[ 'presion_neumatico_re' ];
         // Pastillas freno
         $this->editar_inspeccion_vehiculo->pastillas_freno_di = $_POST[ 'pastillas_freno_di' ];
         $this->editar_inspeccion_vehiculo->pastillas_freno_dd = $_POST[ 'pastillas_freno_dd' ];
         $this->editar_inspeccion_vehiculo->pastillas_freno_ti = $_POST[ 'pastillas_freno_ti' ];
         $this->editar_inspeccion_vehiculo->pastillas_freno_td = $_POST[ 'pastillas_freno_td' ];
         // Discos freno
         $this->editar_inspeccion_vehiculo->discos_freno_di = $_POST[ 'discos_freno_di' ];
         $this->editar_inspeccion_vehiculo->discos_freno_dd = $_POST[ 'discos_freno_dd' ];
         $this->editar_inspeccion_vehiculo->discos_freno_ti = $_POST[ 'discos_freno_ti' ];
         $this->editar_inspeccion_vehiculo->discos_freno_td = $_POST[ 'discos_freno_td' ];
         // Suspensión
         $this->editar_inspeccion_vehiculo->amortiguadores_di = $_POST[ 'amortiguadores_di' ];
         $this->editar_inspeccion_vehiculo->amortiguadores_dd = $_POST[ 'amortiguadores_dd' ];
         $this->editar_inspeccion_vehiculo->amortiguadores_ti = $_POST[ 'amortiguadores_ti' ];
         $this->editar_inspeccion_vehiculo->amortiguadores_td = $_POST[ 'amortiguadores_td' ];
         $this->editar_inspeccion_vehiculo->fuelle_di = $_POST[ 'fuelle_di' ];
         $this->editar_inspeccion_vehiculo->fuelle_dd = $_POST[ 'fuelle_dd' ];
         $this->editar_inspeccion_vehiculo->fuelle_ti = $_POST[ 'fuelle_ti' ];
         $this->editar_inspeccion_vehiculo->fuelle_td = $_POST[ 'fuelle_td' ];
         // Iluminación
         $this->editar_inspeccion_vehiculo->luz_posicion_di = $_POST[ 'luz_posicion_di' ];
         $this->editar_inspeccion_vehiculo->luz_posicion_dd = $_POST[ 'luz_posicion_dd' ];
         $this->editar_inspeccion_vehiculo->luz_posicion_ti = $_POST[ 'luz_posicion_ti' ];
         $this->editar_inspeccion_vehiculo->luz_posicion_td = $_POST[ 'luz_posicion_td' ];
         $this->editar_inspeccion_vehiculo->luz_corta_di = $_POST[ 'luz_corta_di' ];
         $this->editar_inspeccion_vehiculo->luz_corta_dd = $_POST[ 'luz_corta_dd' ];
         $this->editar_inspeccion_vehiculo->luz_larga_di = $_POST[ 'luz_larga_di' ];
         $this->editar_inspeccion_vehiculo->luz_larga_dd = $_POST[ 'luz_larga_dd' ];
         $this->editar_inspeccion_vehiculo->luz_freno_ti = $_POST[ 'luz_freno_ti' ];
         $this->editar_inspeccion_vehiculo->luz_freno_td = $_POST[ 'luz_freno_td' ];
         $this->editar_inspeccion_vehiculo->luz_marcha_atras_ti = $_POST[ 'luz_marcha_atras_ti' ];
         $this->editar_inspeccion_vehiculo->luz_marcha_atras_td = $_POST[ 'luz_marcha_atras_td' ];
         $this->editar_inspeccion_vehiculo->luz_antiniebla_di = $_POST[ 'luz_antiniebla_di' ];
         $this->editar_inspeccion_vehiculo->luz_antiniebla_dd = $_POST[ 'luz_antiniebla_dd' ];
         $this->editar_inspeccion_vehiculo->luz_antiniebla_ti = $_POST[ 'luz_antiniebla_ti' ];
         $this->editar_inspeccion_vehiculo->luz_antiniebla_td = $_POST[ 'luz_antiniebla_td' ];
         // Niveles
         $this->editar_inspeccion_vehiculo->nivel_aceite = $_POST[ 'nivel_aceite' ];
         $this->editar_inspeccion_vehiculo->nivel_anticongelante = $_POST[ 'nivel_anticongelante' ];
         $this->editar_inspeccion_vehiculo->nivel_limpiacristales = $_POST[ 'nivel_limpiacristales' ];
         $this->editar_inspeccion_vehiculo->nivel_direccion = $_POST[ 'nivel_direccion' ];
         $this->editar_inspeccion_vehiculo->nivel_frenos = $_POST[ 'nivel_frenos' ];
         // Carrocería
         $this->editar_inspeccion_vehiculo->paragolpes_delantero = $_POST[ 'paragolpes_delantero' ];
         $this->editar_inspeccion_vehiculo->paragolpes_trasero = $_POST[ 'paragolpes_trasero' ];
         $this->editar_inspeccion_vehiculo->capo = $_POST[ 'capo' ];
         $this->editar_inspeccion_vehiculo->maletero = $_POST[ 'maletero' ];
         $this->editar_inspeccion_vehiculo->puerta_di = $_POST[ 'puerta_di' ];
         $this->editar_inspeccion_vehiculo->puerta_dd = $_POST[ 'puerta_dd' ];
         $this->editar_inspeccion_vehiculo->puerta_ti = $_POST[ 'puerta_ti' ];
         $this->editar_inspeccion_vehiculo->puerta_td = $_POST[ 'puerta_td' ];
         $this->editar_inspeccion_vehiculo->llanta_di = $_POST[ 'llanta_di' ];
         $this->editar_inspeccion_vehiculo->llanta_dd = $_POST[ 'llanta_dd' ];
         $this->editar_inspeccion_vehiculo->llanta_ti = $_POST[ 'llanta_ti' ];
         $this->editar_inspeccion_vehiculo->llanta_td = $_POST[ 'llanta_td' ];
         $this->editar_inspeccion_vehiculo->latiguillo_freno_di = $_POST[ 'latiguillo_freno_di' ];
         $this->editar_inspeccion_vehiculo->latiguillo_freno_dd = $_POST[ 'latiguillo_freno_dd' ];
         $this->editar_inspeccion_vehiculo->latiguillo_freno_ti = $_POST[ 'latiguillo_freno_ti' ];
         $this->editar_inspeccion_vehiculo->latiguillo_freno_td = $_POST[ 'latiguillo_freno_td' ];
         $this->editar_inspeccion_vehiculo->rodamiento_di = $_POST[ 'rodamiento_di' ];
         $this->editar_inspeccion_vehiculo->rodamiento_dd = $_POST[ 'rodamiento_dd' ];
         $this->editar_inspeccion_vehiculo->rodamiento_ti = $_POST[ 'rodamiento_ti' ];
         $this->editar_inspeccion_vehiculo->rodamiento_td = $_POST[ 'rodamiento_td' ];
         $this->editar_inspeccion_vehiculo->palier_di = $_POST[ 'palier_di' ];
         $this->editar_inspeccion_vehiculo->palier_dd = $_POST[ 'palier_dd' ];
         $this->editar_inspeccion_vehiculo->palier_ti = $_POST[ 'palier_ti' ];
         $this->editar_inspeccion_vehiculo->palier_td = $_POST[ 'palier_td' ];
         $this->editar_inspeccion_vehiculo->trapecio_di = $_POST[ 'trapecio_di' ];
         $this->editar_inspeccion_vehiculo->trapecio_dd = $_POST[ 'trapecio_dd' ];
         $this->editar_inspeccion_vehiculo->trapecio_ti = $_POST[ 'trapecio_ti' ];
         $this->editar_inspeccion_vehiculo->trapecio_td = $_POST[ 'trapecio_td' ];
         $this->editar_inspeccion_vehiculo->limpiaparabrisas_d = $_POST[ 'limpiaparabrisas_d' ];
         $this->editar_inspeccion_vehiculo->limpiaparabrisas_t = $_POST[ 'limpiaparabrisas_t' ];
         $this->editar_inspeccion_vehiculo->bateria = $_POST[ 'bateria' ];
         $this->editar_inspeccion_vehiculo->fugas = $_POST[ 'fugas' ];
         $this->editar_inspeccion_vehiculo->correa_aux = $_POST[ 'correa_aux' ];
         $this->editar_inspeccion_vehiculo->manguitos = $_POST[ 'manguitos' ];
         $this->editar_inspeccion_vehiculo->silencioso_d = $_POST[ 'silencioso_d' ];
         $this->editar_inspeccion_vehiculo->silencioso_t = $_POST[ 'silencioso_t' ];
         $this->editar_inspeccion_vehiculo->tubos = $_POST[ 'tubos' ];
         $this->editar_inspeccion_vehiculo->fijaciones = $_POST[ 'fijaciones' ];
         $this->editar_inspeccion_vehiculo->palanca_cambios = $_POST[ 'palanca_cambios' ];
         $this->editar_inspeccion_vehiculo->elevalunas = $_POST[ 'elevalunas' ];
         $this->editar_inspeccion_vehiculo->cinturones = $_POST[ 'cinturones' ];
         $this->editar_inspeccion_vehiculo->embrague = $_POST[ 'embrague' ];
         $this->editar_inspeccion_vehiculo->holgura_direccion = $_POST[ 'holgura_direccion' ];
         $this->editar_inspeccion_vehiculo->aleta_di = $_POST[ 'aleta_di' ];
         $this->editar_inspeccion_vehiculo->aleta_dd = $_POST[ 'aleta_dd' ];
         $this->editar_inspeccion_vehiculo->aleta_ti = $_POST[ 'aleta_ti' ];
         $this->editar_inspeccion_vehiculo->aleta_td = $_POST[ 'aleta_td' ];
         $this->editar_inspeccion_vehiculo->observaciones = $_POST[ 'observaciones' ];

         if ($this->editar_inspeccion_vehiculo->save()) {
            $this->new_message('Se ha modificado la inspección del vehículo correctamente.');

            $this->editar_inspeccion_vehiculo = $this->inspeccion_vehiculo->get($_POST[ 'id' ]);
         } else {
            $this->new_error_msg('Ha ocurrido un error modificando la inspección del vehículo.');
         }
      }
   }

   protected function insertar_inspeccion()
   {
      // Identificación vehículo
      $this->inspeccion_vehiculo->id_vehiculo = $_POST[ 'id_vehiculo' ];
      $this->inspeccion_vehiculo->kilometraje = $_POST[ 'kilometraje' ];
      $this->inspeccion_vehiculo->fecha = $_POST[ 'fecha' ];
      // Profundidad neumáticos
      $this->inspeccion_vehiculo->profundidad_neumatico_di = $_POST[ 'profundidad_neumatico_di' ];
      $this->inspeccion_vehiculo->profundidad_neumatico_dd = $_POST[ 'profundidad_neumatico_dd' ];
      $this->inspeccion_vehiculo->profundidad_neumatico_ti = $_POST[ 'profundidad_neumatico_ti' ];
      $this->inspeccion_vehiculo->profundidad_neumatico_td = $_POST[ 'profundidad_neumatico_td' ];
      $this->inspeccion_vehiculo->profundidad_neumatico_re = $_POST[ 'profundidad_neumatico_re' ];
      // Presión neumáticos
      $this->inspeccion_vehiculo->presion_neumatico_di = $_POST[ 'presion_neumatico_di' ];
      $this->inspeccion_vehiculo->presion_neumatico_dd = $_POST[ 'presion_neumatico_dd' ];
      $this->inspeccion_vehiculo->presion_neumatico_ti = $_POST[ 'presion_neumatico_ti' ];
      $this->inspeccion_vehiculo->presion_neumatico_td = $_POST[ 'presion_neumatico_td' ];
      $this->inspeccion_vehiculo->presion_neumatico_re = $_POST[ 'presion_neumatico_re' ];
      // Pastillas freno
      $this->inspeccion_vehiculo->pastillas_freno_di = $_POST[ 'pastillas_freno_di' ];
      $this->inspeccion_vehiculo->pastillas_freno_dd = $_POST[ 'pastillas_freno_dd' ];
      $this->inspeccion_vehiculo->pastillas_freno_ti = $_POST[ 'pastillas_freno_ti' ];
      $this->inspeccion_vehiculo->pastillas_freno_td = $_POST[ 'pastillas_freno_td' ];
      // Discos freno
      $this->inspeccion_vehiculo->discos_freno_di = $_POST[ 'discos_freno_di' ];
      $this->inspeccion_vehiculo->discos_freno_dd = $_POST[ 'discos_freno_dd' ];
      $this->inspeccion_vehiculo->discos_freno_ti = $_POST[ 'discos_freno_ti' ];
      $this->inspeccion_vehiculo->discos_freno_td = $_POST[ 'discos_freno_td' ];
      // Suspensión
      $this->inspeccion_vehiculo->amortiguadores_di = $_POST[ 'amortiguadores_di' ];
      $this->inspeccion_vehiculo->amortiguadores_dd = $_POST[ 'amortiguadores_dd' ];
      $this->inspeccion_vehiculo->amortiguadores_ti = $_POST[ 'amortiguadores_ti' ];
      $this->inspeccion_vehiculo->amortiguadores_td = $_POST[ 'amortiguadores_td' ];
      $this->inspeccion_vehiculo->fuelle_di = $_POST[ 'fuelle_di' ];
      $this->inspeccion_vehiculo->fuelle_dd = $_POST[ 'fuelle_dd' ];
      $this->inspeccion_vehiculo->fuelle_ti = $_POST[ 'fuelle_ti' ];
      $this->inspeccion_vehiculo->fuelle_td = $_POST[ 'fuelle_td' ];
      // Iluminación
      $this->inspeccion_vehiculo->luz_posicion_di = $_POST[ 'luz_posicion_di' ];
      $this->inspeccion_vehiculo->luz_posicion_dd = $_POST[ 'luz_posicion_dd' ];
      $this->inspeccion_vehiculo->luz_posicion_ti = $_POST[ 'luz_posicion_ti' ];
      $this->inspeccion_vehiculo->luz_posicion_td = $_POST[ 'luz_posicion_td' ];
      $this->inspeccion_vehiculo->luz_corta_di = $_POST[ 'luz_corta_di' ];
      $this->inspeccion_vehiculo->luz_corta_dd = $_POST[ 'luz_corta_dd' ];
      $this->inspeccion_vehiculo->luz_larga_di = $_POST[ 'luz_larga_di' ];
      $this->inspeccion_vehiculo->luz_larga_dd = $_POST[ 'luz_larga_dd' ];
      $this->inspeccion_vehiculo->luz_freno_ti = $_POST[ 'luz_freno_ti' ];
      $this->inspeccion_vehiculo->luz_freno_td = $_POST[ 'luz_freno_td' ];
      $this->inspeccion_vehiculo->luz_marcha_atras_ti = $_POST[ 'luz_marcha_atras_ti' ];
      $this->inspeccion_vehiculo->luz_marcha_atras_td = $_POST[ 'luz_marcha_atras_td' ];
      $this->inspeccion_vehiculo->luz_antiniebla_di = $_POST[ 'luz_antiniebla_di' ];
      $this->inspeccion_vehiculo->luz_antiniebla_dd = $_POST[ 'luz_antiniebla_dd' ];
      $this->inspeccion_vehiculo->luz_antiniebla_ti = $_POST[ 'luz_antiniebla_ti' ];
      $this->inspeccion_vehiculo->luz_antiniebla_td = $_POST[ 'luz_antiniebla_td' ];
      // Niveles
      $this->inspeccion_vehiculo->nivel_aceite = $_POST[ 'nivel_aceite' ];
      $this->inspeccion_vehiculo->nivel_anticongelante = $_POST[ 'nivel_anticongelante' ];
      $this->inspeccion_vehiculo->nivel_limpiacristales = $_POST[ 'nivel_limpiacristales' ];
      $this->inspeccion_vehiculo->nivel_direccion = $_POST[ 'nivel_direccion' ];
      $this->inspeccion_vehiculo->nivel_frenos = $_POST[ 'nivel_frenos' ];
      // Carrocería
      $this->inspeccion_vehiculo->paragolpes_delantero = $_POST[ 'paragolpes_delantero' ];
      $this->inspeccion_vehiculo->paragolpes_trasero = $_POST[ 'paragolpes_trasero' ];
      $this->inspeccion_vehiculo->capo = $_POST[ 'capo' ];
      $this->inspeccion_vehiculo->maletero = $_POST[ 'maletero' ];
      $this->inspeccion_vehiculo->puerta_di = $_POST[ 'puerta_di' ];
      $this->inspeccion_vehiculo->puerta_dd = $_POST[ 'puerta_dd' ];
      $this->inspeccion_vehiculo->puerta_ti = $_POST[ 'puerta_ti' ];
      $this->inspeccion_vehiculo->puerta_td = $_POST[ 'puerta_td' ];
      $this->inspeccion_vehiculo->llanta_di = $_POST[ 'llanta_di' ];
      $this->inspeccion_vehiculo->llanta_dd = $_POST[ 'llanta_dd' ];
      $this->inspeccion_vehiculo->llanta_ti = $_POST[ 'llanta_ti' ];
      $this->inspeccion_vehiculo->llanta_td = $_POST[ 'llanta_td' ];
      $this->inspeccion_vehiculo->latiguillo_freno_di = $_POST[ 'latiguillo_freno_di' ];
      $this->inspeccion_vehiculo->latiguillo_freno_dd = $_POST[ 'latiguillo_freno_dd' ];
      $this->inspeccion_vehiculo->latiguillo_freno_ti = $_POST[ 'latiguillo_freno_ti' ];
      $this->inspeccion_vehiculo->latiguillo_freno_td = $_POST[ 'latiguillo_freno_td' ];
      $this->inspeccion_vehiculo->rodamiento_di = $_POST[ 'rodamiento_di' ];
      $this->inspeccion_vehiculo->rodamiento_dd = $_POST[ 'rodamiento_dd' ];
      $this->inspeccion_vehiculo->rodamiento_ti = $_POST[ 'rodamiento_ti' ];
      $this->inspeccion_vehiculo->rodamiento_td = $_POST[ 'rodamiento_td' ];
      $this->inspeccion_vehiculo->palier_di = $_POST[ 'palier_di' ];
      $this->inspeccion_vehiculo->palier_dd = $_POST[ 'palier_dd' ];
      $this->inspeccion_vehiculo->palier_ti = $_POST[ 'palier_ti' ];
      $this->inspeccion_vehiculo->palier_td = $_POST[ 'palier_td' ];
      $this->inspeccion_vehiculo->trapecio_di = $_POST[ 'trapecio_di' ];
      $this->inspeccion_vehiculo->trapecio_dd = $_POST[ 'trapecio_dd' ];
      $this->inspeccion_vehiculo->trapecio_ti = $_POST[ 'trapecio_ti' ];
      $this->inspeccion_vehiculo->trapecio_td = $_POST[ 'trapecio_td' ];
      $this->inspeccion_vehiculo->limpiaparabrisas_d = $_POST[ 'limpiaparabrisas_d' ];
      $this->inspeccion_vehiculo->limpiaparabrisas_t = $_POST[ 'limpiaparabrisas_t' ];
      $this->inspeccion_vehiculo->bateria = $_POST[ 'bateria' ];
      $this->inspeccion_vehiculo->fugas = $_POST[ 'fugas' ];
      $this->inspeccion_vehiculo->correa_aux = $_POST[ 'correa_aux' ];
      $this->inspeccion_vehiculo->manguitos = $_POST[ 'manguitos' ];
      $this->inspeccion_vehiculo->silencioso_d = $_POST[ 'silencioso_d' ];
      $this->inspeccion_vehiculo->silencioso_t = $_POST[ 'silencioso_t' ];
      $this->inspeccion_vehiculo->tubos = $_POST[ 'tubos' ];
      $this->inspeccion_vehiculo->fijaciones = $_POST[ 'fijaciones' ];
      $this->inspeccion_vehiculo->palanca_cambios = $_POST[ 'palanca_cambios' ];
      $this->inspeccion_vehiculo->elevalunas = $_POST[ 'elevalunas' ];
      $this->inspeccion_vehiculo->cinturones = $_POST[ 'cinturones' ];
      $this->inspeccion_vehiculo->embrague = $_POST[ 'embrague' ];
      $this->inspeccion_vehiculo->holgura_direccion = $_POST[ 'holgura_direccion' ];
      $this->inspeccion_vehiculo->aleta_di = $_POST[ 'aleta_di' ];
      $this->inspeccion_vehiculo->aleta_dd = $_POST[ 'aleta_dd' ];
      $this->inspeccion_vehiculo->aleta_ti = $_POST[ 'aleta_ti' ];
      $this->inspeccion_vehiculo->aleta_td = $_POST[ 'aleta_td' ];
      $this->inspeccion_vehiculo->observaciones = $_POST[ 'observaciones' ];

      if ($this->inspeccion_vehiculo->save()) {
         $this->new_message('Se ha insertado la inspección del vehículo correctamente.');
      } else {
         $this->new_error_msg('Ha ocurrido un error guardando la inspección del vehículo.');
      }
   }

   protected function eliminar_inspeccion()
   {
      $delete_inspeccion = $this->inspeccion_vehiculo->delete($_GET[ 'delete' ]);

      if ($delete_inspeccion) {
         $this->new_message('Se ha eliminado la inspección del vehículo correctamente.');
      } else {
         $this->new_error_msg('Ha ocurrido un error eliminando la inspección del vehículo.');
      }
   }

   private function buscar_matricula_vehiculo()
   {
      /// desactivamos la plantilla HTML
      $this->template = false;

      $json = array();
      foreach ($this->vehiculo->search($_REQUEST[ 'buscar_matricula_vehiculo' ]) as $vehiculo) {
         $json[] = array('value' => $vehiculo->matricula, 'data' => $vehiculo->id);
      }

      header('Content-Type: application/json');
      echo json_encode(array('query' => $_REQUEST[ 'buscar_matricula_vehiculo' ],
         'suggestions' => $json, ));
   }

   public function share_extensions()
   {
      $items =
       '<script type="text/javascript" src="view/js/jquery.validate.min.js"></script>';

      $extensions = array(
         array(
             'name' => 'automocion_inspecciones_vehiculos',
             'page_from' => __CLASS__,
             'page_to' => 'ventas_cliente',
             'type' => 'button',
             'text' => '<span class="glyphicon glyphicon-list" aria-hidden="true"></span> &nbsp; Inspecciones veh&iacute;culos',
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

      $data = $this->db->select('SELECT COUNT(id) AS total FROM automocion_inspecciones_vehiculos;');
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
