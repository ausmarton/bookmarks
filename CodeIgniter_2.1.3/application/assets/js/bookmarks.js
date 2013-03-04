$(function(){

  var Tag = Backbone.Model.extend({
    urlRoot: "/codeigniter/index.php/tags",
    defaults: function() {
      return {
        id: null,
        name: null
      };
    },
    initialize: function() {
      if (!this.get("name")) {
        this.set({"name": this.defaults().name});
      }
    }
  });

  var TagList = Backbone.Collection.extend({

    model: Tag,

    url: "/codeigniter/index.php/tags"

  });

	var TagListView = Backbone.View.extend({

		  tagName:'ul',
	 
		  initialize:function () {
		      this.model.bind("reset", this.render, this);
		      var self = this;
		      this.model.bind("add", function (tag) {
				$(self.el).append(new TagListItemView({model:tag}).render().el);
		      });
		  },
	 
		  render:function (eventName) {
		      _.each(this.model.models, function (tag) {
		          $(this.el).append(new TagListItemView({model:tag}).render().el);
		      }, this);
		      return this;
		  }
	});

  var TagListItemView = Backbone.View.extend({

    tagName:"li",

    template:_.template($('#tag-view-template').html()),

    events:{
      "dblclick .tag-view"  : "showEdit",
      "click .remove-tag" : "removeTag"
    },

		removeTag: function() {
			if(this.bookmark != undefined) {
				var existing_tags = this.bookmark.get('tags');
				existing_tags.splice(existing_tags.indexOf(this.model),1);
				this.bookmark.set({tags: existing_tags});
				this.bookmark.save();
				this.close();
			}
		},

    showEdit: function() {
      this.editTag = new TagView({model: this.model});
      $(this.el).children('.edit-tag-text').html(this.editTag.render().el);
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

  var TagView = Backbone.View.extend({

    template:_.template($('#tag-edit-template').html()),

    initialize:function () {
      this.model.bind("change", this.render, this);
    },

    render:function (eventName) {
      $(this.el).html(this.template(this.model.toJSON()));
      return this;
    },

    events: {
      "keypress .edit-tag"  : "updateOnEnter",
      "blur .edit-tag"      : "saveTag"
    },
    saveTag:function () {
      if(this.model.isNew()) {
        this.model.set({
          name:$('header .edit-tag:first').val(),				  	
        });
        app.allTags.create(this.model);
        this.model = new Tag();
        this.render();
      } else {
        this.model.set({
          name:$(this.el).children('.edit-tag').val()
        });							
        this.model.save();
      }
      return false;
    },
    
    updateOnEnter: function(e) {
      if (e.keyCode == 13) this.saveTag();
    },

    close:function () {
      $(this.el).unbind();
      $(this.el).empty();
    }
  });

	var AddTagView = TagView.extend({
		events: {
      "keypress .edit-tag"  : "updateOnEnter"
    },

		saveTag:function () {
			var tag_name = $(this.el).children('.edit-tag').val();
			var matching_tags = app.allTags.where({name: tag_name});
			if(matching_tags.length == 0) {
				this.model = new Tag();
        this.model.set({
          name:tag_name, 	
        });
      } else {
				this.model = matching_tags[0];
      }
			this.bookmark.get('tags').push(this.model);
			this.bookmark.save();
			this.bookmarkListItemView.render();
    },

		updateOnEnter: function(e) {
      if (e.keyCode == 13) this.saveTag();
    },

    close:function () {
      $(this.el).unbind();
      $(this.el).empty();
    }
	});

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
      "dblclick .view":"showEdit",
			"dblclick .add-tag":"showAddTag"
    },

    showAddTag: function() {
			this.showAddTag = new AddTagView({model: new Tag()});
			this.showAddTag.bookmark = this.model;
			this.showAddTag.bookmarkListItemView = this;
			$(this.el).children('.add-tag').html(this.showAddTag.render().el);
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
			this.tags = this.model.get('tags');
      $(this.el).html(this.template(this.model.toJSON()));
			for(var index in this.tags) {
				var tag = app.allTags.get(this.tags[index]['id']);
				var tagListItemView = new TagListItemView({model:tag});
				tagListItemView.bookmark = this.model;
				this.$('.tags').append(tagListItemView.render().el);
			}
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
      "click .save":"saveBookmark",
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

		render:function (eventName) {
			$(this.el).html(this.template(this.model.toJSON()));
			return this;
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
      this.allTags = new TagList;
      this.allTagsListView = new TagListView({model: this.allTags});
      this.allTags.fetch();
      $('#all-tags').html(this.allTagsListView.render().el);


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
