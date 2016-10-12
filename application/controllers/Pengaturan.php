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

class Pengaturan extends MY_Controller {

   private $pk = 'id';
   private $table = 'options';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      if ($_POST) {
         if ($this->validation()) {
            $data = $this->field_data();
            foreach($data as $key => $value) {
               $check = $this->db->where('variable', $key)->count_all_results('options');
               if ($check == 0) {
                  $this->db->insert('options', ['variable' => $key, 'value' => $value]);
               } else {
                  $this->db->where('variable', $key)->update('options', ['value' => $value]);
               }
            }
            $this->session->set_flashdata('alert', alert('success', status('updated')));
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(uri_string());
      } else {
         $this->data['title'] = 'Pengaturan PPDB Online';
         $this->data['button'] = 'SIMPAN PENGATURAN';
         $this->data['action'] = site_url(uri_string());
         $this->data['ppdb'] = $this->data['set_ppdb'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['content'] = 'ppdb-pengaturan';
         $this->load->view('backend/index', $this->data);
      }
   }

   private function field_data() {
      return [
         'ppdb_tahun' => $this->input->post('ppdb_tahun'),
         'ppdb_status' => $this->input->post('ppdb_status'),
      ];
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('ppdb_tahun', 'Tahun', 'trim|required|numeric|min_length[4]|max_length[4]');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }
}

/* End of file pengaturan.php */
/* Location: ./application/controllers/ppdb/pengaturan.php */