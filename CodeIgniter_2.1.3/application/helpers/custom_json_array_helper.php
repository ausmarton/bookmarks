<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('tag_to_array')) {
	function tag_to_array($tag) {
		return array('id' => $tag->id, 'name' => $tag->name);
	}
}

if ( ! function_exists('tags_to_array')) {
	function tags_to_array($tag_models) {
		$tags = array();
		foreach($tag_models as $tag_model) {
			$tags[] = tag_to_array($tag_model);
		}
		return $tags;
	}
}

if ( ! function_exists('bookmark_to_array')) {
	function bookmark_to_array($bookmark_model) {
		return array(
			'id' => $bookmark_model->id,
			'name' => $bookmark_model->name,
			'url' => $bookmark_model->url,
			'tags' => tags_to_array($bookmark_model->tag->get()),
		);
	}
}

if ( ! function_exists('bookmarks_to_array')) {
	function bookmarks_to_array($bookmark_models) {
		$bookmarks = array();
		foreach($bookmark_models as $bookmark_model) {
			$bookmarks[] = bookmark_to_array($bookmark_model);
		}
		return $bookmarks;
	}
}

if ( ! function_exists('get_JSON_HTTP_data')) {
	function get_JSON_HTTP_data() {
		return json_decode(file_get_contents("php://input"), true);
	}
}
