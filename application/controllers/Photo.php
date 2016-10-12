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

class Photo extends MY_Controller {

	private $pk = 'photo_id';
	private $table = 'photo';

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->library('pagination');
		$config['base_url'] = site_url('photo/index');
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
		$this->data['title'] = 'Photo';
		$this->data['gallery'] = $this->data['photo'] = TRUE;
		$this->data['alert'] = $this->session->flashdata('alert');
		$this->data['query'] = $this->db
			->select('p.*, a.album')
			->join('album a', 'p.album_id = a.album_id', 'LEFT')
			->get($this->table . ' p', $config['per_page'], $this->uri->segment(3));
		$this->data['content'] = 'photo/read';
		$this->load->view('backend/index', $this->data);
	}

	public function delete() {
		if (isset($_POST[$this->pk]) && isset($_POST['delete'])) {
			$counter = 0;
			foreach ($_POST[$this->pk] as $key) {
				$query = $this->m_global->find($this->table, $this->pk, $key)->row_array();

				if ($this->m_global->delete($this->pk, $key, $this->table)) {
					@unlink('./assets/gallery/' . $query['photo_original']);
					@unlink('./assets/gallery/thumb/' . $query['photo_thumb']);
					$counter++;
				}
			}
			$counter > 0 ?
			$this->session->set_flashdata('alert', alert('success', status('deleted'))) :
			$this->session->set_flashdata('alert', alert('error', status('not_deleted')));
		} elseif ($this->uri->segment(3)) {
			$query = $this->m_global->find($this->table, $this->pk, $this->uri->segment(3))->row_array();
			if ($this->m_global->delete($this->pk, $this->uri->segment(3), $this->table)) {
				@unlink('./assets/gallery/' . $query['photo_original']);
				@unlink('./assets/gallery/thumb/' . $query['photo_thumb']);
				$this->session->set_flashdata('alert', alert('success', status('deleted')));
			} else {
				$this->session->set_flashdata('alert', alert('error', status('not_deleted')));
			}
		} else {
			$this->session->set_flashdata('alert', alert('warning', status('not_selected')));
		}
		redirect($this->uri->segment(1));
	}

	public function upload() {
		$id = $this->uri->segment(3);
		if ($id && $id != 0 && ctype_digit((string) $id)) {
			$album = $this->m_global->find('album', 'album_id', $id)->row();
			$this->data['title'] = 'Upload Album Photo '. $album->album;
			$this->data['alert'] = $this->session->flashdata('alert');
			$this->data['gallery'] = $this->data['album'] = TRUE;
			$this->data['action'] = site_url('photo/do_upload/'.$id);
			$this->data['content'] = 'photo/upload';
			$this->load->view('backend/index', $this->data);
		} else {
			redirect($this->uri->segment(1));
		}
	}

	public function do_upload() {
		$id = $this->uri->segment(3);
		$response = [];
		if ($id && $id != 0 && ctype_digit((string) $id)) {
			$dir = './assets/gallery/thumb';
			create_dir($dir);
			$config['upload_path']   = './assets/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']      = 0;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('file')) {
				$response['action'] = 'validation_errors';
				$response['type'] = 'error';
				$response['message'] = $this->upload->display_errors();
			} else {
				$file = $this->upload->data();
				$data = [
					'photo_original' => $file['file_name'],
					'photo_thumb' => $file['file_name'],
					'album_id' => $id
				];
				$this->db->insert($this->table, $data);              
				$source_image = './assets/';
				$this->resize_photo($source_image, $file['file_name']);
				$response['action'] = 'upload';
				$response['type'] = 'success';
				$response['message'] = 'uploaded';
			}
		} else {
			$response['action'] = 'error';
			$response['type'] = 'error';
			$response['message'] = 'Not initialize ID or ID is not numeric !';
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	  /**
	  * Resize Images
	  */
	 private function resize_photo($source_image, $file_name) {
		$img = config_themes($this->setting['themes']);
		$this->load->library('image_lib');
		$config['image_library']  = 'gd2';
		$config['source_image']   = $source_image.'/'.$file_name;    
		$config['new_image']      = $source_image.'/gallery/thumb/'.$file_name;
		$config['create_thumb']   = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width']          = $img['config']['gallery']['thumb']['width'];
		$config['height']         = $img['config']['posts']['thumb']['height'];
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
		$config['image_library']  = 'gd2';
		$config['source_image']   = $source_image.'/'.$file_name;    
		$config['new_image']      = $source_image.'/gallery/'.$file_name;
		$config['create_thumb']   = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['width']          = $img['config']['gallery']['width'];
		$config['height']         = $img['config']['gallery']['height'];
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
		@unlink('./assets/' . $file_name);
	}
}