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

function pdf($html = null) {
//$html= utf8_decode($html);
//    $html="OOOJHKJHKJH JLH KJH KH KJH";
    ob_clean();

// create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

// ---------------------------------------------------------
// set default font subsetting mode
    $pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
    $pdf->AddPage();

// set text shadow effect
    $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
// Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
    $pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
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
        $html = "<select id='$id' class='$class' name=$name >";
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
                    if (strpos($option_name, ',')) {
                        $option_name1 = explode(',', $option_name);
                        $html.="<option   value=" . $row->$option_value . " onlyRead >" . $row->$option_name1[0] . ' und (' . $row->$option_name1[1] . ")</option>";
                    } else
                        $html.="<option   value=" . $row->$option_value . " onlyRead >" . $row->$option_name . "</option>";
                }
            }
        }
        return $html.="</select>";
    } else {
        return false;
    }
}

function auto($tabla, $idcampo, $nombrecampo, $letra, $limit = null) {
    $search = buscador($limit, $tabla, $nombrecampo, $letra);
    $h = 0;
    foreach ($search as $result) {
        $data[$h] = array(
            'id' => $result->$idcampo,
            'label' => $result->$nombrecampo,
            'value' => $result->$nombrecampo
        );
        $h++;
    }
    return $data;
}

function buscador($limit = null, $tabla, $nombrecampo, $palabra, $campo1 = null, $campo2 = null, $campo3 = null) {
    $CI = & get_instance();
    $CI->db->like($nombrecampo, $palabra);
    if ($campo1 != null)
        $CI->db->or_like($campo1, $palabra);
    if ($campo2 != null)
        $CI->db->or_like($campo2, $palabra);
    if ($campo3 != null)
        $CI->db->or_like($campo3, $palabra);
    $user = $CI->db->get($tabla, $limit);
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
        $html = "<select multiple id='$id' class='$class' name='$name' required='required'     >";
        $i = 0;
        if (isset($value[$i]))
            if ($value[$i] == "")
                $i = 1;
        foreach ($query->result() as $row) {
            if ($row->$option_value == (isset($value[$i]) ? $value[$i] : '')) {
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

function arregloconsulta($tabla) {

    $data = array();
    $d = 0;
    foreach ($tabla as $total => $num):
//            echo $total;
        $i = 0;
        foreach ($num as $campo => $valor):
            $data[$d][$i] = $valor;
            $i++;
        endforeach;
        $d++;
    endforeach;

    return $data;
}
