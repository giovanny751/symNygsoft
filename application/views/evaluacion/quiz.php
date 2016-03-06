<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i>Prueba de Conocimiento
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('message')) { ?>
                                <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div>            
                            <?php } ?>
                            <table class="table table-striped table-bordered table-hover tabla-sst">
                                <thead>
                                <th></th>
                                <th><b>Evaluación</b></th>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($evaluacion)) {
                                        foreach ($evaluacion as $value) {
                                            ?>
                                            <tr>
                                                <td><center><button class="btn btn-success <?php echo (empty($value->eva_texto)?'ingresar':' modal_texto" data-toggle="modal" data-target="#myModal"')  ?>" titulo="<?php echo $value->eva_nombre ?>" texto="<?php echo (!empty($value->eva_texto)?  base64_encode($value->eva_texto):'')?>" id="<?php echo $value->eva_id ?>">Ingresar</button></center></td>
                                        <td><?php echo $value->eva_nombre ?></td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="titulo_"></span></h4>
      </div>
      <div class="modal-body">
        <p><span class="cuerpo_"></span></p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success boton_modal ingresar" id="" data-dismiss="modal">Ingresar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<form action="<?php echo base_url('index.php/Evaluacion/prueba') ?>" id="form1" method="post"><input type="hidden" id="eva_id" name="eva_id"></form>
<script>
    $('.ingresar').click(function () {
        var r = confirm('En este momento va a dar incio a la prueba \n ¿desea continuar?');
        if (r == false)
            return false;
        $('#eva_id').val($(this).attr('id'));
        $('#form1').submit();
    })
    $('.modal_texto').click(function(){
        var titulo=$(this).attr('titulo');
        var texto=$(this).attr('texto');
        $('.boton_modal').attr('id',$(this).attr('id'));
        $('.titulo_').html(titulo);
        $('.cuerpo_').html(Base64.decode(texto));
//        Base64.encode(input.value);
    })
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // base 64 js
    var Base64 = {


    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",


    encode: function(input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },


    decode: function(input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    _utf8_decode: function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}
</script>