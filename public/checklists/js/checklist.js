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
    $("button.submit").click(function(){
    var $title = $("input[name='title']").val();
    var $content = $("input[name='content']").val();
    var $name = $("input[name='name']").val();
    var $sex = $("select.sex option:selected").val();  // var $sex = $('select.sex option:selected').text();
    var $country = $("select[name='country'] option[selected]").val(); // var $country = $("select[name='country'] option[selected]").text();
    var $nbateam = $("select.nbateam").find("option:selected").val(); //var $nbateam = $("select.nbateam").find("option:selected").text();
    var $url = "xumadd?title=" + $title + "&content=" + $content;
        $url += "&name=" + $name + "&sex=" + $sex;
        $url += "&country=" + $country + "&nbateam=" + $nbateam;
    window.location.href = $url;
/*     $.ajax({
        	type: "POST",
        	 url: "xumadd",
        	data: {
                 "title": $title,
               "content": $content,
                  "name": $name,
                   "sex": $sex,
               "country": $country,
               "nbateam": $nbateam
        	},
        success: function(){
            //alert("123");
         }
        });*/
    });
 });

 function postAjaxData(){

 }


/*--------------------------------------------------------------------*/
 /*
  *
  *     	layer.msg('success');
  *  	//alert("click me!");
  *        //window.location.href = "index"; // go to indexAction()
  *
  */