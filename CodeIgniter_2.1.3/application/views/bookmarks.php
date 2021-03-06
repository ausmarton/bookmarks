<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Bookmarks</title>
  <link rel="stylesheet" href="/codeigniter/application/assets/bookmarks.css"/>
</head>

<body>

  <div id="bookmarking">
		<h2>Add a new Bookmark</h2>
    <header id="header">
    </header>
    <ul>
    	<li>Double click on tags and bookmarks to edit them</li>
    	<li>Use the "<span class="delete-mark">x</span>" and the "<span class="add-mark">+</span>" marks to add or delete tags from bookmarks</li>
    </ul>
    <h2 class="bookmarks">Bookmarks</h2><h2 class="all-tags">All Tags</h2>
    <section id="bookmarks">
    </section>

    <section id="all-tags">
    </section>

  </div>

  <script src="/codeigniter/application/assets/js/json2.js"></script>
  <script src="/codeigniter/application/assets/js/jquery-1.9.1.min.js"></script>
  <script src="/codeigniter/application/assets/js/underscore-min.js"></script>
  <script src="/codeigniter/application/assets/js/backbone-min.js"></script>
<!-- Templates -->

  <script type="text/template" id="bookmark-template">
    <div class="view" >
      <label><%- name %></label>
        <a href="<%-url %>"><%- url %></a>
      </div>
			<ul class="tags"></ul>
			<div class="add-tag"><span class="add-mark">+</span> Tag</div>
    <div class="edit-bookmark">
    </div>
  </script>

  <script type="text/template" id="tag-view-template">
    <p class="tag-view" href="<%- id %>"><%- name %></p>
    <div class="remove-tag delete-mark">x</div>
    <div class="edit-tag-text">
    </div>
  </script>

  <script type="text/template" id="tag-edit-template">
    <input class="edit-tag" type="text" placeholder="Tag Name" value="<%- name %>" />
  </script>

  <script type="text/template" id="edit-bookmark-template">
    <input class="edit-name" type="text" placeholder="Bookmark Name" value="<%- name %>" />
    <input class="edit-url" type="text" placeholder="Bookmark Url" value="<%- url %>" />
    <div>
    	<button class="save">Save</button>
    	<button class="delete">Delete</button>
    </div>
  </script>

  <script src="/codeigniter/application/assets/js/bookmarks.js"></script>

</body>
</html>
