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

class marca_vehiculo extends fs_model
{
   public $id;
   public $nombre;
   public $imagen;

   public function __construct($marca_vehiculo = false)
   {
      parent::__construct('automocion_marcas_vehiculos', 'plugins/automocion/');
      if ($marca_vehiculo) {
         $this->id = $marca_vehiculo[ 'id' ];
         $this->nombre = $marca_vehiculo[ 'nombre' ];
         $this->imagen = $marca_vehiculo[ 'imagen' ];
      } else {
         $this->id = null;
         $this->nombre = null;
         $this->imagen = null;
      }
   }

   /**
    * 
    * @return type
    */
   protected function install()
   {
      return 'INSERT INTO '.$this->table_name.' (nombre, imagen) VALUES'.
           "('Abarth',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVOV9PbUlaWWdXdzA')".', '.
           "('AC',               'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUHlJdkdBb3pZckE')".', '.
           "('Acura',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUUkxQ0tNVFdZNzQ')".', '.
           "('Aixam',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNE1qOEV3Vkt2eEU')".', '.
           "('Alfa Romeo',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVdWJUX1JkaWRmcXM')".', '.
           "('Alpina',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRnM3UXFyaGt5VW8')".', '.
           "('Alpine',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZ3BoY1ZEUks4LUU')".', '.
           "('Aprilia',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUW1zWWZUdUZQM0k')".', '.
           "('Arash',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVWEE5elI2SUpVQ1U')".', '.
           "('Aro',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZ0VEXzc0VHZLSjQ')".', '.
           "('Asia',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVVk5yNG5jZ3BYeUE')".', '.
           "('Aston Martin',     'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVX1pfWk1WUWYzblk')".', '.
           "('Astro',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRFg4Nk44bEc4X1U')".', '.
           "('Audi',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVODNSZU9hWUs4LXM')".', '.
           "('Austin',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNFZQdzk5RGFZeEU')".', '.
           "('Autobianchi',      'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVa1Zrem02TnVyR00')".', '.
           "('BaltijasDzips',    'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQzVUSl9QVFBDVHM')".', '.
           "('Beijing',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVYVRfVEtZNUQwNGc')".', '.
           "('Benelli',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVVklEUF9ra3hDaFE')".', '.
           "('Bentley',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVN0JyU1lzNV9qc2s')".', '.
           "('Bertone',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVN2JsUVhEUF9WREE')".', '.
           "('Beta',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTUZUYmRpejRPSlE')".', '.
           "('Bimota',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTWRNcGMxVTlKVVE')".', '.
           "('Bitter',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVVTdBSjA1bEFKYjQ')".', '.
           "('Blonell',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVN1VlY3FzTlotUHc')".', '.
           "('BMW',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRDZ3UURyenM3ck0')".', '.
           "('Brilliance',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRUZrclFRQ0FxS28')".', '.
           "('Bristol',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVb0RfQWt4SmVnRVk')".', '.
           "('BRP',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVaUNvSENTVEVSQzQ')".', '.
           "('Buell',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUGdoSTNIRU9lUU0')".', '.
           "('Bufori',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZWdnUmVMNHVNWGc')".', '.
           "('Bugatti',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRmlsLXFucEJuUFU')".', '.
           "('Buick',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVelRCX093OWtoQUk')".', '.
           "('BYD',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVdmJQSVJFWjhObTg')".', '.
           "('Cadillac',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTnZXa2lmclR1ZkE')".', '.
           "('Cagiva',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVVktOU014RV9rTFE')".', '.
           "('Callaway',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRjlkcEVDYy1TOGs')".', '.
           "('Carbodies',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVeVhWMzhnUDlydmc')".', '.
           "('Caterham',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZUZVYnpnMlh2YUk')".', '.
           "('ChangAn',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNkNXMjJjY1RTTHc')".', '.
           "('ChangFeng',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVanlXNkRVYzZyTGs')".', '.
           "('Chery',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMnNyMWFhTHlMb28')".', '.
           "('Chevrolet',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVOXlheXE5aVQ2VnM')".', '.
           "('Chrysler',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVb2hmekNvOVNLMWs')".', '.
           "('Citroen',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVSmQ3LUVWbmdMUWc')".', '.
           "('Cizeta',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVaVZoR1NxeGdsZzQ')".', '.
           "('Coggiola',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQ2lBd3lCS0RhY00')".', '.
           "('Crossley',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZjJUWm4tbWROUUE')".', '.
           "('Dacia',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVSHRHMUVIWVNRYVU')".', '.
           "('Dadi',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUDg0Z3JuOUJEZk0')".', '.
           "('Daelim',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUE02d05UMVVCS0U')".', '.
           "('Daewoo',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVcWZrMl9WcWJLVTQ')".', '.
           "('DAF',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVSEU2SVpUYnNFUkk')".', '.
           "('Daihatsu',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUExhbnBLclh6VEE')".', '.
           "('Daimler',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVU1l2NFp5czgyWVk')".', '.
           "('Dallas',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVdF92UUJxb3VMMnc')".', '.
           "('DeLorean',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVdVF6ekNNdUZzMVE')".', '.
           "('Derbi',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVcmlJT0NIb1F1VUE')".', '.
           "('Derways',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTXFUZG9OV2tSekk')".', '.
           "('DeTomaso',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTGVfZk5OQWg5c0k')".', '.
           "('Dodge',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVeVpoSUxIdW13SnM')".', '.
           "('DongFeng',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVdjI4LVhQU1k2OW8')".', '.
           "('Donkervoort',      'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVYUpQS0xVaVRYcEk')".', '.
           "('Ducati',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVeTFxVlV2S1VvazQ')".', '.
           "('Eagle',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMWUtalhQM3dKem8')".', '.
           "('FAW',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZmVDMTNHTG1Nd2c')".', '.
           "('Ferrari',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVV1dRZ0lHOGNONWM')".', '.
           "('Fiat',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVb2xPQ0x1OU1LUnc')".', '.
           "('Ford',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZXppOFJ3U01veUU')".', '.
           "('FSO',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQ1RmZ3RUVGRoMGM')".', '.
           "('Fuqi',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVald4MkxiX2kyMXc')".', '.
           "('Galloper',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVVEpObTBRMVo5Mjg')".', '.
           "('Gas Gas',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZWt4S0wyM01VVTA')".', '.
           "('GAZ',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQ2tOTGsyYU5QdWM')".', '.
           "('Geely',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVYkJxVjVpenVQT0U')".', '.
           "('Geo',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVbzB1VkcyckdoeWM')".', '.
           "('GG Technik',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVM0dabGJ5LW94RVE')".', '.
           "('Gilera',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVeDFTQUF0ZGgxR2M')".', '.
           "('GMC',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVU2ZmLTktRWZsbjQ')".', '.
           "('Gonow',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQ2xabzN1bFJVQVU')".', '.
           "('GreatWall',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNHEtVDYwRzdCU2c')".', '.
           "('Hafei',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVcGVhQnVIcWdxSlE')".', '.
           "('Harley-Davidson',  'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQ1BXeEQ0aVZwbDA')".', '.
           "('Hindustan',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVLTl6VzJzQzlfWk0')".', '.
           "('Holden',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVSlVwTXlLZlVfZUU')".', '.
           "('Honda',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVaUhiYjR6c2ZtTVk')".', '.
           "('HuangHai',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUUREdDJncVgxaXc')".', '.
           "('Hummer',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVbVd3SlJJZHV5WW8')".', '.
           "('Hurtan',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQXhZaG5kNGRLSGc')".', '.
           "('Husaberg',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVWWgzUGRQN3VFd3M')".', '.
           "('Husqvarna',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMjhKV1o1Zldtdlk')".', '.
           "('Hyosung',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZlVCZHFfRHlBN3M')".', '.
           "('Hyundai',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUzF3SXdhdU4zS2M')".', '.
           "('Infiniti',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVamtpSmpHTlJxd3M')".', '.
           "('Innocenti',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVWFRMVmwzZ2dYUHM')".', '.
           "('Invicta',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVOTMwTWRFQ2tqQUU')".', '.
           "('IranKhodro',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMUMzd0twQnR6VUk')".', '.
           "('Irmscher',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMTh1ZTE0WUpmTUU')".', '.
           "('Isdera',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVb0dRWFpWaDZ2SEk')".', '.
           "('Isuzu',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVM3RCM0pzLXBxcHc')".', '.
           "('Iveco',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVSXZXU0UzcjBYLW8')".', '.
           "('Izh',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVY0w1bFJva0VKVm8')".', '.
           "('JAC',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVbmtHNzhpb0RYMjA')".', '.
           "('Jaguar',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZWxwUmZaWVNfcDQ')".', '.
           "('Jeep',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQ21QTHEzZTBqSE0')".', '.
           "('Jensen',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUHl0OU1jbk5NZ00')".', '.
           "('Jiangling',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMVZ5bGpERzNhNWc')".', '.
           "('Kamaz',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTUIyTW9WTzlTRms')".', '.
           "('Kawasaki',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTzZVUWFDQ21tRG8')".', '.
           "('Kia',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVbERYN3dVTnV1SUk')".', '.
           "('Koeningsegg',      'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVelBaVXBwSGd1ZXc')".', '.
           "('KTM',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVU1Nra2JmMHo1dzA')".', '.
           "('Kymco',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVeTFjY3JHNEZHd0k')".', '.
           "('Lada',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUmRrekdfMEZnSGc')".', '.
           "('Lamborghini',      'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVYkgzaXZsWThsN2M')".', '.
           "('Lancia',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRVhHSE1ONTVEWEk')".', '.
           "('Land Rover',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNFk5OTRxMkdYZnM')".', '.
           "('Landwind',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVcUhoWXlLbHlOLWM')".', '.
           "('LDV',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZHIzcm1YVkZDeVU')".', '.
           "('Lexus',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVckh1bzJNdzd5VjQ')".', '.
           "('LiebaoMotor',      'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVT09ZM1dKOUpZZU0')".', '.
           "('Lifan',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVeHpJdTFobXhRblk')".', '.
           "('Lincoln',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVak9DWW5CN0J4alk')".', '.
           "('Lotus',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRVEya3NrSmZwWmM')".', '.
           "('LTI',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZ1M5UVVnZm9PckU')".', '.
           "('LUAZ',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVU2NUd0NseWNuMFk')".', '.
           "('Mahindra',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNkRPenFrUVJjMHM')".', '.
           "('Marcos',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMTlZczFseHVHRXc')".', '.
           "('Marlin',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVWm9SOS1zX2x1cE0')".', '.
           "('Maruti',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVWnBjcTlCTXRqQTg')".', '.
           "('Maserati',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVdTZhLVIzRjdWNW8')".', '.
           "('Maybach',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMXpkV3dNOUQ0WWc')".', '.
           "('Mazda',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVcHlaMzVNNEZacUk')".', '.
           "('MCC',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVWFBWUUFfNndRa2M')".', '.
           "('McLaren',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVemFVRFdDRkpsbmc')".', '.
           "('Mega',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRlcydDVvWjBWNVk')".', '.
           "('Mercedes Benz',    'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVWjJadFBLcVhadHc')".', '.
           "('Mercury',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNWxkcnktMXE3VlE')".', '.
           "('Metrocab',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsValg2UndpOElpRlE')".', '.
           "('MG',               'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVYnFJbW1IVDNvRkU')".', '.
           "('Microcar',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUEJiVTNXYUNvVnM')".', '.
           "('Minelli',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVc0VMZGVLaHh5MGs')".', '.
           "('Mini',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVd0xqbjhwemVpTnM')".', '.
           "('Mitsubishi',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVU2lETnFldDQ0dzQ')".', '.
           "('Mitsuoka',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVeVNTYVREVGtvbHc')".', '.
           "('Mondial',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVS3ZEeFBnU3MzTnc')".', '.
           "('MonteCarlo',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUll6YWZLMHpEajg')".', '.
           "('Morgan',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUDRXUkdhV3VfaGM')".', '.
           "('Morris',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUXZMaVFkRnl2MVE')".', '.
           "('Moskvich',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTUJOZm1jbHdsdU0')".', '.
           "('Moto Guzzi',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVOGlMX1FFeE1sdFE')".', '.
           "('Moto Morini',      'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQzBGeG92WTNPaHc')".', '.
           "('MV Agusta',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVb0JDam5PM2xiLUE')".', '.
           "('Nissan',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMFdia0NsMktxXzA')".', '.
           "('Noble',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNWdscmdUVjRtLVU')".', '.
           "('Oldsmobile',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQmIyNXJZbEFvOEU')".', '.
           "('Opel',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVSTJCOHlfQ3J5UUE')".', '.
           "('Osca',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVcXNUc01DR3M1RmM')".', '.
           "('Pagani',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVajJjc3R1MmZLR2M')".', '.
           "('Panoz',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRXJLMm9JWnJzS3c')".', '.
           "('Paykan',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVYzNUTFRwb0dxdEU')".', '.
           "('Perodua',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZ0s0eVJSZ3NwS1U')".', '.
           "('Peugeot',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVN1VqNzkwYVpYa2M')".', '.
           "('Piaggio',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVaWF1WkkzUXA1Z00')".', '.
           "('Plymouth',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVY3k0MlhYUDFoMTA')".', '.
           "('Pontiac',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVVmVhdk1jaGVrTVE')".', '.
           "('Porsche',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVR2V6dVhkdDhHMG8')".', '.
           "('Premier',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVOFROYzBjN0Rjdzg')".', '.
           "('Proton',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVaWlMYlkxRlN3Y2M')".', '.
           "('PUCH',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVWVdDYmlSSDUxaHM')".', '.
           "('Puma',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVcjFEOHlqeWlOTHc')".', '.
           "('Qvale',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQkREXzQ5LUNiVWs')".', '.
           "('Reliant',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVSTZGTHpiSjJpWnM')".', '.
           "('Renault',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVOHhGUkJoVFVhTzQ')".', '.
           "('RenaultSamsung',   'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTGxsYlNyVHlSa28')".', '.
           "('RollsRoyce',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVcVpOQk15S19HbXM')".', '.
           "('Ronart',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVcVdxeER5U1pOSWM')".', '.
           "('Rover',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVT1F4ZDN3c2kteHc')".', '.
           "('Royal Enfield',    'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVR1pvQ0M5SjczV0U')".', '.
           "('Saab',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVaXM1LXVBOXh4dWM')".', '.
           "('Saleen',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVakdCcEF1RS01TVU')".', '.
           "('Santana',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVT1hjV1JQZDNYb2s')".', '.
           "('Saturn',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVc3g5VDItY2FCSDg')".', '.
           "('Scion',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVOFQ4X1U4T2xTWVU')".', '.
           "('Seat',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTnlCa2RpNVBoQWs')".', '.
           "('SeAZ',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMUZWOVc4a1lmUnM')".', '.
           "('Sherco',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVOHEyOXdsSnJWZFk')".', '.
           "('ShuangHuan',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQzlLMHgyNjFhdTQ')".', '.
           "('Skoda',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVb0VBVE1NWUw0RU0')".', '.
           "('SMA',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVSWduVFJ1RXp6OUk')".', '.
           "('Smart',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVc2E5ZjRldlhTN3c')".', '.
           "('SMZ',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVODUtanZwc3E4NVE')".', '.
           "('Soueast',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMnhkZE84RUEzZFk')".', '.
           "('Spectre',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNDh5ZVExT3dwZG8')".', '.
           "('Spyker',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZVVDUGhIckFQYTA')".', '.
           "('SsangYong',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTzJQZnd5X1RobzQ')".', '.
           "('Subaru',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNXoxTm9nZFFXSzg')".', '.
           "('Suzuki',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVeWc2MlhOM3RSNW8')".', '.
           "('SYM',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVLV9IUXltYUtRck0')".', '.
           "('TagAz',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRjZMU2IwaV9wZVE')".', '.
           "('Talbot',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVVEUzbGZTVkhtcWM')".', '.
           "('Tata',             'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVWkdseFQ5SnNYNUU')".', '.
           "('Tatra',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVRWJTeU1VYVNHUFU')".', '.
           "('Tesla',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVOHZJVVFSQ1JHT1k')".', '.
           "('TGB',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVaUlHUEhmcWJqVGs')".', '.
           "('Tianma',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVVklaQ3dGR1l6cmc')".', '.
           "('Tianye',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVWkk3MlIxSno0Y0U')".', '.
           "('Tofas',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsValNHUTIzQ2NvZnM')".', '.
           "('Tonggong',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZHdTeHNFb2dMenM')".', '.
           "('Toyota',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNnRja2d2YlFSYTg')".', '.
           "('Trabant',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUmRHNUlBTTRBXzQ')".', '.
           "('Triumph',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVaXVyTmlCMjR0VEE')".', '.
           "('TVR',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVN0N4ZnZOeE9YWkk')".', '.
           "('UAZ',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNzVMY2lKeXF1Vk0')".', '.
           "('Vauxhall',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVSndhMGVSSHJpclk')".', '.
           "('VAZ',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVcWE4U2h2MDVwNFU')".', '.
           "('Vector',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVNGcyOThZZDg5cmM')".', '.
           "('Venturi',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVbXAweEFZWVMxZDg')".', '.
           "('Vespa',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVMnpQZHhRMFBoWlU')".', '.
           "('Volkswagen',       'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVdVRQWF9UVm51Uk0')".', '.
           "('Volvo',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVX0dhbWFfWkxmT0k')".', '.
           "('Voxan',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZkxfcnRNOGdrWEE')".', '.
           "('VWPorsche',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZGxEU3p6cFk0NUE')".', '.
           "('Wartburg',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVVGVFb0Jrc252Qzg')".', '.
           "('Westfield',        'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVTFdINl9SN2RDcDQ')".', '.
           "('Wiesmann',         'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVS1AtZ3JJV09vTlU')".', '.
           "('XinKai',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVZUFLWEQ2UWFzX3c')".', '.
           "('Yamaha',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVQmU3dXJYNmNKNHM')".', '.
           "('Yuejin',           'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUUgxRWFrdXNLajA')".', '.
           "('Zastava',          'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVLWVGaXpDdEQ1N3M')".', '.
           "('ZAZ',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVVzFKeThKMGdmU2c')".', '.
           "('ZIL',              'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVd01MMldJNFV1b3M')".', '.
           "('Zorzi',            'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVS1FzcGpOdFl0Nm8')".', '.
           "('ZX',               'https://drive.google.com/uc?export=view&id=0B7Fp5QCwhbsVUXl2VWFIY2o3ME0');";
   }

   /**
    * 
    * @param type $id
    * @return boolean|\self
    */
   public function get($id)
   {
      $element = $this->db->select('SELECT * FROM '.$this->table_name.
                                    ' WHERE id = '.$this->var2str($id).';');
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
         return $this->db->select('SELECT * FROM '.$this->table_name.
                                    ' WHERE id = '.$this->var2str($this->id).';');
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
                     .'nombre = '.$this->var2str($this->nombre)
                     .', imagen = '.$this->var2str($this->imagen)
                  .' WHERE id = '.$this->var2str($this->id).';';

         return $this->db->exec($sql);
      } else {
         $sql = 'INSERT INTO '.$this->table_name.' (nombre, imagen) '
               .'VALUES ('
                  .$this->var2str($this->nombre)
                  .', '.$this->var2str($this->imagen).');';

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
    * Devuelve todos los registros de automocion_marcas_vehiculos 
    * ordenados por nombre ASC por defecto
    * 
    * @param type $offset
    * @param type $order
    * @return \self
    */
   public function all($offset=0, $order='nombre ASC')
   {
      $list = array();
      $sql = 'SELECT * FROM '.$this->table_name.' ORDER BY '.$order;

      $elements = $this->db->select_limit($sql, FS_ITEM_LIMIT, $offset);
      if ($elements) {
         foreach ($elements as $e) {
            $list[] = new self($e);
         }
      }

      return $list;
   }

   /**
    * Devuelve todos los campos de automocion_marcas_vehiculos 
    * donde $query coincide con nombre o id 
    * sin limit
    * 
    * @param type $query
    * @param type $offset
    * @return \self
    */
   public function search($query, $offset = 0)
   {
      $result_list = array();
      $query2 = strtolower($this->no_html($query));

      $consulta = 'SELECT * FROM '.$this->table_name.' WHERE ';
      if (is_numeric($query2)) {
         $consulta .= "id LIKE '%".$query2."%'";
      } else {
         $buscar = str_replace(' ', '%', $query2);
         $consulta .= "lower(nombre) LIKE '%".$buscar."%'";
      }
      $consulta .= ' ORDER BY nombre ASC';

      $marcas_vehiculos = $this->db->select($consulta);
      if ($marcas_vehiculos) {
         foreach ($marcas_vehiculos as $v) {
            $result_list[] = new self($v);
         }
      }

      return $result_list;
   }

   /**
    * Devuelve todos los campos de automocion_marcas_vehiculos 
    * donde $query coincide con nombre o id 
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

      $consulta = 'SELECT * FROM '.$this->table_name.' WHERE ';
      if (is_numeric($query2)) {
         $consulta .= "id LIKE '%".$query2."%'";
      } else {
         $buscar = str_replace(' ', '%', $query2);
         $consulta .= "lower(nombre) LIKE '%".$buscar."%'";
      }
      $consulta .= ' ORDER BY nombre ASC';

      $marcas_vehiculos = $this->db->select_limit($consulta, FS_ITEM_LIMIT, $offset);
      if ($marcas_vehiculos) {
         foreach ($marcas_vehiculos as $v) {
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
         return 'index.php?page=automocion_marcas_vehiculos';
      } else {
         return 'index.php?page=automocion_marcas_vehiculos&id='.$this->id;
      }
   }

}
