window.onload = function(){
    $("#iusub").click(function(e){
		e.preventDefault();
		insertUser();
    });
    
    $(document).on("change","#euname",function(e){
		fillEditForm($(this).val());
    });
    
    $("#saveUser").click(function(e){
		e.preventDefault();
		adminEdit();
	});

	$(".feed-content").hide();
	$(".feed-block a").click(function(e)
	{
		e.preventDefault();
		if($(this).hasClass("notsel"))
		 { 
		 	$(".feed-block a").addClass("notsel");    
		 	$(".feed-block a").html("Open");       
		   	$(this).removeClass("notsel");
		   	$(this).html("Close");
		   	$(".feed-content").slideUp("fast");
		   	$("#"+ $(this).attr("href")).slideDown("slow");
	 	 } else {

		   	$("#"+ $(this).attr("href")).slideUp("slow");           
		   	$(this).addClass("notsel");
		   	$(this).html("Open");
	 	 }
	 });
}

function adminEdit() {
	var username = $("#euname").val();
	var gmail = $("#euemail").val();
	var pw1 = $("#eupass1").val();
	var pw2 = $("#eupass2").val();
	var role = $('input[name="eurole"]:checked').val();
	var gender = $("#eugender").val();
	var image = $('#euimg')[0].files[0];
	var fd = new FormData();
	fd.append("username",username);
	fd.append("email",gmail);
	fd.append("pw1",pw1);
	fd.append("pw2",pw2);
	fd.append("role",role);
    fd.append("pic",image);
    fd.append("id",$("#euid").val());
	$.ajax({
		url:"adminEditUser",
			method:"POST",
			processData: false,
      		contentType: false,
			data: fd,
			dataType:"JSON",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			success:function(res,status,jqXHR){
                console.log(res);
				if(res!="no"){
                    $("#eupic").attr("src",res.path);
                }
				alert("User edited");
			},
			error:function(e){
				console.log(e);
			}
	});
}

function fillEditForm(username){
	if(username!=0){
        var fd = new FormData();
        fd.append("username",username);
		$.ajax({
		url:"loadUser",
			method:"POST",
            processData: false,
            contentType: false,
			data: fd,
			dataType:"JSON",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			success:function(res,status,jqXHR){
                console.log(res);
				$("#euemail").val(res[0].email);
				if(res[0].path){
					$("#eupic").attr("src",res[0].path);
				}
				$('input:radio[name="eurole"]').each(function() {
				   if($(this).val()==res[0].IdRole){
				   	$(this).prop('checked', true);
				   }
                });
                $("#euid").val(res[0].IdUser)
			},
			error:function(e){
				console.log(e);
			}
	});
	} else {
		document.getElementById("editusform").reset();
	}
}


function insertUser(){
	var username = $("#iuname").val();
	var gmail = $("#iuemail").val();
	var pw = $("#iupass").val();
	var role = $('input[name="role"]:checked').val();
    var fd = new FormData();
    fd.append("username",username);
    fd.append("email",gmail);
    fd.append("pw",pw);
    fd.append("role",role);
	$.ajax({
		url:"insertUser",
			method:"POST",
            processData: false,
            contentType: false,
			data: fd,
			dataType:"JSON",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			success:function(res,status,jqXHR){
                console.log(res);
				alert("User inserted");
			},
			error:function(e){
				console.log(e);
			}
	});
}