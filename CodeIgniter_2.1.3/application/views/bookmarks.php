<style>
.bookmark a:link,
.bookmark a:visited,
.bookmark a:hover{
	outline: 0;
	text-decoration: none;
}
.bookmark .name {
	font-size: 1.2em;
}
.bookmark .url {
	font-size: 1em;
}
.bookmark {
	margin: 1em;
	padding: 0.5em;
	border: 1px solid gray;
}
.bookmark .tags {
	margin: 0.2em;
}
.bookmark .tags .tag {
	padding: 0 0.3em;
	border: 1px solid gray;
	background-color: #ddd;
}
</style>
<?php include "menu.php"; ?>
<?php foreach($bookmarks as $bookmark) : ?> 
	<div class="bookmark">
		<div class="name"><?php echo anchor(site_url() . "/bookmarks/" . $bookmark->id ."/edit",$bookmark->name); ?></div>
		<div class="url"><?php echo anchor($bookmark->url,$bookmark->url); ?></div>
		<div class="tags">
			<?php // $bookmark->tag->get(); ?>
			<?php foreach($bookmark->tag->get() as $tag) : ?>
				<span class="tag"><?php echo $tag->name ?></span>
			<?php endforeach; ?>
		</div>
		<form action="<?php echo site_url() . "/bookmarks/" . $bookmark->id . "/delete"; ?>" method="POST">
			<input type="submit" value="Remove"></input>
		</form>
	</div>
<?php endforeach; ?>
