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

class Jawaban extends MY_Controller {

   private $pk = 'jawaban_id';
   private $table = 'jawaban';

   public function __construct() {
      parent::__construct();
   }

   public function create() {
      $pertanyaan_id = $this->uri->segment(3);
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
      } elseif ($pertanyaan_id && $pertanyaan_id != 0 && ctype_digit((string) $pertanyaan_id)) {
         $this->data['title'] = 'Tambah Pilihan Jawaban';
         $this->data['button'] = 'SIMPAN';
         $this->data['action'] = site_url(uri_string());
         $this->data['module'] = $this->data['polling'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['pertanyaan'] = $this->m_global->find('pertanyaan', 'pertanyaan_id', $pertanyaan_id)->row_array();
         $this->data['query'] = FALSE;
         $this->data['jawaban'] = $this->db->where('pertanyaan_id', $pertanyaan_id)->get('jawaban');
         $this->data['content'] = 'polling/create_answer';
         $this->load->view('backend/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect('pertanyaan');
      }
   }

   public function delete() {
      $pertanyaan_id = $this->uri->segment(3);
      $jawaban_id = $this->uri->segment(4);
      if ($pertanyaan_id &&
         $pertanyaan_id != 0 &&
         ctype_digit((string) $pertanyaan_id) &&
         $jawaban_id &&
         $jawaban_id != 0 &&
         ctype_digit((string) $jawaban_id)
      ) {
         if ($this->db->where('jawaban_id', $jawaban_id)->delete('jawaban')) {
            $this->session->set_flashdata('alert', alert('success', status('deleted')));
         } else {
            $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
         }
      }
      redirect('jawaban/create/' . $pertanyaan_id);
   }

   private function field_data() {
      return [
         'pertanyaan_id' => $this->uri->segment(3),
         'jawaban' => $this->input->post('jawaban'),
      ];
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('jawaban', 'Jawaban', 'trim|required');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }
}