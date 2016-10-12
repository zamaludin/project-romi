<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery-nestable/jquery.nestable.css');?>"/>
<script src="<?=base_url('assets/jquery-nestable/jquery.nestable.js');?>"></script>
<style type="text/css">
  .dd-handle {
    font-weight: bold;
  }
</style>
<section class="content-header">
    <h1><i class="fa fa-sort-alpha-asc text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="dd" id="nestable">
                <ol class="dd-list">
                    <?php 
                    foreach ($query as $nav) {
                        echo '<li class="dd-item" data-id="'.$nav['post_id'].'">';
                        echo '<div class="dd-handle">'.strtoupper($nav['post_title']).'</div>';
                        $sub_nav = nested_list($nav['child']);
                        if ($sub_nav != '') {
                            echo '<ol class="dd-list">';                       
                            echo nested_list($nav['child']);                                               
                            echo '</ol>';    
                        }
                        echo '</li>';
                    }
                    ?>
                </ol>
            </div>
            <br>
            <?php if (count($query)) { ?>
                <button id="save-form" type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> SAVE CHANGES</button>
            <?php } ?>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    var result; 
    var updateOutput = function(e) {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            result = window.JSON.stringify(list.nestable('serialize'));
        }
    };
    $('#nestable').nestable().on('change', updateOutput);
    $('#save-form').click(function() {
      $.post("<?=site_url('pages/save_position')?>", {"page":result}, function(response) {
        if (response.growl == 'success') {
            alert('Data sudah tersimpan!');
        }
      });
    });
});
</script>