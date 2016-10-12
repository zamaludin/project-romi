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

class Users extends MY_Controller {

   private $pk = 'id';
   private $table = 'users';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      if ($this->session->userdata('level') != 'administrator') redirect('dashboard');
      $this->load->library('pagination');
      $config['base_url'] = site_url('users/index');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db
         ->where('level', 'operator')
         ->count_all_results($this->table);
      $config['per_page'] = 10;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'Pengguna';
      $this->data['users'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db
                                 ->where('level', 'operator')
                                 ->get($this->table, $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'users/read';
      $this->load->view('backend/index', $this->data);
   }

   public function create() {
      if ($this->session->userdata('level') != 'administrator') redirect('dashboard');

      if ($_POST) {
         if ($this->validation()) {
            if ($this->db->insert($this->table, $this->field_data())) {
               $this->session->set_flashdata('alert', alert('success', status('created')));
            } else {
               $this->session->set_flashdata('alert', alert('warning', status('existed')));
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(uri_string());
      } else {
         $this->data['title'] = 'Tambah Pengguna';
         $this->data['button'] = 'SIMPAN';
         $this->data['action'] = site_url(uri_string());
         $this->data['users'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = FALSE;
         $this->data['content'] = 'users/profile';
         $this->load->view('backend/index', $this->data);
      }
   }

   public function update() {
      $id = $this->session->userdata('id');
      if ($this->session->userdata('level') == 'administrator') {
         if($this->uri->segment(3)) {
            $id = $this->uri->segment(3);
         }
      }

      if ($_POST) {
         if ($this->validation()) {
            if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data())) {
               $this->session->set_flashdata('alert', alert('success', status('updated')));
            } else {
               $this->session->set_flashdata('alert', alert('warning', status('existed')));
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(uri_string());
      } else {
         $this->data['title'] = 'Profil Pengguna';
         $this->data['button'] = 'SIMPAN';
         if ($this->uri->segment(3)) {
            $this->data['users'] = TRUE;
         }
         $this->data['action'] = site_url(uri_string());
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = $this->m_global->find('users', 'id', $id)->row_array();
         $this->data['content'] = 'users/profile';
         $this->load->view('backend/index', $this->data);
      }
   }

   private function field_data() {
      if (null !== $this->input->post('password')) {
         $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
      }
      $data['username'] = $this->input->post('username');
      $data['email'] = $this->input->post('email');
      $data['display_name'] = $this->input->post('display_name');
      return $data;
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('username', 'Nama Akun', 'trim|required');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('display_name', 'Nama Lengkap', 'trim|required');
      $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|min_length[8]');
      $this->form_validation->set_rules('c_password', 'Ulangi Kata Sandi', 'trim|min_length[8]|matches[password]');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }

   public function delete() {
      if ($this->session->userdata('level') != 'administrator') redirect('dashboard');

      if (isset($_POST['delete']) && isset($_POST[$this->pk])) {
         $n = 0;
         foreach ($_POST[$this->pk] as $key) {
            if ($this->db->where($this->pk, $key)->delete($this->table)) {
               $n++;
            }
         }
         $n > 0 ?
         $this->session->set_flashdata('alert', alert('success', status('deleted'))) :
         $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
      } else if ($this->uri->segment(3)) {
         if ($this->db->where($this->pk, $this->uri->segment(3))->delete($this->table)) {
            $this->session->set_flashdata('alert', alert('success', status('deleted')));
         } else {
            $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
         }
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
      }
      redirect($this->uri->segment(1));
   }
}