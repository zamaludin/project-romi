<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url();?>assets/chart/RGraph.common.core.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.bar.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.common.tooltips.js" ></script>
<script src="<?=base_url();?>assets/chart/RGraph.common.dynamic.js" ></script>
<section id="main-content">
	<div class="widget-title">
		<h4><i class="icon-signal"></i> <?=strtoupper($title);?></h4>
	</div>
	<div class="widget">
        <div class="form-wrapper">
            <?php if ($q_tahun->num_rows() > 0) { ?>
            <form method="POST" action="<?=site_url('ppdb-smk/statistik/redirect_tahun');?>">
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
            <?php } ?>
        </div>

        <?php if ($per_bulan->num_rows() > 0) { ?>
        <div class="well well-sm">
    		<?php
        $bulan = array();
        $jumlah = array();
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
        <strong>GRAFIK JUMLAH CALON PESERTA DIDIK BARU BERDASARKAN BULAN DAFTAR</strong>
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
                .Set('colors', ['Gradient(#0642a6:#2c74ea)'])
                .Draw();
        </script>
        </div>
        <?php } ?>

        <?php if ($per_sekolah->num_rows() > 0) { ?>
        <div class="well well-sm">
        <?php
        $sekolah_asal = array();
        $jumlah = array();
        foreach ($per_sekolah->result() as $value) {
          $sekolah_asal[] = "'" . $value->sekolah_asal . "'";
          $jumlah[] = $value->jumlah;
        }

        $sekolah_asal = implode(',', $sekolah_asal);
        $jumlah = implode(',', $jumlah);
        ?>
        <strong>GRAFIK JUMLAH CALON PESERTA DIDIK BARU BERDASARKAN ASAL SEKOLAH</strong>
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
                .Set('colors', ['Gradient(#0642a6:#2c74ea)'])
                .Draw();
        </script>
        </div>
        <?php } ?>

        <?php if ($per_jalur->num_rows() > 0) { ?>
        <div class="well well-sm">
        <?php
        $jalur = array();
        $jumlah = array();
        foreach ($per_jalur->result() as $value) {
         $jalur[] = "'" . $value->jalur_pendaftaran . "'";
          $jumlah[] = $value->jumlah;
        }

       $jalur = implode(',', $jalur);
       $jumlah = implode(',', $jumlah);
       ?>
        <strong>GRAFIK JUMLAH CALON PESERTA DIDIK BARU BERDASARKAN JALUR PENDAFTARAN</strong>
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
                .Set('colors', ['Gradient(#0642a6:#2c74ea)'])
                .Draw();
        </script>
        </div>
        <?php } ?>

        <?php if ($per_pilihan_1->num_rows() > 0) { ?>
        <div class="well well-sm">
        <?php
        $pilihan_satu = array();
        $jumlah = array();

        foreach ($per_pilihan_1->result() as $value) {
          $pilihan_satu[] = "'" . $value->pilihan_satu . "'";
          $jumlah[] = $value->jumlah;
        }

        $pilihan_satu = implode(',', $pilihan_satu);
        $jumlah = implode(',', $jumlah);
        ?>
        <strong>GRAFIK JUMLAH CALON PESERTA DIDIK BARU PER JURUSAN BERDASARKAN PILIHAN PERTAMA</strong>
        <br>
        <canvas id="pilihan_satu" width="643" height="400">[No canvas support]</canvas>
        <script>
            bar = new RGraph.Bar('pilihan_satu', [<?=$jumlah?>])
                .Set('background.grid.dashed', true)
                .Set('background.grid.dashed', true)
                .Set('labels.above', true)
                .Set('tooltips', [<?=$pilihan_satu?>])
                .Set('tooltips.event', 'onmousemove')
                .Set('shadow', true)
                .Set('shadow.offsetx', 2)
                .Set('shadow.offsety', 2)
                .Set('shadow.blur', 1)
                .Set('colors', ['Gradient(#0642a6:#2c74ea)'])
                .Draw();
        </script>
        </div>
        <?php } ?>

        <?php if ($per_pilihan_2->num_rows() > 0) { ?>
        <div class="well well-sm">
        <?php
        $pilihan_dua = array();
        $jumlah = array();

        foreach ($per_pilihan_2->result() as $value) {
          $pilihan_dua[] = "'" . $value->pilihan_dua . "'";
          $jumlah[] = $value->jumlah;
        }

        $pilihan_dua = implode(',', $pilihan_dua);
        $jumlah = implode(',', $jumlah);
        ?>
        <strong>GRAFIK JUMLAH CALON PESERTA DIDIK BARU PER JURUSAN BERDASARKAN PILIHAN KEDUA</strong>
        <br>
        <canvas id="pilihan_dua" width="643" height="400">[No canvas support]</canvas>
        <script>
            bar = new RGraph.Bar('pilihan_dua', [<?=$jumlah?>])
                .Set('background.grid.dashed', true)
                .Set('background.grid.dashed', true)
                .Set('labels.above', true)
                .Set('tooltips', [<?=$pilihan_dua?>])
                .Set('tooltips.event', 'onmousemove')
                .Set('shadow', true)
                .Set('shadow.offsetx', 2)
                .Set('shadow.offsety', 2)
                .Set('shadow.blur', 1)
                .Set('colors', ['Gradient(#0642a6:#2c74ea)'])
                .Draw();
        </script>
        </div>
        <?php } ?>
        <?php if ($per_kelamin->num_rows() > 0) { ?>
        <div class="well well-sm">
        <?php
        $kelamin = array();
        $jumlah = array();

        foreach ($per_kelamin->result() as $value) {
          $kelamin[] = "'" . $value->jenis_kelamin . "'";
          $jumlah[] = $value->jumlah;
        }

        $kelamin = implode(',', $kelamin);
        $jumlah = implode(',', $jumlah);
        ?>
        <strong>GRAFIK JUMLAH CALON PESERTA DIDIK BARU BERDASARKAN JENIS KELAMIN</strong>
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
        <?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>