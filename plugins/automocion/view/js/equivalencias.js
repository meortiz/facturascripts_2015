/* Dibujar neumatico: http://www.equivalencias.info/neumaticos/?idmodulo=4 */

var img_llanta_url = "plugins/automocion/view/images/informacion_vehiculos/equivalencias/llanta.png";
var img_rodada_url = "plugins/automocion/view/images/informacion_vehiculos/equivalencias/rodada.gif";

//drawNeumatico(125, 100, frm.ancho.value, frm.perfil.value, frm.diametro.value, "#00aa00");

function drawNeumatico(x, y, ancho, perfil, diametro, color_txt) {
   var _diametro = (diametro * 25.4);
   var x, y, ancho, perfil, diametro;
   var _x, _y, _perfil;
   _perfil = (ancho * perfil / 100);
   diametro_neumatico = (_diametro + _perfil * 2);

   jg_doc.setStroke(1);
   jg_doc.setColor("#000000"); //neumatico
   _diametro_neumatico = diametro_neumatico / 4; //escala
   _x = x - (_diametro_neumatico / 2);
   _y = y - (_diametro_neumatico / 2);
   jg_doc.fillEllipse(_x, _y, _diametro_neumatico, _diametro_neumatico);

   jg_doc.drawImage(img_rodada_url, _x + _diametro_neumatico + 40, _y, ancho / 4, _diametro_neumatico, _diametro_neumatico, 'name="img_rodada"');

   //cotas
   var xo = 20;
   jg_doc.setStroke(Stroke.DOTTED);
   jg_doc.setFont("verdana", "10px", Font.ITALIC);
   jg_doc.setColor("#aa0000");
   //anchura
   jg_doc.drawLine(_x + _diametro_neumatico + 40, _y + (_diametro_neumatico) + xo - 10,
      _x + _diametro_neumatico + 38 + (ancho / 4), _y + (_diametro_neumatico) + xo - 10); //ancho
   jg_doc.drawLine(_x + _diametro_neumatico + 40, _y + (_diametro_neumatico), _x + _diametro_neumatico + 40, _y + (_diametro_neumatico) + xo);
   jg_doc.drawLine(_x + _diametro_neumatico + 38 + (ancho / 4), _y + (_diametro_neumatico), _x + _diametro_neumatico + 38 + (ancho / 4), _y + (_diametro_neumatico) + xo);
   var medio = (ancho / 8);
   jg_doc.drawStringRect(Math.round(ancho), _x + _diametro_neumatico + 40 + medio - 8, _y + (_diametro_neumatico) + 10, "right");

   //horizontales
   jg_doc.drawLine(_x + (_diametro_neumatico / 2), y - (_diametro_neumatico / 2), _x + (_diametro_neumatico /*/2*/ ) + xo, y - (_diametro_neumatico / 2)); //arriba
   //jg_doc.drawLine(_x-xo,y,(_x)+(_diametro_neumatico/2),y);//eje
   jg_doc.drawLine(_x - xo, y - (_diametro / 8), (_x) + (_diametro_neumatico / 2), y - (_diametro / 8)); //perfil arriba
   jg_doc.drawLine(_x - xo, y - (_diametro / 8) + (_diametro / 4), (_x) + (_diametro_neumatico / 2), y - (_diametro / 8) + (_diametro / 4)); //perfil abajo
   jg_doc.drawLine(_x - xo, _y + _diametro_neumatico, (_x) + (_diametro_neumatico /*/2*/ ) + xo, _y + _diametro_neumatico); //abajo

   //cota total
   jg_doc.drawLine(_x + (_diametro_neumatico) + 10, y - (_diametro_neumatico / 2), _x + (_diametro_neumatico) + 10, _y + _diametro_neumatico);
   medio = ((_y + _diametro_neumatico) - (y - (_diametro_neumatico / 2))) / 2;
   jg_doc.drawStringRect(Math.round(diametro_neumatico), _x + (_diametro_neumatico) + 11, y - (_diametro_neumatico / 2) + medio - 5, "right");
   //cota llanta
   jg_doc.drawLine(_x - xo + 10, y - (_diametro / 8) + (_diametro / 4), _x - xo + 10, y - (_diametro / 8)); //perfil abajo
   medio = ((y - (_diametro / 8) + (_diametro / 4)) - (y - (_diametro / 8))) / 2;
   jg_doc.drawStringRect(Math.round(diametro * 25.4), _x - xo - 11, y - (_diametro / 8) + medio - 5, "right");
   //cota perfil
   jg_doc.drawLine(_x - xo + 10, y - (_diametro / 8) + (_diametro / 4), _x - xo + 10, _y + _diametro_neumatico);
   medio = ((_y + _diametro_neumatico) - (y - (_diametro / 8) + (_diametro / 4))) / 2;
   jg_doc.drawStringRect(Math.round(_perfil), _x - xo - 11, y - (_diametro / 8) + (_diametro / 4) + medio - 5, "right");
   ////////

   jg_doc.setColor("#ffffff");
   _diametro = _diametro / 4; //escala
   _x = x - (_diametro / 2);
   _y = y - (_diametro / 2);

   jg_doc.fillEllipse(_x, _y, _diametro, _diametro);

   jg_doc.drawImage(img_llanta_url, _x, _y, _diametro, _diametro, 'name="img_llanta"');

   jg_doc.setColor(color_txt);
   jg_doc.setFont("Verdana", "11px", Font.BOLD);
   _x = x - (_diametro_neumatico / 2);
   _x = 10;
   _y = y + (_diametro_neumatico / 2);
   var tmp = 0,
      signo = "";
   jg_doc.drawStringRect(+ancho + "/" + perfil + "R" + diametro, _x, y - (_diametro_neumatico / 2) - 15, "right");
   jg_doc.drawStringRect("Diametro llanta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " + Math.round(diametro * 25.4) + " mm.", _x, _y, "right");
   jg_doc.drawStringRect("Altura perfil&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " + Math.round(_perfil) + " mm.", _x, _y + 12, "right");
   tmp = getDiametro(frm.ancho.value, frm.perfil.value, frm.diametro.value) / diametro_neumatico;
   if (tmp > 1) {
      tmp = (tmp - 1);
      signo = "-";
   } else {
      tmp = (1 - tmp);
      signo = "+";
   }
   tmp = Math.round(tmp * 10000) / 100;
   jg_doc.drawStringRect("Diametro total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " + Math.round(diametro_neumatico) + " mm. (" + signo + tmp + " %)", _x, _y + 24, "right");
   jg_doc.drawStringRect("Distancia/revolución&nbsp;: " + Math.round(diametro_neumatico * 3.141592 / 10) / 100 + " m.", _x, _y + 36, "right");
   jg_doc.drawStringRect("Revoluciones/km&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " + Math.round(1000 / (diametro_neumatico * 3.141592 / 1000)) + " rev.", _x, _y + 48, "right");
   if (signo == "+") {
      tmp = tmp * -1;
   }
   jg_doc.drawStringRect("Velocimetro (a 100 Km/h marcara):" + Math.round(100 + tmp) + " km/h", _x, _y + 60, "right");

   jg_doc.paint();
}

function drawLlanta(x, y, diametro) {
   var diametro = (diametro * 25.4);
   var x, y;
   jg_doc.setColor("#cccccc");
   diametro = diametro / 4;
   jg_doc.fillEllipse(x, y, diametro, diametro);
   jg_doc.paint();
}

function calcular() {
   var f = document.equivalencias;
   var resultado, altura_total, diferencia_altura, diferencia_porcentual;
   var a2;
   var indicado = false;
   var todas = false;
   var anchas = false;
   var estrechas = false;
   var contador = 0;

   if (f.perfil.value) {
      f_perfil = f.perfil.value;
   } else {
      f_perfil = 80;
   }

   if (f.ancho.value) {
      f_ancho = f.ancho.value;
   } else {
      f_ancho = 205;
   }

   if (f.diametro.value) {
      f_diametro = f.diametro.value;
   } else {
      f_diametro = 16;
   }

   if (f.llanta.value) {
      f_llanta = f.llanta.value;
      indicado = true;
   } else {
      indicado = false;
      f_llanta = 10;
   }

   var filtro = document.getElementsByName("filtrado");

   for (var i = 0; i < filtro.length; i++) {
      if (filtro[i].checked == true) {
         selectedFiltro = filtro[i].id;
      }
   }

   var a0;

   switch (selectedFiltro) {
      case "todas":
         todas = true;
         a0 = "<p>Se mostrar&aacute;n todas las combinaciones medidas posibles.</p>";
         break;
      case "anchas":
         anchas = true;
         a0 = "<p>Se mostrar&aacute;n las medidas m&aacute;s anchas y con llanta mayor o igual.</p>";
         break;
      case "estrechas":
         estrechas = true;
         a0 = "<p>Se mostrar&aacute;n las medidas m&aacute;s estrechas y con llanta menor o igual.</p>";
         break;
      default:
         alert("Algo has hecho mal...");
         todas = false;
         anchas = false;
         estrechas = false;
         break;
   }

   resultado = ((2 * parseInt(f_ancho) * parseInt(f_perfil) / 2540) + parseInt(f_diametro)) * 25.4;
   document.getElementById('resultado').innerHTML = "<p>La medida solicitada es <b>" + f_ancho + "/" + f_perfil + " R" + f_diametro + "</b> y su diametro es <b>" + (Math.round(resultado * 100) / 100) + "mm</b>.</p> <p>La altura m&iacute;nima es <b>" + Math.round((resultado * 0.97) * 100) / 100 + "</b> y la m&aacute;xima es <b>" + Math.round((resultado * 1.03) * 100) / 100 + "</b>.</p><p><b>Advertencia: Las equivalencias se calculan sobre la medida original del vehiculo, no sobre otras medidas homologadas posteriormente.</b></p>";

   var a1 = "<table class='table table-hover text-center'>";
   a1 += "<thead>";
   a1 += "<tr>";
   a1 += "<th class='text-center'>#</th>";
   a1 += "<th class='text-center'>Ancho</th>";
   a1 += "<th class='text-center'>Perfil</th>";
   a1 += "<th class='text-center'>Llanta</th>";
   a1 += "<th class='text-center'>Altura (mm)</th>";
   a1 += "<th class='text-center'>Diferencia (mm)</th>";
   a1 += "<th class='text-center'>Diferencia (%)</th>";
   a1 += "</tr>";
   a1 += "<thead>";
   a1 += "<tbody>";

   for (ancho = 135; ancho <= 275; ancho += 10) {
      for (perfil = 35; perfil <= 80; perfil += 5) {
         for (llanta = 10; llanta <= 30; llanta++) {
            altura = ((2 * ancho * perfil / 2540) + llanta) * 25.4;
            altura_min = resultado * 0.97;
            altura_max = resultado * 1.03;
            altura_total = (Math.round(altura * 100) / 100);
            diferencia_altura = (Math.round((altura - resultado) * 100) / 100);
            diferencia_porcentual = (Math.round((diferencia_altura/resultado)*100000)/1000);

            /*Todas las equivalencias*/
            if (altura > altura_min && altura < altura_max && todas == true) {
               if (f_llanta == llanta) {
                  if (contador == 0) {
                     if (contador % 2) {
                        contador++;
                        a2 = "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual+ "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 = "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  } else {
                     if (contador % 2) {
                        contador++;
                        a2 += "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 += "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  }
               } else if (indicado == false) {
                  if (contador == 0) {
                     if (contador % 2) {
                        contador++;
                        a2 += "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 += "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  } else {
                     if (contador % 2) {
                        contador++;
                        a2 += "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 += "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  }
               }
            }
            /* Todas las equivalencias más anchas (Útil para sobredimensionamientos)*/
            else if (altura > altura_min && altura < altura_max && ancho >= f_ancho && anchas == true) {
               if (f_llanta == llanta) {
                  if (contador == 0) {
                     if (contador % 2) {
                        contador++;
                        a2 = "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 = "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  } else {
                     if (contador % 2) {
                        contador++;
                        a2 += "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 += "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  }
               } else if (indicado == false) {
                  if (contador == 0) {
                     if (contador % 2) {
                        contador++;
                        a2 += "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 += "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  } else {
                     if (contador % 2) {
                        contador++;
                        a2 += "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 += "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  }
               }
            }
            /* Todas las equivalencias más estrechas (Útil para invierno) */
            else if (altura > altura_min && altura < altura_max && ancho <= f_ancho && estrechas == true) {
               if (f_llanta == llanta) {
                  if (contador == 0) {
                     if (contador % 2) {
                        contador++;
                        a2 = "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 += "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  } else {
                     if (contador % 2) {
                        contador++;
                        a2 += "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 += "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  }
               } else if (indicado == false) {
                  if (contador == 0) {
                     if (contador % 2) {
                        contador++;
                        a2 = "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 += "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  } else {
                     if (contador % 2) {
                        contador++;
                        a2 += "<tr class='active'>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     } else {
                        contador++;
                        a2 += "<tr>";
                        a2 += "<td scope='row'><b>" + contador + "</b></td>";
                        a2 += "<td>" + ancho + "</td>";
                        a2 += "<td>" + perfil + "</td>";
                        a2 += "<td>" + llanta + "</td>";
                        a2 += "<td>" + altura_total + "</td>";
                        a2 += "<td>" + diferencia_altura + "</td>";
                        a2 += "<td>" + diferencia_porcentual + "</td>";
                        a2 += "</tr>";
                     }
                  }
               }
            }
         }
      }
   }

   var a3 = "</tr></tbody></table>";
   document.getElementById('equivalentes').innerHTML = a0 + a1 + a2 + a3;
   a2 = "";

   //drawNeumatico(125, 100, f_ancho, f_perfil, f_diametro.value, "#00aa00");
}
