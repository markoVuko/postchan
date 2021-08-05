window.onload = function() {
    localStorage.clear();
    $("#newpostsub").click(function(e){
    e.preventDefault();
    submitPost();
});

$(document).on("click",".like",function(e){
        e.preventDefault();
        
        like($(this));
    });

$(document).on("click","#settingsBtn",function(e){
    e.preventDefault();
    $("#profileModal").modal();
});

$("#profileEditBtn").on("click",function(){
    editUser();
});

$(document).on("click",".edit",function(e){
    e.preventDefault();
    $("#postModal").modal();
    $("#postModalText").val($(this).parent().parent().children(":first").html());
    $("#postModalImage").attr('src',$(this).parent().parent().children(":first").next().attr("src"));
    $("#postModalId").val($(this).attr("href"));
});

$(document).on("click",".del",function(e){
    e.preventDefault();
    var b = false; 
    deletePost($(this).attr("href"),$(this).parent().parent());
});

$("#postModalPic").change(function(){previewPic(this);});

$("#profileModalPic").change(function(){profilePic(this);});

$("#postEditBtn").on("click",function(){
    editPost($("#postModalId").val());
});

$(".post-close").on("click",function(){ localStorage.clear(); });

$(".profile-close").on("click",function(){
    $("#profileModalPic").val("");
    $("#profileModalPw1").val("");
    $("#profileModalPw2").val("");
    $("#profileModalImg").attr("src",$("#userProfilePic").attr("src"));
});

}

function like(el){
    var isLike = false;
    
    if(el.data("id")=="like"){
        isLike = true;
    }
    var fd = new FormData();
    fd.append("isLike",isLike);
    fd.append("pid",el.parent().parent().data("id"));
    $.ajax({
        url:"likePost",
        method:"POST",
        processData: false,
        contentType: false,
        data: fd,
        dataType:"JSON",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(r){
            console.log(el.html());
            var likeText="";
            var dislikeText="";
            var a = null;
            var b = null;
            var c = null;
            var d = null;
            if(r.doILike){
                likeText="Unlike";
            }
            if(!r.doILike){
                likeText="Like";
            }

            if(r.doIDislike){
                dislikeText="Undislike";
            }
                
            if(!r.doIDislike){
                dislikeText="Dislike";
            }
            if(isLike){
                a = el.find(".likeText");
                b = el.next().find(".dislikeText");
                c = el.find(".likeNums");
                d = el.next().find(".dislikeNums");
            } else {
                
                a = el.prev().find(".likeText");
                b = el.find(".dislikeText");
                c = el.prev().find(".likeNums");
                d = el.find(".dislikeNums");
            }
            a.html(likeText);
            b.html(dislikeText);
            d.html(r.dislikeNum);
            c.html(r.likeNum);
        },
        error:function(e){
            console.log(e);
        }
    });
}

function editUser(){
    var pic = $('#profileModalPic')[0].files[0];
    var email = $("#profileModalEmail").val();
    var pw1 = $("#profileModalPw1").val();
    var pw2 = $("#profileModalPw2").val();
    var id = $("#profileModalId").val();
    var fd = new FormData();
    fd.append("pic",pic);
    fd.append("email",email);
    fd.append("pw1",pw1);
    fd.append("pw2",pw2);
    fd.append("id",id);
    if(email!=null){
        $.ajax({
            url:`editUser`,
            method:"POST",
            processData: false,
            contentType: false,
            data:fd,
            dataType:"JSON",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(res){
                console.log(res);
                if(res=="img"){
                    var profileImg = JSON.parse(localStorage.getItem("profileImg"));
                    $("#userProfilePic").attr("src",profileImg);
                }
            },
            error:function(e){
                console.log(e);
            }
        });
    }
}

function editPost(pid){
    var ppic = $('#postModalPic')[0].files[0];
    var ptext = $("#postModalText").val();
    var fd = new FormData();
    fd.append("ptext",ptext);
    fd.append("ppic",ppic);
    fd.append("pid",pid);
    console.log(ptext);
    if(ptext!=null){
        $.ajax({
            url:`editPost`,
            method:"POST",
            processData: false,
            contentType: false,
            data:fd,
            dataType:"JSON",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(res){
                console.log(res);
                var editImg = JSON.parse(localStorage.getItem("editImg"));
                $(`.post[data-id="${pid}"]`).children(":first").html(ptext);
                if(editImg){
                    $(`.post[data-id="${pid}"]`).children(":first").next().attr('src', editImg);
                }
            },
            error:function(e){
                console.log(e);
            }
        });
    }
}

function profilePic(pic){
    if (pic.files && pic.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#profileModalImg').attr('src', e.target.result);
          localStorage.setItem("profileImg",JSON.stringify(e.target.result));
        }
        
        reader.readAsDataURL(pic.files[0]); 
      }
}

function previewPic(pic){
    if (pic.files && pic.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#postModalImage').attr('src', e.target.result);
          localStorage.setItem("editImg",JSON.stringify(e.target.result));
        }
        
        reader.readAsDataURL(pic.files[0]); 
      }
}

function deletePost(pid,b){
    if(pid){
        $.ajax({
        url:`deletePost/${pid}`,
        method:"POST",
        processData: false,
        contentType: false,
        data: {pid:pid},
        dataType:"JSON",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(res,status,jqXHR){
           console.log(res);
            b.remove();
        },
        error:function(e){
            console.log(e);
        }
    });
    } else return false;
}

function submitPost(){
var ptext = $("#newposttext").val();
var pid = $("#pid").val();
var pimage = $('#newpostpic')[0].files[0];
var fd = new FormData();
fd.append("ptext",ptext);
fd.append("ppic",pimage);
fd.append("pid",pid);
if(pimage!=null&&ptext!=null){
    $.ajax({
        url:"submitPost",
        method:"POST",
        processData: false,
        contentType: false,
        data: fd,
        dataType:"JSON",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(res,status,jqXHR){
            alert("Post submitted.");
            console.log(res);
            var string = `<article class="post" data-id="${res.IdPost}">
            <p>${res.text}</p>
            <img src="${res.path}" alt="${res.alt}">
            <span class="postinfo">Posted by ${res.username}(${res.date})</span>
            <div class="interact">
                <a href="${res.IdPost}" class="like">Like</a>
                <a href="${res.IdPost}" class="like">Dislike</a>
                <a href="${res.IdPost}" class="edit">Edit</a>
                <a href="${res.IdPost}" class="del">Delete</a>
            </div>
        </article>`;
            $("#postList").prepend(string);
        },
        error:function(e){
            console.log(e);
        }
    });
}
}