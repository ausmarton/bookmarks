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
		<div class="name"><?php echo anchor(site_url() . "/bookmarks/edit/" . $bookmark->id ,$bookmark->name); ?></div>
		<div class="url"><?php echo anchor($bookmark->url,$bookmark->url); ?></div>
		<div class="tags">
			<?php // $bookmark->tag->get(); ?>
			<?php foreach($bookmark->tag->get() as $tag) : ?>
				<span class="tag"><?php echo $tag->name ?></span>
			<?php endforeach; ?>
		</div>
		<div class="action"><?php echo anchor(site_url() . "/bookmarks/remove/" . $bookmark->id,"Remove"); ?></div>
	</div>
<?php endforeach; ?>
