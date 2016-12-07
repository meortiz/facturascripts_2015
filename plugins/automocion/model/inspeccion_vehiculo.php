<?php

/*
 * This file is part of FacturaScripts
 * Copyright (C) 2014-2016   Francesc Pineda Segarra   shawe.ewahs@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.   See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.   If not, see <http://www.gnu.org/licenses/>.
 */

/*
 * La clase vehículo sirve para guardar datos sobre vehiculos y a que cliente pertenece.
 * NOTA: Todavía no se guarda el cliente.
 */

require_model('vehiculo.php');

class inspeccion_vehiculo extends fs_model
{
   // Identificación vehículo
   public $id;
   public $id_vehiculo;
   public $matricula;
   public $codcliente;
   public $nombre_cliente;
   public $kilometraje;
   public $fecha;
// Profundidad neumáticos
   public $profundidad_neumatico_di;
   public $profundidad_neumatico_dd;
   public $profundidad_neumatico_ti;
   public $profundidad_neumatico_td;
   public $profundidad_neumatico_re;
// Presión neumáticos
   public $presion_neumatico_di;
   public $presion_neumatico_dd;
   public $presion_neumatico_ti;
   public $presion_neumatico_td;
   public $presion_neumatico_re;
// Pastillas freno
   public $pastillas_freno_di;
   public $pastillas_freno_dd;
   public $pastillas_freno_ti;
   public $pastillas_freno_td;
// Discos freno
   public $discos_freno_di;
   public $discos_freno_dd;
   public $discos_freno_ti;
   public $discos_freno_td;
// Suspensión
   public $amortiguadores_di;
   public $amortiguadores_dd;
   public $amortiguadores_ti;
   public $amortiguadores_td;
   public $fuelle_di;
   public $fuelle_dd;
   public $fuelle_ti;
   public $fuelle_td;
// Iluminación
   public $luz_posicion_di;
   public $luz_posicion_dd;
   public $luz_posicion_ti;
   public $luz_posicion_td;
   public $luz_corta_di;
   public $luz_corta_dd;
   public $luz_larga_di;
   public $luz_larga_dd;
   public $luz_freno_ti;
   public $luz_freno_td;
   public $luz_marcha_atras_ti;
   public $luz_marcha_atras_td;
   public $luz_antiniebla_di;
   public $luz_antiniebla_dd;
   public $luz_antiniebla_ti;
   public $luz_antiniebla_td;
// Niveles
   public $nivel_aceite;
   public $nivel_anticongelante;
   public $nivel_limpiacristales;
   public $nivel_direccion;
   public $nivel_frenos;
// Carrocería
   public $paragolpes_delantero;
   public $paragolpes_trasero;
   public $capo;
   public $maletero;
   public $puerta_di;
   public $puerta_dd;
   public $puerta_ti;
   public $puerta_td;
   public $llanta_di;
   public $llanta_dd;
   public $llanta_ti;
   public $llanta_td;
   public $latiguillo_freno_di;
   public $latiguillo_freno_dd;
   public $latiguillo_freno_ti;
   public $latiguillo_freno_td;
   public $rodamiento_di;
   public $rodamiento_dd;
   public $rodamiento_ti;
   public $rodamiento_td;
   public $palier_di;
   public $palier_dd;
   public $palier_ti;
   public $palier_td;
   public $trapecio_di;
   public $trapecio_dd;
   public $trapecio_ti;
   public $trapecio_td;
   public $limpiaparabrisas_d;
   public $limpiaparabrisas_t;
   public $bateria;
   public $fugas;
   public $correa_aux;
   public $manguitos;
   public $silencioso_d;
   public $silencioso_t;
   public $tubos;
   public $fijaciones;
   public $palanca_cambios;
   public $elevalunas;
   public $cinturones;
   public $embrague;
   public $holgura_direccion;
   public $aleta_di;
   public $aleta_dd;
   public $aleta_ti;
   public $aleta_td;
   public $observaciones;

   public function __construct($inspeccion_vehiculo = false)
   {
      parent::__construct('automocion_inspecciones_vehiculos', 'plugins/automocion/');
      if ($inspeccion_vehiculo) {
         // Identificación vehículo
         $this->id = $inspeccion_vehiculo[ 'id' ];
         $this->id_vehiculo = (isset($inspeccion_vehiculo[ 'id_vehiculo' ]))?$inspeccion_vehiculo[ 'id_vehiculo' ]:NULL;
         $this->matricula = $inspeccion_vehiculo[ 'matricula' ];
         $this->codcliente = $inspeccion_vehiculo[ 'codcliente' ];
         $this->nombre_cliente = $inspeccion_vehiculo[ 'nombre_cliente' ];
         $this->kilometraje = $inspeccion_vehiculo[ 'kilometraje' ];
         $this->fecha = Date('d-m-Y', strtotime($inspeccion_vehiculo[ 'fecha' ]));
// Profundidad neumáticos
         $this->profundidad_neumatico_di = (isset($inspeccion_vehiculo[ 'profundidad_neumatico_di' ]))?$inspeccion_vehiculo[ 'profundidad_neumatico_di' ]:NULL;;
         $this->profundidad_neumatico_dd = (isset($inspeccion_vehiculo[ 'profundidad_neumatico_dd' ]))?$inspeccion_vehiculo[ 'profundidad_neumatico_dd' ]:NULL;;
         $this->profundidad_neumatico_ti = (isset($inspeccion_vehiculo[ 'profundidad_neumatico_ti' ]))?$inspeccion_vehiculo[ 'profundidad_neumatico_ti' ]:NULL;;
         $this->profundidad_neumatico_td = (isset($inspeccion_vehiculo[ 'profundidad_neumatico_td' ]))?$inspeccion_vehiculo[ 'profundidad_neumatico_td' ]:NULL;;
         $this->profundidad_neumatico_re = (isset($inspeccion_vehiculo[ 'profundidad_neumatico_re' ]))?$inspeccion_vehiculo[ 'profundidad_neumatico_re' ]:NULL;;
// Presión neumáticos
         $this->presion_neumatico_di = (isset($inspeccion_vehiculo[ 'presion_neumatico_di' ]))?$inspeccion_vehiculo[ 'presion_neumatico_ti' ]:NULL;
         $this->presion_neumatico_dd = (isset($inspeccion_vehiculo[ 'presion_neumatico_dd' ]))?$inspeccion_vehiculo[ 'presion_neumatico_td' ]:NULL;
         $this->presion_neumatico_ti = (isset($inspeccion_vehiculo[ 'presion_neumatico_ti' ]))?$inspeccion_vehiculo[ 'presion_neumatico_ti' ]:NULL;
         $this->presion_neumatico_td = (isset($inspeccion_vehiculo[ 'presion_neumatico_td' ]))?$inspeccion_vehiculo[ 'presion_neumatico_td' ]:NULL;
         $this->presion_neumatico_re = (isset($inspeccion_vehiculo[ 'presion_neumatico_re' ]))?$inspeccion_vehiculo[ 'presion_neumatico_re' ]:NULL;
// Pastillas freno
         $this->pastillas_freno_di = (isset($inspeccion_vehiculo[ 'pastillas_freno_di' ]))?$inspeccion_vehiculo[ 'pastillas_freno_di' ]:NULL;
         $this->pastillas_freno_dd = (isset($inspeccion_vehiculo[ 'pastillas_freno_dd' ]))?$inspeccion_vehiculo[ 'pastillas_freno_dd' ]:NULL;
         $this->pastillas_freno_ti = (isset($inspeccion_vehiculo[ 'pastillas_freno_ti' ]))?$inspeccion_vehiculo[ 'pastillas_freno_ti' ]:NULL;
         $this->pastillas_freno_td = (isset($inspeccion_vehiculo[ 'pastillas_freno_td' ]))?$inspeccion_vehiculo[ 'pastillas_freno_td' ]:NULL;
// Discos freno
         $this->discos_freno_di = (isset($inspeccion_vehiculo[ 'discos_freno_di' ]))?$inspeccion_vehiculo[ 'discos_freno_di' ]:NULL;
         $this->discos_freno_dd = (isset($inspeccion_vehiculo[ 'discos_freno_dd' ]))?$inspeccion_vehiculo[ 'discos_freno_dd' ]:NULL;
         $this->discos_freno_ti = (isset($inspeccion_vehiculo[ 'discos_freno_ti' ]))?$inspeccion_vehiculo[ 'discos_freno_ti' ]:NULL;
         $this->discos_freno_td = (isset($inspeccion_vehiculo[ 'discos_freno_td' ]))?$inspeccion_vehiculo[ 'discos_freno_td' ]:NULL;
// Suspensión
         $this->amortiguadores_di = (isset($inspeccion_vehiculo[ 'amortiguadores_di' ]))?$inspeccion_vehiculo[ 'amortiguadores_di' ]:NULL;
         $this->amortiguadores_dd = (isset($inspeccion_vehiculo[ 'amortiguadores_dd' ]))?$inspeccion_vehiculo[ 'amortiguadores_dd' ]:NULL;
         $this->amortiguadores_ti = (isset($inspeccion_vehiculo[ 'amortiguadores_ti' ]))?$inspeccion_vehiculo[ 'amortiguadores_ti' ]:NULL;
         $this->amortiguadores_td = (isset($inspeccion_vehiculo[ 'amortiguadores_td' ]))?$inspeccion_vehiculo[ 'amortiguadores_td' ]:NULL;
         $this->fuelle_di = (isset($inspeccion_vehiculo[ 'fuelle_di' ]))?$inspeccion_vehiculo[ 'fuelle_di' ]:NULL;
         $this->fuelle_dd = (isset($inspeccion_vehiculo[ 'fuelle_dd' ]))?$inspeccion_vehiculo[ 'fuelle_dd' ]:NULL;
         $this->fuelle_ti = (isset($inspeccion_vehiculo[ 'fuelle_ti' ]))?$inspeccion_vehiculo[ 'fuelle_ti' ]:NULL;
         $this->fuelle_td = (isset($inspeccion_vehiculo[ 'fuelle_td' ]))?$inspeccion_vehiculo[ 'fuelle_td' ]:NULL;
// Iluminación
         $this->luz_posicion_di = (isset($inspeccion_vehiculo[ 'luz_posicion_di' ]))?$inspeccion_vehiculo[ 'luz_posicion_di' ]:NULL;
         $this->luz_posicion_dd = (isset($inspeccion_vehiculo[ 'luz_posicion_dd' ]))?$inspeccion_vehiculo[ 'luz_posicion_dd' ]:NULL;
         $this->luz_posicion_ti = (isset($inspeccion_vehiculo[ 'luz_posicion_ti' ]))?$inspeccion_vehiculo[ 'luz_posicion_ti' ]:NULL;
         $this->luz_posicion_td = (isset($inspeccion_vehiculo[ 'luz_posicion_td' ]))?$inspeccion_vehiculo[ 'luz_posicion_td' ]:NULL;
         $this->luz_corta_di = (isset($inspeccion_vehiculo[ 'luz_corta_di' ]))?$inspeccion_vehiculo[ 'luz_corta_di' ]:NULL;
         $this->luz_corta_dd = (isset($inspeccion_vehiculo[ 'luz_corta_dd' ]))?$inspeccion_vehiculo[ 'luz_corta_dd' ]:NULL;
         $this->luz_larga_di = (isset($inspeccion_vehiculo[ 'luz_larga_di' ]))?$inspeccion_vehiculo[ 'luz_larga_di' ]:NULL;
         $this->luz_larga_dd = (isset($inspeccion_vehiculo[ 'luz_larga_dd' ]))?$inspeccion_vehiculo[ 'luz_larga_dd' ]:NULL;
         $this->luz_freno_ti = (isset($inspeccion_vehiculo[ 'luz_freno_ti' ]))?$inspeccion_vehiculo[ 'luz_freno_ti' ]:NULL;
         $this->luz_freno_td = (isset($inspeccion_vehiculo[ 'luz_freno_td' ]))?$inspeccion_vehiculo[ 'luz_freno_td' ]:NULL;
         $this->luz_marcha_atras_ti = (isset($inspeccion_vehiculo[ 'luz_marcha_atras_ti' ]))?$inspeccion_vehiculo[ 'luz_marcha_atras_ti' ]:NULL;
         $this->luz_marcha_atras_td = (isset($inspeccion_vehiculo[ 'luz_marcha_atras_td' ]))?$inspeccion_vehiculo[ 'luz_marcha_atras_td' ]:NULL;
         $this->luz_antiniebla_di = (isset($inspeccion_vehiculo[ 'luz_antiniebla_di' ]))?$inspeccion_vehiculo[ 'luz_antiniebla_di' ]:NULL;
         $this->luz_antiniebla_dd = (isset($inspeccion_vehiculo[ 'luz_antiniebla_dd' ]))?$inspeccion_vehiculo[ 'luz_antiniebla_dd' ]:NULL;
         $this->luz_antiniebla_ti = (isset($inspeccion_vehiculo[ 'luz_antiniebla_ti' ]))?$inspeccion_vehiculo[ 'luz_antiniebla_ti' ]:NULL;
         $this->luz_antiniebla_td = (isset($inspeccion_vehiculo[ 'luz_antiniebla_td' ]))?$inspeccion_vehiculo[ 'luz_antiniebla_td' ]:NULL;
// Niveles
         $this->nivel_aceite = (isset($inspeccion_vehiculo[ 'nivel_aceite' ]))?$inspeccion_vehiculo[ 'nivel_aceite' ]:NULL;
         $this->nivel_anticongelante = (isset($inspeccion_vehiculo[ 'nivel_anticongelante' ]))?$inspeccion_vehiculo[ 'nivel_anticongelante' ]:NULL;
         $this->nivel_limpiacristales = (isset($inspeccion_vehiculo[ 'nivel_limpiacristales' ]))?$inspeccion_vehiculo[ 'nivel_limpiacristales' ]:NULL;
         $this->nivel_direccion = (isset($inspeccion_vehiculo[ 'nivel_direccion' ]))?$inspeccion_vehiculo[ 'nivel_direccion' ]:NULL;
         $this->nivel_frenos = (isset($inspeccion_vehiculo[ 'nivel_frenos' ]))?$inspeccion_vehiculo[ 'nivel_frenos' ]:NULL;
// Carrocería
         $this->paragolpes_delantero = (isset($inspeccion_vehiculo[ 'paragolpes_delantero' ]))?$inspeccion_vehiculo[ 'paragolpes_delantero' ]:NULL;
         $this->paragolpes_trasero = (isset($inspeccion_vehiculo[ 'paragolpes_trasero' ]))?$inspeccion_vehiculo[ 'paragolpes_trasero' ]:NULL;
         $this->capo = (isset($inspeccion_vehiculo[ 'capo' ]))?$inspeccion_vehiculo[ 'capo' ]:NULL;
         $this->maletero = (isset($inspeccion_vehiculo[ 'maletero' ]))?$inspeccion_vehiculo[ 'maletero' ]:NULL;
         $this->puerta_di = (isset($inspeccion_vehiculo[ 'puerta_di' ]))?$inspeccion_vehiculo[ 'puerta_di' ]:NULL;
         $this->puerta_dd = (isset($inspeccion_vehiculo[ 'puerta_dd' ]))?$inspeccion_vehiculo[ 'puerta_dd' ]:NULL;
         $this->puerta_ti = (isset($inspeccion_vehiculo[ 'puerta_ti' ]))?$inspeccion_vehiculo[ 'puerta_ti' ]:NULL;
         $this->puerta_td = (isset($inspeccion_vehiculo[ 'puerta_td' ]))?$inspeccion_vehiculo[ 'puerta_td' ]:NULL;
         $this->llanta_di = (isset($inspeccion_vehiculo[ 'llanta_di' ]))?$inspeccion_vehiculo[ 'llanta_di' ]:NULL;
         $this->llanta_dd = (isset($inspeccion_vehiculo[ 'llanta_dd' ]))?$inspeccion_vehiculo[ 'llanta_dd' ]:NULL;
         $this->llanta_ti = (isset($inspeccion_vehiculo[ 'llanta_ti' ]))?$inspeccion_vehiculo[ 'llanta_ti' ]:NULL;
         $this->llanta_td = (isset($inspeccion_vehiculo[ 'llanta_td' ]))?$inspeccion_vehiculo[ 'llanta_td' ]:NULL;
         $this->latiguillo_freno_di = (isset($inspeccion_vehiculo[ 'latiguillo_freno_di' ]))?$inspeccion_vehiculo[ 'latiguillo_freno_di' ]:NULL;
         $this->latiguillo_freno_dd = (isset($inspeccion_vehiculo[ 'latiguillo_freno_dd' ]))?$inspeccion_vehiculo[ 'latiguillo_freno_dd' ]:NULL;
         $this->latiguillo_freno_ti = (isset($inspeccion_vehiculo[ 'latiguillo_freno_ti' ]))?$inspeccion_vehiculo[ 'latiguillo_freno_ti' ]:NULL;
         $this->latiguillo_freno_td = (isset($inspeccion_vehiculo[ 'latiguillo_freno_td' ]))?$inspeccion_vehiculo[ 'latiguillo_freno_td' ]:NULL;
         $this->rodamiento_di = (isset($inspeccion_vehiculo[ 'rodamiento_di' ]))?$inspeccion_vehiculo[ 'rodamiento_di' ]:NULL;
         $this->rodamiento_dd = (isset($inspeccion_vehiculo[ 'rodamiento_dd' ]))?$inspeccion_vehiculo[ 'rodamiento_dd' ]:NULL;
         $this->rodamiento_ti = (isset($inspeccion_vehiculo[ 'rodamiento_ti' ]))?$inspeccion_vehiculo[ 'rodamiento_ti' ]:NULL;
         $this->rodamiento_td = (isset($inspeccion_vehiculo[ 'rodamiento_td' ]))?$inspeccion_vehiculo[ 'rodamiento_td' ]:NULL;
         $this->palier_di = (isset($inspeccion_vehiculo[ 'palier_di' ]))?$inspeccion_vehiculo[ 'palier_di' ]:NULL;
         $this->palier_dd = (isset($inspeccion_vehiculo[ 'palier_dd' ]))?$inspeccion_vehiculo[ 'palier_dd' ]:NULL;
         $this->palier_ti = (isset($inspeccion_vehiculo[ 'palier_ti' ]))?$inspeccion_vehiculo[ 'palier_ti' ]:NULL;
         $this->palier_td = (isset($inspeccion_vehiculo[ 'palier_td' ]))?$inspeccion_vehiculo[ 'palier_td' ]:NULL;
         $this->trapecio_di = (isset($inspeccion_vehiculo[ 'trapecio_di' ]))?$inspeccion_vehiculo[ 'trapecio_di' ]:NULL;
         $this->trapecio_dd = (isset($inspeccion_vehiculo[ 'trapecio_dd' ]))?$inspeccion_vehiculo[ 'trapecio_dd' ]:NULL;
         $this->trapecio_ti = (isset($inspeccion_vehiculo[ 'trapecio_ti' ]))?$inspeccion_vehiculo[ 'trapecio_ti' ]:NULL;
         $this->trapecio_td = (isset($inspeccion_vehiculo[ 'trapecio_td' ]))?$inspeccion_vehiculo[ 'trapecio_td' ]:NULL;
         $this->limpiaparabrisas_d = (isset($inspeccion_vehiculo[ 'limpiaparabrisas_d' ]))?$inspeccion_vehiculo[ 'limpiaparabrisas_d' ]:NULL;
         $this->limpiaparabrisas_t = (isset($inspeccion_vehiculo[ 'limpiaparabrisas_t' ]))?$inspeccion_vehiculo[ 'limpiaparabrisas_t' ]:NULL;
         $this->bateria = (isset($inspeccion_vehiculo[ 'bateria' ]))?$inspeccion_vehiculo[ 'bateria' ]:NULL;
         $this->fugas = (isset($inspeccion_vehiculo[ 'fugas' ]))?$inspeccion_vehiculo[ 'fugas' ]:NULL;
         $this->correa_aux = (isset($inspeccion_vehiculo[ 'correa_aux' ]))?$inspeccion_vehiculo[ 'correa_aux' ]:NULL;
         $this->manguitos = (isset($inspeccion_vehiculo[ 'manguitos' ]))?$inspeccion_vehiculo[ 'manguitos' ]:NULL;
         $this->silencioso_d = (isset($inspeccion_vehiculo[ 'silencioso_d' ]))?$inspeccion_vehiculo[ 'silencioso_d' ]:NULL;
         $this->silencioso_t = (isset($inspeccion_vehiculo[ 'silencioso_t' ]))?$inspeccion_vehiculo[ 'silencioso_t' ]:NULL;
         $this->tubos = (isset($inspeccion_vehiculo[ 'tubos' ]))?$inspeccion_vehiculo[ 'tubos' ]:NULL;
         $this->fijaciones = (isset($inspeccion_vehiculo[ 'fijaciones' ]))?$inspeccion_vehiculo[ 'fijaciones' ]:NULL;
         $this->palanca_cambios = (isset($inspeccion_vehiculo[ 'palanca_cambios' ]))?$inspeccion_vehiculo[ 'palanca_cambios' ]:NULL;
         $this->elevalunas = (isset($inspeccion_vehiculo[ 'elevalunas' ]))?$inspeccion_vehiculo[ 'elevalunas' ]:NULL;
         $this->cinturones = (isset($inspeccion_vehiculo[ 'cinturones' ]))?$inspeccion_vehiculo[ 'cinturones' ]:NULL;
         $this->embrague = (isset($inspeccion_vehiculo[ 'embrague' ]))?$inspeccion_vehiculo[ 'embrague' ]:NULL;
         $this->holgura_direccion = (isset($inspeccion_vehiculo[ 'holgura_direccion' ]))?$inspeccion_vehiculo[ 'holgura_direccion' ]:NULL;
         $this->aleta_di = (isset($inspeccion_vehiculo[ 'aleta_di' ]))?$inspeccion_vehiculo[ 'aleta_di' ]:NULL;
         $this->aleta_dd = (isset($inspeccion_vehiculo[ 'aleta_dd' ]))?$inspeccion_vehiculo[ 'aleta_dd' ]:NULL;
         $this->aleta_ti = (isset($inspeccion_vehiculo[ 'aleta_ti' ]))?$inspeccion_vehiculo[ 'aleta_ti' ]:NULL;
         $this->aleta_td = (isset($inspeccion_vehiculo[ 'aleta_td' ]))?$inspeccion_vehiculo[ 'aleta_td' ]:NULL;
         $this->observaciones = (isset($inspeccion_vehiculo[ 'observaciones' ]))?$inspeccion_vehiculo[ 'observaciones' ]:NULL;
      } else {
         // Identificación vehículo
         $this->id = null;
         $this->id_vehiculo = null;
         $this->matricula = null;
         $this->codcliente = null;
         $this->nombre_cliente = null;
         $this->kilometraje = null;
         $this->fecha = Date('d-m-Y');
// Profundidad neumáticos
         $this->profundidad_neumatico_di = null;
         $this->profundidad_neumatico_dd = null;
         $this->profundidad_neumatico_ti = null;
         $this->profundidad_neumatico_td = null;
         $this->profundidad_neumatico_re = null;
// Presión neumáticos
         $this->presion_neumatico_di = null;
         $this->presion_neumatico_dd = null;
         $this->presion_neumatico_ti = null;
         $this->presion_neumatico_td = null;
         $this->presion_neumatico_re = null;
// Pastillas freno
         $this->pastillas_freno_di = null;
         $this->pastillas_freno_dd = null;
         $this->pastillas_freno_ti = null;
         $this->pastillas_freno_td = null;
// Discos freno
         $this->discos_freno_di = null;
         $this->discos_freno_dd = null;
         $this->discos_freno_ti = null;
         $this->discos_freno_td = null;
// Suspensión
         $this->amortiguadores_di = null;
         $this->amortiguadores_dd = null;
         $this->amortiguadores_ti = null;
         $this->amortiguadores_td = null;
         $this->fuelle_di = null;
         $this->fuelle_dd = null;
         $this->fuelle_ti = null;
         $this->fuelle_td = null;
// Iluminación
         $this->luz_posicion_di = null;
         $this->luz_posicion_dd = null;
         $this->luz_posicion_ti = null;
         $this->luz_posicion_td = null;
         $this->luz_corta_di = null;
         $this->luz_corta_dd = null;
         $this->luz_larga_di = null;
         $this->luz_larga_dd = null;
         $this->luz_freno_ti = null;
         $this->luz_freno_td = null;
         $this->luz_marcha_atras_ti = null;
         $this->luz_marcha_atras_td = null;
         $this->luz_antiniebla_di = null;
         $this->luz_antiniebla_dd = null;
         $this->luz_antiniebla_ti = null;
         $this->luz_antiniebla_td = null;
// Niveles
         $this->nivel_aceite = null;
         $this->nivel_anticongelante = null;
         $this->nivel_limpiacristales = null;
         $this->nivel_direccion = null;
         $this->nivel_frenos = null;
// Carrocería
         $this->paragolpes_delantero = null;
         $this->paragolpes_trasero = null;
         $this->capo = null;
         $this->maletero = null;
         $this->puerta_di = null;
         $this->puerta_dd = null;
         $this->puerta_ti = null;
         $this->puerta_td = null;
         $this->llanta_di = null;
         $this->llanta_dd = null;
         $this->llanta_ti = null;
         $this->llanta_td = null;
         $this->latiguillo_freno_di = null;
         $this->latiguillo_freno_dd = null;
         $this->latiguillo_freno_ti = null;
         $this->latiguillo_freno_td = null;
         $this->rodamiento_di = null;
         $this->rodamiento_dd = null;
         $this->rodamiento_ti = null;
         $this->rodamiento_td = null;
         $this->palier_di = null;
         $this->palier_dd = null;
         $this->palier_ti = null;
         $this->palier_td = null;
         $this->trapecio_di = null;
         $this->trapecio_dd = null;
         $this->trapecio_ti = null;
         $this->trapecio_td = null;
         $this->limpiaparabrisas_d = null;
         $this->limpiaparabrisas_t = null;
         $this->bateria = null;
         $this->fugas = null;
         $this->correa_aux = null;
         $this->manguitos = null;
         $this->silencioso_d = null;
         $this->silencioso_t = null;
         $this->tubos = null;
         $this->fijaciones = null;
         $this->palanca_cambios = null;
         $this->elevalunas = null;
         $this->cinturones = null;
         $this->embrague = null;
         $this->holgura_direccion = null;
         $this->aleta_di = null;
         $this->aleta_dd = null;
         $this->aleta_ti = null;
         $this->aleta_td = null;
         $this->observaciones = null;
      }
   }

   /**
    * 
    */
   protected function install()
   {
   }

   /**
    * Devuelve todos los campos de automocion_inspecciones_vehiculos y 
    * el codcliente del vehiculo con id=$id
    * 
    * @param type $id
    * @return boolean|\self
    */
   public function get($id)
   {
      $element = $this->db->select('SELECT '.
                                        $this->table_name.'.id, '.
                                        $this->table_name.'.id_vehiculo, '.
                                        'automocion_vehiculos.matricula, '.
                                        'automocion_vehiculos.codcliente, '.
                                        'clientes.nombre AS nombre_cliente, '.
                                        $this->table_name.'.kilometraje, '.
                                        $this->table_name.'.fecha, '.
                                        $this->table_name.'.profundidad_neumatico_di, '.
                                        $this->table_name.'.profundidad_neumatico_dd, '.
                                        $this->table_name.'.profundidad_neumatico_ti, '.
                                        $this->table_name.'.profundidad_neumatico_td, '.
                                        $this->table_name.'.profundidad_neumatico_re, '.
                                        $this->table_name.'.presion_neumatico_di, '.
                                        $this->table_name.'.presion_neumatico_dd, '.
                                        $this->table_name.'.presion_neumatico_ti, '.
                                        $this->table_name.'.presion_neumatico_td, '.
                                        $this->table_name.'.presion_neumatico_re, '.
                                        $this->table_name.'.pastillas_freno_di, '.
                                        $this->table_name.'.pastillas_freno_dd, '.
                                        $this->table_name.'.pastillas_freno_ti, '.
                                        $this->table_name.'.pastillas_freno_td, '.
                                        $this->table_name.'.discos_freno_di, '.
                                        $this->table_name.'.discos_freno_dd, '.
                                        $this->table_name.'.discos_freno_ti, '.
                                        $this->table_name.'.discos_freno_td, '.
                                        $this->table_name.'.amortiguadores_di, '.
                                        $this->table_name.'.amortiguadores_dd, '.
                                        $this->table_name.'.amortiguadores_ti, '.
                                        $this->table_name.'.amortiguadores_td, '.
                                        $this->table_name.'.fuelle_di, '.
                                        $this->table_name.'.fuelle_dd, '.
                                        $this->table_name.'.fuelle_ti, '.
                                        $this->table_name.'.fuelle_td, '.
                                        $this->table_name.'.luz_posicion_di, '.
                                        $this->table_name.'.luz_posicion_dd, '.
                                        $this->table_name.'.luz_posicion_ti, '.
                                        $this->table_name.'.luz_posicion_td, '.
                                        $this->table_name.'.luz_corta_di, '.
                                        $this->table_name.'.luz_corta_dd, '.
                                        $this->table_name.'.luz_larga_di, '.
                                        $this->table_name.'.luz_larga_dd, '.
                                        $this->table_name.'.luz_freno_ti, '.
                                        $this->table_name.'.luz_freno_td, '.
                                        $this->table_name.'.luz_marcha_atras_ti, '.
                                        $this->table_name.'.luz_marcha_atras_td, '.
                                        $this->table_name.'.luz_antiniebla_di, '.
                                        $this->table_name.'.luz_antiniebla_dd, '.
                                        $this->table_name.'.luz_antiniebla_ti, '.
                                        $this->table_name.'.luz_antiniebla_td, '.
                                        $this->table_name.'.nivel_aceite, '.
                                        $this->table_name.'.nivel_anticongelante, '.
                                        $this->table_name.'.nivel_limpiacristales, '.
                                        $this->table_name.'.nivel_direccion, '.
                                        $this->table_name.'.nivel_frenos, '.
                                        $this->table_name.'.paragolpes_delantero, '.
                                        $this->table_name.'.paragolpes_trasero, '.
                                        $this->table_name.'.capo, '.
                                        $this->table_name.'.maletero, '.
                                        $this->table_name.'.puerta_di, '.
                                        $this->table_name.'.puerta_dd, '.
                                        $this->table_name.'.puerta_ti, '.
                                        $this->table_name.'.puerta_td, '.
                                        $this->table_name.'.llanta_di, '.
                                        $this->table_name.'.llanta_dd, '.
                                        $this->table_name.'.llanta_ti, '.
                                        $this->table_name.'.llanta_td, '.
                                        $this->table_name.'.latiguillo_freno_di, '.
                                        $this->table_name.'.latiguillo_freno_dd, '.
                                        $this->table_name.'.latiguillo_freno_ti, '.
                                        $this->table_name.'.latiguillo_freno_td, '.
                                        $this->table_name.'.rodamiento_di, '.
                                        $this->table_name.'.rodamiento_dd, '.
                                        $this->table_name.'.rodamiento_ti, '.
                                        $this->table_name.'.rodamiento_td, '.
                                        $this->table_name.'.palier_di, '.
                                        $this->table_name.'.palier_dd, '.
                                        $this->table_name.'.palier_ti, '.
                                        $this->table_name.'.palier_td, '.
                                        $this->table_name.'.trapecio_di, '.
                                        $this->table_name.'.trapecio_dd, '.
                                        $this->table_name.'.trapecio_ti, '.
                                        $this->table_name.'.trapecio_td, '.
                                        $this->table_name.'.limpiaparabrisas_d, '.
                                        $this->table_name.'.limpiaparabrisas_t, '.
                                        $this->table_name.'.bateria, '.
                                        $this->table_name.'.fugas, '.
                                        $this->table_name.'.correa_aux, '.
                                        $this->table_name.'.manguitos, '.
                                        $this->table_name.'.silencioso_d, '.
                                        $this->table_name.'.silencioso_t, '.
                                        $this->table_name.'.tubos, '.
                                        $this->table_name.'.fijaciones, '.
                                        $this->table_name.'.palanca_cambios, '.
                                        $this->table_name.'.elevalunas, '.
                                        $this->table_name.'.cinturones, '.
                                        $this->table_name.'.embrague, '.
                                        $this->table_name.'.holgura_direccion, '.
                                        $this->table_name.'.aleta_di, '.
                                        $this->table_name.'.aleta_dd, '.
                                        $this->table_name.'.aleta_ti, '.
                                        $this->table_name.'.aleta_td, '.
                                        $this->table_name.'.observaciones '.
                                     'FROM '.$this->table_name.
                                        ' INNER JOIN automocion_vehiculos '.
                                            ' ON '.$this->table_name.'.id_vehiculo=automocion_vehiculos.id '.
                                        ' INNER JOIN clientes '.
                                            ' ON automocion_vehiculos.codcliente=clientes.codcliente '.
                                     'WHERE '.$this->table_name.'.id = '.$this->var2str($id).';');
      if ($element) {
         return new self($element[ 0 ]);
      } else {
         return false;
      }
   }

   /**
    * Devuelve todos los registros con id=$id,
    * sino false
    * 
    * @return boolean
    */
   public function exists()
   {
      if (is_null($this->id)) {
         return false;
      } else {
         return $this->db->select('SELECT * FROM '.$this->table_name.' WHERE id = '.$this->var2str($this->id).';');
      }
   }

   /**
    * Devuelve true si ha añadido o actualizado el registro,
    * sino false
    * 
    * @return boolean
    */
   public function save()
   {
      if ($this->exists()) {
         $sql = 'UPDATE '.$this->table_name.' SET '
                     .'id_vehiculo = '.$this->var2str($this->id_vehiculo)
                     .', kilometraje= '.$this->var2str($this->kilometraje)
                     .', fecha = '.$this->var2str($this->fecha)
                     .', profundidad_neumatico_di = '.$this->var2str($this->profundidad_neumatico_di)
                     .', profundidad_neumatico_dd = '.$this->var2str($this->profundidad_neumatico_dd)
                     .', profundidad_neumatico_ti = '.$this->var2str($this->profundidad_neumatico_ti)
                     .', profundidad_neumatico_td = '.$this->var2str($this->profundidad_neumatico_td)
                     .', profundidad_neumatico_re = '.$this->var2str($this->profundidad_neumatico_re)
                     .', presion_neumatico_di = '.$this->var2str($this->presion_neumatico_di)
                     .', presion_neumatico_dd = '.$this->var2str($this->presion_neumatico_dd)
                     .', presion_neumatico_ti = '.$this->var2str($this->presion_neumatico_ti)
                     .', presion_neumatico_td = '.$this->var2str($this->presion_neumatico_td)
                     .', presion_neumatico_re = '.$this->var2str($this->presion_neumatico_re)
                     .', pastillas_freno_di = '.$this->var2str($this->pastillas_freno_di)
                     .', pastillas_freno_dd = '.$this->var2str($this->pastillas_freno_dd)
                     .', pastillas_freno_ti = '.$this->var2str($this->pastillas_freno_ti)
                     .', pastillas_freno_td = '.$this->var2str($this->pastillas_freno_td)
                     .', discos_freno_di = '.$this->var2str($this->discos_freno_di)
                     .', discos_freno_dd = '.$this->var2str($this->discos_freno_dd)
                     .', discos_freno_ti = '.$this->var2str($this->discos_freno_ti)
                     .', discos_freno_td = '.$this->var2str($this->discos_freno_td)
                     .', amortiguadores_di = '.$this->var2str($this->amortiguadores_di)
                     .', amortiguadores_dd = '.$this->var2str($this->amortiguadores_dd)
                     .', amortiguadores_ti = '.$this->var2str($this->amortiguadores_ti)
                     .', amortiguadores_td = '.$this->var2str($this->amortiguadores_td)
                     .', fuelle_di = '.$this->var2str($this->fuelle_di)
                     .', fuelle_dd = '.$this->var2str($this->fuelle_dd)
                     .', fuelle_ti = '.$this->var2str($this->fuelle_ti)
                     .', fuelle_td = '.$this->var2str($this->fuelle_td)
                     .', luz_posicion_di = '.$this->var2str($this->luz_posicion_di)
                     .', luz_posicion_dd = '.$this->var2str($this->luz_posicion_dd)
                     .', luz_posicion_ti = '.$this->var2str($this->luz_posicion_ti)
                     .', luz_posicion_td = '.$this->var2str($this->luz_posicion_td)
                     .', luz_corta_di = '.$this->var2str($this->luz_corta_di)
                     .', luz_corta_dd = '.$this->var2str($this->luz_corta_dd)
                     .', luz_larga_di = '.$this->var2str($this->luz_larga_di)
                     .', luz_larga_dd = '.$this->var2str($this->luz_larga_dd)
                     .', luz_freno_ti = '.$this->var2str($this->luz_freno_ti)
                     .', luz_freno_td = '.$this->var2str($this->luz_freno_td)
                     .', luz_marcha_atras_ti = '.$this->var2str($this->luz_marcha_atras_ti)
                     .', luz_marcha_atras_td = '.$this->var2str($this->luz_marcha_atras_td)
                     .', luz_antiniebla_di = '.$this->var2str($this->luz_antiniebla_di)
                     .', luz_antiniebla_dd = '.$this->var2str($this->luz_antiniebla_dd)
                     .', luz_antiniebla_ti = '.$this->var2str($this->luz_antiniebla_ti)
                     .', luz_antiniebla_td = '.$this->var2str($this->luz_antiniebla_td)
                     .', nivel_aceite = '.$this->var2str($this->nivel_aceite)
                     .', nivel_anticongelante = '.$this->var2str($this->nivel_anticongelante)
                     .', nivel_limpiacristales= '.$this->var2str($this->nivel_limpiacristales)
                     .', nivel_direccion= '.$this->var2str($this->nivel_direccion)
                     .', nivel_frenos= '.$this->var2str($this->nivel_frenos)
                     .', paragolpes_delantero= '.$this->var2str($this->paragolpes_delantero)
                     .', paragolpes_trasero = '.$this->var2str($this->paragolpes_trasero)
                     .', capo = '.$this->var2str($this->capo)
                     .', maletero = '.$this->var2str($this->maletero)
                     .', puerta_di = '.$this->var2str($this->puerta_di)
                     .', puerta_dd = '.$this->var2str($this->puerta_dd)
                     .', puerta_ti = '.$this->var2str($this->puerta_ti)
                     .', puerta_td = '.$this->var2str($this->puerta_td)
                     .', llanta_di         = '.$this->var2str($this->llanta_di)
                     .', llanta_dd         = '.$this->var2str($this->llanta_dd)
                     .', llanta_ti         = '.$this->var2str($this->llanta_ti)
                     .', llanta_td         = '.$this->var2str($this->llanta_td)
                     .', latiguillo_freno_di = '.$this->var2str($this->latiguillo_freno_di)
                     .', latiguillo_freno_dd = '.$this->var2str($this->latiguillo_freno_dd)
                     .', latiguillo_freno_ti = '.$this->var2str($this->latiguillo_freno_ti)
                     .', latiguillo_freno_td = '.$this->var2str($this->latiguillo_freno_td)
                     .', rodamiento_di      = '.$this->var2str($this->rodamiento_di)
                     .', rodamiento_dd      = '.$this->var2str($this->rodamiento_dd)
                     .', rodamiento_ti      = '.$this->var2str($this->rodamiento_ti)
                     .', rodamiento_td      = '.$this->var2str($this->rodamiento_td)
                     .', palier_di         = '.$this->var2str($this->palier_di)
                     .', palier_dd         = '.$this->var2str($this->palier_dd)
                     .', palier_ti         = '.$this->var2str($this->palier_ti)
                     .', palier_td         = '.$this->var2str($this->palier_td)
                     .', trapecio_di      = '.$this->var2str($this->trapecio_di)
                     .', trapecio_dd      = '.$this->var2str($this->trapecio_dd)
                     .', trapecio_ti      = '.$this->var2str($this->trapecio_ti)
                     .', trapecio_td      = '.$this->var2str($this->trapecio_td)
                     .', limpiaparabrisas_d   = '.$this->var2str($this->limpiaparabrisas_d)
                     .', limpiaparabrisas_t   = '.$this->var2str($this->limpiaparabrisas_t)
                     .', bateria = '.$this->var2str($this->bateria)
                     .', fugas = '.$this->var2str($this->fugas)
                     .', correa_aux = '.$this->var2str($this->correa_aux)
                     .', manguitos = '.$this->var2str($this->manguitos)
                     .', silencioso_d = '.$this->var2str($this->silencioso_d)
                     .', silencioso_t = '.$this->var2str($this->silencioso_t)
                     .', tubos = '.$this->var2str($this->tubos)
                     .', fijaciones = '.$this->var2str($this->fijaciones)
                     .', palanca_cambios = '.$this->var2str($this->palanca_cambios)
                     .', elevalunas = '.$this->var2str($this->elevalunas)
                     .', cinturones = '.$this->var2str($this->cinturones)
                     .', embrague = '.$this->var2str($this->embrague)
                     .', holgura_direccion = '.$this->var2str($this->holgura_direccion)
                     .', aleta_di = '.$this->var2str($this->aleta_di)
                     .', aleta_dd = '.$this->var2str($this->aleta_dd)
                     .', aleta_ti = '.$this->var2str($this->aleta_ti)
                     .', aleta_td = '.$this->var2str($this->aleta_td)
                     .', observaciones = '.$this->var2str($this->observaciones)
                  .' WHERE id = '.$this->var2str($this->id).';';

         return $this->db->exec($sql);
      } else {
         $sql = 'INSERT INTO '.$this->table_name
                     .' (id_vehiculo, kilometraje, fecha, profundidad_neumatico_di, profundidad_neumatico_dd, profundidad_neumatico_ti, profundidad_neumatico_td, profundidad_neumatico_re, presion_neumatico_di, presion_neumatico_dd, presion_neumatico_ti, presion_neumatico_td, presion_neumatico_re, pastillas_freno_di, pastillas_freno_dd, pastillas_freno_ti, pastillas_freno_td, discos_freno_di, discos_freno_dd, discos_freno_ti, discos_freno_td, amortiguadores_di, amortiguadores_dd, amortiguadores_ti, amortiguadores_td, fuelle_di, fuelle_dd, fuelle_ti, fuelle_td, luz_posicion_di, luz_posicion_dd, luz_posicion_ti, luz_posicion_td, luz_corta_di, luz_corta_dd, luz_larga_di, luz_larga_dd, luz_freno_ti, luz_freno_td, luz_marcha_atras_ti, luz_marcha_atras_td, luz_antiniebla_di, luz_antiniebla_dd, luz_antiniebla_ti, luz_antiniebla_td, nivel_aceite, nivel_anticongelante, nivel_limpiacristales, nivel_direccion, nivel_frenos, paragolpes_delantero, paragolpes_trasero, capo, maletero, puerta_di, puerta_dd, puerta_ti, puerta_td , llanta_di, llanta_dd, llanta_ti, llanta_td, latiguillo_freno_di, latiguillo_freno_dd, latiguillo_freno_ti, latiguillo_freno_td, rodamiento_di, rodamiento_dd, rodamiento_ti, rodamiento_td, palier_di, palier_dd, palier_ti, palier_td, trapecio_di, trapecio_dd, trapecio_ti, trapecio_td, limpiaparabrisas_d, limpiaparabrisas_t, bateria, fugas, correa_aux, manguitos, silencioso_d, silencioso_t, tubos, fijaciones, palanca_cambios, elevalunas, cinturones, embrague, holgura_direccion, aleta_di, aleta_dd, aleta_ti, aleta_td, observaciones ) '.
                  ' VALUES ('.
                     $this->var2str($this->id_vehiculo).', '.
                     $this->var2str($this->kilometraje).', '.
                     $this->var2str($this->fecha).', '.
                     $this->var2str($this->profundidad_neumatico_di).', '.
                     $this->var2str($this->profundidad_neumatico_dd).', '.
                     $this->var2str($this->profundidad_neumatico_ti).', '.
                     $this->var2str($this->profundidad_neumatico_td).', '.
                     $this->var2str($this->profundidad_neumatico_re).', '.
                     $this->var2str($this->presion_neumatico_di).', '.
                     $this->var2str($this->presion_neumatico_dd).', '.
                     $this->var2str($this->presion_neumatico_ti).', '.
                     $this->var2str($this->presion_neumatico_td).', '.
                     $this->var2str($this->presion_neumatico_re).', '.
                     $this->var2str($this->pastillas_freno_di).', '.
                     $this->var2str($this->pastillas_freno_dd).', '.
                     $this->var2str($this->pastillas_freno_ti).', '.
                     $this->var2str($this->pastillas_freno_td).', '.
                     $this->var2str($this->discos_freno_di).', '.
                     $this->var2str($this->discos_freno_dd).', '.
                     $this->var2str($this->discos_freno_ti).', '.
                     $this->var2str($this->discos_freno_td).', '.
                     $this->var2str($this->amortiguadores_di).', '.
                     $this->var2str($this->amortiguadores_dd).', '.
                     $this->var2str($this->amortiguadores_ti).', '.
                     $this->var2str($this->amortiguadores_td).', '.
                     $this->var2str($this->fuelle_di).', '.
                     $this->var2str($this->fuelle_dd).', '.
                     $this->var2str($this->fuelle_ti).', '.
                     $this->var2str($this->fuelle_td).', '.
                     $this->var2str($this->luz_posicion_di).', '.
                     $this->var2str($this->luz_posicion_dd).', '.
                     $this->var2str($this->luz_posicion_ti).', '.
                     $this->var2str($this->luz_posicion_td).', '.
                     $this->var2str($this->luz_corta_di).', '.
                     $this->var2str($this->luz_corta_dd).', '.
                     $this->var2str($this->luz_larga_di).', '.
                     $this->var2str($this->luz_larga_dd).', '.
                     $this->var2str($this->luz_freno_ti).', '.
                     $this->var2str($this->luz_freno_td).', '.
                     $this->var2str($this->luz_marcha_atras_ti).', '.
                     $this->var2str($this->luz_marcha_atras_td).', '.
                     $this->var2str($this->luz_antiniebla_di).', '.
                     $this->var2str($this->luz_antiniebla_dd).', '.
                     $this->var2str($this->luz_antiniebla_ti).', '.
                     $this->var2str($this->luz_antiniebla_td).', '.
                     $this->var2str($this->nivel_aceite).', '.
                     $this->var2str($this->nivel_anticongelante).', '.
                     $this->var2str($this->nivel_limpiacristales).', '.
                     $this->var2str($this->nivel_direccion).', '.
                     $this->var2str($this->nivel_frenos).', '.
                     $this->var2str($this->paragolpes_delantero).', '.
                     $this->var2str($this->paragolpes_trasero).', '.
                     $this->var2str($this->capo).', '.
                     $this->var2str($this->maletero).', '.
                     $this->var2str($this->puerta_di).', '.
                     $this->var2str($this->puerta_dd).', '.
                     $this->var2str($this->puerta_ti).', '.
                     $this->var2str($this->puerta_td).', '.
                     $this->var2str($this->llanta_di).', '.
                     $this->var2str($this->llanta_dd).', '.
                     $this->var2str($this->llanta_ti).', '.
                     $this->var2str($this->llanta_td).', '.
                     $this->var2str($this->latiguillo_freno_di).', '.
                     $this->var2str($this->latiguillo_freno_dd).', '.
                     $this->var2str($this->latiguillo_freno_ti).', '.
                     $this->var2str($this->latiguillo_freno_td).', '.
                     $this->var2str($this->rodamiento_di).', '.
                     $this->var2str($this->rodamiento_dd).', '.
                     $this->var2str($this->rodamiento_ti).', '.
                     $this->var2str($this->rodamiento_td).', '.
                     $this->var2str($this->palier_di).', '.
                     $this->var2str($this->palier_dd).', '.
                     $this->var2str($this->palier_ti).', '.
                     $this->var2str($this->palier_td).', '.
                     $this->var2str($this->trapecio_di).', '.
                     $this->var2str($this->trapecio_dd).', '.
                     $this->var2str($this->trapecio_ti).', '.
                     $this->var2str($this->trapecio_td).', '.
                     $this->var2str($this->limpiaparabrisas_d).', '.
                     $this->var2str($this->limpiaparabrisas_t).', '.
                     $this->var2str($this->bateria).', '.
                     $this->var2str($this->fugas).', '.
                     $this->var2str($this->correa_aux).', '.
                     $this->var2str($this->manguitos).', '.
                     $this->var2str($this->silencioso_d).', '.
                     $this->var2str($this->silencioso_t).', '.
                     $this->var2str($this->tubos).', '.
                     $this->var2str($this->fijaciones).', '.
                     $this->var2str($this->palanca_cambios).', '.
                     $this->var2str($this->elevalunas).', '.
                     $this->var2str($this->cinturones).', '.
                     $this->var2str($this->embrague).', '.
                     $this->var2str($this->holgura_direccion).', '.
                     $this->var2str($this->aleta_di).', '.
                     $this->var2str($this->aleta_dd).', '.
                     $this->var2str($this->aleta_ti).', '.
                     $this->var2str($this->aleta_td).', '.
                     $this->var2str($this->observaciones).');';

         if ($this->db->exec($sql)) {
           $this->id = $this->db->lastval();

           return true;
         } else {
           return false;
         }
      }
   }

   /**
    * Devuelve el resultado de eliminar el registro con id=$id
    * 
    * @return type
    */
   public function delete()
   {
      $sql = 'DELETE FROM '.$this->table_name.' WHERE id = '.$this->var2str($this->id).';';

      return $this->db->exec($sql);
   }

   /**
    * Devuelve todos los campos de automocion_inspecciones_vehiculos y
    * la matricula y el codcliente asociado al vehiculo y el nombre del cliente
    * ordenados por id DESC por defecto
    * 
    * @param type $offset
    * @param type $order
    * @return \self
    */
   public function all($offset=0, $order='id DESC')
   {
      $list = array();
      $sql = 'SELECT '.
                                       $this->table_name.'.id, '.
                                       $this->table_name.'.id_vehiculo, '.
                                       'automocion_vehiculos.matricula, '.
                                       'automocion_vehiculos.codcliente, '.
                                       'clientes.nombre AS nombre_cliente, '.
                                       $this->table_name.'.kilometraje, '.
                                       $this->table_name.'.fecha, '.
                                       $this->table_name.'.profundidad_neumatico_di, '.
                                       $this->table_name.'.profundidad_neumatico_dd, '.
                                       $this->table_name.'.profundidad_neumatico_ti, '.
                                       $this->table_name.'.profundidad_neumatico_td, '.
                                       $this->table_name.'.profundidad_neumatico_re, '.
                                       $this->table_name.'.presion_neumatico_di, '.
                                       $this->table_name.'.presion_neumatico_dd, '.
                                       $this->table_name.'.presion_neumatico_ti, '.
                                       $this->table_name.'.presion_neumatico_td, '.
                                       $this->table_name.'.presion_neumatico_re, '.
                                       $this->table_name.'.pastillas_freno_di, '.
                                       $this->table_name.'.pastillas_freno_dd, '.
                                       $this->table_name.'.pastillas_freno_ti, '.
                                       $this->table_name.'.pastillas_freno_td, '.
                                       $this->table_name.'.discos_freno_di, '.
                                       $this->table_name.'.discos_freno_dd, '.
                                       $this->table_name.'.discos_freno_ti, '.
                                       $this->table_name.'.discos_freno_td, '.
                                       $this->table_name.'.amortiguadores_di, '.
                                       $this->table_name.'.amortiguadores_dd, '.
                                       $this->table_name.'.amortiguadores_ti, '.
                                       $this->table_name.'.amortiguadores_td, '.
                                       $this->table_name.'.fuelle_di, '.
                                       $this->table_name.'.fuelle_dd, '.
                                       $this->table_name.'.fuelle_ti, '.
                                       $this->table_name.'.fuelle_td, '.
                                       $this->table_name.'.luz_posicion_di, '.
                                       $this->table_name.'.luz_posicion_dd, '.
                                       $this->table_name.'.luz_posicion_ti, '.
                                       $this->table_name.'.luz_posicion_td, '.
                                       $this->table_name.'.luz_corta_di, '.
                                       $this->table_name.'.luz_corta_dd, '.
                                       $this->table_name.'.luz_larga_di, '.
                                       $this->table_name.'.luz_larga_dd, '.
                                       $this->table_name.'.luz_freno_ti, '.
                                       $this->table_name.'.luz_freno_td, '.
                                       $this->table_name.'.luz_marcha_atras_ti, '.
                                       $this->table_name.'.luz_marcha_atras_td, '.
                                       $this->table_name.'.luz_antiniebla_di, '.
                                       $this->table_name.'.luz_antiniebla_dd, '.
                                       $this->table_name.'.luz_antiniebla_ti, '.
                                       $this->table_name.'.luz_antiniebla_td, '.
                                       $this->table_name.'.nivel_aceite, '.
                                       $this->table_name.'.nivel_anticongelante, '.
                                       $this->table_name.'.nivel_limpiacristales, '.
                                       $this->table_name.'.nivel_direccion, '.
                                       $this->table_name.'.nivel_frenos, '.
                                       $this->table_name.'.paragolpes_delantero, '.
                                       $this->table_name.'.paragolpes_trasero, '.
                                       $this->table_name.'.capo, '.
                                       $this->table_name.'.maletero, '.
                                       $this->table_name.'.puerta_di, '.
                                       $this->table_name.'.puerta_dd, '.
                                       $this->table_name.'.puerta_ti, '.
                                       $this->table_name.'.puerta_td, '.
                                       $this->table_name.'.llanta_di, '.
                                       $this->table_name.'.llanta_dd, '.
                                       $this->table_name.'.llanta_ti, '.
                                       $this->table_name.'.llanta_td, '.
                                       $this->table_name.'.latiguillo_freno_di, '.
                                       $this->table_name.'.latiguillo_freno_dd, '.
                                       $this->table_name.'.latiguillo_freno_ti, '.
                                       $this->table_name.'.latiguillo_freno_td, '.
                                       $this->table_name.'.rodamiento_di, '.
                                       $this->table_name.'.rodamiento_dd, '.
                                       $this->table_name.'.rodamiento_ti, '.
                                       $this->table_name.'.rodamiento_td, '.
                                       $this->table_name.'.palier_di, '.
                                       $this->table_name.'.palier_dd, '.
                                       $this->table_name.'.palier_ti, '.
                                       $this->table_name.'.palier_td, '.
                                       $this->table_name.'.trapecio_di, '.
                                       $this->table_name.'.trapecio_dd, '.
                                       $this->table_name.'.trapecio_ti, '.
                                       $this->table_name.'.trapecio_td, '.
                                       $this->table_name.'.limpiaparabrisas_d, '.
                                       $this->table_name.'.limpiaparabrisas_t, '.
                                       $this->table_name.'.bateria, '.
                                       $this->table_name.'.fugas, '.
                                       $this->table_name.'.correa_aux, '.
                                       $this->table_name.'.manguitos, '.
                                       $this->table_name.'.silencioso_d, '.
                                       $this->table_name.'.silencioso_t, '.
                                       $this->table_name.'.tubos, '.
                                       $this->table_name.'.fijaciones, '.
                                       $this->table_name.'.palanca_cambios, '.
                                       $this->table_name.'.elevalunas, '.
                                       $this->table_name.'.cinturones, '.
                                       $this->table_name.'.embrague, '.
                                       $this->table_name.'.holgura_direccion, '.
                                       $this->table_name.'.aleta_di, '.
                                       $this->table_name.'.aleta_dd, '.
                                       $this->table_name.'.aleta_ti, '.
                                       $this->table_name.'.aleta_td, '.
                                       $this->table_name.'.observaciones '.
                                    'FROM '.$this->table_name.
                                       ' INNER JOIN automocion_vehiculos '.
                                          'ON '.$this->table_name.'.id_vehiculo=automocion_vehiculos.id '.
                                       ' INNER JOIN clientes '.
                                          'ON automocion_vehiculos.codcliente=clientes.codcliente '.
                                    'ORDER BY '.$this->table_name.'.'.$order;

      $elements = $this->db->select_limit($sql, FS_ITEM_LIMIT, $offset);
      if ($elements) {
         foreach ($elements as $e) {
           $list[] = new self($e);
         }
      }

      return $list;
   }

   /**
    * Devuelve todos los campos de automocion_inspecciones_vehiculos y 
    * la matricula y el codigo de cliente del vehiculo y el nombre del cliente
    * para codcliente=$codcliente
    * 
    * @param type $codcliente
    * @param type $offset
    * @return \inspeccion_vehiculo
    */
   public function all_from_cliente($codcliente, $offset = 0)
   {
      $list = array();

      $sql = 'SELECT '.
                                       $this->table_name.'.id, '.
                                       $this->table_name.'.id_vehiculo, '.
                                       'automocion_vehiculos.matricula, '.
                                       'automocion_vehiculos.codcliente, '.
                                       'clientes.nombre AS nombre_cliente, '.
                                       $this->table_name.'.kilometraje, '.
                                       $this->table_name.'.fecha, '.
                                       $this->table_name.'.profundidad_neumatico_di, '.
                                       $this->table_name.'.profundidad_neumatico_dd, '.
                                       $this->table_name.'.profundidad_neumatico_ti, '.
                                       $this->table_name.'.profundidad_neumatico_td, '.
                                       $this->table_name.'.profundidad_neumatico_re, '.
                                       $this->table_name.'.presion_neumatico_di, '.
                                       $this->table_name.'.presion_neumatico_dd, '.
                                       $this->table_name.'.presion_neumatico_ti, '.
                                       $this->table_name.'.presion_neumatico_td, '.
                                       $this->table_name.'.presion_neumatico_re, '.
                                       $this->table_name.'.pastillas_freno_di, '.
                                       $this->table_name.'.pastillas_freno_dd, '.
                                       $this->table_name.'.pastillas_freno_ti, '.
                                       $this->table_name.'.pastillas_freno_td, '.
                                       $this->table_name.'.discos_freno_di, '.
                                       $this->table_name.'.discos_freno_dd, '.
                                       $this->table_name.'.discos_freno_ti, '.
                                       $this->table_name.'.discos_freno_td, '.
                                       $this->table_name.'.amortiguadores_di, '.
                                       $this->table_name.'.amortiguadores_dd, '.
                                       $this->table_name.'.amortiguadores_ti, '.
                                       $this->table_name.'.amortiguadores_td, '.
                                       $this->table_name.'.fuelle_di, '.
                                       $this->table_name.'.fuelle_dd, '.
                                       $this->table_name.'.fuelle_ti, '.
                                       $this->table_name.'.fuelle_td, '.
                                       $this->table_name.'.luz_posicion_di, '.
                                       $this->table_name.'.luz_posicion_dd, '.
                                       $this->table_name.'.luz_posicion_ti, '.
                                       $this->table_name.'.luz_posicion_td, '.
                                       $this->table_name.'.luz_corta_di, '.
                                       $this->table_name.'.luz_corta_dd, '.
                                       $this->table_name.'.luz_larga_di, '.
                                       $this->table_name.'.luz_larga_dd, '.
                                       $this->table_name.'.luz_freno_ti, '.
                                       $this->table_name.'.luz_freno_td, '.
                                       $this->table_name.'.luz_marcha_atras_ti, '.
                                       $this->table_name.'.luz_marcha_atras_td, '.
                                       $this->table_name.'.luz_antiniebla_di, '.
                                       $this->table_name.'.luz_antiniebla_dd, '.
                                       $this->table_name.'.luz_antiniebla_ti, '.
                                       $this->table_name.'.luz_antiniebla_td, '.
                                       $this->table_name.'.nivel_aceite, '.
                                       $this->table_name.'.nivel_anticongelante, '.
                                       $this->table_name.'.nivel_limpiacristales, '.
                                       $this->table_name.'.nivel_direccion, '.
                                       $this->table_name.'.nivel_frenos, '.
                                       $this->table_name.'.paragolpes_delantero, '.
                                       $this->table_name.'.paragolpes_trasero, '.
                                       $this->table_name.'.capo, '.
                                       $this->table_name.'.maletero, '.
                                       $this->table_name.'.puerta_di, '.
                                       $this->table_name.'.puerta_dd, '.
                                       $this->table_name.'.puerta_ti, '.
                                       $this->table_name.'.puerta_td, '.
                                       $this->table_name.'.llanta_di, '.
                                       $this->table_name.'.llanta_dd, '.
                                       $this->table_name.'.llanta_ti, '.
                                       $this->table_name.'.llanta_td, '.
                                       $this->table_name.'.latiguillo_freno_di, '.
                                       $this->table_name.'.latiguillo_freno_dd, '.
                                       $this->table_name.'.latiguillo_freno_ti, '.
                                       $this->table_name.'.latiguillo_freno_td, '.
                                       $this->table_name.'.rodamiento_di, '.
                                       $this->table_name.'.rodamiento_dd, '.
                                       $this->table_name.'.rodamiento_ti, '.
                                       $this->table_name.'.rodamiento_td, '.
                                       $this->table_name.'.palier_di, '.
                                       $this->table_name.'.palier_dd, '.
                                       $this->table_name.'.palier_ti, '.
                                       $this->table_name.'.palier_td, '.
                                       $this->table_name.'.trapecio_di, '.
                                       $this->table_name.'.trapecio_dd, '.
                                       $this->table_name.'.trapecio_ti, '.
                                       $this->table_name.'.trapecio_td, '.
                                       $this->table_name.'.limpiaparabrisas_d, '.
                                       $this->table_name.'.limpiaparabrisas_t, '.
                                       $this->table_name.'.bateria, '.
                                       $this->table_name.'.fugas, '.
                                       $this->table_name.'.correa_aux, '.
                                       $this->table_name.'.manguitos, '.
                                       $this->table_name.'.silencioso_d, '.
                                       $this->table_name.'.silencioso_t, '.
                                       $this->table_name.'.tubos, '.
                                       $this->table_name.'.fijaciones, '.
                                       $this->table_name.'.palanca_cambios, '.
                                       $this->table_name.'.elevalunas, '.
                                       $this->table_name.'.cinturones, '.
                                       $this->table_name.'.embrague, '.
                                       $this->table_name.'.holgura_direccion, '.
                                       $this->table_name.'.aleta_di, '.
                                       $this->table_name.'.aleta_dd, '.
                                       $this->table_name.'.aleta_ti, '.
                                       $this->table_name.'.aleta_td, '.
                                       $this->table_name.'.observaciones '.
                                    'FROM '.$this->table_name.
                                       ' INNER JOIN automocion_vehiculos '.
                                          'ON '.$this->table_name.'.id_vehiculo=automocion_vehiculos.id '.
                                       ' INNER JOIN clientes '.
                                          'ON automocion_vehiculos.codcliente=clientes.codcliente '.
                                    'WHERE clientes.codcliente = ' . $this->var2str($codcliente) .' '.
                                    'ORDER BY '.$this->table_name.'.fecha DESC, '.$this->table_name.'.id DESC';

      $data = $this->db->select_limit($sql, FS_ITEM_LIMIT, $offset);
      if($data)
      {
         foreach($data as $p)
            $list[] = new inspeccion_vehiculo($p);
      }

      return $list;
   }

   /**
    * Devuelve un array con los campos id, codcliente, matricula, nombre_cliente, kilometraje y fecha 
    * donde $query coincide con id o matricula
    * sin limit
    * 
    * @param type $query
    * @param type $offset
    * @return \self
    */
   public function search($query, $offset = 0)
   {
      $result_list = array();
      $query = strtolower($this->no_html($query));

      $consulta = 'SELECT '.
                     $this->table_name.'.id AS id, '.
                     'automocion_vehiculos.codcliente AS codcliente, '.
                     'automocion_vehiculos.matricula AS matricula, '.
                     'clientes.nombre AS nombre_cliente, '.
                     $this->table_name.'.kilometraje AS kilometraje, '.
                     $this->table_name.'.fecha AS fecha'.
                  ' FROM '.$this->table_name.
                  ' INNER JOIN automocion_vehiculos '.
                     'ON '.$this->table_name.'.id_vehiculo = automocion_vehiculos.id'.
                  ' INNER JOIN clientes '.
                     'ON automocion_vehiculos.codcliente = clientes.codcliente'.
                  ' WHERE ';
      if (is_numeric($query)) {
         $consulta .= $this->table_name.".id LIKE '%".$query."%' OR automocion_vehiculos.matricula LIKE '%".$query."%'";
      } else {
         $buscar = str_replace(' ', '%', $query);
         $consulta .= "lower(automocion_vehiculos.matricula) LIKE '%".$buscar."%'";
      }
      $consulta .= ' ORDER BY automocion_vehiculos.matricula ASC';

      $inspecciones = $this->db->select($consulta);
      if ($inspecciones) {
         foreach ($inspecciones as $i) {
           $result_list[] = new self($i);
         }
      }

      return $result_list;
   }

   /**
    * Devuelve un array con los campos id, codcliente, matricula, nombre_cliente, kilometraje y fecha 
    * donde $query coincide con id o matricula
    * usando limit
    * 
    * @param type $query
    * @param type $offset
    * @return \self
    */
   public function search_limit($query, $offset = 0)
   {
      $result_list = array();
      $query = strtolower($this->no_html($query));

      $consulta = 'SELECT '.
                     $this->table_name.'.id AS id, '.
                     'automocion_vehiculos.codcliente AS codcliente, '.
                     'automocion_vehiculos.matricula AS matricula, '.
                     'clientes.nombre AS nombre_cliente, '.
                     $this->table_name.'.kilometraje AS kilometraje, '.
                     $this->table_name.'.fecha AS fecha'.
                  ' FROM '.$this->table_name.
                  ' INNER JOIN automocion_vehiculos '.
                     'ON '.$this->table_name.'.id_vehiculo = automocion_vehiculos.id'.
                  ' INNER JOIN clientes '.
                     'ON automocion_vehiculos.codcliente = clientes.codcliente'.
                  ' WHERE ';
      if (is_numeric($query)) {
         $consulta .= $this->table_name.".id LIKE '%".$query."%' OR automocion_vehiculos.matricula LIKE '%".$query."%'";
      } else {
         $buscar = str_replace(' ', '%', $query);
         $consulta .= "lower(automocion_vehiculos.matricula) LIKE '%".$buscar."%'";
      }
      $consulta .= ' ORDER BY automocion_vehiculos.matricula ASC';

      $inspecciones = $this->db->select_limit($consulta, FS_ITEM_LIMIT, $offset);
      if ($inspecciones) {
         foreach ($inspecciones as $i) {
           $result_list[] = new self($i);
         }
      }

      return $result_list;
   }

   /**
    * Devuelve si no hay id la URL a la pagina inspecciones de vehiculos,
    * y sino la página de inspeccion del vehiculo
    * 
    * @return string
    */
   public function url()
   {
      if( is_null($this->id) ) {
         return 'index.php?page=inspecciones_vehiculos';
      } else {
         return 'index.php?page=inspecciones_vehicuos&id='.$this->id;
      }
   }

}
