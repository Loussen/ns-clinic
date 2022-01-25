function checkMenuMinimize(){
	var menu_minimize=$("#menu_minimize").val();
	var document_width=$('body').width();

	if(menu_minimize>0 || document_width<1153){
		$("body").addClass('content-wrapper');
		$(".ti-menu").removeClass('icon-arrow-left-circle');
		
		$(".admin_name").addClass('hide');
		$(".user-profile").hide();
		$(".small_logo").show();
	}
}

$(window).on('resize', function(){
      var win = $(this); //this = window
	  if (win.width() < 751) checkMenuMinimize();
});

$(document).ready(function()
{
	setTimeout(function(){
		var countTD=$(".table-striped tr:first > th").length;
		var percent=100/countTD;
		$(".table-striped tr.auto_resize:first > th").css('width',percent+'%');
		
		if($(".fa-pencil").length>0 && $(".white-box form").hasClass('hide') ) $(".white-box .nav-tabs").hide();
	},100);
	
	$("a.navbar-toggle").click(function(e){
		e.preventDefault();
		var check=$(this).find('i.ti-close');
		if(check.hasClass('ti-menu')){
			$("div.sidebar-nav.navbar-collapse.slimscrollsidebar").removeClass('show');
			$("div.sidebar-nav.navbar-collapse.slimscrollsidebar").removeAttr('aria-expanded','false');
		}
		else{
			$("div.sidebar-nav.navbar-collapse.slimscrollsidebar").addClass('show');
			$("div.sidebar-nav.navbar-collapse.slimscrollsidebar").attr('aria-expanded','true');
		}
		return false;
	});
	
	
	//
	$(".sidebar #side-menu>li").mouseenter(function(){
		var width=$(this).width();
		$(".sidebar").addClass('overflowV');	$(".sidebar").removeClass('overflowH');
		$(".slimScrollDiv").addClass('overflowV');	$(".sidebar").removeClass('overflowH');
		
		if(width<100) $(this).addClass('w300');
		$(this).css('background','#f7fafc');
	});
	$(".sidebar #side-menu>li").mouseleave(function(){
		$(".sidebar").removeClass('overflowV');	$(".sidebar").addClass('overflowH');
		$(".slimScrollDiv").removeClass('overflowV');	$(".sidebar").addClass('overflowH');
		
		$(this).removeClass('w300');
		$(this).css('background','none');
	});
	//
	
	$(".open-close").click(function(){
		if($(".admin_name").hasClass('hide')){
			console.log('b');
			$(".admin_name").removeClass('hide');
			$(".user-profile").show();
			$(".small_logo").hide();
			$.post("jquery_post.php",{process_name:'menu_open_close',type:'unminimize'},function(data){});
		}
		else{
			console.log('a');
			$(".admin_name").addClass('hide');
			$(".user-profile").hide();
			$(".small_logo").show();
			$.post("jquery_post.php",{process_name:'menu_open_close',type:'minimize'},function(data){});
		}
	});
	setTimeout(checkMenuMinimize, 50);
	setTimeout(checkMenuMinimize, 100);
	setTimeout(checkMenuMinimize, 200);
	setTimeout(checkMenuMinimize, 300);
	setTimeout(checkMenuMinimize, 500);
	
	$(".tab-pane:first").addClass('active');
	var a=$(".tab-pane").height();
	//if(a==0) $(".tab-content").removeClass('tab-content');
	
	$(".print_img").click(function(){
		window.print();
	});
	
	$("#search_form").find('.form-control').change(function(){
		$("#search_form").submit();
	});
	
	$("#role_id").change(function(){
		if($(this).val()==0) $(".only_special").show();
		else $(".only_special").hide();
	});
	
	setTimeout(function(){
		var hg=$("ul.nav-tabs").height();
		if(hg<10) $("ul.nav-tabs").hide();
		
		var hg=$("div.all_delete_buttons").height();
		if(hg<10) $("hr.bottom_add_new").hide();
	},100);
	
	$("#all_check").click(function(){
		var all_check_changed=$("#all_check_changed").val();
		if(all_check_changed==0){
			all_check_changed=1;
			$("#link_url").val("-");
			var link_url=$("#link_url").val();
			$('td input:checkbox').each(function() {
				$(this).attr("checked", "checked");
				$(this).prop("checked", true);
				id=this.id;
				id=id.substr(5);
				link_url=link_url+id+"-";
			});
			$("#link_url").val(link_url);
		}
		else{
			all_check_changed=0;
			$('td input:checkbox').each(function(){
				$(this).removeAttr("checked", "checked");
				$(this).prop("checked", false);
			});
			
			$("#link_url").val("-");
		}
		$("#all_check_changed").val(all_check_changed);
	});
	
	$(".chbx_del").click(function(){
		var delete_text2=$("#delete_text2").val();
		var sual=confirm(delete_text2);
		if(!sual) return false;
		
		var link_url=$("#link_url").val();
		var current_link=$("#current_link").val();
		if(link_url.length>1) window.location.href = current_link+'&checkbox_del=1&checkboxes='+link_url;
	});
	
	$(".chbx_active").click(function(){
		var val=$(this).data("val");
		var special=parseInt($(this).data("special"));
		var link_url=$("#link_url").val();
		var current_link=$("#current_link").val();
		if(link_url.length>1) window.location.href = current_link+'&active='+val+'&checkboxes='+link_url;
	});
	
	$(".delete").click(function(event){
		var title=$(this).data('title');
		var important=$(this).data('important');
		
		if(important>0){
			var for_js_text1=$("#for_js_text1").val();
			var for_js_text2=$("#for_js_text2").val();
			
			$.toast({
				heading: for_js_text1,
				text: for_js_text2,
				position: 'top-right',
				loaderBg:'#ff6849',
				icon: 'error',
				hideAfter: 5000, 
				stack: 6
			});
			event.preventDefault();
			return false;
		}
		else{
			var delete_text1=$("#delete_text1").val();
			var delete_text2=$("#delete_text2").val();
			if (confirm(delete_text1+': "'+title+'"\n'+delete_text2) == false) {
				event.preventDefault();
				return false;
			}
		}
	});
	
});

function will_hide_menu(data){
	if(data=='all'){
		$('ul.dropdown-menu').remove();
		$('ul.second_menu').remove();
	}
	else{
		data=data.split(',');
		
		$('ul.dropdown-menu li a').each(function(){
			var href=$(this).context.href;
			if(href!='javascript:void(0)'){
				href=href.split('do=');
				if(href[1]!=undefined) href=href[1]; else href='';
				if(href.indexOf('&') >= 0){ href=href.split('&');	href=href[0]; }
				
				if( $.inArray( href, data ) == -1 ) $(this).parents('li').remove();
			}
		});
		
		$('ul.second_menu li a').each(function(){
			var href=$(this).context.href;
			if(href!='javascript:void(0)'){
				href=href.split('do=');
				if(href[1]!=undefined) href=href[1]; else href='';
				if(href.indexOf('&') >= 0){ href=href.split('&');	href=href[0]; }
				
				if( $.inArray( href, data ) == -1 ) $(this).parents('li').remove();
			}
		});
		
	}
	
}

// select checkbox multi
function chbx_(id){
	id=id.substr(5);
	if($("#chbx_"+id).is(":checked")){
		var link_url=$("#link_url").val();
		link_url=link_url+id+"-";
		$("#link_url").val(link_url);
	}
	else{
		var link_url=$("#link_url").val();
		link_url=link_url.replace("-"+id+"-","-");
		$("#link_url").val(link_url);
	}
}

function active(table,value,title)
{
	var id=value.substr(5);
	var new_title;
	var new_active;
	if(title=="Active"){
		new_title="Deactive"; new_active=0;
		$("#info_"+id).removeClass("fa-toggle-on");
		$("#info_"+id).addClass("fa-toggle-off");
		$("#info_"+id).attr("title",new_title);
	}
	else{
		new_title="Active"; new_active=1;
		$("#info_"+id).addClass("fa-toggle-on");
		$("#info_"+id).removeClass("fa-toggle-off");
		$("#info_"+id).attr("title",new_title);
	}
	$.post("jquery_post.php",{table:table,info_id:id,new_active:new_active},function(data){console.log(data);});

}

function tab_select(id)
{
	var idi=id.substr(8);	
	$('.left_switch').removeClass('active');
	$('#tab_lang'+idi).addClass('active');
	
	$('.tab_content').addClass('hide');
	$('#tab'+idi+'_content').removeClass('hide');
}

function show_flag(value)
{
	$("#flag_image").attr("src",value);
}