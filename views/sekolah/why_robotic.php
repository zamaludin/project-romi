<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">.cke_contents { height: 500px !important; }</style>
<section class="content-header">
    <h1><i class="fa fa-microphone text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <div class="col-md-12">
                    <textarea name="why_robotic" class="ckeditor" id="ckeditor">
                        <?=(set_value('why_robotic')) ? set_value('why_robotic') : $this->setting['why_robotic']?>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                </div>
            </div>
        </div>
    </form>
</section>