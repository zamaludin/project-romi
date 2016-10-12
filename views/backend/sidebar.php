<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<ul class="sidebar-menu">
    <li>
        <a href="<?=base_url();?>" target="_blank">
            <i class="fa fa-rocket"></i> <span>VISIT SITE</span>
        </a>
    </li>
    <li <?=isset($dashboard) ? 'class="active"' : '';?>>
        <a href="<?=site_url('dashboard');?>">
            <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
        </a>
    </li>
    <li class="treeview <?=isset($setting) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-cogs"></i> <span>PENGATURAN</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($header) ? 'class="active"' : '';?>><a href="<?=site_url('header');?>"><i class="fa fa-image"></i> Header Website</a></li>
            <li <?=isset($sekolah) ? 'class="active"' : '';?>><a href="<?=site_url('sekolah');?>"><i class="fa fa-info-circle"></i> Identitas Sekolah</a></li>
            <li <?=isset($jurusan) ? 'class="active"' : '';?>><a href="<?=site_url('jurusan');?>"><i class="fa fa-random"></i> Jurusan</a></li>
            <li <?=isset($kelas) ? 'class="active"' : '';?>><a href="<?=site_url('kelas');?>"><i class="fa fa-sitemap"></i> Kelas</a></li>
            <li <?=isset($labels) ? 'class="active"' : '';?>><a href="<?=site_url('label');?>"><i class="fa fa-check-square-o"></i> Label Widget</a></li>
            <li <?=isset($mapel) ? 'class="active"' : '';?>><a href="<?=site_url('mata_pelajaran');?>"><i class="fa fa-book"></i> Mata Pelajaran</a></li>
            <li <?=isset($themes) ? 'class="active"' : '';?>><a href="<?=site_url('themes');?>"><i class="fa fa-puzzle-piece"></i> Themes</a></li>
            <li <?=isset($caching) ? 'class="active"' : '';?>><a href="<?=site_url('caching');?>"><i class="fa fa-globe"></i> Web Page Caching</a></li>
        </ul>
    </li>
    <li class="treeview <?=isset($module) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-star-o"></i> <span>MODULE</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($event) ? 'class="active"' : '';?>><a href="<?=site_url('agenda');?>"><i class="fa fa-calendar-o"></i> Agenda</a></li>
            <li <?=isset($banner) ? 'class="active"' : '';?>><a href="<?=site_url('banner');?>"><i class="fa fa-puzzle-piece"></i> Banner</a></li>
            <li <?=isset($polling) ? 'class="active"' : '';?>><a href="<?=site_url('pertanyaan');?>"><i class="fa fa-question-circle"></i> Jajak Pendapat</a></li>
            <li <?=isset($motivasi) ? 'class="active"' : '';?>><a href="<?=site_url('motivasi');?>"><i class="fa fa-comments-o"></i> Kata Motivasi</a></li>
            <li <?=isset($kotak_masuk) ? 'class="active"' : '';?>><a href="<?=site_url('kotak_masuk');?>"><i class="fa fa-envelope"></i> Kotak Masuk</a></li>
            <li <?=isset($pengumuman) ? 'class="active"' : '';?>><a href="<?=site_url('pengumuman');?>"><i class="fa fa-bullhorn"></i> Pengumuman</a></li>
            <li <?=isset($prestasi) ? 'class="active"' : '';?>><a href="<?=site_url('prestasi');?>"><i class="fa fa-trophy"></i> Prestasi</a></li>
            <li <?=isset($kepsek) ? 'class="active"' : '';?>><a href="<?=site_url('why_robotic');?>"><i class="fa fa-microphone"></i> Mengapa Harus Robotic?</a></li>
            <li <?=isset($sekilas_info) ? 'class="active"' : '';?>><a href="<?=site_url('sekilas_info');?>"><i class="fa fa-info-circle"></i> Sekilas Info</a></li>
            <li <?=isset($tautan) ? 'class="active"' : '';?>><a href="<?=site_url('tautan');?>"><i class="fa fa-chain"></i> Tautan</a></li>
        </ul>
    </li>
    <li class="treeview <?=isset($siswa) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-user"></i> <span>PESERTA DIDIK</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($lulus) ? 'class="active"' : '';?>><a href="<?=site_url('siswa/status/lulus');?>"><i class="fa fa-user"></i> Alumni</a></li>
            <li <?=isset($chart_siswa) ? 'class="active"' : '';?>><a href="<?=site_url('siswa/chart');?>"><i class="fa fa-bar-chart"></i> Grafik Siswa</a></li>
            <li <?=isset($import_siswa) ? 'class="active"' : '';?>><a href="<?=site_url('siswa/import');?>"><i class="fa fa-file-excel-o"></i> Import Data Siswa</a></li>
            <li <?=isset($naik_kelas) ? 'class="active"' : '';?>><a href="<?=site_url('naik_kelas');?>"><i class="fa fa-level-up"></i> Kenaikan Kelas</a></li>
            <li <?=isset($set_kelas) ? 'class="active"' : '';?>><a href="<?=site_url('set_kelas');?>"><i class="fa fa-wrench"></i> Pengaturan Kelas</a></li>
            <li <?=isset($aktif) ? 'class="active"' : '';?>><a href="<?=site_url('siswa/status/aktif');?>"><i class="fa fa-check-square-o"></i> Siswa Aktif</a></li>
            <li <?=isset($dropout) ? 'class="active"' : '';?>><a href="<?=site_url('siswa/status/dropout');?>"><i class="fa fa-external-link"></i> Siswa Drop Out</a></li>
            <li <?=isset($pindah) ? 'class="active"' : '';?>><a href="<?=site_url('siswa/status/pindah');?>"><i class="fa fa-mail-forward"></i> Siswa Pindah Sekolah</a></li>
            <li <?=isset($add_siswa) ? 'class="active"' : '';?>><a href="<?=site_url('siswa/create');?>"><i class="fa fa-plus"></i> Tambah Data Siswa</a></li>
        </ul>
    </li>
    <li class="treeview <?=isset($ptk) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-user"></i> <span>DIREKTORI PTK</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($ptk_list) ? 'class="active"' : '';?>><a href="<?=site_url('ptk');?>"><i class="fa fa-users"></i> Daftar PTK</a></li>
            <li <?=isset($ptk_input) ? 'class="active"' : '';?>><a href="<?=site_url('ptk/create');?>"><i class="fa fa-plus"></i> Tambah Data PTK</a></li>
            <li <?=isset($ptk_import) ? 'class="active"' : '';?>><a href="<?=site_url('ptk/import');?>"><i class="fa fa-file-excel-o"></i> Import Data PTK</a></li>
            <li <?=isset($ptk_chart) ? 'class="active"' : '';?>><a href="<?=site_url('ptk/chart');?>"><i class="fa fa-bar-chart"></i> Grafik Data PTK</a></li>
        </ul>
    </li>
    <?php if ($this->setting['jenjang'] == 'SMK' && is_dir(APPPATH . 'controllers/ppdb-smk')) {?>
    <li class="treeview <?=isset($ppdb) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-cog"></i> <span>PPDB ONLINE</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($pendaftar) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb-smk/siswa');?>"><i class="fa fa-user"></i> Data Pendaftar</a></li>
            <li <?=isset($jalur_pendaftaran) ? 'class="active"' : '';?>><a href="<?=site_url('jalur_pendaftaran');?>"><i class="fa fa-code-fork"></i> Jalur Pendaftaran</a></li>
            <li <?=isset($set_ppdb) ? 'class="active"' : '';?>><a href="<?=site_url('pengaturan');?>"><i class="fa fa-wrench"></i> Pengaturan</a></li>
            <li <?=isset($seleksi) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb-smk/seleksi');?>"><i class="fa fa-filter"></i> Proses Seleksi</a></li>
            <li <?=isset($diterima) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb-smk/hasil_seleksi/diterima');?>"><i class="fa fa-check-square-o"></i> Siswa Diterima</a></li>
            <li <?=isset($tidak_diterima) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb-smk/hasil_seleksi/tidak_diterima');?>"><i class="fa fa-times"></i> Siswa Tidak Diterima</a></li>
            <li <?=isset($statistik) ? 'class="active"' : '';?>><a target="_blank" href="<?=site_url('ppdb-smk/statistik');?>"><i class="fa fa-bar-chart-o"></i> Statistik Pendaftaran</a></li>
            <li <?=isset($verifikasi) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb-smk/verifikasi');?>"><i class="fa fa-folder-open-o"></i> Verifikasi Pendaftaran</a></li>
        </ul>
    </li>
    <?php }
?>

    <?php if ($this->setting['jenjang'] == 'SD' && is_dir(APPPATH . 'controllers/ppdb-sd')) {?>
    <li class="treeview <?=isset($ppdb) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-cog"></i> <span>PPDB ONLINE</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li <?=isset($pendaftar) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb-sd/siswa');?>"><i class="fa fa-user"></i> Data Pendaftar</a></li>
            <li <?=isset($jalur_pendaftaran) ? 'class="active"' : '';?>><a href="<?=site_url('jalur_pendaftaran');?>"><i class="fa fa-code-fork"></i> Jalur Pendaftaran</a></li>
            <li <?=isset($set_ppdb) ? 'class="active"' : '';?>><a href="<?=site_url('pengaturan');?>"><i class="fa fa-wrench"></i> Pengaturan</a></li>
            <li <?=isset($seleksi) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb-sd/seleksi');?>"><i class="fa fa-filter"></i> Proses Seleksi</a></li>
            <li <?=isset($diterima) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb-sd/hasil_seleksi/diterima');?>"><i class="fa fa-check-square-o"></i> Siswa Diterima</a></li>
            <li <?=isset($tidak_diterima) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb-sd/hasil_seleksi/tidak_diterima');?>"><i class="fa fa-times"></i> Siswa Tidak Diterima</a></li>
            <li <?=isset($statistik) ? 'class="active"' : '';?>><a target="_blank" href="<?=site_url('ppdb-sd/statistik');?>"><i class="fa fa-bar-chart-o"></i> Statistik Pendaftaran</a></li>
            <li <?=isset($verifikasi) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb-sd/verifikasi');?>"><i class="fa fa-folder-open-o"></i> Verifikasi Pendaftaran</a></li>
        </ul>
    </li>
    <?php }
?>

    <?php if ($this->setting['jenjang'] == 'SMP' || $this->setting['jenjang'] == 'SMA' && is_dir(APPPATH . 'controllers/ppdb')) {?>
    <li class="treeview <?=isset($ppdb) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-cog"></i> <span>PPDB ONLINE</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($pendaftar) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb/siswa');?>"><i class="fa fa-user"></i> Data Pendaftar</a></li>
            <li <?=isset($jalur_pendaftaran) ? 'class="active"' : '';?>><a href="<?=site_url('jalur_pendaftaran');?>"><i class="fa fa-code-fork"></i> Jalur Pendaftaran</a></li>
            <li <?=isset($set_ppdb) ? 'class="active"' : '';?>><a href="<?=site_url('pengaturan');?>"><i class="fa fa-wrench"></i> Pengaturan</a></li>
            <li <?=isset($seleksi) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb/seleksi');?>"><i class="fa fa-filter"></i> Proses Seleksi</a></li>
            <li <?=isset($diterima) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb/hasil_seleksi/diterima');?>"><i class="fa fa-check-square-o"></i> Siswa Diterima</a></li>
            <li <?=isset($tidak_diterima) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb/hasil_seleksi/tidak_diterima');?>"><i class="fa fa-times"></i> Siswa Tidak Diterima</a></li>
            <li <?=isset($statistik) ? 'class="active"' : '';?>><a target="_blank" href="<?=site_url('ppdb/statistik');?>"><i class="fa fa-bar-chart-o"></i> Statistik Pendaftaran</a></li>
            <li <?=isset($verifikasi) ? 'class="active"' : '';?>><a href="<?=site_url('ppdb/verifikasi');?>"><i class="fa fa-folder-open-o"></i> Verifikasi Pendaftaran</a></li>
        </ul>
    </li>
    <?php }
?>

    <li class="treeview <?=isset($posts) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-thumb-tack"></i> <span>POSTS</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($add_post) ? 'class="active"' : '';?>><a href="<?=site_url('posts/create');?>"><i class="fa fa-plus"></i> Add New</a></li>
            <li <?=isset($post) ? 'class="active"' : '';?>><a href="<?=site_url('posts');?>"><i class="fa fa-list"></i> All Posts</a></li>
            <li <?=isset($categories) ? 'class="active"' : '';?>><a href="<?=site_url('category');?>"><i class="fa fa-tags"></i> Categories</a></li>
        </ul>
    </li>
    <li class="treeview <?=isset($pages) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-files-o"></i> <span>PAGES</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($add_page) ? 'class="active"' : '';?>><a href="<?=site_url('pages/create');?>"><i class="fa fa-plus"></i> Add New</a></li>
            <li <?=isset($page) ? 'class="active"' : '';?>><a href="<?=site_url('pages');?>"><i class="fa fa-list"></i> All Pages</a></li>
            <li <?=isset($page_order) ? 'class="active"' : '';?>><a href="<?=site_url('pages/page_order');?>"><i class="fa fa-sort-alpha-asc"></i> Page Order</a></li>
        </ul>
    </li>
    <li class="treeview <?=isset($files) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-upload"></i> <span>UPLOAD FILE</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($file) ? 'class="active"' : '';?>><a href="<?=site_url('file');?>"><i class="fa fa-paperclip"></i> File</a></li>
            <li <?=isset($file_category) ? 'class="active"' : '';?>><a href="<?=site_url('file_category');?>"><i class="fa fa-bars"></i> Kategori</a></li>
        </ul>
    </li>
    <li class="treeview <?=isset($gallery) ? 'active' : '';?>">
        <a href="#">
            <i class="fa fa-picture-o"></i> <span>GALLERY</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($album) ? 'class="active"' : '';?>><a href="<?=site_url('album');?>"><i class="fa fa-folder-open-o"></i> Album</a></li>
            <li <?=isset($photo) ? 'class="active"' : '';?>><a href="<?=site_url('photo');?>"><i class="fa fa-camera"></i> Photo</a></li>
            <li <?=isset($video) ? 'class="active"' : '';?>><a href="<?=site_url('video');?>"><i class="fa fa-film"></i> Video</a></li>
        </ul>
    </li>
    <?php if ($this->session->userdata('level') == 'administrator') { ?>
    <li>
        <a href="<?=site_url('backup');?>">
            <i class="fa fa-database"></i> <span>BACKUP DATABASE</span>
        </a>
    </li>
    <?php } ?>
    <?php if ($this->session->userdata('level') == 'administrator') { ?>
    <li <?=isset($users) ? 'class="active"' : '';?>>
        <a href="<?=site_url('users');?>">
            <i class="fa fa-user"></i> <span>PENGGUNA</span>
        </a>
    </li>
    <?php } ?>
</ul>