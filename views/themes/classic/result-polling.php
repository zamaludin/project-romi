<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url();?>assets/chart/RGraph.common.core.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.bar.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.common.tooltips.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.common.dynamic.js" ></script>
<section id="main-content">
	<div class="widget-title">
		<h4><i class="icon-user"></i> HASIL POLLING</h4>
	</div>
	<div class="widget">
        <?php
        if ($query->num_rows() > 0) {
           $jawaban = array();
           $jumlah = array();
           foreach ($query->result() as $value) {
              $jawaban[] = "'" . $value->jawaban . "'";
              $jumlah[] = $value->jumlah;
           }

           $jawaban = implode(',', $jawaban);
           $jumlah = implode(',', $jumlah);
           ?>
            <strong><?=$pertanyaan['pertanyaan'];?></strong>
            <br>
            <canvas id="jawaban" width="673" height="400">[No canvas support]</canvas>
            <script>
                bar = new RGraph.Bar('jawaban', [<?=$jumlah?>])
                    .Set('background.grid.dashed', true)
                    .Set('background.grid.dashed', true)
                    .Set('labels.above', true)
                    .Set('labels', [<?=$jawaban?>])
                    .Set('shadow', true)
                    .Set('shadow.offsetx', 2)
                    .Set('shadow.offsety', 2)
                    .Set('shadow.blur', 1)
                    .Set('colors', ['Gradient(#ff7800:#fab171)'])
                    .Draw();
            </script>
        <?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>