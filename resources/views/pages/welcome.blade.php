@extends("layouts.master")

@section("title")
postchan - welcome
@endsection

@section("content")

<div class="row" id="welcomerow">
        <div class="col-md-6">
            <form action="#" method="POST" id="regForm">
                @csrf
                <h3>Register</h3>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="regEmail" class="form-control">
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="regUsername" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pw1">Password:</label>
                    <input type="password" name="pw1" id="regPw1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pw2">Password:</label>
                    <input type="password" name="pw2" id="regPw2" class="form-control">
                </div>
                <input type="submit" value="Register" id="regBtn" class="btn btn-primary">
            </form>
        </div>
        <div class="col-md-6">
            <form action="#" method="POST" id="logForm">
                @csrf
                <h3>Log In</h3>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="logUsername" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pw">Password:</label>
                    <input type="password" name="pw" id="logPw" class="form-control">
                </div>
                <input type="submit" value="Login" id="logBtn" class="btn btn-primary">
            </form>
            </div>
 </div>

    <script>
        window.onload = function () {
    $("#regBtn").click(function(e){
        e.preventDefault();
        regForm();
    });
    $("#logBtn").click(function(e){
        e.preventDefault();
        logForm();
    });
}

function logForm() {
    var greske = 0;
	var username = document.getElementById("logUsername")
	var usernameRX=/^\w{3,12}$/;
	if(!usernameRX.test(username.value))
	{
		greske++;
		username.classList.add("bad");
		$("#logUsername").css("background-color","pink");
		alert("Username must be 3-12 characters");
	} else {
		username.classList.remove("bad");
		$("#logUsername").css("background-color","white");
	}

	var pw = document.getElementById("logPw");
	var pwRX = /^(?=.*[A-z])(?=.*[0-9])[A-Za-z0-9]{8,30}$/;
	if(!pwRX.test(pw.value))
	{
		greske++;
		$("#logPw").css("background-color","pink");
		alert("Password must be 8-30 letters and numbers.");
	} else {
		$("#logPw").css("background-color","white");
	}

	if(greske==0)
	{
		$.ajax({
            url:'{{ url("/logForm") }}',
            method:"POST",
            data:{
                username: username.value,
                pw: pw.value
            },
            dataType:"JSON",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(res){
                alert(res);
                window.location.href = "home";
            },
            error:function(err){
                console.log(err);
            }
        });
	} else { return; }
}

function regForm() {
    var greske = 0;
	var username = document.getElementById("regUsername")
	var usernameRX=/^\w{3,12}$/;
	if(!usernameRX.test(username.value))
	{
		greske++;
		username.classList.add("bad");
		$("#regUsername").css("background-color","pink");
		alert("Username must be 3-12 characters");
	} else {
		username.classList.remove("bad");
		$("#regUsername").css("background-color","white");
	}

	var email = document.getElementById("regEmail");
	var emailRX = /^(\w+(\.\w{2,})?){3,50}@(\w{2,10}(\.{1,1}[a-z]{2,3}){1,3})$/;
	if(!emailRX.test(email.value))
	{
		greske++;
		$("#regEmail").css("background-color","pink");
		alert("Email must be a valid format(eg: name@gmail.com");
	} else {
		$("#regEmail").css("background-color","white");
	}

	var pw1 = document.getElementById("regPw1");
	var pwRX = /^(?=.*[A-z])(?=.*[0-9])[A-Za-z0-9]{8,30}$/;
	if(!pwRX.test(pw1.value))
	{
		greske++;
		$("#regPw1").css("background-color","pink");
		alert("Password must be 8-30 letters and numbers.");
	} else {
		$("#regPw1").css("background-color","white");
	}

	var pw2 = document.getElementById("regPw1");
	if(!pwRX.test(pw2.value))
	{
		greske++;
		$("#regPw2").css("background-color","pink");
	} else {
		$("#regPw2").css("background-color","white");
	}
	if(pw1.value!=pw2.value){
		$("#regPw1").css("background-color","pink");
		$("#regPw2").css("background-color","pink");
		alert("Passwords must match!");
	} 


	if(greske==0)
	{
		$.ajax({
            url:'{{ url("/regForm") }}',
            method:"POST",
            data:{
                username: username.value,
                email: email.value,
                pw1: pw1.value,
                pw2: pw2.value
            },
            dataType:"JSON",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(res){
                window.location.href = "home";
            },
            error:function(err){
                console.log(err);
            }
        });
	} else { 
        return;
    }
}
    </script>
    <script src="{{ asset("../resources/js/script.js") }}"></script>
@endsection