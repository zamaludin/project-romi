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

class Lost_password extends CI_Controller {

   private $pk = 'username';
   private $table = 'users';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      if ($_POST) {
         if ($this->validation()) {
            $email = $this->input->post('email');
            $from = $this->setting['email'];
            $name = $this->setting['site_title'];
            $this->load->library('email');
            $email_setting = array('mailtype' => 'html');
            $this->email->initialize($email_setting);
            $this->email->from($from, $name);
            $this->email->to($email);
            $this->email->subject('Ubah kata sandi');
            $encrypt = sha1(date('Y-m-d') . $email);
            $message = 'Anda kehilangan kata sandi ??? klik ' . anchor('lost_password/reset_password/' . $encrypt, 'disini') . ' untuk mengatur ulang kata sandi website anda! Jika ini adalah kesalahan, abaikan pesan ini.';
            $this->email->message($message);
            if ($this->email->send()) {
               $this->db->where('email', $email)->update('users', array('activation_key' => $encrypt));
               echo 1; // terkirim
            } else {
               echo 2; // tidak terkirim
            }
         } else {
            echo 0; // gagal
         }
      } else {
         $query = $this->db->select('value')->limit(1)->where('variable', 'nama_sekolah')->get('options')->row();
         $data['nama_sekolah'] = $query->value;
         $data['action'] = site_url(uri_string());
         $this->load->view('users/form_send_mail', $data);
      }
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_mail');
      return $this->form_validation->run();
   }

   public function check_mail($email) {
      $query = $this->db->where('email', $email)->get('users');
      if ($query->num_rows() == 1) {
         return TRUE;
      } else {
         $this->form_validation->set_message('check_mail', '%s Email tidak ditemukan!"');
         return FALSE;
      }
   }

   public function reset_password() {
      $activation_key = $this->uri->segment(3);
      if ($_POST) {
         if ($this->password_validation()) {
            echo $this->m_global->update('activation_key', $activation_key, 'users', $this->field_data()) ? 1 : 0;
         } else {
            echo 0;
         }
      } else if ($activation_key) {
         $check = $this->db->where('activation_key', $activation_key)->get('users');
         if ($check->num_rows() == 1) {
            $data['action'] = site_url(uri_string());
            $this->load->view('users/form_reset_password', $data);
         } else {
            redirect(base_url());
         }
      } else {
         redirect(base_url());
      }
   }

   private function field_data() {
      return [
         'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
      ];
   }

   private function password_validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|min_length[8]');
      $this->form_validation->set_rules('c_password', 'Ulangi Kata Sandi', 'trim|min_length[8]|matches[password]');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }
}