var SwagRouter = Backbone.Router.extend({
	oCategoryList : new Backbone.Collection(),
	oItemList : new Backbone.Collection(),
	oImageList : new Backbone.Collection(),
	nCategoryId: null,
	nProductId: null,
	fNavTemplate : _.template(jQuery('#navTemplate').html()),
	fProductTemplate : _.template(jQuery('#productTemplate').html()),
	fIndicatorTemplate : _.template(jQuery('#indicatorTemplate').html()),
	fImageTemplate : _.template(jQuery('#myCarousel1Template').html()),
	fPreviewTemplate: _.template(jQuery('#previewTemplate').html()),
	initialize : function() {
		this.oCategoryList.url = 'categories/';
		this.oCategoryList.fetch({
			success : jQuery.proxy(this.renderNav, this),
			error : function(collection, err) {
				throw err.status + " " + err.statusText;
			}
		});
		return this;
	},
	renderNav: function(){
		this.oCategoryList.models.forEach(function(oCategory) {
			// we append a single cd into the cdlist div
			jQuery("#navPlaceHolder").append(this.fNavTemplate(oCategory.attributes));
		}, this);
		jQuery("#navPlaceHolder").append(this.fNavTemplate({name: 'about', id: 10001}));
		jQuery("#navPlaceHolder").append(this.fNavTemplate({name: 'contact', id: 10002}));
		Backbone.history.start();

	},
	renderImages: function(){
		var nImage = 0;
		jQuery("#myCarousel1PlaceHolder").html("");
		jQuery("#indicatorPlaceHolder").html("");
		this.oImageList.models.forEach(function(oImage) {
			// we append a single image into #myCarousel1
			oImage.set('title', this.oItemList.get(this.nProductId).get('title'));
			var sActiveClass = "";
			if(nImage == 0){
				sActiveClass = 'active';
			}
			oImage.set('activeClass', sActiveClass);
			jQuery("#indicatorPlaceHolder").append(this.fIndicatorTemplate({nImage: nImage, activeClass: sActiveClass}));
			jQuery("#myCarousel1PlaceHolder").append(this.fImageTemplate(oImage.attributes));
			nImage++;
		}, this);
	},
	renderItem: function(){
		var oItem = this.oItemList.get(this.nProductId);
		jQuery('#productPlaceHolder').html(this.fProductTemplate(oItem.attributes));
		this.oImageList.url = 'categories/' + this.nCategoryId + '/products/' + this.nProductId + '/images/';
		this.oImageList.fetch({
			success : jQuery.proxy(this.renderImages, this),
			error : function(collection, err) {
				throw err.status + " " + err.statusText;
			}
		});			
	},
	renderItems: function(){
		if(!this.nProductId) this.nProductId = this.oItemList.models[0].id;
		this.renderItem();
		var i = 0;
		var curDiv = null;
		jQuery("#myCarousel2PlaceHolder").html("");
		this.oItemList.models.forEach(function(oItem) {
			if(!(i % 4)){
				// then we need to render an item div
				if(curDiv) jQuery("#myCarousel2PlaceHolder").append(curDiv);
				curDiv = jQuery("<div class=\"item\"></div>");
				if(i==0){
					curDiv.addClass("active");
				}
			}
			curDiv.append(this.fPreviewTemplate(oItem.attributes));
			i++;
		}, this);
	},
	routes : {
		"about" : "showAbout",
		"contact": "showContact",
		"(:category)(/:productid)" : "showProduct",
	},
	showProduct : function(nCategoryId, nProductId) {
		jQuery("#product").show();
		jQuery("#contact").hide();
		jQuery("#about").hide();
		jQuery("#home").hide();
		if(nCategoryId == null){
			nCategoryId = this.oCategoryList.at(0).id;
		}else if(isNaN(parseInt(nCategoryId))){
			nCategoryId = this.oCategoryList.findWhere({name: nCategoryId}).id;
		}
		this.nProductId = nProductId;
		if(this.nCategoryId != nCategoryId ){
			this.nCategoryId = nCategoryId;
			this.oItemList.url = 'categories/' + nCategoryId + '/products/';
			this.oItemList.fetch({
				success : jQuery.proxy(this.renderItems, this),
				error : function(collection, err) {
					throw err.status + " " + err.statusText;
				}
			});			
		}else{
			this.renderItem();
		}
	},
	showAbout: function(){
		jQuery("#product").hide();
		jQuery("#contact").hide();
		jQuery("#about").show();
		jQuery("#home").hide();
	},
	showContact: function(){
		jQuery("#product").hide();
		jQuery("#contact").show();
		jQuery("#about").hide();
		jQuery("#home").hide();
	}
});

window.onerror = function(message, file, lineNumber) {
	// all errors will be caught here
	// you can use `message` to make sure it's the error you're looking for
	// returning true overrides the default window behaviour
	jQuery("#errlist").html(
			"File: " + file + " Line: " + lineNumber + " Message: "
					+ message);
	return true;
};

new SwagRouter();