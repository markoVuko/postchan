window.onload = function(){
    $(document).on("click",".follow",function(e){
        e.preventDefault();
        
        follow($(this));
    });

    $(document).on("click","#searchBtn",function(e){
        e.preventDefault();
        searchUsers($("#userSearch").val());
    });
}

function searchUsers(name){
    var fd =  new FormData();
    fd.append("name",name);
    $.ajax({
        url:"searchUser",
        method:"POST",
        processData: false,
        contentType: false,
        data: fd,
        dataType:"JSON",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(r){
            console.log(r);
            $("#user-list").html(r);
        },
        error:function(e){
            console.log(e);
        }
    });
}

function follow(el){
    var fid = el.attr("href");
    var follow = true;
    if(el.html() != "Follow"){
        follow = false;
    }
    console.log(follow);
    var fd = new FormData();
    fd.append("fid",fid);
    fd.append("follow",follow);
    if($("#hidProf").val()==1){
        $.ajax({
            url:"../followUser",
            method:"POST",
            processData: false,
            contentType: false,
            data: fd,
            dataType:"JSON",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(r){
                console.log(r);
                if(r=="Followed user"){
                        var folNum =parseInt($(".folNum").html());
                        folNum++;
                        $(".folNum").html(folNum)
                    
                    el.html("Unfollow")
                    
                }
                else if(r=="Unfollowed user"){
                        var folNum =parseInt($(".folNum").html());
                        folNum--;
                        $(".folNum").html(folNum)
                    
                    el.html("Follow");
                    
                }
            },
            error:function(e){
                console.log(e);
            }
        });
    } else {
    $.ajax({
        url:"followUser",
        method:"POST",
        processData: false,
        contentType: false,
        data: fd,
        dataType:"JSON",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(r){
            console.log(r);
            if(r=="Followed user"){
                el.html("Unfollow")
                var folNum = parseInt(el.prev().find(".folNum").html());
                folNum++;
                el.prev().find(".folNum").html(folNum);
            }
            else if(r=="Unfollowed user"){
                el.html("Follow");
                var folNum = parseInt(el.prev().find(".folNum").html());
                folNum--;
                el.prev().find(".folNum").html(folNum);
            }
        },
        error:function(e){
            console.log(e);
        }
    });}
}