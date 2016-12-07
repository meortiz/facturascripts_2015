<?php

/*
 * This file is part of FacturaScripts
 * Copyright (C) 2014-2016  France, Europesc Pineda Segarra  shawe.ewahs@gmail.com
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

/**
 * El modelo wmi_vehiculo relaciona el bastidor de los vehiculos con información 
 * relevante acerca de sus 3 primeros digitos.
 *
 * @author France, Europesc Pineda Segarra
 */

class wmi_vehiculo extends fs_model
{
   public $id;
   public $id_marca;
   public $nombre;
   public $país;
   public $wmi;

   public function __construct($wmi_vehiculo = false)
   {
      parent::__construct('automocion_wmi_vehiculos', 'plugins/automocion/');
      if ($wmi_vehiculo) {
         $this->id = $wmi_vehiculo[ 'id' ];
         $this->id_marca = $wmi_vehiculo[ 'id_marca' ];
         $this->nombre = $wmi_vehiculo[ 'nombre' ];
         $this->wmi = $wmi_vehiculo[ 'wmi' ];
         $this->pais = $wmi_vehiculo[ 'pais' ];
      } else {
         $this->id = null;
         $this->id_marca = null;
         $this->nombre = null;
         $this->wmi = null;
         $this->pais = null;
      }
   }
   
   protected function install()
   {
	/// Fuente: https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)/World_Manufacturer_Identifier_(WMI)
      return 'INSERT INTO '.$this->table_name.' (id, id_marca, nombre, wmi, pais) VALUES '.
            "(1,     220,  'Volkswagen', 'AAV', 'South Africa, Africa')".', '.
            "(2,     93,   'Hyundai', 'AC5', 'South Africa, Africa')".', '.
            "(3,     93,   'Hyundai', 'ADD', 'South Africa, Africa')".', '.
            "(4,     69,   'Ford', 'AFA', 'South Africa, Africa')".', '.
            "(5,     210,  'Toyota', 'AHT', 'South Africa, Africa')".', '.
            "(6,     144,  'Mitsubishi', 'JA3', 'Japan, Asia')".', '.
            "(7,     144,  'Mitsubishi', 'JA4', 'Japan, Asia')".', '.
            "(8,     100,  'Isuzu', 'JA', 'Japan, Asia')".', '.
            "(9,     54,   'Daihatsu', 'JD', 'Japan, Asia')".', '.
            "(10,    197,  'Subaru (Fuji Heavy Industries)', 'JF', 'Japan, Asia')".', '.
            "(11,    86,   'Honda', 'JH', 'Japan, Asia')".', '.
            "(12,    109,  'Kawasaki (Motorcycles)', 'JK', 'Japan, Asia')".', '.
            "(13,    144,  'Mitsubishi Fuso', 'JL5', 'Japan, Asia')".', '.
            "(14,    144,  'Mitsubishi Motors', 'JMB', 'Japan, Asia')".', '.
            "(15,    144,  'Mitsubishi Motors', 'JMY', 'Japan, Asia')".', '.
            "(16,    133,  'Mazda', 'JMZ', 'Japan, Asia')".', '.
            "(17,    154,  'Nissan', 'JN', 'Japan, Asia')".', '.
            "(18,    198,  'Suzuki', 'JS', 'Japan, Asia')".', '.
            "(19,    210,  'Toyota', 'JT', 'Japan, Asia')".', '.
            "(20,    228,  'Yamaha (Motorcycles)', 'JY', 'Japan, Asia')".', '.
            "(21,    52,   'Daewoo General Motors', 'KL', 'South Korea, Asia')".', '.
            "(22,    93,   'Hyundai', 'KM', 'South Korea, Asia')".', '.
            "(23,    51,   'Daelim (Motorcycles)', 'KMY', 'South Korea, Asia')".', '.
            "(24,    92,   'Hyosung (Motorcycles', 'KM1', 'South Korea, Asia')".', '.
            "(25,    110,  'Kia', 'KN', 'South Korea, Asia')".', '.
            "(26,    175,  'Renault Samsung', 'KNM', 'South Korea, Asia')".', '.
            "(27,    196,  'SsangYong', 'KPA', 'South Korea, Asia')".', '.
            "(28,    196,  'SsangYong', 'KPT', 'South Korea, Asia')".', '.
            "(29,    NULL, 'Changzhou Yamasaki Motorcycle', 'LAN', 'China, Asia')".', '.
            "(30,    NULL, 'Zhejiang Qianjiang Motorcycle (Keeway/Generic)', 'LBB', 'China, Asia')".', '.
            "(31,    18,   'Beijing Hyundai', 'LBE', 'China, Asia')".', '.
            "(32,    164,  'Zongshen Piagio', 'LBM', 'China, Asia')".', '.
            "(33,    228,  'Chongqinq Jainshe Yamaha (Motorcycles)', 'LBP', 'China, Asia')".', '.
            "(34,    75,   'Geely Motorcycles', 'LB2', 'China, Asia')".', '.
            "(35,    NULL, 'Hangzhou Chunfeng Motorcycles (CFMOTO)', 'LCE', 'China, Asia')".', '.
            "(36,    62,   'Dong Feng Peugeot Citroen (DPCA)', 'LDC', 'China, Asia')".', '.
            "(37,    NULL, 'Dandong Huanghai Automobile', 'LDD', 'China, Asia')".', '.
            "(38,    193,  'SouEast Motor', 'LDN', 'China, Asia')".', '.
            "(39,    NULL, 'Zhongtong Coach', 'LDY', 'China, Asia')".', '.
            "(40,    100,  'Jiangling-Isuzu Motors', 'LET', 'China, Asia')".', '.
            "(41,    18,   'Beijing Benz', 'LE4', 'China, Asia')".', '.
            "(42,    66,   'FAW (Busses)', 'LFB', 'China, Asia')".', '.
            "(43,    NULL, 'Taizhou Chuanl Motorcycle Manufacturing', 'LFG', 'China, Asia')".', '.
            "(44,    66,   'FAW (Passenger Vehicles)', 'LFP', 'China, Asia')".', '.
            "(45,    66,   'FAW (Trailers)', 'LFT', 'China, Asia')".', '.
            "(46,    66,   'FAW-Volkswagen', 'LFV', 'China, Asia')".', '.
            "(47,    66,   'FAW JieFang', 'LFW', 'China, Asia')".', '.
            "(48,    NULL, 'Changshu Light Motorcycle Factory', 'LFY', 'China, Asia')".', '.
            "(49,    62,   'Dong Feng (DFM)', 'LGB', 'China, Asia')".', '.
            "(50,    62,   'Qoros (Dong Feng (DFM))', 'LGH', 'China, Asia')".', '.
            "(51,    34,   'BYD Auto', 'LGX', 'China, Asia')".', '.
            "(52,    18,   'Beijing Automotive Industry Holding', 'LHB', 'China, Asia')".', '.
            "(53,    66,   'FAW-Haima', 'LH1', 'China, Asia')".', '.
            "(54,    103,  'JAC', 'LJC', 'China, Asia')".', '.
            "(55,    103,  'JAC', 'LJ1', 'China, Asia')".', '.
            "(56,    NULL, 'Suzhou King Long', 'LKL', 'China, Asia')".', '.
            "(57,    41,   'Hunan Changfeng Manufacture Join-Stock', 'LL6', 'China, Asia')".', '.
            "(58,    NULL, 'Linhai (ATV)', 'LL8', 'China, Asia')".', '.
            "(59,    198,  'Suzuki (Motorcycles)', 'LMC', 'Hong Kong, China, Asia')".', '.
            "(60,    228,  'Yamaha (Motorcycles)', 'LPR', 'Hong Kong, China, Asia')".', '.
            "(61,    NULL, 'Shanghai General Motors', 'LSG', 'China, Asia')".', '.
            "(62,    140,  'MG Motor UK Limited - SAIC Motor', 'LSJ', 'Shanghai, China, Asia')".', '.
            "(63,    220,  'Shanghai Volkswagen', 'LSV', 'China, Asia')".', '.
            "(64,    27,   'Brilliance Zhonghua', 'LSY', 'China, Asia')".', '.
            "(65,    210,  'Toyota Tian Jin', 'LTV', 'China, Asia')".', '.
            "(66,    86,   'Guanqgi Honda', 'LUC', 'China, Asia')".', '.
            "(67,    40,   'Ford Chang An', 'LVS', 'China, Asia')".', '.
            "(68,    42,   'Chery', 'LVV', 'China, Asia')".', '.
            "(69,    62,   'Dong Feng Sokon Motor Company (DFSK)', 'LVZ', 'China, Asia')".', '.
            "(70,    NULL, 'MAN', 'LZM', 'China, Asia')".', '.
            "(71,    100,  'Isuzu Guangzhou', 'LZE', 'China, Asia')".', '.
            "(72,    NULL, 'Shaanxi Automobile Group', 'LZG', 'China, Asia')".', '.
            "(73,    NULL, 'Zhongshan Guochi Motorcycle (Baotian)', 'LZP', 'China, Asia')".', '.
            "(74,    NULL, 'Yutong Zhengzhou', 'LZY', 'China, Asia')".', '.
            "(75,    NULL, 'Chongqing Shuangzing Mech & Elec (Howo)', 'LZZ', 'China, Asia')".', '.
            "(76,    NULL, 'Xingyue Group (Motorcycles)', 'L4B', 'China, Asia')".', '.
            "(77,    NULL, 'KangDi (ATV)', 'L5C', 'China, Asia')".', '.
            "(78,    NULL, 'Zhejiang Yongkang Easy Vehicle', 'L5K', 'China, Asia')".', '.
            "(79,    NULL, 'Zhejiang Taotao (ATV & Motorcycles)', 'L5N', 'China, Asia')".', '.
            "(80,    NULL, 'Merato Motorcycle Taizhou Zhongneng', 'L5Y', 'China, Asia')".', '.
            "(81,    NULL, 'Zhejiang Yongkang Huabao Electric Appliance', 'L85', 'China, Asia')".', '.
            "(82,    NULL, 'Zhejiang Summit Huawin Motorcycle', 'L8X', 'China, Asia')".', '.
            "(83,    127,  'Mahindra & Mahindra', 'MAB', 'India, Asia')".', '.
            "(84,    127,  'Mahindra & Mahindra', 'MAC', 'India, Asia')".', '.
            "(85,    69,   'Ford', 'MAJ', 'India, Asia')".', '.
            "(86,    86,   'Honda Sield Cars', 'MAK', 'India, Asia')".', '.
            "(87,    93,   'Hyundai', 'MAL', 'India, Asia')".', '.
            "(88,    202,  'Tata Motors', 'MAT', 'India, Asia')".', '.
            "(89,    127,  'Mahindra & Mahindra', 'MA1', 'India, Asia')".', '.
            "(90,    198,  'Suzuki (Maruti)', 'MA3', 'India, Asia')".', '.
            "(91,    NULL, 'GM', 'MA6', 'India, Asia')".', '.
            "(92,    NULL, 'Mitsubishi (formerly Honda)', 'MA7', 'India, Asia')".', '.
            "(93,    198,  'Suzuki (Maruti)', 'MBH', 'India, Asia')".', '.
            "(94,    210,  'Toyota', 'MBJ', 'India, Asia')".', '.
            "(95,    137,  'Mercedes-Benz', 'MBR', 'India, Asia')".', '.
            "(96,    NULL, 'Ashok Leyland', 'MB1', 'India, Asia')".', '.
            "(97,    68,   'Fiat', 'MCA', 'India, Asia')".', '.
            "(98,    NULL, 'GM', 'MCB', 'India, Asia')".', '.
            "(99,    221,  'Volvo Eicher commercial vehicules limited', 'MC2', 'India, Asia')".', '.
            "(100,   154,  'Nissan', 'MDH', 'India, Asia')".', '.
            "(101,   NULL, 'Bajaj Auto', 'MD2', 'India, Asia')".', '.
            "(102,   174,  'Renault', 'MEE', 'India, Asia')".', '.
            "(103,   220,  'Volkswagen India, Asia', 'MEX', 'India, Asia')".', '.
            "(104,   210,  'Toyota', 'MHF', 'Indonesia, Asia')".', '.
            "(105,   86,   'Honda', 'MHR', 'Indonesia, Asia')".', '.
            "(106,   198,  'Suzuki', 'MLC', 'Thailand, Asia')".', '.
            "(107,   86,   'Honda', 'MLH', 'Thailand, Asia')".', '.
            "(108,   144,  'Mitsubishi', 'MMB', 'Thailand, Asia')".', '.
            "(109,   144,  'Mitsubishi', 'MMC', 'Thailand, Asia')".', '.
            "(110,   43,   'Chevrolet', 'MMM', 'Thailand, Asia')".', '.
            "(111,   144,  'Mitsubishi', 'MMT', 'Thailand, Asia')".', '.
            "(112,   133,  'Mazda', 'MM8', 'Thailand, Asia')".', '.
            "(113,   69,   'Ford', 'MNB', 'Thailand, Asia')".', '.
            "(114,   154,  'Nissan', 'MNT', 'Thailand, Asia')".', '.
            "(115,   100,  'Isuzu', 'MPA', 'Thailand, Asia')".', '.
            "(116,   100,  'Isuzu', 'MP1', 'Thailand, Asia')".', '.
            "(117,   86,   'Honda', 'MRH', 'Thailand, Asia')".', '.
            "(118,   210,  'Toyota', 'MR0', 'Thailand, Asia')".', '.
            "(119,   86,   'Honda', 'NLA', 'Türkey')".', '.
            "(120,   137,  'Mercedes-Benz Truck', 'NLE', 'Türkey')".', '.
            "(121,   93,   'Hyundai Assan', 'NLH', 'Türkey')".', '.
            "(122,   69,   'Ford', 'NM0', 'Türkey')".', '.
            "(123,   208,  'Tofas Türk', 'NM4', 'Türkey')".', '.
            "(124,   210,  'Toyota', 'NMT', 'Türkey')".', '.
            "(125,   69,   'Ford', 'PE1', 'Philippines, Asia')".', '.
            "(126,   133,  'Mazda', 'PE3', 'Philippines, Asia')".', '.
            "(127,   169,  'Proton', 'PL1', 'Malaysia, Asia')".', '.
            "(128,   163,  'NAZA (Peugeot)', 'PNA', 'Malaysia, Asia')".', '.
            "(129,   113,  'Kymco', 'RFB', 'Taiwan, Asia')".', '.
            "(130,   NULL, 'Sanyang SYM', 'RFG', 'Taiwan, Asia')".', '.
            "(131,   NULL, 'Adly', 'RFL', 'Taiwan, Asia')".', '.
            "(132,   NULL, 'CPI', 'RFT', 'Taiwan, Asia')".', '.
            "(133,   NULL, 'Aeon Motor', 'RF3', 'Taiwan, Asia')".', '.
            "(134,   117,  'Land Rover', 'SAL', 'United Kingdom, Europe')".', '.
            "(135,   104,  'Jaguar', 'SAJ', 'United Kingdom, Europe')".', '.
            "(136,   178,  'Rover', 'SAR', 'United Kingdom, Europe')".', '.
            "(137,   210,  'Toyota', 'SB1', 'United Kingdom, Europe')".', '.
            "(138,   135,  'McLaren', 'SBM', 'United Kingdom, Europe')".', '.
            "(139,   176,  'Rolls Royce', 'SCA', 'United Kingdom, Europe')".', '.
            "(140,   20,   'Bentley', 'SCB', 'United Kingdom, Europe')".', '.
            "(141,   124,  'Lotus Cars', 'SCC', 'United Kingdom, Europe')".', '.
            "(142,   57,   'DeLorean Motor Cars N', 'SCE', 'Ireland, United Kingdom, Europe')".', '.
            "(143,   12,   'Aston', 'SCF', 'United Kingdom, Europe')".', '.
            "(144,   201,  'Peugeot (formerly Talbot)', 'SDB', 'United Kingdom, Europe')".', '.
            "(145,   NULL, 'General Motors Luton Plant', 'SED', 'United Kingdom, Europe')".', '.
            "(146,   119,  'LDV', 'SEY', 'United Kingdom, Europe')".', '.
            "(147,   69,   'Ford', 'SFA', 'United Kingdom, Europe')".', '.
            "(148,   NULL, 'Alexander Dennis', 'SFD', 'United Kingdom, Europe')".', '.
            "(149,   86,   'Honda', 'SHH', 'United Kingdom, Europe')".', '.
            "(150,   86,   'Honda', 'SHS', 'United Kingdom, Europe')".', '.
            "(151,   154,  'Nissan', 'SJN', 'United Kingdom, Europe')".', '.
            "(152,   215,  'Vauxhall', 'SKF', 'United Kingdom, Europe')".', '.
            "(153,   NULL, 'JCB Research', 'SLP', 'United Kingdom, Europe')".', '.
            "(154,   212,  'Triumph Motorcycles', 'SMT', 'United Kingdom, Europe')".', '.
            "(155,   68,   'Fiat Auto', 'SUF', 'Poland, Europe')".', '.
            "(156,   NULL, 'FSC', 'SUL', 'Poland, Europe')".', '.
            "(157,   70,   'FSO-Daewoo', 'SUP', 'Poland, Europe')".', '.
            "(158,   NULL, 'Solaris Bus & Coach', 'SUU', 'Poland, Europe')".', '.
            "(159,   191,  'Micro Compact Car AG (smart 1998-1999)', 'TCC', 'Switzerland, Europe')".', '.
            "(160,   NULL, 'QUANTYA Swiss Electric Movement', 'TDM', 'Switzerland, Europe')".', '.
            "(161,   93,   'Hyundai Motor Manufacturing', 'TMA', 'Czech Republic, Europe')".', '.
            "(162,   189,  'Skoda', 'TMB', 'Czech Republic, Europe')".', '.
            "(163,   NULL, 'Karosa', 'TMK', 'Czech Republic, Europe')".', '.
            "(164,   189,  'Skoda trolleybuses', 'TMP', 'Czech Republic, Europe')".', '.
            "(165,   203,  'Tatra', 'TMT', 'Czech Republic, Europe')".', '.
            "(166,   189,  'Skoda trolleybuses', 'TM9', 'Czech Republic, Europe')".', '.
            "(167,   NULL, 'TAZ', 'TNE', 'Czech Republic, Europe')".', '.
            "(168,   NULL, 'Karosa', 'TN9', 'Czech Republic, Europe')".', '.
            "(169,   NULL, 'Ikarus Bus', 'TRA', 'Hungary, Europe')".', '.
            "(170,   14,   'Audi', 'TRU', 'Hungary, Europe')".', '.
            "(171,   NULL, 'Ikarus Egyedi Autobuszgyar', 'TSE', 'Hungary, Europe')".', '.
            "(172,   198,  'Suzuki', 'TSM', 'Hungary, Europe')".', '.
            "(173,   210,  'Toyota Caetano', 'TW1', 'Portugal, Europe')".', '.
            "(174,   144,  'Mitsubishi Trucks', 'TYA', 'Portugal, Europe')".', '.
            "(175,   144,  'Mitsubishi Trucks', 'TYB', 'Portugal, Europe')".', '.
            "(176,   174,  'Renault Dacia', 'UU1', 'Romania, Europe')".', '.
            "(177,   10,   'ARO', 'UU3', 'Europe')".', '.
            "(178,   52,   'Daewoo', 'UU6', 'Romania, Europe')".', '.
            "(179,   110,  'Kia Motors', 'U5Y', 'Slovakia, Europe')".', '.
            "(180,   110,  'Kia Motors', 'U6Y', 'Slovakia, Europe')".', '.
            "(181,   NULL, 'Magna Steyr Puch', 'VAG', 'Austria, Europe')".', '.
            "(182,   NULL, 'MAN', 'VAN', 'Austria, Europe')".', '.
            "(183,   112,  'KTM (Motorcycles)', 'VBK', 'Austria, Europe')".', '.
            "(184,   174,  'Renault', 'VF1', 'France, Europe')".', '.
            "(185,   174,  'Renault', 'VF2', 'France, Europe')".', '.
            "(186,   163,  'Peugeot', 'VF3', 'France, Europe')".', '.
            "(187,   201,  'Talbot', 'VF4', 'France, Europe')".', '.
            "(188,   174,  'Renault (Trucks & Buses)', 'VF6', 'France, Europe')".', '.
            "(189,   45,   'Citroën', 'VF7', 'France, Europe')".', '.
            "(190,   NULL, 'Matra', 'VF8', 'France, Europe')".', '.
            "(191,   NULL, 'MBK (Motorcycles)', 'VG5', 'France, Europe')".', '.
            "(192,   NULL, 'Scania', 'VLU', 'France, Europe')".', '.
            "(193,   NULL, 'SOVAB', 'VN1', 'France, Europe')".', '.
            "(194,   NULL, 'Irisbus', 'VNE', 'France, Europe')".', '.
            "(195,   210,  'Toyota', 'VNK', 'France, Europe')".', '.
            "(196,   174,  'Renault-Nissan', 'VNV', 'France, Europe')".', '.
            "(197,   137,  'Mercedes-Benz', 'VSA', 'Spain, Europe')".', '.
            "(198,   198,  'Suzuki (Santana Motors)', 'VSE', 'Spain, Europe')".', '.
            "(199,   154,  'Nissan', 'VSK', 'Spain, Europe')".', '.
            "(200,   185,  'SEAT', 'VSS', 'Spain, Europe')".', '.
            "(201,   157,  'Opel', 'VSX', 'Spain, Europe')".', '.
            "(202,   69,   'Ford', 'VS6', 'Spain, Europe')".', '.
            "(203,   45,   'Citroën', 'VS7', 'Spain, Europe')".', '.
            "(204,   NULL, 'Carrocerias Ayats', 'VS9', 'Spain, Europe')".', '.
            "(205,   58,   'Derbi (Motorcycles)', 'VTH', 'Hungary, Europe')".', '.
            "(206,   198,  'Suzuki (Motorcycles)', 'VTT', 'Hungary, Europe')".', '.
            "(207,   NULL, 'TAURO', 'VV9', 'Hungary, Europe')".', '.
            "(208,   154,  'Nissan', 'VWA', 'Spain, Europe')".', '.
            "(209,   220,  'Volkswagen', 'VWV', 'Spain, Europe')".', '.
            "(210,   230,  'Zastava/Yugo Serbia', 'VX1', 'Yugoslavia, Europe')".', '.
            "(211,   NULL, 'Neoplan', 'WAG', 'Germany, Europe')".', '.
            "(212,   14,   'Audi', 'WAU', 'Germany, Europe')".', '.
            "(213,   14,   'Audi SUV', 'WA1', 'Germany, Europe')".', '.
            "(214,   26,   'BMW', 'WBA', 'Germany, Europe')".', '.
            "(215,   26,   'BMW M', 'WBS', 'Germany, Europe')".', '.
            "(216,   55,   'Daimler', 'WDA', 'Germany, Europe')".', '.
            "(217,   137,  'Mercedes-Benz', 'WDB', 'Germany, Europe')".', '.
            "(218,   55,   'DaimlerChrysler', 'WDC', 'Germany, Europe')".', '.
            "(219,   137,  'Mercedes-Benz', 'WDD', 'Germany, Europe')".', '.
            "(220,   137,  'Mercedes-Benz (Commercial vehicles)', 'WDF', 'Germany, Europe')".', '.
            "(221,   137,  'Evobus GmbH (Mercedes-Bus)', 'WEB', 'Germany, Europe')".', '.
            "(222,   101,  'Iveco Magirus', 'WJM', 'Germany, Europe')".', '.
            "(223,   69,   'Ford', 'WF0', 'Germany, Europe')".', '.
            "(224,   NULL, 'MAN', 'WMA', 'Germany, Europe')".', '.
            "(225,   191,  'Smart', 'WME', 'Germany, Europe')".', '.
            "(226,   143,  'MINI', 'WMW', 'Germany, Europe')".', '.
            "(227,   137,  'Mercedes-AMG', 'WMX', 'Germany, Europe')".', '.
            "(228,   167,  'Porsche', 'WP0', 'Germany, Europe')".', '.
            "(229,   167,  'Porsche SUV', 'WP1', 'Germany, Europe')".', '.
            "(230,   157,  'Opel', 'W0L', 'Germany, Europe')".', '.
            "(231,   NULL, 'quattro GmbH', 'WUA', 'Germany, Europe')".', '.
            "(232,   220,  'Volkswagen MPV/SUV', 'WVG', 'Germany, Europe')".', '.
            "(233,   220,  'Volkswagen', 'WVW', 'Germany, Europe')".', '.
            "(234,   220,  'Volkswagen Commercial Vehicles', 'WV1', 'Germany, Europe')".', '.
            "(235,   220,  'Volkswagen Bus/Van', 'WV2', 'Germany, Europe')".', '.
            "(236,   220,  'Volkswagen Trucks', 'WV3', 'Germany, Europe')".', '.
            "(237,   221,  'Volvo (NedCar)', 'XLB', 'The Netherlands, Europe')".', '.
            "(238,   NULL, 'Scania The Netherlands, Europe', 'XLE', 'The Netherlands, Europe')".', '.
            "(239,   53,   'DAF (Trucks)', 'XLR', 'The Netherlands, Europe')".', '.
            "(240,   144,  'Mitsubishi (NetCar)', 'XMC', 'The Netherlands, Europe')".', '.
            "(241,   114,  'Lada/AutoVaz', 'XTA', 'Russia, Europe')".', '.
            "(242,   214,  'UAZ/Sollers', 'XTT', 'Russia, Europe')".', '.
            "(243,   NULL, 'General Motors', 'XUF', 'Russia, Europe')".', '.
            "(244,   NULL, 'AvtoTor (General Motors SKD)', 'XUU', 'Russia, Europe')".', '.
            "(245,   220,  'Volkswagen Group', 'XW8', 'Russia, Europe')".', '.
            "(246,   52,   'UZ-Daewoo', 'XWB', 'Uzbekistan, Russia, Europe')".', '.
            "(247,   NULL, 'AvtoTor (Hyundai-Kia SKD)', 'XWE', 'Russia, Europe')".', '.
            "(248,   NULL, 'AvtoTor (BMW SKD)', 'X4X', 'Russia, Europe')".', '.
            "(249,   174,  'Renault AvtoFramos', 'X7L', 'Russia, Europe')".', '.
            "(250,   200,  'Hyundai TagAZ', 'X7M', 'Russia, Europe')".', '.
            "(251,   220,  'Volkswagen', 'YBW', 'Belgium, Europe')".', '.
            "(252,   133,  'Mazda', 'YCM', 'Belgium, Europe')".', '.
            "(253,   NULL, 'Van Hool (Buses)', 'YE2', 'Belgium, Europe')".', '.
            "(254,   180,  'Saab-Valmet', 'YK1', 'Finland, Europe')".', '.
            "(255,   NULL, 'Scania AB', 'YS2', 'Sweden, Europe')".', '.
            "(256,   180,  'Saab', 'YS3', 'Sweden, Europe')".', '.
            "(257,   NULL, 'Scania Bus', 'YS4', 'Sweden, Europe')".', '.
            "(258,   180,  'Saab NEVS', 'YTN', 'Sweden, Europe')".', '.
            "(259,   90,   'Husaberg (Motorcycles)', 'YU7', 'Sweden, Europe')".', '.
            "(260,   221,  'Volvo Cars', 'YV1', 'Sweden, Europe')".', '.
            "(261,   221,  'Volvo Cars', 'YV4', 'Sweden, Europe')".', '.
            "(262,   221,  'Volvo Trucks', 'YV2', 'Sweden, Europe')".', '.
            "(263,   221,  'Volvo Buses', 'YV3', 'Sweden, Europe')".', '.
            "(264,   NULL, 'Zaporozhets/AvtoZAZ', 'Y6D', 'Ukraine, Europe')".', '.
            "(265,   16,   'Autobianchi', 'ZAA', 'Italy, Europe')".', '.
            "(266,   131,  'Maserati', 'ZAM', 'Italy, Europe')".', '.
            "(267,   164,  'Piaggio/Vesta/Gilera', 'ZAP', 'Italy, Europe')".', '.
            "(268,   5,    'Alfa Romeo', 'ZAR', 'Italy, Europe')".', '.
            "(269,   19,   'Benelli', 'ZBN', 'Italy, Europe')".', '.
            "(270,   NULL, 'Cagiva SpA/MV Agusta', 'ZVG', 'Europe')".', '.
            "(271,   101,  'Iveco', 'ZCF', 'Italy, Europe')".', '.
            "(272,   64,   'Ducati Motor Holdings SpA', 'ZDM', 'Italy, Europe')".', '.
            "(273,   67,   'Ferrari Dino', 'ZDF', 'Italy, Europe')".', '.
            "(274,   228,  'Yamaha', 'ZD0', 'Italy, Europe')".', '.
            "(275,   22,   'Beta Motor', 'ZD3', 'Italy, Europe')".', '.
            "(276,   8,    'Aprilia', 'ZD4', 'Italy, Europe')".', '.
            "(277,   68,   'Fiat', 'ZFA', 'Italy, Europe')".', '.
            "(278,   68,   'Fiat V.I.', 'ZFC', 'Italy, Europe')".', '.
            "(279,   67,   'Ferrari', 'ZFF', 'Italy, Europe')".', '.
            "(280,   151,  'Moto Guzzi', 'ZGU', 'Italy, Europe')".', '.
            "(281,   115,  'Lamborghini', 'ZHW', 'Italy, Europe')".', '.
            "(282,   NULL, 'Malaguti', 'ZJM', 'Italy, Europe')".', '.
            "(283,   95,   'Innocenti', 'ZJN', 'Italy, Europe')".', '.
            "(284,   91,   'Husqvarna Motorcycles', 'ZKH', 'Italy, Europe')".', '.
            "(285,   116,  'Lancia', 'ZLA', 'Italy, Europe')".', '.
            "(286,   NULL, 'OM', 'ZOM', 'Italy, Europe')".', '.
            "(287,   NULL, 'Marussia', 'Z8M', 'Russia, Europe')".', '.
            "(288,   61,    'Dodge', '1B3', 'United States, North America')".', '.
            "(289,   44,   'Chrysler', '1C3', 'United States, North America')".', '.
            "(290,   44,   'Chrysler', '1C6', 'United States, North America')".', '.
            "(291,   61,   'Dodge', '1D3', 'United States, North America')".', '.
            "(292,   69,   'Ford Motor Company', '1FA', 'United States, North America')".', '.
            "(293,   69,   'Ford Motor Company', '1FB', 'United States, North America')".', '.
            "(294,   69,   'Ford Motor Company', '1FC', 'United States, North America')".', '.
            "(295,   69,   'Ford Motor Company', '1FD', 'United States, North America')".', '.
            "(296,   69,   'Ford Motor Company', '1FM', 'United States, North America')".', '.
            "(297,   69,   'Ford Motor Company', '1FT', 'United States, North America')".', '.
            "(298,   NULL, 'Freightliner', '1FU', 'United States, North America')".', '.
            "(299,   NULL, 'Freightliner', '1FV', 'United States, North America')".', '.
            "(300,   NULL, 'FWD Corp.', '1F9', 'United States, North America')".', '.
            "(301,   NULL, 'General Motors', '1G', 'United States, North America')".', '.
            "(302,   43,   'Chevrolet Truck', '1GC', 'United States, North America')".', '.
            "(303,   79,   'GMC Truck', '1GT', 'United States, North America')".', '.
            "(304,   43,   'Chevrolet', '1G1', 'United States, North America')".', '.
            "(305,   166,  'Pontiac', '1G2', 'United States, North America')".', '.
            "(306,   156,  'Oldsmobile', '1G3', 'United States, North America')".', '.
            "(307,   33,   'Buick', '1G4', 'United States, North America')".', '.
            "(308,   35,   'Cadillac', '1G6', 'United States, North America')".', '.
            "(309,   183,  'Saturn', '1G8', 'United States, North America')".', '.
            "(310,   166,  'Pontiac', '1GM', 'United States, North America')".', '.
            "(311,   35,   'Cadillac', '1GY', 'United States, North America')".', '.
            "(312,   86,   'Honda', '1H', 'United States, North America')".', '.
            "(313,   83,   'Harley-Davidson', '1HD', 'United States, North America')".', '.
            "(314,   105,  'Jeep', '1J4', 'United States, North America')".', '.
            "(315,   123,  'Lincoln', '1L', 'United States, North America')".', '.
            "(316,   138,  'Mercury', '1ME', 'United States, North America')".', '.
            "(317,   NULL, 'Mack Truck', '1M1', 'United States, North America')".', '.
            "(318,   NULL, 'Mack Truck', '1M2', 'United States, North America')".', '.
            "(319,   NULL, 'Mack Truck', '1M3', 'United States, North America')".', '.
            "(320,   NULL, 'Mack Truck', '1M4', 'United States, North America')".', '.
            "(321,   NULL, 'Mynatt Truck & Equipment', '1M9', 'United States, North America')".', '.
            "(322,   154,  'Nissan', '1N', 'United States, North America')".', '.
            "(323,   NULL, 'NUMMI', '1NX', 'United States, North America')".', '.
            "(324,   165,  'Plymouth', '1P3', 'United States, North America')".', '.
            "(325,   NULL, 'Roadrunner Hay Squeeze', '1R9', 'United States, North America')".', '.
            "(326,   220,  'Volkswagen', '1VW', 'United States, North America')".', '.
            "(327,   NULL, 'Kenworth', '1XK', 'United States, North America')".', '.
            "(328,   NULL, 'Peterbit', '1XP', 'United States, North America')".', '.
            "(329,   133,  'Mazda (AutoAlliance International)', '1YV', 'United States, North America')".', '.
            "(330,   69,   'Ford (AutoAlliance International)', '1ZV', 'United States, North America')".', '.
            "(331,   44,   'Chrysler', '2A4', 'Canada, North America')".', '.
            "(332,   61,   'Dodge', '2B3', 'Canada, North America')".', '.
            "(333,   61,   'Dodge', '2B7', 'Canada, North America')".', '.
            "(334,   44,   'Chrysler', '2C3', 'Canada, North America')".', '.
            "(335,   NULL, 'CAMI', '2CN', 'Canada, North America')".', '.
            "(336,   61,   'Dodge', '2D3', 'Canada, North America')".', '.
            "(337,   69,   'Ford Motor Company', '2FA', 'Canada, North America')".', '.
            "(338,   69,   'Ford Motor Company', '2FB', 'Canada, North America')".', '.
            "(339,   69,   'Ford Motor Company', '2FC', 'Canada, North America')".', '.
            "(340,   69,   'Ford Motor Company', '2FM', 'Canada, North America')".', '.
            "(341,   69,   'Ford Motor Company', '2FT', 'Canada, North America')".', '.
            "(342,   NULL, 'Freightliner', '2FU', 'Canada, North America')".', '.
            "(343,   NULL, 'Freightliner', '2FV', 'Canada, North America')".', '.
            "(344,   NULL, 'Sterling', '2FZ', 'Canada, North America')".', '.
            "(345,   NULL, 'General Motors', '2G', 'Canada, North America')".', '.
            "(346,   43,   'Chevrolet', '2G1', 'Canada, North America')".', '.
            "(347,   166,  'Pontiac', '2G2', 'Canada, North America')".', '.
            "(348,   156,  'Oldsmobile', '2G3', 'Canada, North America')".', '.
            "(349,   33,   'Buick', '2G4', 'Canada, North America')".', '.
            "(350,   86,   'Honda', '2HG', 'Canada, North America')".', '.
            "(351,   86,   'Honda', '2HK', 'Canada, North America')".', '.
            "(352,   86,   'Honda', '2HJ', 'Canada, North America')".', '.
            "(353,   93,   'Hyundai', '2HM', 'Canada, North America')".', '.
            "(354,   138,  'Mercury', '2M', 'Canada, North America')".', '.
            "(355,   NULL, 'Nova Bus', '2NV', 'Canada, North America')".', '.
            "(356,   165,  'Plymouth', '2P3', 'Canada, North America')".', '.
            "(357,   210,  'Toyota', '2T', 'Canada, North America')".', '.
            "(358,   220,  'Volkswagen', '2V4', 'Canada, North America')".', '.
            "(359,   220,  'Volkswagen', '2V8', 'Canada, North America')".', '.
            "(360,   NULL, 'Western Star', '2WK', 'Canada, North America')".', '.
            "(361,   NULL, 'Western Star', '2WL', 'Canada, North America')".', '.
            "(362,   NULL, 'Western Star', '2WM', 'Canada, North America')".', '.
            "(363,   44,   'Chrysler', '3C4', 'Mexico, North America')".', '.
            "(364,   61,   'Dodge', '3D3', 'Mexico, North America')".', '.
            "(365,   69,   'Ford Motor Company', '3FA', 'Mexico, North America')".', '.
            "(366,   69,   'Ford Motor Company', '3FE', 'Mexico, North America')".', '.
            "(367,   NULL, 'General Motors', '3G', 'Mexico, North America')".', '.
            "(368,   86,   'Honda', '3H', 'Mexico, North America')".', '.
            "(369,   29,   'BRP (all-terrain vehicles)', '3JB', 'Mexico, North America')".', '.
            "(370,   133,  'Mazda', '3MZ', 'Mexico, North America')".', '.
            "(371,   154,  'Nissan', '3N', 'Mexico, North America')".', '.
            "(372,   165,  'Plymouth', '3P3', 'Mexico, North America')".', '.
            "(373,   220,  'Volkswagen', '3VW', 'Mexico, North America')".', '.
            "(374,   133,  'Mazda', '4F', 'United States, North America')".', '.
            "(375,   137,  'Mercedes-Benz', '4JG', 'United States, North America')".', '.
            "(376,   138,  'Mercury', '4M', 'United States, North America')".', '.
            "(377,   NULL, 'Nova Bus', '4RK', 'United States, North America')".', '.
            "(378,   NULL, 'Subaru-Isuzu Automotive', '4S', 'United States, North America')".', '.
            "(379,   210,  'Toyota', '4T', 'United States, North America')".', '.
            "(380,   NULL, 'Lumen Motors', '4T9', 'United States, North America')".', '.
            "(381,   NULL, 'Arctic Cat Inc.', '4UF', 'United States, North America')".', '.
            "(382,   26,   'BMW', '4US', 'United States, North America')".', '.
            "(383,   NULL, 'Frt-Thomas Bus', '4UZ', 'United States, North America')".', '.
            "(384,   221,  'Volvo', '4V1', 'United States, North America')".', '.
            "(385,   221,  'Volvo', '4V2', 'United States, North America')".', '.
            "(386,   221,  'Volvo', '4V3', 'United States, North America')".', '.
            "(387,   221,  'Volvo', '4V4', 'United States, North America')".', '.
            "(388,   221,  'Volvo', '4V5', 'United States, North America')".', '.
            "(389,   221,  'Volvo', '4V6', 'United States, North America')".', '.
            "(390,   221,  'Volvo', '4VL', 'United States, North America')".', '.
            "(391,   221,  'Volvo', '4VM', 'United States, North America')".', '.
            "(392,   221,  'Volvo', '4VZ', 'United States, North America')".', '.
            "(393,   NULL, 'Zero Motorcycles', '538', 'United States, North America')".', '.
            "(394,   86,   'Honda', '5F', 'Alabama, United States, North America')".', '.
            "(395,   NULL, 'Lincoln', '5L', 'United States, North America')".', '.
            "(396,   154,  'Nissan', '5N1', 'United States, North America')".', '.
            "(397,   93,   'Hyundai', '5NP', 'United States, North America')".', '.
            "(398,   210,  'Toyota Trucks', '5T', 'United States, North America')".', '.
            "(399,   204,  'Tesla Motors', '5YJ', 'United States, North America')".', '.
            "(400,   NULL, 'MAN', '6AB', 'Australia, Oceania')".', '.
            "(401,   154,  'Nissan Motor Company', '6F4', 'Australia, Oceania')".', '.
            "(402,   NULL, 'Kenworth', '6F5', 'Australia, Oceania')".', '.
            "(403,   69,   'Ford Motor Company', '6FP', 'Australia, Oceania')".', '.
            "(404,   NULL, 'General Motors-Holden (Post Nov. 2002)', '6G1', 'Australia, Oceania')".', '.
            "(405,   166,  'Pontiac (GTO & G8)', '6G2', 'Australia, Oceania')".', '.
            "(406,   NULL, 'General Motors-Holden (Pre Nov. 2002)', '6H8', 'Australia, Oceania')".', '.
            "(407,   144,  'Mitsubishi Motors', '6MN', 'Australia, Oceania')".', '.
            "(408,   210,  'Toyota Motor Corporation', '6T1', 'Australia, Oceania')".', '.
            "(409,   NULL, 'Privately Imported car in Australia, Oceania', '6U9', 'Australia, Oceania')".', '.
            "(410,   163,  'Peugeot', '8AD', 'Argentina, South America')".', '.
            "(411,   69,   'Ford Motor Company', '8AF', 'Argentina, South America')".', '.
            "(412,   43,   'Chevrolet', '8AG', 'Argentina, South America')".', '.
            "(413,   210,  'Toyota', '8AJ', 'Argentina, South America')".', '.
            "(414,   198,  'Suzuki', '8AK', 'Argentina, South America')".', '.
            "(415,   68,   'Fiat', '8AP', 'Argentina, South America')".', '.
            "(416,   220,  'Volkswagen', '8AW', 'Argentina, South America')".', '.
            "(417,   174,  'Renault', '8A1', 'Argentina, South America')".', '.
            "(418,   163,  'Peugeot', '8GD', 'Chile, South America')".', '.
            "(419,   43,   'Chevrolet', '8GG', 'Chile, South America')".', '.
            "(420,   45,   'Citroën', '935', 'Brazil, South America')".', '.
            "(421,   163,  'Peugeot', '936', 'Brazil, South America')".', '.
            "(422,   86,   'Honda', '93H', 'Brazil, South America')".', '.
            "(423,   210,  'Toyota', '93R', 'Brazil, South America')".', '.
            "(424,   14,   'Audi', '93U', 'Brazil, South America')".', '.
            "(425,   14,   'Audi', '93V', 'Brazil, South America')".', '.
            "(426,   144,  'Mitsubishi Motors', '93X', 'Brazil, South America')".', '.
            "(427,   174,  'Renault', '93Y', 'Brazil, South America')".', '.
            "(428,   154,  'Nissan', '94D', 'Brazil, South America')".', '.
            "(429,   68,   'Fiat', '9BD', 'Brazil, South America')".', '.
            "(430,   69,   'Ford Motor Company', '9BF', 'Brazil, South America')".', '.
            "(432,   137,  'Mercedes-Benz', '9BM', 'Brazil, South America')".', '.
            "(433,   210,  'Toyota', '9BR', 'Brazil, South America')".', '.
            "(434,   NULL, 'Scania', '9BS', 'Brazil, South America')".', '.
            "(435,   220,  'Volkswagen', '9BW', 'Brazil, South America')".', '.
            "(436,   174,  'Renault', '9FB', 'Colombia, South America');";
   }

   /**
    * 
    * @param type $wmi
    * @return boolean|\self
    */
   public function get($wmi)
   {
      $element = $this->db->select('SELECT * FROM '.$this->table_name.
           ' WHERE wmi = '.$this->var2str($wmi).';');
      if ($element) {
         return new self($element[ 0 ]);
      } else {
         return false;
      }
   }

   /**
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
    * 
    * @return boolean
    */
   public function save()
   {
      if ($this->exists()) {
         $sql = 'UPDATE '.$this->table_name.' SET '
                .'id_marca = '.$this->var2str($_POST[ 'id_marca' ])
                .', nombre = '.$this->var2str($_POST[ 'nombre' ])
                .', wmi = '.$this->var2str($_POST[ 'wmi' ])
                .', pais = '.$this->var2str($_POST[ 'pais' ])
              .' WHERE id = '.$this->var2str($_POST[ 'id' ]).';';

         return $this->db->exec($sql);
      } else {
         $sql = 'INSERT INTO '.$this->table_name.' (id, id_marca, nombre, wmi, pais) '
              .'VALUES ('
                .$this->var2str($_POST[ 'id_marca' ])
                .', '.$this->var2str($_POST[ 'nombre' ])
                .', '.$this->var2str($_POST[ 'wmi' ])
                .', '.$this->var2str($_POST[ 'pais' ]).');';

         if ($this->db->exec($sql)) {
            $this->id = $this->db->lastval();

            return true;
         } else {
            return false;
         }
      }
   }

   /**
    * 
    * @return type
    */
   public function delete()
   {
      $sql = 'DELETE FROM '.$this->table_name.' WHERE id = '.$this->var2str($this->id).';';

      return $this->db->exec($sql);
   }

   /**
    * 
    * @return \self
    */
   public function all()
   {
      $list = array();

      $elements = $this->db->select('SELECT * FROM '.$this->table_name.' ORDER BY wmi ASC;');
      if ($elements) {
         foreach ($elements as $e) {
            $list[] = new self($e);
         }
      }

      return $list;
   }

   /**
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
      $consulta .= ' ORDER BY wmi ASC';

      $marcas_vehiculos = $this->db->select_limit($consulta, FS_ITEM_LIMIT, $offset);
      if ($marcas_vehiculos) {
         foreach ($marcas_vehiculos as $v) {
            $result_list[] = new self($v);
         }
      }

      return $result_list;
   }
}