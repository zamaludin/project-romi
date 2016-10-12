<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
    tr.success {
        background-color: #f5f5f5;
        color: green;
    }
    tr.danger {
        background-color: #f5f5f5;
        color: maroon;
    }
</style>
<script type="text/javascript" src="<?=base_url('assets/plupload-2.1.8/js/plupload.full.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plupload-2.1.8/js/jquery.plupload.queue/jquery.plupload.queue.min.js')?>"></script>
<section class="content-header">
    <h1><i class="fa fa-upload text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box-body">
                <table class="table table-bordered table-condensedd no-margin">
                    <thead>
                        <tr>
                            <th>FILE NAME</th>
                            <th width="20%">FILE TYPE</th>
                            <th width="20%">FILE SIZE</th>
                        </tr>
                    </thead>
                    <tbody id="filelist"></tbody>
                </table>
            </div>
            <br>
            <button class="btn btn-primary btn-sm" id="pickfiles"><i class="fa fa-search"></i> SELECT IMAGES</button>
            <button class="btn btn-info btn-sm" id="uploadfiles"><i class="fa fa-upload"></i> UPLOAD</button>
            <img id="loading" style="display:none;" src="<?=base_url('assets/images/facebook.gif');?>">
            <span id="success"></span>
            <span id="failled"></span>
        </div>        
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        var success = 0, failled =0;
        var uploader = new plupload.Uploader({
            runtimes: 'html5,flash,silverlight,html4',
            browse_button: 'pickfiles',
            container: $('#container_upload')[0],
            url: '<?=$action?>',
            filters: {
                mime_types: [
                    { title:"Image files", extensions:'jpg,png,jpeg' }        
                ]
            }, 
            flash_swf_url: '<?=base_url("assets/plupload-2.1.8/js/Moxie.swf");?>',
            silverlight_xap_url: '<?=base_url("assets/plupload-2.1.8/js/Moxie.xap");?>',
            init: {
                PostInit: function() {
                    $('#filelist').html('');
                    $('#uploadfiles').on('click', function() {
                        $('#loading').show();
                        $('#pickfiles', '#uploadfiles').attr('disabled', 'disabled');
                        uploader.start();
                        return false;
                    });
                },
                FilesAdded: function(up, files) {
                    var html = '';
                    plupload.each(files, function(response) {
                        html += '<tr id="row_' + response.id + '">'
                            + '<td>' + response.name + '</td>'
                            + '<td>' + response.type + '</td>'
                            + '<td>' + plupload.formatSize(response.size) + '</td>'
                            + '</tr>';
                    });
                    $('#filelist').html(html);
                },
                FileUploaded: function(up, file, info) {
                    var res = JSON.parse(info.response);
                    if (res.type == 'success') {
                        success++;
                        $('#success').html(success + ' file uploaded.');
                        $('tr#row_'+file.id).addClass('success');
                    } else {
                        failled++;
                        $('#failled').html(failled + ' file not uploaded.');
                        $('tr#row_'+file.id).addClass('danger');
                    }
                },
                UploadComplete:function(up, file) {
                    $('#loading').hide();
                    $('#pickfiles', '#uploadfiles').removeAttr('disabled');
                },
                Error: function(up, err) {
                    console.log(up, err);
                }
            }
        });
        uploader.init();
    });
</script>