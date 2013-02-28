<style>
.tag a:link,
.tag a:visited,
.tag a:hover{
	outline: 0;
	text-decoration: none;
}
.tag .name {
	font-size: 1.2em;
}
.tag {
	margin: 1em;
	padding: 0.5em;
	border: 1px solid gray;
}
</style>
<?php foreach($tags as $tag) : ?>
	<div class="tag">
		<div class="name"><?php echo anchor(site_url() . "/bookmarks/tag/" . $tag->id,$tag->name); ?></div>
		<div class="action"><?php echo anchor(site_url() . "/tags/remove/" . $tag->id,"Remove"); ?></div>
	</div>
<?php endforeach; ?>
