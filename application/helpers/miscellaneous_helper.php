<?php

function print_y($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function get_dropdown($array_objects, $value, $name) {
    $array_return = array();
    foreach ($array_objects as $array) {
        $array_return[$array->$value] = $array->$name;
    }
    return $array_return;
}

function get_dropdown_select($array_objects, $value, $name, $select_value, $select_name = 'Seleccionar...') {
    $array_return = array($select_value => $select_name);
    foreach ($array_objects as $array) {
        $array_return[$array[$value]] = $array[$name];
    }
    return $array_return;
}

function encrypt_id($id) {
    return base64_encode(rand(111111, 999999) . $id . rand(11111, 99999));
}

function encrypt_fijo($id) {
    $id = base64_encode($id);
    return base64_encode($id);
}

function deencrypt_id($id) {
    $id = base64_decode($id);
    $id = substr($id, 6, strlen($id));
    $id = substr($id, 0, strlen($id) - 5);
    return $id;
}

function dias_transcurridos($fecha_i, $fecha_f) {
    $dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
    $dias = abs($dias);
    $dias = floor($dias);
    return $dias;
}

function get_cut_day() {
    $CI = & get_instance();
    $CI->load->model('cut_model');

    $cuts = $CI->cut_model->get_all_cuts();
    $array_cuts = array();
    foreach ($cuts as $cut) {
        if ($cut->CORTE_DIAINICIO > $cut->CORTE_DIAFIN) {
            for ($a = $cut->CORTE_DIAINICIO; $a <= 31; $a++) {
                $array_cuts[$a] = $cut->CORTE_ID;
            }
            for ($a = 1; $a <= $cut->CORTE_DIAFIN; $a++) {
                $array_cuts[$a] = $cut->CORTE_ID;
            }
        } else {
            for ($a = $cut->CORTE_DIAINICIO; $a <= $cut->CORTE_DIAFIN; $a++) {
                $array_cuts[$a] = $cut->CORTE_ID;
            }
        }
    }
    return $array_cuts;
}

function get_cutday_id($id) {
    $CI = & get_instance();
    $CI->load->model('cut_model');
    $cuts = $CI->cut_model->get_cut_id($id);
    return $cuts[0]->CORTE_DIAPAGO;
}

function check_in_range($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

function getUltimoDiaMes($elAnio, $elMes) {
    return date("d", (mktime(0, 0, 0, $elMes + 1, 1, $elAnio) - 1));
}

function get_state_folder($id) {
    switch ($id) {
        case 1: return 'Proceso Aspirante';
            break;
        case 2: return 'No asignada';
            break;
        case 3: return 'Asignada Analista';
            break;
        case 4: return 'Proceso Analista';
            break;
        case 5: return 'Calificada';
            break;
        case 6: return 'Asignada Supervisor';
            break;
        case 7: return 'Proceso Supervisor';
            break;
        case 8: return 'Devuelta';
            break;
        case 9: return 'Cerrada';
            break;
        case 10: return 'Recalificar Analista';
            break;
        default: return '';
            break;
    }
}

function get_color_state_folder($state_name) {
    switch ($state_name) {
        case 'Admitido': return '<span class="badge badge-success">' . $state_name . '</span>';
            break;
        case 'No Admitido': return '<span class="badge badge-danger">' . $state_name . '</span>';
            break;
        default: return '<span class="badge badge-default">' . $state_name . '</span>';
            break;
    }
}

function state_folder() {
    return array(
        '' => '--Todos los Estados--',
        '1' => 'Proceso Aspirante',
        '2' => 'No asignada',
        '3' => 'Asignada Analista',
        '4' => 'Proceso Analista',
        '5' => 'Calificada',
        '6' => 'Asignada Supervisor',
        '7' => 'Proceso Supervisor',
        '8' => 'Devuelta',
        '9' => 'Cerrada',
        '10' => 'Recalificar Analista',
    );
}

function max_folio($id) {
    $CI = & get_instance();
    $SQL = "select (Maximo+1) consecutivo 
  from VW_FOLIO_MAYOR
  where id=" . $id;
    $datos = $CI->db->query($SQL);
    $datos = $datos->result();
    return $datos[0]->consecutivo;
}

function pdf($html = null, $logo = null, $nombre = null,$estadistica,$itiniere,$transporte) {
//$html= utf8_decode($html);
//    $html="OOOJHKJHKJH JLH KJH KH KJH";
    ob_clean();
// create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(210, 272), true, 'UTF-8', false);
//    $pdf = new TCPDF('P', 'IN', array (8.5,11),true, 'UTF-8', false);
// set document information
    //$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
//$pdf->SetTitle('TCPDF Example 001');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
//$pdf->SetHeaderData($logo, '20', PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    if (!empty($logo))
        $pdf->SetHeaderData($logo, '20', '', '      PLAN ESTRATEGICO DE SEGURIDAD VÍAL       ' . date('d/m/Y'), array(0, 64, 128), array(0, 64, 128));
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
// set header and footer fonts
//    $pdf->SetMargins(23, 35, 13);
    $pdf->SetMargins(32, 35, 20);
    $pdf->SetHeaderMargin(14);
    $pdf->SetFooterMargin(21);
    $pdf->SetAutoPageBreak(TRUE, 20);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    //$pdf->setLanguageArray($l);
    $pdf->setFontSubsetting(false);
    $pdf->SetFont('dejavusans', '', 10, '', true);
    //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', '6'));
    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
//    $pdf->AddPage();
    $pdf->SetFillColor(0, 0, 0);
    $pdf->Write(10, '                                                                  ARL');
//    echo $estadistica[0]->arlnula;die;
//   GRAFICA No 1
    $xc = $estadistica[0]->arlnula;
    $yc = $estadistica[0]->arlsi;
    $r = $estadistica[0]->arlno;
//echo "<pre>";
//    var_dump($estadistica);die();
    $total=$xc+$yc+$r;
    $r1=($xc*360)/$total;
    $r2=($yc*360)/$total;
    $r3=($r*360)/$total;
    $r1=  round($r1);
    $r2=  round($r2);
    $r3=  round($r3);
    $xc1 = 105;
    $yc1 = 120;
    $r11 = 50;
    $pdf->SetFillColor(0, 0, 255);
    $pdf->PieSector($xc1, $yc1, $r11, 0, $r1, 'FD', false, 0, 2);
    $pdf->SetFillColor(0, 255, 0);
    $pdf->PieSector($xc1, $yc1, $r11, $r1, $r2+$r1, 'FD', false, 0, 2);
    $pdf->SetFillColor(255, 0, 0);
    $pdf->PieSector($xc1, $yc1, $r11, $r2+$r1, 0, 'FD', false, 0, 2);
    
        $pdf->SetTextColor(0,0,255);
    $pdf->Text(150, 150, 'NO CONTESTADAS: '.$xc);
    $pdf->SetTextColor(0,255,0);
    $pdf->Text(150, 155, 'SI: '.$yc);
    $pdf->SetTextColor(255,0,0);
    $pdf->Text(150, 160, 'NO: '.$r);
    
        $pdf->AddPage();
    
//----------------------------------------------------------------
//   GRAFICA No 2
    $pdf->SetTextColor(0,0,0);
        $pdf->Write(10, '                                                             PENSION');
    $xc = $estadistica[0]->pensionnula;
    $yc = $estadistica[0]->pensionsi;
    $r = $estadistica[0]->pensionno;

    $total=$xc+$yc+$r;
    $r1=($xc*360)/$total;
    $r2=($yc*360)/$total;
    $r3=($r*360)/$total;
    $r1=  round($r1);
    $r2=  round($r2);
    $r3=  round($r3);
    $xc1 = 105;
    $yc1 = 100;
    $r11 = 50;
    $pdf->SetFillColor(0, 0, 255);
    $pdf->PieSector($xc1, $yc1, $r11, 0, $r1, 'FD', false, 0, 2);
    $pdf->SetFillColor(0, 255, 0);
    $pdf->PieSector($xc1, $yc1, $r11, $r1, $r2+$r1, 'FD', false, 0, 2);
    $pdf->SetFillColor(255, 0, 0);
    $pdf->PieSector($xc1, $yc1, $r11, $r2+$r1, 0, 'FD', false, 0, 2);
    
        $pdf->SetTextColor(0,0,255);
    $pdf->Text(150, 150, 'NO CONTESTADAS: '.$xc);
    $pdf->SetTextColor(0,255,0);
    $pdf->Text(150, 155, 'SI: '.$yc);
    $pdf->SetTextColor(255,0,0);
    $pdf->Text(150, 160, 'NO: '.$r);
        $pdf->AddPage();
//----------------------------------------------------------------
//   GRAFICA No 3
        $pdf->SetTextColor(0,0,0);
        $pdf->Write(10, '                                                                 EPS');
    $xc = $estadistica[0]->epsnula;
    $yc = $estadistica[0]->epssi;
    $r = $estadistica[0]->epsno;

    $total=$xc+$yc+$r;
    $r1=($xc*360)/$total;
    $r2=($yc*360)/$total;
    $r3=($r*360)/$total;
    $r1=  round($r1);
    $r2=  round($r2);
    $r3=  round($r3);
    $xc1 = 105;
    $yc1 = 100;
    $r11 = 50;
    $pdf->SetFillColor(0, 0, 255);
    $pdf->PieSector($xc1, $yc1, $r11, 0, $r1, 'FD', false, 0, 2);
    $pdf->SetFillColor(0, 255, 0);
    $pdf->PieSector($xc1, $yc1, $r11, $r1, $r2+$r1, 'FD', false, 0, 2);
    $pdf->SetFillColor(255, 0, 0);
    $pdf->PieSector($xc1, $yc1, $r11, $r2+$r1, 0, 'FD', false, 0, 2);
    
        $pdf->SetTextColor(0,0,255);
    $pdf->Text(150, 150, 'NO CONTESTADAS: '.$xc);
    $pdf->SetTextColor(0,255,0);
    $pdf->Text(150, 155, 'SI: '.$yc);
    $pdf->SetTextColor(255,0,0);
    $pdf->Text(150, 160, 'NO: '.$r);
        $pdf->AddPage();
//----------------------------------------------------------------
//   GRAFICA No 4
        $pdf->SetTextColor(0,0,0);
        $pdf->Write(10, '                                                  CAJA DE COMPENSACIÓN');
    $xc = $estadistica[0]->cajacompensacionnula;
    $yc = $estadistica[0]->cajacompensacionsi;
    $r = $estadistica[0]->cajacompensacionno;

    $total=$xc+$yc+$r;
    $r1=($xc*360)/$total;
    $r2=($yc*360)/$total;
    $r3=($r*360)/$total;
    $r1=  round($r1);
    $r2=  round($r2);
    $r3=  round($r3);
    $xc1 = 105;
    $yc1 = 100;
    $r11 = 50;
    $pdf->SetFillColor(0, 0, 255);
    $pdf->PieSector($xc1, $yc1, $r11, 0, $r1, 'FD', false, 0, 2);
    $pdf->SetFillColor(0, 255, 0);
    $pdf->PieSector($xc1, $yc1, $r11, $r1, $r2+$r1, 'FD', false, 0, 2);
    $pdf->SetFillColor(255, 0, 0);
    $pdf->PieSector($xc1, $yc1, $r11, $r2+$r1, 0, 'FD', false, 0, 2);
    
        $pdf->SetTextColor(0,0,255);
    $pdf->Text(150, 150, 'NO CONTESTADAS: '.$xc);
    $pdf->SetTextColor(0,255,0);
    $pdf->Text(150, 155, 'SI: '.$yc);
    $pdf->SetTextColor(255,0,0);
    $pdf->Text(150, 160, 'NO: '.$r);
        $pdf->AddPage();
//----------------------------------------------------------------
//   GRAFICA No 5
        $pdf->SetTextColor(0,0,0);
        $pdf->Write(10, '                                              DESPLAZAMIENTO EN MISIÓN');
    $xc = $estadistica[0]->usu_desplazamiento_misionnula;
    $yc = $estadistica[0]->usu_desplazamiento_misionsi;
    $r = $estadistica[0]->usu_desplazamiento_misionno;
    

    $total=$xc+$yc+$r;
    $r1=($xc*360)/$total;
    $r2=($yc*360)/$total;
    $r3=($r*360)/$total;
    $r1=  round($r1);
    $r2=  round($r2);
    $r3=  round($r3);
    $xc1 = 105;
    $yc1 = 100;
    $r11 = 50;
    $pdf->SetFillColor(0, 0, 255);
    $pdf->PieSector($xc1, $yc1, $r11, 0, $r1, 'FD', false, 0, 2);
    $pdf->SetFillColor(0, 255, 0);
    $pdf->PieSector($xc1, $yc1, $r11, $r1, $r2+$r1, 'FD', false, 0, 2);
    $pdf->SetFillColor(255, 0, 0);
    $pdf->PieSector($xc1, $yc1, $r11, $r2+$r1, 0, 'FD', false, 0, 2);
    
        $pdf->SetTextColor(0,0,255);
    $pdf->Text(150, 150, 'NO CONTESTADAS: '.$xc);
    $pdf->SetTextColor(0,255,0);
    $pdf->Text(150, 155, 'SI: '.$yc);
    $pdf->SetTextColor(255,0,0);
    $pdf->Text(150, 160, 'NO: '.$r);
       
//    $pdf->Write(0, 'Example of PieSector() method.');
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
    
//    $pdf->writeHTMLCell(1, 1, '', '', $html, 0, 1, 0, true, '', true);
    $pdf->Output('pesv.pdf', 'I');
}
function lista($name, $id, $class, $tabla, $option_value, $option_name, $value, $where, $bloqued) {
    $CI = & get_instance();
        if (!isset($value)) {
            $value = "";
        }
        if (isset($where)) {
            foreach ($where as $campo => $igual) {
                $CI->db->where($campo, $igual);
            }
        }
        $query = $CI->db->get($tabla); //var_dump($this->db1->last_query());echo '</br>';
        if ($query->num_rows() > 0) {
            $html = "<select id=$id class='$class' name=$name >";
            if ($bloqued) {
                $html .= "<option value='' disabled=disabled>Seleccione</option>";
            } else {
                $html .= "<option value=''>Seleccione</option>";
            }
            foreach ($query->result() as $row) {
                if ($row->$option_value == $value) {
                    $html.="<option value=" . $row->$option_value . " selected>" . $row->$option_name . "</option>";
                } else {
                    if ($bloqued) {
                        $html.="<option  disabled=disabled  value=" . $row->$option_value . " >" . $row->$option_name . "</option>";
                    } else {
                        $html.="<option   value=" . $row->$option_value . " onlyRead >" . $row->$option_name . "</option>";
                    }
                }
            }
            return $html.="</select>";
        } else {
            return false;
        }
    }
    function auto($tabla,$idcampo,$nombrecampo,$letra,$limit = null) {
            $search = buscador($limit,$tabla,$nombrecampo,$letra);
            $h = 0;
            foreach($search as $result){
                $data[$h] = array(
                    'id' => $result->$idcampo,
                       'label' => $result->$nombrecampo,
                       'value' => $result->$nombrecampo
                );
                $h++;
            }
            return $data;
    }
    function buscador($limit = null,$tabla,$nombrecampo,$palabra,$campo1=null,$campo2=null,$campo3=null){
        $CI = & get_instance();
        $CI->db->like($nombrecampo,$palabra);
        if($campo1!=null)
        $CI->db->or_like($campo1,$palabra);
        if($campo2!=null)
        $CI->db->or_like($campo2,$palabra);
        if($campo3!=null)
        $CI->db->or_like($campo3,$palabra);
        $user = $CI->db->get($tabla,$limit);
        return $user->result();
    }
    function listaMultiple2($name, $id, $class, $tabla, $option_value, $option_name, $value, $where, $bloqued) {
        $CI = & get_instance();
        if (!isset($value)) {
            $value = "";
        }
        if (isset($where)) {
            foreach ($where as $campo => $igual) {
                $CI->db->where($campo, $igual);
            }
        }
        $query = $CI->db->get($tabla); //var_dump($this->db1->last_query());echo '</br>';
        if ($query->num_rows() > 0) {
            $html = "<select multiple id=$id class=$class name=$name required='required'     >";
            $i=0;
            if(isset($value[$i]))
            if($value[$i]=="")
                $i=1;
            foreach ($query->result() as $row) {
                if ($row->$option_value == (isset($value[$i])?$value[$i]:'')) {
                    $html.="<option value=" . $row->$option_value . " selected>" . $row->$option_name . "</option>";
                    $i++;
                } else {
                    if ($bloqued) {
                        $html.="<option  disabled=disabled  value=" . $row->$option_value . " >" . $row->$option_name . "</option>";
                    } else {
                        $html.="<option   value=" . $row->$option_value . " onlyRead >" . $row->$option_name . "</option>";
                    }
                }
            }
            return $html.="</select>";
        } else {
            return false;
        }
    }
    function arregloconsulta($tabla){
        
        $data = array();
        $d = 0;
        foreach ($tabla as $total => $num):
//            echo $total;
            $i = 0;
            foreach ($num as $campo => $valor):
                $data[$d][$i] =  $valor;
                $i++;
            endforeach;
            $d++;
        endforeach;
        
        return $data;
    }