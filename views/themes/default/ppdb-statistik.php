<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url();?>assets/chart/RGraph.common.core.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.bar.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.common.tooltips.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.common.dynamic.js" ></script>
<section id="main-content">
	<div class="widget-title">
		<h4><?=strtoupper($title);?> <i class="fa fa-bar-chart"></i></h4>
	</div>
	<div class="widget">
        <div class="form-wrapper">
            <form method="POST" action="<?=site_url('ppdb/statistik/redirect_tahun');?>">
                <ol class="form">
                    <li>
                        <select style="width:auto;" name="tahun" onChange='this.form.submit()'>
                            <option value="">Pilih Tahun :</option>
                            <?php
                            foreach ($q_tahun->result() as $tahun) {
                               echo '<option value="';
                               echo $tahun->tahun;
                               if ($this->uri->segment(4) == $tahun->tahun) {
                                  echo '"selected>';
                               } else {
                                  echo '">';
                               }
                               echo 'Tahun ' . $tahun->tahun;
                               echo '</option>';
                            }
                            ?>
                        </select>
                    </li>
                </ol>

            </form>
        </div>
		<?php
        $bulan = [];
        $jumlah = [];
        $i = 1;
        foreach ($per_bulan->result() as $value) {
           $bulan[] = "'" . bulan($value->bulan) . "'";
           $jumlah[] = $value->jumlah;
           $i++;
        }
        $bulan = implode(',', $bulan);
        $jumlah = implode(',', $jumlah);
        $width = 50 * $i;
        ?>
        <strong>GRAFIK CALON PESERTA DIDIK BARU BERDASARKAN BULAN</strong>
        <br>
        <canvas id="bulan" width="<?=$width;?>" height="400">[No canvas support]</canvas>
        <script>
            bar = new RGraph.Bar('bulan', [<?=$jumlah?>])
                .Set('background.grid.dashed', true)
                .Set('background.grid.dashed', true)
                .Set('labels.above', true)
                .Set('tooltips', [<?=$bulan?>])
                .Set('tooltips.event', 'onmousemove')
                .Set('shadow', true)
                .Set('shadow.offsetx', 2)
                .Set('shadow.offsety', 2)
                .Set('shadow.blur', 1)
                .Set('colors', ['Gradient(#ff7800:#fab171)'])
                .Draw();
        </script>
        <br>

        <?php
        $sekolah_asal = [];
        $jumlah = [];
        foreach ($per_sekolah->result() as $value) {
           $sekolah_asal[] = "'" . $value->sekolah_asal . "'";
           $jumlah[] = $value->jumlah;
        }

        $sekolah_asal = implode(',', $sekolah_asal);
        $jumlah = implode(',', $jumlah);
        ?>
        <strong>GRAFIK CALON PESERTA DIDIK BARU BERDASARKAN ASAL SEKOLAH</strong>
        <br>
        <canvas id="sekolah_asal" width="643" height="400">[No canvas support]</canvas>
        <script>
            bar = new RGraph.Bar('sekolah_asal', [<?=$jumlah?>])
                .Set('background.grid.dashed', true)
                .Set('background.grid.dashed', true)
                .Set('labels.above', true)
                .Set('tooltips', [<?=$sekolah_asal?>])
                .Set('tooltips.event', 'onmousemove')
                .Set('shadow', true)
                .Set('shadow.offsetx', 2)
                .Set('shadow.offsety', 2)
                .Set('shadow.blur', 1)
                .Set('colors', ['Gradient(#9f1d13:#e8392c)'])
                .Draw();
        </script>
        <br>

        <?php
        $jalur = [];
        $jumlah = [];
        $i = 0;

        foreach ($per_jalur->result() as $value) {
           $jalur[] = "'" . $value->jalur_pendaftaran . "'";
           $jumlah[] = $value->jumlah;
           $i++;
        }

        $jalur = implode(',', $jalur);
        $jumlah = implode(',', $jumlah);
        $width = 80 * $i;
        ?>
        <strong>GRAFIK CALON PESERTA DIDIK BARU BERDASARKAN JALUR PENDAFTARAN</strong>
        <br>
        <canvas id="jalur" width="643" height="400">[No canvas support]</canvas>
        <script>
            bar = new RGraph.Bar('jalur', [<?=$jumlah?>])
                .Set('background.grid.dashed', true)
                .Set('background.grid.dashed', true)
                .Set('labels.above', true)
                .Set('labels', [<?=$jalur?>])
                .Set('shadow', true)
                .Set('shadow.offsetx', 2)
                .Set('shadow.offsety', 2)
                .Set('shadow.blur', 1)
                .Set('colors', ['Gradient(#258d20:#49c942)'])
                .Draw();
        </script>
        <br>

        <?php
        $kelamin = [];
        $jumlah = [];

        foreach ($per_kelamin->result() as $value) {
           $kelamin[] = "'" . $value->jenis_kelamin . "'";
           $jumlah[] = $value->jumlah;
        }

        $kelamin = implode(',', $kelamin);
        $jumlah = implode(',', $jumlah);
        ?>
        <strong>GRAFIK CALON PESERTA DIDIK BARU BERDASARKAN JENIS KELAMIN</strong>
        <br>
        <canvas id="kelamin" width="300" height="400">[No canvas support]</canvas>
        <script>
            bar = new RGraph.Bar('kelamin', [<?=$jumlah?>])
                .Set('background.grid.dashed', true)
                .Set('background.grid.dashed', true)
                .Set('labels.above', true)
                .Set('labels', [<?=$kelamin?>])
                .Set('shadow', true)
                .Set('shadow.offsetx', 2)
                .Set('shadow.offsety', 2)
                .Set('shadow.blur', 1)
                .Set('colors', ['Gradient(#0642a6:#2c74ea)'])
                .Draw();
        </script>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>