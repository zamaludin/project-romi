<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @copyright  (c) 2014-2016
 * @link       http://inorobo.com
 * @since      Version 1.4.7
 *
 * PERINGATAN : 
 * 1. TIDAK DIPERKENANKAN MEMPERJUALBELIKAN APLIKASI INI TANPA SEIZIN DARI PIHAK PENGEMBANG APLIKASI.
 * 2. TIDAK DIPERKENANKAN MENGHAPUS KODE SUMBER APLIKASI.
 * 3. TIDAK MENYERTAKAN LINK KOMERSIL (JASA LAYANAN HOSTING DAN DOMAIN) YANG MENGUNTUNGKAN SEPIHAK.
 */

class MY_Controller extends CI_Controller {

    protected $data = [];
    public $setting = [];

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->setting = $this->m_global->get_options();
        $allowed = [
            'formulir_ppdb/index',
            'ppdb/cetak_formulir',
            'ppdb/registration',
            'ppdb/check',
            'ppdb/statistik',
            'ppdb/confirmation',
            'ppdb/cetak',
            'ppdb-sd/cetak_formulir',
            'ppdb-sd/registration',
            'ppdb-sd/check',
            'ppdb-sd/statistik',            
            'ppdb-sd/confirmation',
            'ppdb-sd/cetak',
            'ppdb-smk/cetak_formulir',
            'ppdb-smk/registration',
            'ppdb-smk/check',
            'ppdb-smk/statistik',
            'ppdb-smk/confirmation',
            'ppdb-smk/cetak',
        ]; 

        if ($this->uri->segment(1) == FALSE 
            || in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $allowed) 
            || $this->uri->segment(1) == 'home') {
            $this->data['silder']        = $this->m_global->posts('post');
            $this->data['prestasi']      = $this->m_global->get_prestasi();
            $this->data['recent_photo']  = $this->m_global->get_recent_photo();
            $this->data['kepsek']        = $this->m_global->get_kepala_sekolah();
            $this->data['banner']        = $this->db->get('banner');
            $this->data['tautan']        = $this->db->get('tautan');
            $this->data['categories']    = $this->m_global->widget_post_category();
            $this->data['archives']      = $this->m_global->widget_archive_posts();
            $this->data['motivation']    = $this->db->get('kata_motivasi');
            $this->data['sekilas_info']  = $this->m_global->posts('sekilas_info');
            $this->data['file_category'] = $this->db->where('parent', 0)->get('file_category');
            $this->data['pertanyaan']    = $this->m_global->find('pertanyaan', 'status', 'y')->row_array();
            $this->data['jawaban']       = $this->m_global->find('jawaban', 'pertanyaan_id', $this->data['pertanyaan']['pertanyaan_id']);
            $this->data['menu']          = json_decode($this->setting['set_menu_label'], true);
        }

        if ($this->uri->segment(1) != FALSE 
            && ! in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $allowed) 
            && $this->uri->segment(1) != 'home') {
            if ( ! $this->auth->is_logged_in() == TRUE) {
                redirect('login');
            }
        }

        $this->data['version']          = $this->config->item('version');
        $this->data['site_title']       = $this->setting['nama_sekolah'];
        $this->data['meta_keywords']    = $this->setting['meta_keywords'];
        $this->data['meta_description'] = $this->setting['meta_description'];
        $this->data['author']           = 'inorobo.com';
        // $this->output->enable_profiler(TRUE);
    }
}