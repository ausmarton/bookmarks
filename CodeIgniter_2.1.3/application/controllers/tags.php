<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('tag');
	}

	private function save($tag) {
		$post_data = get_JSON_HTTP_data();
		$tag->name = strtolower($post_data['name']);
		$tag->save();
		echo json_encode(tag_to_array($tag));
	}

	public function get_index() {
		$tag = new Tag();
		$data['tags'] = $tag->get();
		echo json_encode(tags_to_array($data['tags']));		
	}

	public function post_create() {
		$tag = new Tag();
		$this->save($tag);
	}

	public function put_update($id) {
		$tag = new Tag();
		$tag->id = $id;
		$this->save($tag);
	}

	public function remove($id) {
		$tag = new Tag();
		$tag->id = $this->uri->segment(3);
		if($tag->delete()) {
			redirect(site_url() . "/tags/",'location');
		}
	}
}
