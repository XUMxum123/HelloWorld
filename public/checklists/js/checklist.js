/**
 * checklist.js
 *
 * @author meng.xu
 * @time 2016.08.20
 *
 */

/*$(document).ready(function(){
	var $option_count = $("select.nbateam").length;
	alert($option_count);
	if($option_count > 2){
		$("select.nbateam option[text='骑士']").attr("selected", true);
	}
});*/

$(document).ready(function(){
   $("input[type='button'].saveEdit").click(function(){
       //alert("saveEdit");
	   var $newsId = $("input[name='newsId']").val();
	    var $title = $("input[name='title']").val();
	    var $content = $("input[name='content']").val();
	   //var url =  "/checklist/xumaddnews" + '?title=' + $title + '&content=' + $content + '&newsId=' + $newsId;
	   //alert(url);
	   //window.location.href = url;
	    $.ajax({
	    	type: 'POST',
	    	 url: "/checklist/xumaddnews" + '?title=' + $title + '&content=' + $content + '&newsId=' + $newsId,
	     success: function(){
	         	layer.msg('保存成功', {
	         		  icon: 1,
	         		  time: 1000
	         		}, function(){
	         			//alert("123");
	         		  setInterval("refer()",1000);
	         	 });
	          }
	    });
   });
});

$(document).ready(function(){
	onFocusBlur();
    $("button.submit").click(function(){
    var $title = $("input[name='title']").val();
    var $content = $("input[name='content']").val();
    var $name = $("input[name='name']").val();
    var $sex = $("select.sex option:selected").val();  // var $sex = $('select.sex option:selected').text();
    var $country = $("select.country").find("option:selected").val(); // var $country = $("select[name='country'] option[selected]").text();
    var $nbateamid = $("select.nbateam").find("option:selected").val(); //var $nbateam = $("select.nbateam").find("option:selected").text();
/*    var $url = "xumadd?title=" + $title + "&content=" + $content;
        $url += "&name=" + $name + "&sex=" + $sex;
        $url += "&country=" + $country + "&nbateam=" + $nbateam;
        window.location.href = $url;*/
     $.ajax({
        	type: "POST",
        	 url: "xumadd" + '?title=' + $title + '&content=' + $content + '&name=' + $name
 	               + '&sex=' + $sex + '&country=' + $country + '&nbateamid=' + $nbateamid,
        success: function(){
        	layer.msg('保存成功', {
        		  icon: 1,
        		  time: 1000
        		}, function(){
        		  setInterval("refer()",1000);
        		});
         }
        });
    });
 });

var t = 3; // how time goto another page
function refer(){
  if(t==0){
	 window.location.href = "/checklist/xumlist";
  }
  $("div#show").text("" + t + "秒后跳转到列表"); // 显示倒计时
  t--;
}

function onFocusBlur(){
	 $(".title").focus(function(){
	     var $txt_value = $(this).val();
	     if($txt_value == "请输入标题"){
	         $(this).val("");
	     }
	 });
	 $(".title").blur(function(){
	     var $txt_value = $(this).val();
	     if($txt_value == ""){
	         $(this).val("请输入标题");
	     }
	 });

	 $(".content").focus(function(){
	     var $txt_value = $(this).val();
	     if($txt_value == "请输入内容"){
	         $(this).val("");
	     }
	 });
	 $(".content").blur(function(){
	     var $txt_value = $(this).val();
	     if($txt_value == ""){
	         $(this).val("请输入内容");
	     }
	 });

	 $(".name").focus(function(){
	     var $txt_value = $(this).val();
	     if($txt_value == "请输入名字"){
	         $(this).val("");
	     }
	 });
	 $(".name").blur(function(){
	     var $txt_value = $(this).val();
	     if($txt_value == ""){
	         $(this).val("请输入名字");
	     }
	 });
}

function showInfo($nbateamId){ //[normal way]
	layer.open({
		area: ['600px', '500px'],
		  type: 2,
		  content: 'xumnbateam2' + '?id=' + $nbateamId
		});
}

$(document).ready(function(){
	$target = $('tr.tabContent td a.usersId');
	$target.each(function($index){
		  this.onclick=function(){
			  $usersId = $(this).attr('id');
			  $newsId = $(this).parent().prev().find('a.newsId').attr('id');
			  //alert($newsId);
			  deleteRow($usersId,$newsId,$index);
              //$(this).closest('.tabContent').remove();
		      return false;
		  };
		 });
});

function deleteRow($usersId,$newsId,$index){
	layer.confirm('确定删除id=' + $usersId + '的这行记录?', {
		time: 0,
        btn: ['确定','取消']
    }, function(){
	    $.ajax({
	    	type: 'POST',
	    	 url: "/checklist/xumdelete" + '?usersId=' + $usersId + '&newsId=' + $newsId,
	     success: function(){
	         	layer.msg('删除成功', {
	         		  icon: 1,
	         		  time: 1000
	         		}, function(){
	         			$('tr.tabContent:eq('+$index+')').remove();
	         			//alert("123");
	         		  //setInterval("refer()",1000);
	         	 });
	          }
	    });
        //layer.msg('确定', {icon: 1, time:2000});
    }, function(){
    	//var inx = $('table.table tr td:last a').length;
    	//alert(e);
/*    	for(x in $(this)){
    		document.write($(this)[x] +"\n");
    	}*/
        //alert($(this).index());
    	layer.msg('取消', {icon: 2, time:1000});
    });
}
/*--------------------------------------------------------------------*/
 /*
  *
  *     	layer.msg('success');
  *  	//alert("click me!");
  *        //window.location.href = "index"; // go to indexAction()
  *
  */