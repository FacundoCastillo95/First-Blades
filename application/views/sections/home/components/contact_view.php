<section id="contact">
    <h2><?=lang('Contactanos');?></h2>
    <p><?=lang('Completá el formulario para dudas o sugerencias');?>.</p>
    <form id="contact-form">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3">
                <label for="name"><?=lang('Nombre y Apellido');?></label>
                <div>
                    <input type="text" name="name" class="required" required>
                </div>
                <label for="company"><?=lang('Empresa');?></label>
                <div>
                    <input type="text" name="company">
                </div>
                <label for="email"><?=lang('E-mail');?></label>
                <div>
                    <input type="text" name="email" class="required" required>
                </div>
                <label for="subject"><?=lang('Asunto');?></label>
                <div>
                    <select name="subject" id="subject">
                        <option value="Consulta general"><?=lang('Consulta general');?></option>
                        <option value="Problema con un producto"><?=lang('Problema con un producto');?></option>
                        <option value="Inconveniente sitio web"><?=lang('Inconveniente sitio web');?></option>
                        <option value="Trabajá con nosotros"><?=lang('Trabajá con nosotros');?></option>
                        <option value="Otro"><?=lang('Otro');?></option>
                    </select>
                </div>
                <label for="message"><?=lang('Mensaje');?></label>
                <div style="position: relative;">
                    <textarea name="message" id="message" class="required" required></textarea>
                    <img id="attach-file" src="<?=assets_url('images/icons/clip.svg');?>" alt="adjuntar">
                    <small id="attach-file-messages" style="margin-right: auto;"></small>
                </div>
                <div id="upload-error" class="alert alert-warning" style="display: none;">
                    <strong><?= lang('Ocurrió un error');?></strong>
                    <p style="margin-bottom:0px;"><?= lang('Los siguientes archivos no pudieron cargarse ya que excedieron el peso permitido');?> (20 MB).</p>
                    <ul id="files-rejected" style="margin-bottom:0px;padding-left:0px;"></ul>
                </div>
                <div id="attachments"></div>
                <div class="text-center">
                    <button type="submit"><?=lang('Enviar');?></button>
                </div>
            </div>
        </div>
    </form>
    <div id="contact-success" style="display: none;">
    </div>
    <form id="form-upload" style="display: none;">
        <input type="hidden" id="target">
        <input type="hidden" name="app_id" value="<?=md5('firstblades')?>">
        <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
        <input type="hidden" value="vn_upload" name="<?=ini_get("session.upload_progress.name");?>">
    </form>		
</section>

<script src="<?=assets_url('libs/jquery.selectric.js');?>"></script>
<link type="text/css" href="<?=assets_url('css/selectric.css');?>" rel="stylesheet">
<script>
$(function() {
    $('#subject').selectric();
});
</script>

<script>
$('#subject').change(function () { 
    if($(this).val() == 'Trabajá con nosotros'){
        $('#attach-file').css('visibility', 'visible'); 
    }else{
        $('#attach-file').css('visibility', 'hidden');
    }
});
</script>

<script>
$("#attach-file").on("click", function(e) {
    e.preventDefault();
    if ($(this).hasClass("disabled")) {
        return false;
    } else {
        $("#fileToUpload").click();
    }
});

$("#fileToUpload").on("change", function(e) {
    var form_id = document.getElementById('form-upload');
    var form_data = new FormData(form_id);
    var that = this;

    $("#upload-error").hide();

    var rejected = [];
    var approved = 0;

    var s3_post = new FormData();

    form_data.forEach(function(v, i) {
        if (v.name) {
            if (v.size > 20000000) {
                rejected.push(v.name);
            } else {
                approved++;
                s3_post.append(i, v);
            }
        } else {
            s3_post.append(i, v);
        }
    });

    if (rejected.length > 0) {
        var rejected_str = '';
        rejected.forEach(function(v, i) {
            rejected_str += '<li>' + v + '</li>';
        });
        $("#upload-error").show();
        $("#files-rejected").html(rejected_str);
    }

    if (approved > 0) {
        if (approved > 1) {
            $("#attach-file-messages").addClass("disabled").attr("disabled", true).text('<?=lang('Cargando');?>' + ' ' + approved + ' ' + '<?= lang('archivos...');?>');
        } else {
            $("#attach-file-messages").addClass("disabled").attr("disabled", true).text('<?=lang('Cargando archivo...');?>');
        }
        $.ajax({
            type: 'POST',
            url: base_url + 'api/upload/file',
            data: s3_post,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res){
                if (res) {
                    if (res.rejected) {
                        if (res.rejected.length > 0) {
                            var files = '';
                            $.each(res.rejected, function(i, v) {
                                files += '<li>' + v.name + '</li>'
                            });
                            $("#upload-error").show();
                            $("#files-rejected").html(rejected_str);
                        }
                    }
                    if (res.uploaded) {				
                        var filename = 'Archivo(s) cargado(s)';
                        if (res.uploaded.length > 0) {
                            $.each(res.uploaded, function(i, v) {
                                if (v.status === true) {
                                    if (res.uploaded.length === 1) {
                                        filename = v.name;
                                    } else {
                                        filename = res.uploaded.length + ' archivos';
                                    }
                                    $('#attachments').append('<div id="attachment-' + i + '" class="attachment-item">\
                                                                <span>' + v.name + '</span>\
                                                                <a href="#" class="btn-remove" data-id="' + i + '" title="Quitar ' + v.name + '">\
                                                                    <svg height="14" aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">\
                                                                        <path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>\
                                                                    </svg>\
                                                                </a>\
                                                                <input type="hidden" name="attachments[]" value="' + v.url + '">\
                                                            </div>');
                                };
                            });
                        }
                    }
                };
            },
            error: function() {
            },
            complete: function() {
                $("#attach-file").removeClass("disabled").attr("disabled", false).html('<img src="<?=assets_url('images/icons/clip.svg');?>" alt="adjuntar">');
                $("#attach-file-messages").empty();
                uploading = false;
            }
        });
    } else {
        $("#attach-file").removeClass("disabled").attr("disabled", false).html('<img src="<?=assets_url('images/icons/clip.svg');?>" alt="adjuntar">');
        $("#attach-file-messages").empty();
    }
});

$("body").on("click", ".btn-remove", function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    $("#attachment-" + id).remove();
});
</script>

<script type="text/javascript" src="<?=assets_url('libs/jquery-validation/jquery.validate.min.js');?>"></script>
<?php if ($this->session->userdata('language') == 'spanish'): ?>
    <script type="text/javascript" src="<?=assets_url('libs/jquery-validation/localization/messages_es_AR.min.js');?>"></script>
<?php endif ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#contact-form').validate({
            submitHandler: function() {
                $("#form-alert").hide();
                $("#contact-form [type=submit]")
                    .text("<?= lang('Enviando...');?>")
                    .addClass("disabled");
                var data = $("#contact-form").serialize();
                $.ajax({
                    url: base_url + 'api/contact',
                    method: "POST",
                    data: data,
                    dataType: "JSON",
                    success: function() {
                        $("#contact-form input").val("");
                        $("#contact-form textarea").val("");
                        $("#contact-form [type=submit]").text('<?= lang('¡Enviado!');?>');
                        $('#attachments').empty();

                        setTimeout(function(){
                            $("#contact-form [type=submit]").text('<?= lang('Enviar');?>');
                            $("#contact-form [type=submit]").removeClass("disabled");
                        }, 1500);
                    },
                });
                return false;
            }
        });
    });
</script>
