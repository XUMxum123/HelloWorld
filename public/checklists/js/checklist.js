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

});

$(document).ready(function(){
	onFocusBlur();
    $("button.submit").click(function(){
    var $title = $("input[name='title']").val();
    var $content = $("input[name='content']").val();
    var $name = $("input[name='name']").val();
    var $sex = $("select.sex option:selected").val();  // var $sex = $('select.sex option:selected').text();
    var $country = $("select[name='country'] option[selected]").val(); // var $country = $("select[name='country'] option[selected]").text();
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

/*--------------------------------------------------------------------*/
 /*
  *
  *     	layer.msg('success');
  *  	//alert("click me!");
  *        //window.location.href = "index"; // go to indexAction()
  *
  */