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

class Pertanyaan extends MY_Controller {

   private $pk = 'pertanyaan_id';
   private $table = 'pertanyaan';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $this->load->library('pagination');
      $config['base_url'] = site_url('pertanyaan/index');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->count_all_results($this->table);
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
      $this->data['title'] = 'Polling';
      $this->data['module'] = $this->data['polling'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db->get($this->table, $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'polling/read';
      $this->load->view('backend/index', $this->data);
   }

   public function create() {
      if ($_POST) {
         if ($this->validation()) {
            if ($this->db->insert($this->table, $this->field_data())) {
               $id = $this->db->insert_id();
               redirect('jawaban/create/' . $id);
            } else {
               $this->session->set_flashdata('alert', alert('warning', status('existed')));
               redirect(uri_string());
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
            redirect(uri_string());
         }
      } else {
         $this->data['title'] = 'Tambah Polling';
         $this->data['button'] = 'SIMPAN';
         $this->data['action'] = site_url(uri_string());
         $this->data['module'] = $this->data['polling'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = FALSE;
         $this->data['content'] = 'polling/create_question';
         $this->load->view('backend/index', $this->data);
      }
   }

   public function update() {
      $id = $this->uri->segment(3);
      if ($_POST) {
         if ($this->validation()) {
            if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data('update'))) {
               $this->session->set_flashdata('alert', alert('success', status('updated')));
            } else {
               $this->session->set_flashdata('alert', alert('warning', status('existed')));
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(uri_string());
      } elseif ($id && $id != 0 && ctype_digit((string) $id)) {
         $this->data['title'] = 'Edit Polling';
         $this->data['button'] = 'UPDATE';
         $this->data['action'] = site_url(uri_string());
         $this->data['module'] = $this->data['polling'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = $this->m_global->find($this->table, $this->pk, $id)->row_array();
         $this->data['content'] = 'polling/create_question';
         $this->load->view('backend/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect($this->uri->segment(1));
      }
   }

   public function delete() {
      if (isset($_POST['delete']) && isset($_POST[$this->pk])) {
         $n = 0;
         foreach ($_POST[$this->pk] as $key) {
            if ($this->db->where($this->pk, $key)->delete($this->table)) {
               $n++;
            }
         }
         $n > 0 ?
         $this->session->set_flashdata('alert', alert('success', status('deleted'))) :
         $this->session->set_flashdata('alert', alert('info', 'Pertanyaan tidak dapat dihapus! silahkan hapus terlebih dahulu pilihan jawaban dari pertanyaan tersebut.'));
      } else if ($this->uri->segment(3)) {
         if ($this->db->where($this->pk, $this->uri->segment(3))->delete($this->table)) {
            $this->session->set_flashdata('alert', alert('success', status('deleted')));
         } else {
            $this->session->set_flashdata('alert', alert('info', 'Pertanyaan tidak dapat dihapus! silahkan hapus terlebih dahulu pilihan jawaban dari pertanyaan tersebut.'));
         }
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
      }

      redirect($this->uri->segment(1));
   }

   public function set_active() {
      $pertanyaan_id = $this->uri->segment(3);
      $this->db->trans_begin();
      $this->db->query("UPDATE pertanyaan SET status = 'y' WHERE pertanyaan_id = '$pertanyaan_id'");
      $this->db->query("UPDATE pertanyaan SET status = 'n' WHERE pertanyaan_id != '$pertanyaan_id'");
      if ($this->db->trans_status() === FALSE) {
         $this->db->trans_rollback();
         $this->session->set_flashdata('alert', alert('warning', "Pertanyaan tidak dapat diaktifkan"));
      } else {
         $this->db->trans_commit();
         $this->session->set_flashdata('alert', alert('success', "Pertanyaan sudah diaktifkan"));
      }
      redirect($this->uri->segment(1));
   }

   private function field_data() {
      return [
         'pertanyaan' => $this->input->post('pertanyaan'),
      ];
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('pertanyaan', 'Album', 'trim|required');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }
}