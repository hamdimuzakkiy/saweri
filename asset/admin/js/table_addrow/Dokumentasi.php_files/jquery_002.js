(function($){
	var className="DefaultText";
	function DefaultText(target){
		if(target) {
			this.init(target);
			if(!this.target.data("init")) 
				this.target.data("init",[]);
			this.target.data("init").push(function(e){
				new DefaultText(e);
			});
		}
	}
	DefaultText.prototype.init=function(target){
		this.className=className;
		this.target=$(target).data(className,this);
		this.defaultText=""+this.target.attr("rel");
		if(this.isDefault()) 
			this.setDefault();
		else 
			this.setNormal();
		this.seed=Math.round(Math.random()*10000);
		this.target.addClass(className+this.seed)
		.closest("form").submit(function(){
			$("input:text",this).each(function(){
				if(typeof $(this).data(className)!="undefined" 
				&& $(this).data(className).isDefault()) 
					$(this).data(className)
					.clear();
			})
		})
	}
	DefaultText.prototype.setDefault=function(){
		this.target
		.css({color:"#AAA"})
		.val(this.defaultText);
	};
	DefaultText.prototype.setNormal=function(){
		this.target
		.css({color:"#000"});
	};
	DefaultText.prototype.clear=function(){
		if(this.target.attr("value")==this.target.attr("rel"))
			this.target
			.css({color:"#000"})
			.attr("value","")
	};
	DefaultText.prototype.isDefault=function(){
		return (this.target.attr("value")==this.target.attr("rel") 
			|| this.target.attr("value")=="")
	};
	DefaultText.prototype.live=function(){
		if (!this.goLive){
			$("."+className+this.seed)
			.live("click",function(){
				if(!$(this).data(className)) new DefaultText(this);
				$(this)
				.unbind("blur")
				.blur(function(){
					if($(this).data(className).isDefault()) 
						$(this).data(className)
						.setDefault();
					else 
						$(this).data(className)
						.setNormal();
				})
				.data(className)
				.clear();
			}).live("keydown",function(){
				if(!$(this).data(className)) new DefaultText(this);
				$(this)
				.unbind("blur")
				.blur(function(){
					if($(this).data(className).isDefault()) 
						$(this).data(className)
						.setDefault();
					else 
						$(this).data(className)
						.setNormal();
				})
				.data(className)
				.clear();
			});
			this.goLive=true;
		}
		return this
	};
	$.fn.addDefaultText=function(){
		this.each(function(){
			new DefaultText(this).live();
		});
		return this
	};
})(jQuery);
