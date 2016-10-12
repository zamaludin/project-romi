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

class File extends MY_Controller {

	private $pk = 'id';
	private $table = 'file';

	public function __construct() {
      parent::__construct();
   }

	public function index() {
		$this->load->library('pagination');
		$limit = 10;
		!$this->uri->segment(3) ? $offset = 0 : $offset = $this->uri->segment(3);
		$config['base_url'] = site_url('file/index');
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->db->count_all_results($this->table);
		$config['per_page'] = $limit;
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
		$this->data['title'] = 'File';
		$this->data['files'] = $this->data['file'] = TRUE;
		$this->data['alert'] = $this->session->flashdata('alert');
		$this->data['query'] = $this->db->query(
			"SELECT f.*,
                  IF(c.parent != 0, CONCAT((SELECT category FROM file_category WHERE category_id = c.parent), SPACE(1), c.category), c.category) AS category
           FROM file f
           LEFT JOIN file_category c ON c.category_id = f.category_id
           LIMIT $offset, $limit"
		);
		$this->data['content'] = 'file/read';
		$this->load->view('backend/index', $this->data);
	}

	public function create() {
		if ($_POST) {
			if ($this->validation()) {
				$file = $this->upload();
				if ($file['status'] == 'success') {
					if ($this->db->insert($this->table, $this->field_data($file['data']))) {
						$this->session->set_flashdata('alert', alert('success', status('created')));
					} else {
						if (file_exists('./assets/files/' . $file['data']['file_name'])) {
							unlink('./assets/files/' . $file['data']['file_name']);
						}
						$this->session->set_flashdata('alert', alert('warning', status('existed')));
					}
				} else {
					$this->session->set_flashdata('alert', alert('error', $file['data']));
				}
			} else {
				$this->session->set_flashdata('alert', alert('error', validation_errors()));
			}
			redirect(uri_string());
		} else {
			$this->data['title'] = 'Tambah File';
			$this->data['button'] = 'SIMPAN';
			$this->data['action'] = site_url(uri_string());
			$this->data['files'] = $this->data['file'] = TRUE;
			$this->data['alert'] = $this->session->flashdata('alert');
			$this->data['category'] = $this->file_category();
			$this->data['query'] = FALSE;
			$this->data['content'] = 'file/create';
			$this->load->view('backend/index', $this->data);
		}
	}

	public function update() {
		$id = $this->uri->segment(3);
		if ($_POST) {
			if ($this->validation()) {
				if (empty($_FILES['file']['name'])) {
					if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data())) {
						$this->session->set_flashdata('alert', alert('success', status('updated')));
					} else {
						$this->session->set_flashdata('alert', alert('warning', status('existed')));
					}
				} else {
					$file = $this->upload();
					if ($file['status'] == 'success') {
						$query = $this->m_global->find($this->table, $this->pk, $id)->row_array();
						$old_file = $query['file'];
						if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data($file['data']))) {
							if (file_exists('./assets/files/' . $old_file)) {
								unlink('./assets/files/' . $old_file);
							}
							$this->session->set_flashdata('alert', alert('success', status('created')));
						} else {
							if (file_exists('./assets/files/' . $file['data']['file_name'])) {
								unlink('./assets/files/' . $file['data']['file_name']);
							}
							$this->session->set_flashdata('alert', alert('warning', status('existed')));
						}
					} else {
						$this->session->set_flashdata('alert', alert('error', $file['data']));
					}
				}
			} else {
				$this->session->set_flashdata('alert', alert('error', validation_errors()));
			}
			redirect(uri_string());
		} elseif ($id && $id != 0 && ctype_digit((string) $id)) {
			$this->data['title'] = 'Edit File';
			$this->data['button'] = 'UPDATE';
			$this->data['action'] = site_url(uri_string());
			$this->data['files'] = $this->data['file'] = TRUE;
			$this->data['alert'] = $this->session->flashdata('alert');
			$this->data['category'] = $this->file_category();
			$this->data['query'] = $this->m_global->find($this->table, $this->pk, $id)->row_array();
			$this->data['content'] = 'file/create';
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
				$file = $this->m_global->find($this->table, $this->pk, $key)->row_array();
				if ($this->db->where($this->pk, $key)->delete($this->table)) {
					if (file_exists('./assets/berkas/' . $file['file'])) {
						unlink('./assets/berkas/' . $file['file']);
					}
					$n++;
				}
			}
			$n > 0 ?
			$this->session->set_flashdata('alert', alert('success', status('deleted'))) :
			$this->session->set_flashdata('alert', alert('info', status('not_deleted')));
		} else if ($this->uri->segment(3)) {
			$file = $this->m_global->find($this->table, $this->pk, $this->uri->segment(3))->row_array();
			if ($this->db->where($this->pk, $this->uri->segment(3))->delete($this->table)) {
				if (file_exists('./assets/berkas/' . $file['file'])) {
					unlink('./assets/berkas/' . $file['file']);
				}
				$this->session->set_flashdata('alert', alert('success', status('deleted')));
			} else {
				$this->session->set_flashdata('alert', alert('info', status('not_deleted')));
			}
		} else {
			$this->session->set_flashdata('alert', alert('warning', status('not_selected')));
		}
		redirect($this->uri->segment(1));
	}

	private function field_data($file = '') {
		$data['category_id'] = $this->input->post('category_id');
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['access'] = $this->input->post('access');
		if ($file != '') {
			$data['type'] = $file['file_ext'];
			$data['size'] = $file['file_size'];
			$data['file'] = $file['file_name'];
		}
		return $data;
	}

	private function validation() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_error_delimiters('', '<br>');
		return $this->form_validation->run();
	}

	private function upload() {
		create_dir('./assets/berkas/');
		$config['upload_path'] = './assets/berkas/';
		$config['allowed_types'] = '*';
		$config['max_size'] = 0;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('file')) {
			return [
				'status' => 'error',
				'data' => $this->upload->display_errors(),
			];
		} else {
			$data = $this->upload->data();
			return [
				'status' => 'success',
				'data' => $this->upload->data(),
			];
		}
	}

	/**
	 * dropdown()
	 * Fungsi untuk membuat form dropdown
	 * @return array
	 */
	public function file_category() {
		$query = $this->db
			->select('category_id, category')
			->where('parent', 0)
			->get('file_category');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[$row->category_id] = $row->category;
				$child = $this->db
					->select('category_id, category')
					->where('parent', $row->category_id)
					->get('file_category');
				foreach ($child->result() as $key) {
					$data[$key->category_id] = '- - - ' . $row->category . ' ' . $key->category;
				}
			}
			return $data;
		}
		return [];
	}
}

/* End of file file.php */
/* Location: ./application/controllers/file.php */