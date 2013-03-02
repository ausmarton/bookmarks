var dummy=0;
$(function(){

	var Bookmark = Backbone.Model.extend({

		urlRoot: "/codeigniter/index.php/bookmarks",

		defaults: function() {
		  return {
				id: null,
				name: null,
				url: null,
				tags: []
		  };
		},
		initialize: function() {
		  if (!this.get("name")) {
		    this.set({"name": this.defaults().name});
		  }
		}

	});

	var BookmarkList = Backbone.Collection.extend({

		model: Bookmark,

		url: "/codeigniter/index.php/bookmarks"

	});

	
	var BookmarkListView = Backbone.View.extend({

		  tagName:'ul',
	 
		  initialize:function () {
		      this.model.bind("reset", this.render, this);
		      var self = this;
		      this.model.bind("add", function (bookmark) {
							$(self.el).append(new BookmarkListItemView({model:bookmark}).render().el);
		      });
		  },
	 
		  render:function (eventName) {
		      _.each(this.model.models, function (bookmark) {
		          $(this.el).append(new BookmarkListItemView({model:bookmark}).render().el);
		      }, this);
		      return this;
		  }
	});

	var BookmarkListItemView = Backbone.View.extend({
	 
		  tagName:"li",
	 
		  template:_.template($('#bookmark-template').html()),

			events:{
		      "dblclick .view":"showEdit"
		  },

			showEdit: function() {
					this.editBookmark = new BookmarkView({model: this.model});
					$(this.el).children('.edit-bookmark').html(this.editBookmark.render().el);
			},
	 
		  initialize:function () {
		      this.model.bind("change", this.render, this);
		      this.model.bind("destroy", this.close, this);
		  },
	 
		  render:function (eventName) {
		      $(this.el).html(this.template(this.model.toJSON()));
		      return this;
		  },
	 
		  close:function () {
		      $(this.el).unbind();
		      $(this.el).remove();
		  }
	});

	var NewBookmarkView = Backbone.View.extend({

		  template:_.template($('#edit-bookmark-template').html()),
	 
		  initialize:function () {
		      this.model.bind("change", this.render, this);
		  },
	 
		  render:function (eventName) {
		      $(this.el).html(this.template(this.model.toJSON()));
		      return this;
		  },
	 
		  events:{
		      "click .save":"saveBookmark"
		  },

			saveBookmark:function () {
      		this.model.set({
          	name:$('header .edit-name:first').val(),
          	url:$('header .edit-url:first').val()
      		});
					app.bookmarks.create(this.model);
					this.model = new Bookmark();
					this.render();
		      return false;
			}

	});

	var BookmarkView = NewBookmarkView.extend({
			events: {
					"click .save":"saveBookmark",
		      "click .delete":"deleteBookmark"
			},

		  deleteBookmark:function () {
		      this.model.destroy({
		          success:function () {
		              alert('Bookmark deleted successfully');
		          }
		      });
		      return false;
		  },
			saveBookmark:function () {
					this.model.set({
		          	name:$(this.el).children('.edit-name').val(),
		          	url:$(this.el).children('.edit-url').val()
		      		});							
          this.model.save();
		      return false;
			},

		  close:function () {
		      $(this.el).unbind();
		      $(this.el).empty();
		  }
	});

	var AppView = Backbone.View.extend({

		  el: $("#bookmarking"),
		
			initialize: function() {
				this.bookmarks = new BookmarkList;
        this.bookmarkListView = new BookmarkListView({model:this.bookmarks});
        this.bookmarks.fetch();
        $('#bookmarks').html(this.bookmarkListView.render().el);
				this.addBookmarkView = new NewBookmarkView({model:new Bookmark()});
				$('#header').html(this.addBookmarkView.render().el);
		  }
	});

	var app = new AppView;

});
