<?php

/*
 * This file is part of FacturaScripts
 * Copyright (C) 2014-2016 Francesc Pineda Segarra shawe.ewahs@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/*
 * La clase vehículo sirve para guardar datos sobre vehiculos y que proveedor lo interviene.
 * NOTA: Todavía no se guarda el proveedor.
 */

class vehiculo_prov extends fs_model
{
   public $id;
   public $codproveedor;
   public $matricula;
   public $bastidor;
   public $marca;
   public $clase;
   public $tipo;
   public $altura_total;
   public $variante;
   public $anchura_total;
   public $denominacion_comercial;
   public $via_anterior;
   public $tara;
   public $longitud;
   public $mtma;
   public $voladizo_posterior;
   public $mtma1e;
   public $distancia_eje_1_2;
   public $mtma2e;
   public $distancia_eje_2_3;
   public $mtma3e;
   public $distancia_eje_3_4;
   public $mtma4e;
   public $distancia_5_rueda;
   public $mmr;
   public $marca_motor;
   public $neumaticos;
   public $tipo_motor;
   public $n_asientos;
   public $cilindrada;
   public $volumen_bodega;
   public $potencia;
   public $homologaciones;
   public $fecha_matriculacion;

   public $nombre_proveedor;
   public $nombre_marca;
   public $nombre_modelo;
   public $imagen_modelo;

   public function __construct($vehiculo = false)
   {
      parent::__construct('automocion_vehiculos_prov', 'plugins/automocion/');
      if ($vehiculo) {
         $this->id = $vehiculo[ 'id' ];
         $this->codproveedor = $vehiculo[ 'codproveedor' ];
         $this->matricula = $vehiculo[ 'matricula' ];
         $this->bastidor = $vehiculo[ 'bastidor' ];
         $this->marca = $vehiculo[ 'marca' ];
         $this->clase = $vehiculo[ 'clase' ];
         $this->tipo = $vehiculo[ 'tipo' ];
         $this->altura_total = $vehiculo[ 'altura_total' ];
         $this->variante = $vehiculo[ 'variante' ];
         $this->anchura_total = $vehiculo[ 'anchura_total' ];
         $this->denominacion_comercial = $vehiculo[ 'denominacion_comercial' ];
         $this->via_anterior = $vehiculo[ 'via_anterior' ];
         $this->tara = $vehiculo[ 'tara' ];
         $this->longitud = $vehiculo[ 'longitud' ];
         $this->mtma = $vehiculo[ 'mtma' ];
         $this->voladizo_posterior = $vehiculo[ 'voladizo_posterior' ];
         $this->mtma1e = $vehiculo[ 'mtma1e' ];
         $this->distancia_eje_1_2 = $vehiculo[ 'distancia_eje_1_2' ];
         $this->mtma2e = $vehiculo[ 'mtma2e' ];
         $this->distancia_eje_2_3 = $vehiculo[ 'distancia_eje_2_3' ];
         $this->mtma3e = $vehiculo[ 'mtma3e' ];
         $this->distancia_eje_3_4 = $vehiculo[ 'distancia_eje_3_4' ];
         $this->mtma4e = $vehiculo[ 'mtma4e' ];
         $this->distancia_5_rueda = $vehiculo[ 'distancia_5_rueda' ];
         $this->mmr = $vehiculo[ 'mmr' ];
         $this->marca_motor = $vehiculo[ 'marca_motor' ];
         $this->neumaticos = $vehiculo[ 'neumaticos' ];
         $this->tipo_motor = $vehiculo[ 'tipo_motor' ];
         $this->n_asientos = $vehiculo[ 'n_asientos' ];
         $this->cilindrada = $vehiculo[ 'cilindrada' ];
         $this->volumen_bodega = $vehiculo[ 'volumen_bodega' ];
         $this->potencia = $vehiculo[ 'potencia' ];
         $this->homologaciones = $vehiculo[ 'homologaciones' ];
         $this->fecha_matriculacion = Date('d-m-Y', strtotime($vehiculo[ 'fecha_matriculacion' ]));

         $this->nombre_proveedor = (isset($vehiculo[ 'nombre_proveedor' ]))?$vehiculo[ 'nombre_proveedor' ]:NULL;
         $this->nombre_marca = (isset($vehiculo[ 'nombre_marca' ]))?$vehiculo[ 'nombre_marca' ]:NULL;
         $this->nombre_modelo = (isset($vehiculo[ 'nombre_modelo' ]))?$vehiculo[ 'nombre_modelo' ]:NULL;
         $this->imagen_modelo = (isset($vehiculo[ 'imagen_modelo' ]))?$vehiculo[ 'imagen_modelo' ]:NULL;
      } else {
         $this->id = null;
         $this->codproveedor = null;
         $this->matricula = null;
         $this->bastidor = null;
         $this->marca = null;
         $this->clase = null;
         $this->tipo = null;
         $this->altura_total = null;
         $this->variante = null;
         $this->anchura_total = null;
         $this->denominacion_comercial = null;
         $this->via_anterior = null;
         $this->tara = null;
         $this->longitud = null;
         $this->mtma = null;
         $this->voladizo_posterior = null;
         $this->mtma1e = null;
         $this->distancia_eje_1_2 = null;
         $this->mtma2e = null;
         $this->distancia_eje_2_3 = null;
         $this->mtma3e = null;
         $this->distancia_eje_3_4 = null;
         $this->mtma4e = null;
         $this->distancia_5_rueda = null;
         $this->mmr = null;
         $this->marca_motor = null;
         $this->neumaticos = null;
         $this->tipo_motor = null;
         $this->n_asientos = null;
         $this->cilindrada = null;
         $this->volumen_bodega = null;
         $this->potencia = null;
         $this->homologaciones = null;
         $this->fecha_matriculacion = Date('d-m-Y');

         $this->nombre_proveedor = null;
         $this->nombre_marca = null;
         $this->nombre_modelo = null;
         $this->imagen_modelo = null;
      }
   }

   protected function install()
   {
   }

   /**
    * Devuelve todos los registros con id=$id
    * 
    * @param type $id
    * @return boolean|\self
    */
   public function get($id)
   {
      $element = $this->db->select('SELECT * FROM '.$this->table_name.' WHERE id = '.$this->var2str($id).';');
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
              .'codproveedor = '.$this->var2str($this->codproveedor)
              .', matricula = '.$this->var2str($this->matricula)
              .', bastidor = '.$this->var2str($this->bastidor)
              .', marca = '.$this->var2str($this->marca)
              .', clase = '.$this->var2str($this->clase)
              .', tipo = '.$this->var2str($this->tipo)
              .', altura_total = '.$this->var2str($this->altura_total)
              .', variante = '.$this->var2str($this->variante)
              .', anchura_total = '.$this->var2str($this->anchura_total)
              .', denominacion_comercial = '.$this->var2str($this->denominacion_comercial)
              .', via_anterior = '.$this->var2str($this->via_anterior)
              .', tara = '.$this->var2str($this->tara)
              .', longitud = '.$this->var2str($this->longitud)
              .', mtma = '.$this->var2str($this->mtma)
              .', voladizo_posterior = '.$this->var2str($this->voladizo_posterior)
              .', mtma1e = '.$this->var2str($this->mtma1e)
              .', distancia_eje_1_2 = '.$this->var2str($this->distancia_eje_1_2)
              .', mtma2e = '.$this->var2str($this->mtma2e)
              .', distancia_eje_2_3 = '.$this->var2str($this->distancia_eje_2_3)
              .', mtma3e = '.$this->var2str($this->mtma3e)
              .', distancia_eje_3_4 = '.$this->var2str($this->distancia_eje_3_4)
              .', mtma4e = '.$this->var2str($this->mtma4e)
              .', distancia_5_rueda = '.$this->var2str($this->distancia_5_rueda)
              .', mmr = '.$this->var2str($this->mmr)
              .', marca_motor = '.$this->var2str($this->marca_motor)
              .', neumaticos = '.$this->var2str($this->neumaticos)
              .', tipo_motor = '.$this->var2str($this->tipo_motor)
              .', n_asientos = '.$this->var2str($this->n_asientos)
              .', cilindrada = '.$this->var2str($this->cilindrada)
              .', volumen_bodega = '.$this->var2str($this->volumen_bodega)
              .', potencia = '.$this->var2str($this->potencia)
              .', homologaciones = '.$this->var2str($this->homologaciones)
              .', fecha_matriculacion = '.$this->var2str($this->fecha_matriculacion)
            .' WHERE id = '.$this->var2str($this->id).';';

         return $this->db->exec($sql);
      } else {
         $sql = 'INSERT INTO '.$this->table_name.
              ' (codproveedor,matricula,bastidor,marca,clase,tipo,altura_total,variante,anchura_total,denominacion_comercial,via_anterior,tara,longitud,mtma,voladizo_posterior,mtma1e,distancia_eje_1_2,mtma2e,distancia_eje_2_3,mtma3e,distancia_eje_3_4,mtma4e,distancia_5_rueda,mmr,marca_motor,neumaticos,tipo_motor,n_asientos,cilindrada,volumen_bodega,potencia,homologaciones,fecha_matriculacion) '
            .'VALUES ('
              .$this->var2str($this->codproveedor)
              .', '.$this->var2str($this->matricula)
              .', '.$this->var2str($this->bastidor)
              .', '.$this->var2str($this->marca)
              .', '.$this->var2str($this->clase)
              .', '.$this->var2str($this->tipo)
              .', '.$this->var2str($this->altura_total)
              .', '.$this->var2str($this->variante)
              .', '.$this->var2str($this->anchura_total)
              .', '.$this->var2str($this->denominacion_comercial)
              .', '.$this->var2str($this->via_anterior)
              .', '.$this->var2str($this->tara)
              .', '.$this->var2str($this->longitud)
              .', '.$this->var2str($this->mtma)
              .', '.$this->var2str($this->voladizo_posterior)
              .', '.$this->var2str($this->mtma1e)
              .', '.$this->var2str($this->distancia_eje_1_2)
              .', '.$this->var2str($this->mtma2e)
              .', '.$this->var2str($this->distancia_eje_2_3)
              .', '.$this->var2str($this->mtma3e)
              .', '.$this->var2str($this->distancia_eje_3_4)
              .', '.$this->var2str($this->mtma4e)
              .', '.$this->var2str($this->distancia_5_rueda)
              .', '.$this->var2str($this->mmr)
              .', '.$this->var2str($this->marca_motor)
              .', '.$this->var2str($this->neumaticos)
              .', '.$this->var2str($this->tipo_motor)
              .', '.$this->var2str($this->n_asientos)
              .', '.$this->var2str($this->cilindrada)
              .', '.$this->var2str($this->volumen_bodega)
              .', '.$this->var2str($this->potencia)
              .', '.$this->var2str($this->homologaciones)
              .', '.$this->var2str($this->fecha_matriculacion).');';

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
    * Devuelve un array de vehiculos con todos los campos de la tabla vehiculo y
    * el nombre de modelo y marca y la imagen del modelo y el nombre del proveedor
    * ordenados por matricula ASC por defecto
    * 
    * @param type $offset
    * @param type $order
    * @return \self
    */
   public function all($offset=0, $order='matricula ASC')
   {
      $list = array();
      $sql = 'SELECT '.
                              $this->table_name.'.id AS id, '.
                              $this->table_name.'.codproveedor AS codproveedor, '.
                              $this->table_name.'.matricula AS matricula, '.
                              $this->table_name.'.bastidor AS bastidor, '.
                              $this->table_name.'.marca AS marca, '.
                              $this->table_name.'.tipo AS tipo, '.
                              $this->table_name.'.variante AS variante, '.
                              $this->table_name.'.denominacion_comercial AS denominacion_comercial, '.
                              $this->table_name.'.tara AS tara, '.
                              $this->table_name.'.mtma AS mtma, '.
                              $this->table_name.'.mtma1e AS mtma1e, '.
                              $this->table_name.'.mtma2e AS mtma2e, '.
                              $this->table_name.'.mtma3e AS mtma3e, '.
                              $this->table_name.'.mtma4e AS mtma4e, '.
                              $this->table_name.'.mmr AS mmr, '.
                              $this->table_name.'.neumaticos AS neumaticos, '.
                              $this->table_name.'.n_asientos AS n_asientos, '.
                              $this->table_name.'.volumen_bodega AS volumen_bodega, '.
                              $this->table_name.'.clase AS clase, '.
                              $this->table_name.'.altura_total AS altura_total, '.
                              $this->table_name.'.anchura_total AS anchura_total, '.
                              $this->table_name.'.via_anterior AS via_anterior, '.
                              $this->table_name.'.longitud AS longitud, '.
                              $this->table_name.'.voladizo_posterior AS voladizo_posterior, '.
                              $this->table_name.'.distancia_eje_1_2 AS distancia_eje_1_2, '.
                              $this->table_name.'.distancia_eje_2_3 AS distancia_eje_2_3, '.
                              $this->table_name.'.distancia_eje_3_4 AS distancia_eje_3_4, '.
                              $this->table_name.'.distancia_5_rueda AS distancia_5_rueda, '.
                              $this->table_name.'.marca_motor AS marca_motor, '.
                              $this->table_name.'.tipo_motor AS tipo_motor, '.
                              $this->table_name.'.cilindrada AS cilindrada, '.
                              $this->table_name.'.potencia AS potencia, '.
                              $this->table_name.'.homologaciones AS homologaciones, '.
                              $this->table_name.'.fecha_matriculacion AS fecha_matriculacion, '.
                              'automocion_modelos_vehiculos.nombre AS nombre_modelo, '.
                              'automocion_modelos_vehiculos.imagen AS imagen_modelo, '.
                              'automocion_marcas_vehiculos.nombre AS nombre_marca, '.
                              'proveedores.nombre AS nombre_proveedor '.
                           ' FROM '.$this->table_name.
                              ' INNER JOIN automocion_modelos_vehiculos '.
                                ' ON '.$this->table_name.'.denominacion_comercial=automocion_modelos_vehiculos.id '.
                              ' INNER JOIN automocion_marcas_vehiculos '.
                                ' ON '.$this->table_name.'.marca=automocion_marcas_vehiculos.id '.
                              ' INNER JOIN proveedores '.
                                ' ON '.$this->table_name.'.codproveedor=proveedores.codproveedor '.
                           ' ORDER BY '.$this->table_name.'.'.$order;

      $elements = $this->db->select_limit($sql, FS_ITEM_LIMIT, $offset);
      if ($elements) {
         foreach ($elements as $e) {
            $list[] = new self($e);
         }
      }

      return $list;
   }

   /**
    * Devuelve un array de vehiculos con todos los campos de la tabla vehiculo y
    * el nombre de modelo y marca y la imagen del modelo y el nombre del proveedor
    * ordenados por matricula ASC por defecto
    * del proveedor con codproveedor=$codproveedor
    * 
    * @param type $codproveedor
    * @param type $offset
    * @return \vehiculo
    */
   public function all_from_proveedor($codproveedor, $offset = 0)
   {
      $list = array();

      $sql = 'SELECT '.
                              $this->table_name.'.id AS id, '.
                              $this->table_name.'.codproveedor AS codproveedor, '.
                              $this->table_name.'.matricula AS matricula, '.
                              $this->table_name.'.bastidor AS bastidor, '.
                              $this->table_name.'.marca AS marca, '.
                              $this->table_name.'.tipo AS tipo, '.
                              $this->table_name.'.variante AS variante, '.
                              $this->table_name.'.denominacion_comercial AS denominacion_comercial, '.
                              $this->table_name.'.tara AS tara, '.
                              $this->table_name.'.mtma AS mtma, '.
                              $this->table_name.'.mtma1e AS mtma1e, '.
                              $this->table_name.'.mtma2e AS mtma2e, '.
                              $this->table_name.'.mtma3e AS mtma3e, '.
                              $this->table_name.'.mtma4e AS mtma4e, '.
                              $this->table_name.'.mmr AS mmr, '.
                              $this->table_name.'.neumaticos AS neumaticos, '.
                              $this->table_name.'.n_asientos AS n_asientos, '.
                              $this->table_name.'.volumen_bodega AS volumen_bodega, '.
                              $this->table_name.'.clase AS clase, '.
                              $this->table_name.'.altura_total AS altura_total, '.
                              $this->table_name.'.anchura_total AS anchura_total, '.
                              $this->table_name.'.via_anterior AS via_anterior, '.
                              $this->table_name.'.longitud AS longitud, '.
                              $this->table_name.'.voladizo_posterior AS voladizo_posterior, '.
                              $this->table_name.'.distancia_eje_1_2 AS distancia_eje_1_2, '.
                              $this->table_name.'.distancia_eje_2_3 AS distancia_eje_2_3, '.
                              $this->table_name.'.distancia_eje_3_4 AS distancia_eje_3_4, '.
                              $this->table_name.'.distancia_5_rueda AS distancia_5_rueda, '.
                              $this->table_name.'.marca_motor AS marca_motor, '.
                              $this->table_name.'.tipo_motor AS tipo_motor, '.
                              $this->table_name.'.cilindrada AS cilindrada, '.
                              $this->table_name.'.potencia AS potencia, '.
                              $this->table_name.'.homologaciones AS homologaciones, '.
                              $this->table_name.'.fecha_matriculacion AS fecha_matriculacion, '.
                              'automocion_modelos_vehiculos.nombre AS nombre_modelo, '.
                              'automocion_modelos_vehiculos.imagen AS imagen_modelo, '.
                              'automocion_marcas_vehiculos.nombre AS nombre_marca, '.
                              'proveedores.nombre AS nombre_proveedor '.
                           ' FROM '.$this->table_name.
                              ' INNER JOIN automocion_modelos_vehiculos '.
                                ' ON '.$this->table_name.'.denominacion_comercial=automocion_modelos_vehiculos.id '.
                              ' INNER JOIN automocion_marcas_vehiculos '.
                                ' ON '.$this->table_name.'.marca=automocion_marcas_vehiculos.id '.
                              ' INNER JOIN proveedores '.
                                ' ON '.$this->table_name.'.codproveedor=proveedores.codproveedor '.
                           ' WHERE '.$this->table_name.'.codproveedor = ' . $this->var2str($codproveedor) .
                           ' ORDER BY '.$this->table_name.'.matricula ASC';

      $data = $this->db->select_limit($sql, FS_ITEM_LIMIT, $offset);
      if($data)
      {
         foreach($data as $p)
            $list[] = new self($p);
      }

      return $list;
   }

   /**
    * Devuelve un array de vehiculos con todos los campos de la tabla vehiculo y
    * el nombre de modelo y marca y la imagen del modelo y el nombre del proveedor
    * ordenados por matricula ASC
    * donde $query coincida con la matricula
    * sin usar limit
    * 
    * @param type $query
    * @param type $offset
    * @return \self
    */
   public function search($query, $offset = 0)
   {
      $result_list = array();
      $query2 = strtolower($this->no_html($query));

      $consulta = 'SELECT '.
                $this->table_name.'.id AS id, '.
                $this->table_name.'.codproveedor AS codproveedor, '.
                $this->table_name.'.matricula AS matricula, '.
                $this->table_name.'.bastidor AS bastidor, '.
                $this->table_name.'.marca AS marca, '.
                $this->table_name.'.tipo AS tipo, '.
                $this->table_name.'.variante AS variante, '.
                $this->table_name.'.denominacion_comercial AS denominacion_comercial, '.
                $this->table_name.'.tara AS tara, '.
                $this->table_name.'.mtma AS mtma, '.
                $this->table_name.'.mtma1e AS mtma1e, '.
                $this->table_name.'.mtma2e AS mtma2e, '.
                $this->table_name.'.mtma3e AS mtma3e, '.
                $this->table_name.'.mtma4e AS mtma4e, '.
                $this->table_name.'.mmr AS mmr, '.
                $this->table_name.'.neumaticos AS neumaticos, '.
                $this->table_name.'.n_asientos AS n_asientos, '.
                $this->table_name.'.volumen_bodega AS volumen_bodega, '.
                $this->table_name.'.clase AS clase, '.
                $this->table_name.'.altura_total AS altura_total, '.
                $this->table_name.'.anchura_total AS anchura_total, '.
                $this->table_name.'.via_anterior AS via_anterior, '.
                $this->table_name.'.longitud AS longitud, '.
                $this->table_name.'.voladizo_posterior AS voladizo_posterior, '.
                $this->table_name.'.distancia_eje_1_2 AS distancia_eje_1_2, '.
                $this->table_name.'.distancia_eje_2_3 AS distancia_eje_2_3, '.
                $this->table_name.'.distancia_eje_3_4 AS distancia_eje_3_4, '.
                $this->table_name.'.distancia_5_rueda AS distancia_5_rueda, '.
                $this->table_name.'.marca_motor AS marca_motor, '.
                $this->table_name.'.tipo_motor AS tipo_motor, '.
                $this->table_name.'.cilindrada AS cilindrada, '.
                $this->table_name.'.potencia AS potencia, '.
                $this->table_name.'.homologaciones AS homologaciones, '.
                $this->table_name.'.fecha_matriculacion AS fecha_matriculacion, '.
                'automocion_modelos_vehiculos.nombre AS nombre_modelo, '.
                'automocion_modelos_vehiculos.imagen AS imagen_modelo, '.
                'automocion_marcas_vehiculos.nombre AS nombre_marca, '.
                'proveedores.nombre AS nombre_proveedor '.
              ' FROM '.$this->table_name.
                ' INNER JOIN automocion_modelos_vehiculos '.
                  ' ON '.$this->table_name.'.denominacion_comercial=automocion_modelos_vehiculos.id '.
                ' INNER JOIN automocion_marcas_vehiculos '.
                  ' ON '.$this->table_name.'.marca=automocion_marcas_vehiculos.id '.
                ' INNER JOIN proveedores '.
                  ' ON '.$this->table_name.'.codproveedor=proveedores.codproveedor '.
              ' WHERE ';
      if (is_numeric($query2)) {
         $consulta .= $this->table_name.".matricula LIKE '%".$query2."%'";
      } else {
         $buscar = str_replace(' ', '%', $query2);
         $consulta .= 'lower('.$this->table_name.".matricula) LIKE '%".$buscar."%'";
      }
      $consulta .= ' ORDER BY '.$this->table_name.'.matricula ASC';

      $vehiculos = $this->db->select($consulta);
      if ($vehiculos) {
         foreach ($vehiculos as $v) {
            $result_list[] = new self($v);
         }
      }

      return $result_list;
   }

   /**
    * Devuelve un array de vehiculos con todos los campos de la tabla vehiculo y
    * el nombre de modelo y marca y la imagen del modelo y el nombre del proveedor
    * ordenados por matricula ASC
    * donde $query coincida con la matricula
    * usando limit
    * 
    * @param type $query
    * @param type $offset
    * @return \self
    */
   public function search_limit($query, $offset = 0)
   {
      $result_list = array();
      $query2 = strtolower($this->no_html($query));

      $consulta = 'SELECT '.
                $this->table_name.'.id AS id, '.
                $this->table_name.'.codproveedor AS codproveedor, '.
                $this->table_name.'.matricula AS matricula, '.
                $this->table_name.'.bastidor AS bastidor, '.
                $this->table_name.'.marca AS marca, '.
                $this->table_name.'.tipo AS tipo, '.
                $this->table_name.'.variante AS variante, '.
                $this->table_name.'.denominacion_comercial AS denominacion_comercial, '.
                $this->table_name.'.tara AS tara, '.
                $this->table_name.'.mtma AS mtma, '.
                $this->table_name.'.mtma1e AS mtma1e, '.
                $this->table_name.'.mtma2e AS mtma2e, '.
                $this->table_name.'.mtma3e AS mtma3e, '.
                $this->table_name.'.mtma4e AS mtma4e, '.
                $this->table_name.'.mmr AS mmr, '.
                $this->table_name.'.neumaticos AS neumaticos, '.
                $this->table_name.'.n_asientos AS n_asientos, '.
                $this->table_name.'.volumen_bodega AS volumen_bodega, '.
                $this->table_name.'.clase AS clase, '.
                $this->table_name.'.altura_total AS altura_total, '.
                $this->table_name.'.anchura_total AS anchura_total, '.
                $this->table_name.'.via_anterior AS via_anterior, '.
                $this->table_name.'.longitud AS longitud, '.
                $this->table_name.'.voladizo_posterior AS voladizo_posterior, '.
                $this->table_name.'.distancia_eje_1_2 AS distancia_eje_1_2, '.
                $this->table_name.'.distancia_eje_2_3 AS distancia_eje_2_3, '.
                $this->table_name.'.distancia_eje_3_4 AS distancia_eje_3_4, '.
                $this->table_name.'.distancia_5_rueda AS distancia_5_rueda, '.
                $this->table_name.'.marca_motor AS marca_motor, '.
                $this->table_name.'.tipo_motor AS tipo_motor, '.
                $this->table_name.'.cilindrada AS cilindrada, '.
                $this->table_name.'.potencia AS potencia, '.
                $this->table_name.'.homologaciones AS homologaciones, '.
                $this->table_name.'.fecha_matriculacion AS fecha_matriculacion, '.
                'automocion_modelos_vehiculos.nombre AS nombre_modelo, '.
                'automocion_modelos_vehiculos.imagen AS imagen_modelo, '.
                'automocion_marcas_vehiculos.nombre AS nombre_marca, '.
                'proveedores.nombre AS nombre_proveedor '.
              ' FROM '.$this->table_name.
                ' INNER JOIN automocion_modelos_vehiculos '.
                  ' ON '.$this->table_name.'.denominacion_comercial=automocion_modelos_vehiculos.id '.
                ' INNER JOIN automocion_marcas_vehiculos '.
                  ' ON '.$this->table_name.'.marca=automocion_marcas_vehiculos.id '.
                ' INNER JOIN proveedores '.
                  ' ON '.$this->table_name.'.codproveedor=proveedores.codproveedor '.
              ' WHERE ';
      if (is_numeric($query2)) {
         $consulta .= $this->table_name.".matricula LIKE '%".$query2."%'";
      } else {
         $buscar = str_replace(' ', '%', $query2);
         $consulta .= 'lower('.$this->table_name.".matricula) LIKE '%".$buscar."%'";
      }
      $consulta .= ' ORDER BY '.$this->table_name.'.matricula ASC';

      $vehiculos = $this->db->select_limit($consulta, FS_ITEM_LIMIT, $offset);
      if ($vehiculos) {
         foreach ($vehiculos as $v) {
            $result_list[] = new self($v);
         }
      }

      return $result_list;
   }

   /**
    * Devuelve si no hay id la URL a la pagina modelos de vehiculos,
    * y sino la página de modelo del vehiculo
    * 
    * @return string
    */
   public function url()
   {
      if( is_null($this->id) ) {
         return 'index.php?page=automocion_vehiculos_prov';
      } else {
         return 'index.php?page=automocion_vehiculo_prov&id='.$this->id;
      }
   }
}
