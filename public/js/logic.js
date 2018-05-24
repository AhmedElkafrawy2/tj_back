$(document).ready(function(){
	// define global varivales
	var loadedimages = [] ;
	var questionImage;
	// send ajax request function
	function request(url,type,data,success,error){
		$.ajax({
			  url: url,
			  type:type,
			  data:data,
			  processData: false,
			  contentType: false,
			  success: success,
			  error:error
		});
	}
	// click register modal btn
	$(".register-btn-ajax").on("click",function(){
		var url = $(".register-form").attr("data-action");
		var type = "POST";
		var _token = $(".register-form").find("input[ name = '_token']").val();
		var data = new FormData();
		
		// get form data
		var name     = $("#name").val();
		var phone    = $("#tel").val();
		var gender   = $('#gender').find(":selected").val();
		var age      = $("#age").val(); 
		var country  = $('#country').find(":selected").val();
		var city     = $('#city').find(":selected").val();
		var password = $("#password").val();
		var confirm  = $("#password-confirm").val();
		
		data.append("name",name);
		data.append("phone" , phone);
		data.append("gender" , gender);
		data.append("age" , age);
		data.append("country" , country);
		data.append("city" , city);
		data.append("password" , password);
		data.append("password_confirmation" , confirm);
		data.append("_token",_token);
		
		request(url,type,data,function(data){
			if(data.status == false){
				showRegisterErrors(data.errors);
			}else{
				registerRedirect(data);
			}
		},function(error){
			alert("حدث خطأ برجاء المحاولة لاحقا");
		})
	});
	
	function showRegisterErrors(errors){
		$(".register-errors").css("display","block");
		$(".register-errors ul").html("");
		$.each( errors, function( key, value ) {
			$(".register-errors ul").append("<li>" + value + "</li>");
		});
	}
	function registerRedirect(data){
		$("#register-form").css('z-index' , "9");
		$(".notify-modal-content").html("<i class='fa fa-check' aria-hidden='true'></i><br />" + data.msg);
		$('#notify-form').modal();
		setTimeout(function(){
			location.reload();
		}, data.time);
	}
	
	// login new user
	$(".login-btn").on("click",function(){
		var url    =  $(".login-form").attr("data-action");
		var type   = "POST";
		var _token = $(".login-form").find("input[ name = '_token']").val();
		var data   = new FormData();
		
		// get form data
		var phone    = $("#login-tel").val();
		var password = $("#login-password").val();

		
		data.append("phone" , phone);
		data.append("password" , password);
		data.append("_token",_token);
		
		request(url,type,data,function(data){
			$(".login-errors").css("display","block");
			$(".login-errors ul").html("");
			if(data.status == false){
				if(data.errors){
					showLoginErrors(data.errors);
				}else{
					notMatchLogin(data);
				}
			}else{
				loginRedirect(data);
			}
		},function(error){
			alert("حدث خطأ برجاء المحاولة لاحقا");
		})
	});
	
	function notMatchLogin(data){
		$(".login-errors ul").append("<li>" + data.msg + "</li>");
	}
	function showLoginErrors(errors){
		$.each( errors, function( key, value ) {
			$(".login-errors ul").append("<li>" + value + "</li>");
		});
	}
	function loginRedirect(data){
		$("#login-form").css('z-index' , "9");
		$(".notify-modal-content").html("<i class='fa fa-check' aria-hidden='true'></i><br />" + data.msg);
		$('#notify-form').modal();
		setTimeout(function(){
			location.reload();
		}, data.time);
	}
	
	// get cities lisr request
	$("#country, #experience-country").on("change",function(){
		var country = $(this).find(":selected").val();
		var url = $("#country").attr("data-action");
		var type = "POST";
		var _token = $(".login-form").find("input[ name = '_token']").val();
		var data = new FormData();
		data.append("id" , country);
		data.append("_token" , _token);
		if(country != ""){
			request(url,type,data,function(data){
				if(data.status == false){
					alert("حدث خطأ برجاء المحاولة لاحقا");
				}else{
					$("#experience-city ,#city").html("");
					$("#experience-city ,#city").html("<option value='' selected>المدينة</option>");
					$.each(data.cities, function( key, value ) {
						$("#experience-city ,#city").append("<option value='"+value.id+"'>"+value.name+"</option>");    
					});
				}
			},function(error){
				alert("حدث خطأ برجاء المحاولة لاحقا");
			})
		}else{
			$("#experience-city ,#city").html("<option value='' selected>المدينة</option>");
		}
	});
	
	// add exprience images
	$(".add-exp-img").on("change" , function(event){
		var imagesNumber = $(".add-exp-images").children().length;
		if(imagesNumber == 4){
			$(".info-modal-content").html("<i class='fa fa-info' aria-hidden='true'></i><br />عفوا لايمكن اضافة اكثر من اربعة صور");
			$('#info-form').modal();
			setTimeout(function(){
				$('#info-form').modal("hide");
			}, 3000);
			return false;
		}
		var selectedFile = event.target.files;
		$.each(selectedFile , function(k,v){
			loadedimages.push(v);
		});
		var file = document.getElementById('experience-image').files[0];
	    var reader  = new FileReader();
	    // it's onload event and you forgot (parameters)
	    reader.onload = function(e)  {
	    	var dataSrc = e.target.result;
	    	if(dataSrc.substring(0,10) != "data:image"){
				$(".info-modal-content").html("<i class='fa fa-info' aria-hidden='true'></i><br />برجاء اختيار صورة");
				$('#info-form').modal();
				setTimeout(function(){
					$('#info-form').modal("hide");
				}, 3000);
				return false;
	    	}
	        $(".add-exp-images").append("<div><i class='fa fa-times' aria-hidden='true'></i><img class='io' src='"+ e.target.result +"' /></div>");
	    	// remove uploaded image
	    	$(".add-exp-images div").on("mouseover" , function(){
	    		$(this).children().first().css("visibility" , "visible");
	    	});
	    	$(".add-exp-images div").on("mouseleave" , function(){
	    		$(this).children().first().css("visibility" , "hidden");
	    	});
	     	$(".add-exp-images div i").on("click" , function(){
	    		$(this).parent().remove();
	    	});
	    }
	    
	     // you have to declare the file loading
	     reader.readAsDataURL(file);
	});
	
	
	// click on add exp form btn
	$(".add-exp-btn").on("click",function(e){
		e.preventDefault();
		var name    = $(".exp-name").val();
		var desc    = $(".exp_desc").val();
		var cat     = $(".exp-cat").find(":selected").val();
		var status  = $(".exp-status").find(":selected").val();
		
		var date    = $(".exp-date").val();
		var cost    = $(".exp-cost").val();
		var country = $("#experience-country").find(":selected").val();
		var city    = $("#experience-city").find(":selected").val();
		var _token  = $("#exp-add-form").find("input[ name = '_token']").val();
		var url     = $("#exp-add-form").attr("action");
		var type    = "POST";
		
		var data = new FormData();
		data.append("name" , name);
		data.append("desc" , desc);
		data.append("cat" , cat);
		data.append("status" , status);
		data.append("date" , date);
		data.append("cost" , cost);
		data.append("country" , country);
		data.append("city" , city);
		data.append("_token" , _token);
		
		var number = "";
        $.each(loadedimages , function(k , v){
    		console.log("k " , k , " v " , v);
    		data.append(k , v);
            number = k;
        });
        
        data.append("number" , number);
		request(url,type,data,function(data){
			if(data.status == false){
				showAddExptErrors(data.errors);
			}else{
				addExpRedirect(data);
			}
		},function(error){
			alert("حدث خطأ برجاء المحاولة لاحقا");
		})
	});
	
	function showAddExptErrors(errors){
		$(".add-exp-errors").css("display" , "block");
		$(".add-exp-errors ul").html("");
		$.each( errors, function( key, value ) {
			$(".add-exp-errors ul").append("<li>" + value + "</li>");
		});
	}
	function addExpRedirect(data){
		$(".add-exp-errors ul").html("");
		$(".add-exp-errors").css("display" , "none");
		
		$(".notify-modal-content").html("<i class='fa fa-check' aria-hidden='true'></i><br />" + data.msg);
		$('#notify-form').modal();
		setTimeout(function(){
			location.reload();
		}, data.time);
	}
	
	// add question image
	$(".add-question-img").on("change" , function(event){
		
		var file = document.getElementById('experience-image').files[0];
	    var reader  = new FileReader();
	    // it's onload event and you forgot (parameters)
	    reader.onload = function(e)  {
	    	var dataSrc = e.target.result;
	    	if(dataSrc.substring(0,10) != "data:image"){
				$(".info-modal-content").html("<i class='fa fa-info' aria-hidden='true'></i><br />برجاء اختيار صورة");
				$('#info-form').modal();
				setTimeout(function(){
					$('#info-form').modal("hide");
				}, 3000);
				return false;
	    	}
	    	questionImage = event.target.files;
	        $(".add-exp-images").html("<div><i class='fa fa-times' aria-hidden='true'></i><img class='io' src='"+ e.target.result +"' /></div>");
	    	// remove uploaded image
	    	$(".add-exp-images div").on("mouseover" , function(){
	    		$(this).children().first().css("visibility" , "visible");
	    	});
	    	$(".add-exp-images div").on("mouseleave" , function(){
	    		$(this).children().first().css("visibility" , "hidden");
	    	});
	     	$(".add-exp-images div i").on("click" , function(){
	     		
	    		$(this).parent().remove();
	    		questionImage = "";
	    	});
	    }
	    
	     // you have to declare the file loading
	     reader.readAsDataURL(file);
	});
	
	// add question btn click
	$(".add-question-btn").on("click",function(e){
		e.preventDefault();
		var name    = $(".question-name").val();
		var desc    = $(".question-desc").val();
		var _token  = $(".experience-form").find("input[ name = '_token']").val();
		var url     = $("#add-question-form").attr("action");
		var cat     = $(".exp-cat").find(":selected").val();
		var type    = "POST";
		var data = new FormData();
		data.append("name" , name);
		data.append("desc" , desc);
		data.append("cat" , cat);
		data.append("_token" , _token);
		console.log("token" , _token);
		$.each(questionImage,function(k,v){
			data.append("image" , v);
		});
		request(url,type,data,function(data){
			console.log("data" , data);
			if(data.status == false){
				showAddQuestiontErrors(data.errors);
			}else{
				addQuestionRedirect(data);
			}
		},function(error){
			alert("حدث خطأ برجاء المحاولة لاحقا");
		})
	});
	function showAddQuestiontErrors(errors){
		$(".add-exp-errors").css("display" , "block");
		$(".add-exp-errors ul").html("");
		$.each( errors, function( key, value ) {
			$(".add-exp-errors ul").append("<li>" + value + "</li>");
		});
	}
	function addQuestionRedirect(data){
		$(".add-exp-errors ul").html("");
		$(".add-exp-errors").css("display" , "none");
		
		$(".notify-modal-content").html("<i class='fa fa-check' aria-hidden='true'></i><br />" + data.msg);
		$('#notify-form').modal();
		setTimeout(function(){
			location.reload();
		}, data.time);
	}
});












