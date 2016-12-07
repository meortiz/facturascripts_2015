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

require_model('presupuesto_cliente.php');
require_model('pedido_cliente.php');
require_model('servicio_cliente.php');
require_model('albaran_cliente.php');
require_model('factura_cliente.php');


/**
 * El modelo vehiculo_documento relaciona los vehiculos con sus documentos en 
 * la tabla automocion_vehiculo_documentos.
 *
 * @author Francesc Pineda Segarra
 */

class vehiculo_documento extends fs_model
{
   public $id;
   public $idvehiculo;
   public $idpresupuesto;
   public $idpedido;
   public $idservicio;
   public $idalbaran;
   public $idfactura;
   public $kilometraje;

   public function __construct($p = FALSE)
   {
      parent::__construct('automocion_vehiculo_documento','plugins/automocion/');
      if($p) {
         $this->id = $this->intval($p['id']);
         $this->idvehiculo = $this->intval($p['idvehiculo']);
         $this->idpresupuesto = $this->intval($p['idpresupuesto']);
         $this->idpedido = $this->intval($p['idpedido']);
         $this->idservicio = $this->intval($p['idservicio']);
         $this->idalbaran = $this->intval($p['idalbaran']);
         $this->idfactura = $this->intval($p['idfactura']);
         $this->kilometraje = $this->intval($p['kilometraje']);
      } else {
         $this->id=NULL;
         $this->idvehiculo=NULL;
         $this->idpresupuesto=NULL;
         $this->idpedido=NULL;
         $this->idservicio=NULL;
         $this->idalbaran=NULL;
         $this->idfactura=NULL;
         $this->kilometraje=NULL;
      }
   }

   protected function install()
   {
      return '';
   }

   /**
    * No devuelve nada sino hay un id
    * y sino la página del vehiculo o de sus servicios
    * @return string
    */
   public function url()
   {
      if( !is_null($this->idvehiculo) ) {
         return "index.php?page=automocion_vehiculo&id=".$this->idvehiculo;
      } else if( !is_null($this->idpresupuesto) ) {
         return "index.php?page=ventas_presupuesto&id=".$this->idpresupuesto;
      } else if( !is_null($this->idpedido) ) {
         return "index.php?page=ventas_pedido&id=".$this->idpedido;
      } else if( !is_null($this->idservicio) ) {
         return "index.php?page=ventas_servicio&id=".$this->idservicio;
      } else if( !is_null($this->idalbaran) ) {
         return "index.php?page=ventas_albaran&id=".$this->idalbaran;
      } else if( !is_null($this->idfactura) ) {
         return "index.php?page=ventas_factura&id=".$this->idfactura;
      } else {
         return '#';
      }
   }

   /**
    * Elimina registros con todos los idDOCUMENTO=NULL 
    * porque ya no está relacionado con ningun documento
    */
   public function clean_empty_ids()
   {
      $sql = 'DELETE FROM '.$this->table_name.' WHERE idpresupuesto IS NULL AND idpedido IS NULL AND idservicio IS NULL AND idalbaran IS NULL AND idfactura IS NULL;';
      return $this->db->exec($sql);
   }
   
   /**
    * Devuelve todos los registros de automocion_vehiculo_documentos con id=$id
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
    * Devuelve el registro de automocion_vehiculo_documentos si existe,
    * sino devuelve false
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
    * Guarda sino existe o inserta los datos,
    * devuelve true si se ha podido guardar y sino false
    * 
    * @return boolean
    */
   public function save()
   {
      if ($this->exists()) {
         $sql = 'UPDATE '.$this->table_name.' SET'
              .' idvehiculo = '.$this->var2str($this->idvehiculo)
              .', idpresupuesto = '.$this->var2str($this->idpresupuesto)
              .', idpedido = '.$this->var2str($this->idpedido)
              .', idservicio = '.$this->var2str($this->idservicio)
              .', idalbaran = '.$this->var2str($this->idalbaran)
              .', idfactura = '.$this->var2str($this->idfactura)
              .', kilometraje = '.$this->var2str($this->kilometraje)
            .' WHERE id = '.$this->var2str($this->id).';';

         return $this->db->exec($sql);
      } else {
         $sql = 'INSERT INTO '.$this->table_name.
              ' (idvehiculo, idpresupuesto, idpedido, idservicio, idalbaran, idfactura, kilometraje) '
            .'VALUES ('
              .$this->var2str($this->idvehiculo)
              .', '.$this->var2str($this->idpresupuesto)
              .', '.$this->var2str($this->idpedido)
              .', '.$this->var2str($this->idservicio)
              .', '.$this->var2str($this->idalbaran)
              .', '.$this->var2str($this->idfactura)
              .', '.$this->var2str($this->kilometraje).');';

         if ($this->db->exec($sql)) {
            $this->id = $this->db->lastval();
            return true;
         } else {
            return false;
         }
      }
   }

   /**
    * Elimina de la tabla automocion_vehiculo_documentos el registro con id=$id
    * 
    * @return type
    */
   public function delete()
   {
      $sql = 'DELETE FROM '.$this->table_name.' WHERE id = '.$this->var2str($this->id).';';
      return $this->db->exec($sql);
   }

   /**
    * Elimina de la tabla automocion_vehiculo_documentos 
    * la asociacion del vehiculo con el presupuesto
    * 
    * @param type $id
    * @return type
    */
   public function delete_from_presupuesto($idvehiculo, $id)
   {
      $sql = 'UPDATE '.$this->table_name.' SET idpresupuesto=NULL'
              .' WHERE idpresupuesto = '.$this->var2str($id).' AND idvehiculo = '.$this->var2str($idvehiculo).';';
      return $this->db->exec($sql);
   }
   
   /**
    * Elimina de la tabla automocion_vehiculo_documentos 
    * la asociacion del vehiculo con el pedido
    * 
    * @param type $id
    * @return type
    */
   public function delete_from_pedido($idvehiculo, $id)
   {
      $sql = 'UPDATE '.$this->table_name.' SET idpedido=NULL'
              .' WHERE idpedido = '.$this->var2str($id).' AND idvehiculo = '.$this->var2str($idvehiculo).';';
      return $this->db->exec($sql);
   }
   
   /**
    * Elimina de la tabla automocion_vehiculo_documentos 
    * la asociacion del vehiculo con el servicio
    * 
    * @param type $id
    * @return type
    */
   public function delete_from_servicio($idvehiculo, $id)
   {
      $sql = 'UPDATE '.$this->table_name.' SET idservicio=NULL'
              .' WHERE idservicio = '.$this->var2str($id).' AND idvehiculo = '.$this->var2str($idvehiculo).';';
      return $this->db->exec($sql);
   }
   
   /**
    * Elimina de la tabla automocion_vehiculo_documentos 
    * la asociacion del vehiculo con el albaran
    * 
    * @param type $id
    * @return type
    */
   public function delete_from_albaran($idvehiculo, $id)
   {
      $sql = 'UPDATE '.$this->table_name.' SET idalbaran=NULL'
              .' WHERE idalbaran = '.$this->var2str($id).' AND idvehiculo = '.$this->var2str($idvehiculo).';';
      return $this->db->exec($sql);
   }
   
   /**
    * Elimina de la tabla automocion_vehiculo_documentos 
    * la asociacion del vehiculo con el factura
    * 
    * @param type $id
    * @return type
    */
   public function delete_from_factura($idvehiculo, $id)
   {
      $sql = 'UPDATE '.$this->table_name.' SET idfactura=NULL'
              .' WHERE idfactura = '.$this->var2str($id).' AND idvehiculo = '.$this->var2str($idvehiculo).';';
      return $this->db->exec($sql);
   }

   /**
    * Devuelve todos los registros de automocion_vehiculo_documentos con idpresupuesto=$id
    * 
    * @param type $id
    * @return \vehiculo_documento
    */
   public function get_from_presupuesto($id)
   {
      $list = array();
      /* Si se esta recargando la página, es posible que se haya realizado una aprobación */
      $data = $this->db->select('SELECT * FROM presupuestoscli WHERE idpresupuesto = '.$this->var2str($id).';');
      if( $data ) {
         $idpedido = intval($data[0]['idpedido']);
         if( $idpedido ) {
            $sql = 'UPDATE '.$this->table_name.' SET'
               .' idpedido = '.$this->var2str($idpedido)
               .' WHERE idpresupuesto = '.$this->var2str($id).' AND idpedido IS  NULL;';
               $this->db->exec($sql);
         }
      }
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idpresupuesto = ".$this->var2str($id)." ORDER BY id ASC;");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los registros de automocion_vehiculo_documentos con idpedido=$id
    * 
    * @param type $id
    * @return \vehiculo_documento
    */
   public function get_from_pedido($id)
   {
      $list = array();
      /* Si se esta recargando la página, es posible que se haya realizado una aprobación */
      $data = $this->db->select('SELECT * FROM pedidoscli WHERE idpedido = '.$this->var2str($id).';');
      if( $data ) {
         $idalbaran = intval($data[0]['idalbaran']);
         if( $idalbaran ) {
            $sql = 'UPDATE '.$this->table_name.' SET'
               .' idalbaran = '.$this->var2str($idalbaran)
               .' WHERE idpedido = '.$this->var2str($id).' AND idalbaran IS  NULL;';
               $this->db->exec($sql);
         }
      }
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idpedido = ".$this->var2str($id)." ORDER BY id ASC;");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los registros de automocion_vehiculo_documentos con idservicio=$id
    * 
    * @param type $id
    * @return \vehiculo_documento
    */
   public function get_from_servicio($id)
   {
      $list = array();
      /* Si se esta recargando la página, es posible que se haya realizado una aprobación */
      $data = $this->db->select('SELECT * FROM servicioscli WHERE idservicio = '.$this->var2str($id).';');
      if( $data ) {
         $idalbaran = intval($data[0]['idalbaran']);
         if( $idalbaran ) {
            $sql = 'UPDATE '.$this->table_name.' SET'
               .' idalbaran = '.$this->var2str($idalbaran)
               .' WHERE idservicio = '.$this->var2str($id).' AND idalbaran IS  NULL;';
               $this->db->exec($sql);
         }
      }
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idservicio = ".$this->var2str($id)." ORDER BY id ASC;");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los registros de automocion_vehiculo_documentos con idalbaran=$id
    * 
    * @param type $id
    * @param type $p
    * @return \vehiculo_documento
    */
   public function get_from_albaran($id, $p = FALSE)
   {
      $list = array();
      /* Si se esta recargando la página, es posible que se haya realizado una aprobación */
      $data = $this->db->select('SELECT * FROM albaranescli WHERE idalbaran = '.$this->var2str($id).';');
      if( $data ) {
         $idfactura = intval($data[0]['idfactura']);
         if( $idfactura ) {
            $sql = 'UPDATE '.$this->table_name.' SET'
               .' idfactura = '.$this->var2str($idfactura)
               .' WHERE idalbaran = '.$this->var2str($id).' AND idfactura IS  NULL;';
               $this->db->exec($sql);
         }
      }
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idalbaran = ".$this->var2str($id)." ORDER BY id ASC;");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los registros de automocion_vehiculo_documentos con idfactura=$id
    * 
    * @param type $id
    * @return \vehiculo_documento
    */
   public function get_from_factura($id)
   {
      $list = array();
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idfactura = ".$this->var2str($id)." ORDER BY id ASC;");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los registros de automocion_vehiculo_documentos con idvehiculo =$id
    * 
    * @param type $id
    * @return \vehiculo_documento
    */
   public function get_from_vehiculo($id)
   {
      $list = array();
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idvehiculo = ".$this->var2str($id).";");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los campos de automocion_vehiculo_documentos con idvehiculo =$id
    * 
    * @param type $id
    * @return \vehiculo_documento
    */
   public function get_presupuestos_from_vehiculo($id)
   {
      $list = array();
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idvehiculo = ".$this->var2str($id)." AND idpresupuesto IS NOT NULL;");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los campos de automocion_vehiculo_documentos con idvehiculo =$id
    * 
    * @param type $id
    * @return \vehiculo_documento
    */
   public function get_pedidos_from_vehiculo($id)
   {
      $list = array();
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idvehiculo = ".$this->var2str($id)." AND idpedido IS NOT NULL;");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los campos de automocion_vehiculo_documentos con idvehiculo =$id
    * 
    * @param type $id
    * @return \vehiculo_documento
    */
   public function get_servicios_from_vehiculo($id)
   {
      $list = array();
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idvehiculo = ".$this->var2str($id)." AND idservicio IS NOT NULL;");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los campos de automocion_vehiculo_documentos con idvehiculo =$id
    * 
    * @param type $id
    * @return \vehiculo_documento
    */
   public function get_albaranes_from_vehiculo($id)
   {
      $list = array();
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idvehiculo = ".$this->var2str($id)." AND idalbaran IS NOT NULL;");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los campos de automocion_vehiculo_documentos con idvehiculo =$id
    * 
    * @param type $id
    * @return \vehiculo_documento
    */
   public function get_facturas_from_vehiculo($id)
   {
      $list = array();
      $data = $this->db->select("SELECT * FROM ".$this->table_name." WHERE idvehiculo = ".$this->var2str($id)." AND idfactura IS NOT NULL;");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

   /**
    * Devuelve todos los registros de automocion_vehiculo_documentos
    * 
    * @return \vehiculo_documento
    */
   public function all()
   {
      $list = array();
      $data = $this->db->select("SELECT * FROM ".$this->table_name.";");
      if($data) {
         foreach($data as $d) {
            $list[] = new vehiculo_documento($d);
         }
      }
      return $list;
   }

}

?>
