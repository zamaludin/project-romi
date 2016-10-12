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

class Word_filter extends MY_Controller {

   private $pk = 'id';
   private $table = 'options';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      if ($_POST) {
         $this->db->where('variable', 'word_filter')->update($this->table, ['value' => $this->input->post('word_filter')]);
         $this->session->set_flashdata('alert', alert('success', status('updated')));
         redirect(uri_string());
      } else {
         $this->data['title'] = 'Filter Pesan';
         $this->data['button'] = 'SIMPAN';
         $this->data['action'] = site_url(uri_string());
         $this->data['module'] = $this->data['kotak_masuk'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['content'] = 'word_filter';
         $this->load->view('backend/index', $this->data);
      }
   }
}

/* End of file word_filter.php */
/* Location: ./application/controllers/word_filter.php */