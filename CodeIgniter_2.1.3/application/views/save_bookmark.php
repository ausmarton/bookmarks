<?php include "menu.php" ?>
<?php echo form_open(site_url() . "/bookmarks/save") ;?>
	<?php if($type == "edit") : ?>
		<div>
			<label for="id">Id</label>
			<input id="id" name="id" type="text" size="5" value="<?php echo $id ?>" readonly="true" />	
		</div>
	<?php endif ?>
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
			<?php echo form_multiselect('tags',$all_tags,$tags); ?>
	</div>
	<div>
		<input type="submit" />
	</div>
</form>
