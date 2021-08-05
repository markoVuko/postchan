window.onload = function(){
    $(document).on("click",".like",function(e){
        e.preventDefault();
        
        like($(this));
    });
}

function like(el){
    var isLike = false;
    
    if(el.data("id")=="like"){
        isLike = true;
    }
    if($("#hidProf").val()==1){
        var fd = new FormData();
    fd.append("isLike",isLike);
    fd.append("pid",el.parent().parent().data("id"));
    $.ajax({
        url:"../likePost",
        method:"POST",
        processData: false,
        contentType: false,
        data: fd,
        dataType:"JSON",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(r){
            console.log(r);var likeText="";
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
    } else {
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
            console.log(r);
        },
        error:function(e){
            console.log(e);
        }
    });
    }

    
}