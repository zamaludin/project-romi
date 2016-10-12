<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url();?>assets/chart/RGraph.common.core.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.bar.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.common.tooltips.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.common.dynamic.js" ></script>
<section class="content-header">
    <h1><i class="fa fa-file-excel-o text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?php
    if ($status_kepegawaian->num_rows() > 0) {
        $sts_kepegawaian  = [];
        $jumlah = [];
        $i      = 1;
        foreach ($status_kepegawaian->result() as $row) {
            $sts_kepegawaian[]  = "'".status_kepegawaian($row->status_kepegawaian)."'";
            $jumlah[] = $row->jumlah;
            $i++;
        }
        $sts_kepegawaian  = implode(',', $sts_kepegawaian);
        $jumlah = implode(',', $jumlah);
        $width  = 30 * $i;
    ?>
    <strong>GRAFIK PTK BERDASARKAN STATUS KEPEGAWAIAN</strong>
    <br>
    <canvas id="status_kepegawaian" width="1000%" height="400">[No canvas support]</canvas>
    <script>
        bar = new RGraph.Bar('status_kepegawaian', [<?=$jumlah?>])
            .Set('background.grid.dashed', true)
            .Set('background.grid.dashed', true)
            .Set('labels.above', true)
            .Set('tooltips', [<?=$sts_kepegawaian?>])
            .Set('tooltips.event', 'onmousemove')
            .Set('shadow', true)
            .Set('shadow.offsetx', 2)
            .Set('shadow.offsety', 2)
            .Set('shadow.blur', 1)
            .Set('colors', ['Gradient(#ff3d3d:#ff3d3d)'])
            .Draw();
    </script>
    <br>
    <?php } ?>
     <?php
    if ($jenis_ptk->num_rows() > 0) {
        $jns_ptk  = [];
        $jumlah = [];
        $i      = 1;
        foreach ($jenis_ptk->result() as $row) {
            $jns_ptk[]  = "'".jenis_ptk($row->jenis_ptk)."'";
            $jumlah[] = $row->jumlah;
            $i++;
        }
        $jns_ptk  = implode(',', $jns_ptk);
        $jumlah = implode(',', $jumlah);
        $width  = 30 * $i;
    ?>
    <strong>GRAFIK PTK BERDASARKAN JENIS PTK</strong>
    <br>
    <canvas id="jns_ptk" width="1000%" height="400">[No canvas support]</canvas>
    <script>
        bar = new RGraph.Bar('jns_ptk', [<?=$jumlah?>])
            .Set('background.grid.dashed', true)
            .Set('background.grid.dashed', true)
            .Set('labels.above', true)
            .Set('tooltips', [<?=$jns_ptk?>])
            .Set('tooltips.event', 'onmousemove')
            .Set('shadow', true)
            .Set('shadow.offsetx', 2)
            .Set('shadow.offsety', 2)
            .Set('shadow.blur', 1)
            .Set('colors', ['Gradient(#2069ff:#2069ff)'])
            .Draw();
    </script>
    <br>
    <?php } ?>
    <br>
     <?php
    if ($jenis_kelamin->num_rows() > 0) {
        $jns_kelamin  = [];
        $jumlah = [];
        $i      = 1;
        foreach ($jenis_kelamin->result() as $row) {
            $jns_kelamin[]  = "'".$row->jenis_kelamin."'";
            $jumlah[] = $row->jumlah;
            $i++;
        }
        $jns_kelamin  = implode(',', $jns_kelamin);
        $jumlah = implode(',', $jumlah);
        $width  = 30 * $i;
    ?>
    <strong>GRAFIK PTK BERDASARKAN JENIS KELAMIN</strong>
    <br>
    <canvas id="jns_kelamin" width="1000%" height="400">[No canvas support]</canvas>
    <script>
        bar = new RGraph.Bar('jns_kelamin', [<?=$jumlah?>])
            .Set('background.grid.dashed', true)
            .Set('background.grid.dashed', true)
            .Set('labels.above', true)
            .Set('tooltips', [<?=$jns_kelamin?>])
            .Set('tooltips.event', 'onmousemove')
            .Set('shadow', true)
            .Set('shadow.offsetx', 2)
            .Set('shadow.offsety', 2)
            .Set('shadow.blur', 1)
            .Set('colors', ['Gradient(#2069ff:#2069ff)'])
            .Draw();
    </script>
    <?php } ?>
</section>