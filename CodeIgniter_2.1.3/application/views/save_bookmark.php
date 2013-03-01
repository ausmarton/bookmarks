<?php include "menu.php" ?>
<?php echo form_open(site_url() . ($type == "edit" ? "/bookmarks/$id":"/bookmarks")) ;?>
	<div>
		<label for="name">Name</label>
		<input id="name" name="name" type="text" size="80" value="<?php echo $name ?>" />	
	</div>
	<div>
		<label for="url">Url</label>
		<input id="url" name="url" type="text" size="80" value="<?php echo $url ?>" />	
	</div>
	<div>
		<label for="tags">Tags</label>
			<?php echo form_multiselect('tags[]',$all_tags,$tags); ?>
	</div>
	<div>
		<input type="submit" />
	</div>
</form>
