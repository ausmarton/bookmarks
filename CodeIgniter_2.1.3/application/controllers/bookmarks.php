<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookmarks extends CI_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('Bookmark');
		$this->load->model('Tag');
  }
	//TODO: Change this for REST
	public function tag($tag_name) {
		$tag_model = new Tag();
		$tag_model->where(array('name' => $tag_name));
		$tag = $tag_model->get();
		$data['bookmarks'] = $tag->bookmark->get();
		$this->load->view('bookmarks',$data);
	}

	public function index() {
		$this->load->view('bookmarks');
	}

	public function get_index()	{
		$bookmark = new Bookmark();
		$data['bookmarks'] = $bookmark->get();
		echo json_encode(bookmarks_to_array($data['bookmarks']));
	}

	public function post_create() {
		$bookmark = new Bookmark();
		$this->save($bookmark);
	}

	public function put_update($id) {
		$bookmark = new Bookmark();
		$bookmark->id = $id;
		$this->save($bookmark);
	}

	private function save($bookmark) {
		$post_data = get_JSON_HTTP_data();
		$bookmark->name = $post_data['name'];
		$bookmark->url = $post_data['url'];
		if($bookmark->save()) {
			$bookmark_model = new Bookmark();
			$bookmark = $bookmark_model->get_by_id($bookmark->id);
			$existing_tags = array();
			foreach($bookmark->tag->get() as $tag)
				$existing_tags[] = tag_to_array($tag);
			$new_tags = $post_data['tags'];
			$applicable_tags = array_merge_recursive($new_tags,$existing_tags);
			foreach($applicable_tags as $tag_array) {
				$tag_model = new Tag();
				if(trim($tag_array['id']) == "") {
					$tag_model->name = strtolower($tag_array['name']);
					$tag_model->save();
					$tag = $tag_model->where(array('name' => strtolower($tag_array['name'])))->get();
				} else
					$tag = $tag_model->where(array('id' => $tag_array['id']))->get();
				if(in_array($tag_array,$new_tags)) {
				  $tag->save($bookmark);
				} else {
					$tag->delete($bookmark);
				}
			}
			$bookmark = $bookmark->where(array('id' => $bookmark->id))->get();
			echo json_encode(bookmark_to_array($bookmark));
		}
	}

	private function all_available_tags_for_dropdown() {
		$all_tags = array();
		$tag_model = new Tag();
		foreach($tag_model->get() as $tag)
			$all_tags[$tag->id] = $tag->name;
		return $all_tags;	
	}

	public function delete($id)	{
		$bookmark = new Bookmark();
		$bookmark->id = $id;
		$bookmark->delete();
	}
}
