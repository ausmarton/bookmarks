<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookmarks extends CI_Controller {
	
    	function __construct()
    	{
        	parent::__construct();
		$this->load->model('Bookmark');
		$this->load->model('Tag');
    	}
//TODO:
	public function tag($tag_name) {
		$tag_model = new Tag();
		$tag_model->where(array('name' => $tag_name));
		$tag = $tag_model->get();
		$data['bookmarks'] = $tag->bookmark->get();
		$this->load->view('bookmarks',$data);
	}

	private function get_JSON($bookmark_models) {
		$bookmarks = array();
		foreach($bookmark_models as $bookmark_model) {
			$tags = array();
			$tag_models = $bookmark_model->tag->get();
			foreach($tag_models as $tag_model)
				$tags[] = array(
					'id' => $tag_model->id,
					'name' => $tag_model->name
				);
			$bookmarks[] = array(
				'id' => $bookmark_model->id,
				'name' => $bookmark_model->name,
				'url' => $bookmark_model->url,
				'tags' => $tags
			);
		}
		return $bookmarks;
	}

	public function get_index()
	{
		$bookmark = new Bookmark();
		$data['bookmarks'] = $bookmark->get();
		echo json_encode($this->get_JSON($data['bookmarks']));
		//$this->load->view('bookmarks',$data);
	}
	private function get_from_JSON() {
		return json_decode(file_get_contents("php://input"), true);
	}
	public function post_create(){
		$bookmark = new Bookmark();
		$this->save($bookmark);
	}
	public function put_update($id){
		$bookmark = new Bookmark();
		$bookmark->id = $id;
		$this->save($bookmark);
	}
	private function save($bookmark) {
		$post_data = $this->get_from_JSON();
		$bookmark->name = $post_data['name'];
		$bookmark->url = $post_data['url'];
		if($bookmark->save()) {
			$bookmark_model = new Bookmark();
			$bookmark = $bookmark_model->get_by_id($bookmark->id);
			$existing_tags = array();
			foreach($bookmark->tag->get() as $tag)
				$existing_tags[] = $tag->id;
			$new_tags = $post_data['tags'];
			$tags_to_be_removed = array_diff($existing_tags, $new_tags);				
			$tags_to_be_added = array_diff($new_tags, $existing_tags);
			foreach($tags_to_be_removed as $id) {
				$tag_model = new Tag();
				$tag = $tag_model->where(array('id' => $id))->get();
				$tag->delete($bookmark);
			}
			foreach($tags_to_be_added as $id) {
				$tag_model = new Tag();
				$tag = $tag_model->where(array('id' => $id))->get();
				$tag->save($bookmark);
			}
			//redirect(site_url() . "/bookmarks/",'location');
		}
	}

	public function get_new()
	{
		$data['type'] = "create";
		$data['name'] = "";
		$data['url'] = "";
		$data['all_tags'] = $this->all_available_tags_for_dropdown();
		$data['tags'] = array();
		$this->load->view('save_bookmark',$data);
	}
	private function all_available_tags_for_dropdown() {
		$all_tags = array();
		$tag_model = new Tag();
		foreach($tag_model->get() as $tag)
			$all_tags[$tag->id] = $tag->name;
		return $all_tags;	
	}

	public function get_edit($id)
	{
		$data['type'] = "edit";
		$this->load->model('bookmark');
		$bookmark_model = new Bookmark();
		$bookmark = $bookmark_model->get_by_id($id);
		
		$tags = array();
		foreach($bookmark->tag->get() as $tag)
			$tags[] = $tag->id;
		$data['tags'] = $tags;
		$data['all_tags'] = $this->all_available_tags_for_dropdown();
		
		$data['id'] = $bookmark->id;
		$data['name'] = $bookmark->name;
		$data['url'] = $bookmark->url;
		$this->load->view('save_bookmark',$data);
	}

	public function delete($id)
	{
		$bookmark = new Bookmark();
		$bookmark->id = $id;
		$bookmark->delete();
			//redirect(site_url() . "/bookmarks/",'location');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
