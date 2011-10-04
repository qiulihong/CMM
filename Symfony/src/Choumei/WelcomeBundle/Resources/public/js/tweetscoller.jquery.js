var cur=0;
var tweets_array=Array();
var obj;
var limit=0;
var stopFirstTimer=false;
var tempLimit=0;
var intervalLimit=0;
(function($){
	//Attach this new method to jQuery
	$.fn.extend({
		hycustweetscroller:function(options)
		{
			 var defaults = {
				startstop: false,
				limit:10,
				move:'down'
			 };
			options=$.extend({},defaults,options);
 			limit=options.limit;

			return this.each(function()
			{
				obj = $(this).attr("id");

				if(!obj)
					obj="."+$(this).attr('class');
				else
					obj="#"+$(this).attr(id);

				if(limit=='unlimited')
					intervalLimit=20;
				else
					intervalLimit=limit;

				//var first_child=$(this+" div:#tweet_container")
				$.ajax({
					type:"post",
					//url:"/top-users",
					url:"/latest-flowers",
					data: "lim="+limit,
					success:function(msg){
						tweets_array=msg.split("~");
						limit=tweets_array.length;
						tempLimit=limit;
						while(tempLimit>6)
						{
							tempLimit--;
						}
						if(options.move=='down')
							tempLimit+=1;

						while(cur<tempLimit)
						{
							var msg1="<div id='tweet_container'><div id='tweet-content'>"+tweets_array[cur]+"</div></div>";
							$(obj).prepend(msg1);
							cur++;
						}
					}
				});
				cur=1;

				//alert(tempLimit);
				$(this).hover(function(){
					if(options.startstop)
					{
						clearInterval(tweet_scroller_time);
						clearInterval(tweet_get_time=setInterval);
					}
					stopFirstTimer=true;
				});
				$(this).mouseleave(function(){

					if(options.move=='down')
					{
						tweet_scroller_time=setInterval('if(cur==limit)cur=0;  $(obj+" div:last").remove();var msg1="<div id=\'tweet_container\' style=\'display:none;\'></div>";var msg2="<div id=\'tweet-content\' style=\'display:none;\'>"+tweets_array[cur]+"</div>";$(obj).prepend(msg1);$(obj+" div:#tweet_container").slideDown(1500);$(obj+" div:#tweet_container").prepend(msg2);show_now_timer=setTimeout(\'$(obj+" div:#tweet_container div").fadeIn();\',1500);$(obj+" div:last").remove();cur++;', 4000);
					}
					else
						tweet_scroller_time=setInterval('if(cur<0)cur=limit; var msg1="<div id=\'tweet_container\' style=\'display:none;\'></div>";var msg2="<div id=\'tweet-content\' style=\'display:none;\'>"+tweets_array[cur]+"</div>";$(obj).append(msg1);$(obj+">div:first").empty();$(obj+">div:first").slideUp(1500);$(obj+">div:last").slideDown();$(obj+" div:last").prepend(msg2);show_now_timer=setTimeout(\'$(obj+" div:#tweet_container div").fadeIn();\',1500);cur--;setTimeout(\'$(obj+" div:first").remove();\',2000)', 4000);
				});

				if(stopFirstTimer==false)
				{
					if(options.move=='down')
					{
						//show tweet one by one
						tweet_scroller_time=setInterval('if(cur==limit)cur=0;$(obj+" div:last").remove();var msg1="<div id=\'tweet_container\' style=\'display:none;\'></div>";var msg2="<div id=\'tweet-content\' style=\'display:none;\'>"+tweets_array[cur]+"</div>";$(obj).prepend(msg1);$(obj+" div:#tweet_container").slideDown(1500);$(obj+" div:#tweet_container").prepend(msg2);show_now_timer=setTimeout(\'$(obj+" div:#tweet_container div").fadeIn();\',1500);$(obj+" div:last").remove();cur++;', 4000);
					}
					else
						tweet_scroller_time=setInterval('if(cur<0)cur=limit; var msg1="<div id=\'tweet_container\' style=\'display:none;\'></div>";var msg2="<div id=\'tweet-content\' style=\'display:none;\'>"+tweets_array[cur]+"</div>";$(obj).append(msg1);$(obj+">div:first").empty();$(obj+">div:first").slideUp(1500);$(obj+">div:last").slideDown();$(obj+" div:last").prepend(msg2);show_now_timer=setTimeout(\'$(obj+" div:#tweet_container div").fadeIn();\',1500);cur--;setTimeout(\'$(obj+" div:first").remove();\',2000)', 4000);
				}
				//get tweet from database after some time interval
				//tweet_get_time=setInterval('$.ajax({type:"post",url:"/top-users",data: "lim="+limit,success:function(msg){tweets_array=msg.split("~");}});', 4000*intervalLimit);
				tweet_get_time=setInterval('$.ajax({type:"post",url:"/latest-flowers",data: "lim="+limit,success:function(msg){tweets_array=msg.split("~");}});', 4000*intervalLimit);
			});
		}
	});
})(jQuery);
