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
        if ($perkelas->num_rows() > 0) {
            $kelas  = [];
            $jumlah = [];
            $i      = 1;
            foreach ($perkelas->result() as $row) {
                $kelas[]  = "'".$row->kelas .' (L = '.$row->L .', P = '.$row->P.')'."'";
                $jumlah[] = $row->jumlah;
                $i++;
            }
            $kelas  = implode(',', $kelas);
            $jumlah = implode(',', $jumlah);
            $width  = 30 * $i;
        ?>
        <strong>GRAFIK SISWA BERDASARKAN JENIS KELAMIN DAN STATUS SISWA AKTIF</strong>
        <br>
        <canvas id="kelas" width="1000%" height="400">[No canvas support]</canvas>
        <script>
            bar = new RGraph.Bar('kelas', [<?=$jumlah?>])
                .Set('background.grid.dashed', true)
                .Set('background.grid.dashed', true)
                .Set('labels.above', true)
                .Set('tooltips', [<?=$kelas?>])
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
        if ($status_siswa->num_rows() > 0) {
        $status = array();
        $jumlah = array();
        $i      = 1;
        
        foreach ($status_siswa->result() as $value)
        {
            $a  = "'";
            $a .= ucfirst(strtolower($value->status_siswa));
            $a .= "'";
            $status[]  = $a;
            $jumlah[] = $value->jumlah;
            $i++;
        }

        $status  = implode(',', $status);
        $jumlah = implode(',', $jumlah);
        $width  = 120 * $i;
        ?>
        <strong>STATISTIK SISWA BERDASARKAN STATUS SISWA</strong>
        <br>
        <canvas id="status" width="<?=$width;?>" height="400">[No canvas support]</canvas>
        <script>
            bar = new RGraph.Bar('status', [<?=$jumlah?>])
                .Set('background.grid.dashed', true)
                .Set('background.grid.dashed', true)
                .Set('labels', [<?=$status?>])
                .Set('labels.above', true)
                .Set('shadow', true)
                .Set('shadow.offsetx', 2)
                .Set('shadow.offsety', 2)
                .Set('shadow.blur', 1)
                .Set('colors', ['Gradient(#2069ff:#2069ff)'])
                .Draw();
        </script>
        <br>
        <?php } ?>
</section>