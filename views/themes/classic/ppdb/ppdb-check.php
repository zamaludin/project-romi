<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#tanggal_lahir").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});
    });
</script>
<section id="main-content">
	<div class="widget-title">
		<h4>
		<?php
		if ($this->uri->segment(2) == 'check') {
		   echo '<i class="icon-check"></i>';
		} else {
		   echo '<i class="icon-print"></i>';
		}
		?>
		<?=strtoupper($title);?></h4>
	</div>
	<div class="widget">
		<?=$alert;?>
		<?php if ($this->setting['ppdb_status'] == 'open') {?>
	        <?=form_open($action, array('role' => 'form', 'class' => 'my-style'));?>
			    <label>
			        <span>Nomor Pendaftaran :</span>
			        <input required autofocus type="text" name="no_daftar"/>
			        <?=form_error('no_daftar');?>
			    </label>
			    <label>
			        <span>Tanggal Lahir :</span>
			        <input id="tanggal_lahir" required placeholder="Tanggal lahir diisi dengan format : YYYY-MM-DD" type="text" name="tanggal_lahir"/>
			        <?=form_error('tanggal_lahir');?>
			    </label>
			    <label class="submit">
			        <span>&nbsp;</span>
			        <input type="submit" class="button" value="<?=$button;?>"/>
			    </label>
			</form>
		<?php } else {?>
		<p>Penerimaan peserta didik baru (PPDB) online tahun <?=$this->setting['ppdb_tahun']?> sudah ditutup</p>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>