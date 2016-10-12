<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa fa-puzzle-piece text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?>
    <?=form_open($action, array('role' => 'form', 'class' => 'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">Select Themes ?</label>
                <div class="col-md-3">
                    <?=form_dropdown('themes', themes(), $this->setting['themes'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                </div>
            </div>
        </div>
    </form>
</section>