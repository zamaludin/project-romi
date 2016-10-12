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

class Login extends CI_Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      if ($this->auth->is_logged_in() == TRUE) {
         redirect('dashboard');
      }
      if ($_POST) {
         sleep(1);
         if ($this->validation()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            echo $this->auth->login($username, $password) ? 1 : 0;
         } else {
            echo 0;
         }
      } else {
         $query = $this->db->select('value')->limit(1)->where('variable', 'nama_sekolah')->get('options')->row();
         $data['nama_sekolah'] = $query->value;
         $data['action'] = site_url(uri_string());
         $this->load->view('users/form_login', $data);
      }
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('username', 'Nama Akun', 'trim|required');
      $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required');
      $this->form_validation->set_error_delimiters('<i class="icon-remove-sign"></i> ', '<br>');
      return $this->form_validation->run();
   }
}