<script type="text/javascript" src="<?php echo base_url() ?>application/assets/js/jquery-1.9.1.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/assets/js/underscore-min.js" ></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/assets/js/json2.js" ></script>
<script type="text/javascript" src="<?php echo base_url() ?>application/assets/js/backbone-min.js" ></script>
<div class="menu">
	<?php echo anchor(site_url() . "/bookmarks/","All Bookmarks") ?>
	<?php echo anchor(site_url() . "/bookmarks/new","+Add Bookmark") ?>
	<?php echo anchor(site_url() . "/tags/","All Tags") ?>
	<?php echo anchor(site_url() . "/tags/add","+Add Tag") ?>
</div>
