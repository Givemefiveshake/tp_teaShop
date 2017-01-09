$(".header .top_menu .search_bar .search_bar-input").addClass("borderRadius_scheme_large");
$(".header .top_menu .search_bar .search_bar-submit").addClass("button_color_scheme_dark borderRadius_scheme_large");
$(".header .top_menu .search_bar .cart").addClass("button_color_scheme_dark");

$(function(){
	$searched = $(".header .top_menu .search_bar .search_bar-input");
	$auto_wrapper = $(".header .top_menu .search_bar .auto_wrapper");
	$auto_list = $(".header .top_menu .search_bar .auto_wrapper >*");
	
	$searched.on("input", function(){
		if($(this).val().length > 0){
			$auto_list.css({"color":"currentColor"});
			$auto_wrapper.css({"visibility":"visible"});
		}else{
			$auto_list.css({"color":"transparent"});
			$auto_wrapper.css({"visibility":"hidden"});
		}
	});
	$searched.blur(function(){
		$auto_list.css({"color":"transparent"});
		$auto_wrapper.css({"visibility":"hidden"});
	});
	$auto_list.click(function(){
		$searched.val($(this).text());
	});
});
