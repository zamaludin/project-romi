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

class why_robotic extends MY_Controller {

   private $pk = 'id';
   private $table = 'options';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      if ($_POST) {
         if ($this->validation()) {
            $this->db->where('variable', 'why_robotic')->update($this->table, ['value' => $this->input->post('why_robotic')]);
            $this->session->set_flashdata('alert', alert('success', status('updated')));
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(uri_string());
      } else {
         $this->data['title'] = 'Why Should Be Robotic?';
         $this->data['button'] = 'UPDATE';
         $this->data['action'] = site_url(uri_string());
         $this->data['module'] = $this->data['kepsek'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['content'] = 'sekolah/why_robotic';
         $this->load->view('backend/index', $this->data);
      }
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('why_robotic', 'Mengapa Harus Robotic?', 'trim');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }
}

/* End of file why_robotic.php */
/* Location: ./application/controllers/why_robotic.php */