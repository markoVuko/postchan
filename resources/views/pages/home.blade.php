@extends("layouts.master")

@section("content")

    <div id="user-profile">
        @if(!empty($data["pic"]->path))
            <img src="{{ $data['pic']->path }}" alt="{{ $data['pic']->alt }} profile" id="userProfilePic">
        @else 
            <img src="img/profile.png" alt="profile pic" id="userProfilePic">
        @endif
        <div id="user-profile-info">
            Username: {{ $data["user"]->username }}
            E-Mail: {{ $data["user"]->email }}
            @if($data["user"]->IdRole==1)
                Role: Administrator
            @else
                Role: User
            @endif
            Followers: {{ $data["followNums"] }}
            Follows: {{ $data["followedNums"] }}
            <a href="{{ $data['user']->email }}" id="settingsBtn">Settings</a>
        </div>
    </div>
    <section class="row newpost">
        <div class="col-md-6 col-md-offest-6">
            <h3>What's on your mind?</h3>
            <form action="#" method="POST" enctype="multipart/form-data">
            
                <div class="form-group">
                    <textarea class="form-control" name="newposttext" id="newposttext" rows="5"></textarea>
                    <input type="file" name="newpostpic" id="newpostpic">
                    <input type="hidden" name="pid" id="pid" value="{{$data['user']->IdUser}}">
                    <input type="submit" name="newpostsub" id="newpostsub" value="Create Post" class="btn btn-primary">
                </div>
            </form>
        </div>
    </section>
    <section class="row" id="posts">
        <h3>Your posts...</h3>
        {!! $data['posts']->render() !!}
        <div class="col-md-6 col-md-3-offest" id="postList">
            @php
            $likes=$data["likes"];
            $dislikes=$data["dislikes"];
            $likeNums=$data["likeNums"];
            $dislikeNums=$data["dislikeNums"];
            $i=0;
            @endphp
            @foreach($data["posts"] as $p)

                <article class="post" data-id="{{ $p->IdPost }}">
                    <p>{{ $p->text }}</p>
                    <img src="{{ $p->path }}" alt="{{ $p->alt }}">
                    <span class="postinfo">Posted by {{ $p->username }}({{ $p->date }})</span>
                    <div class="interact">
                        @if($likes[$i])
                            <a href="{{ $p->IdPost }}" class="like" data-id="like"><span class="likeText">Unlike</span>(<span class="likeNums">{{ $likeNums[$i] }}</span>)</a>
                        @else 
                            <a href="{{ $p->IdPost }}" class="like" data-id="like"><span class="likeText">Like</span>(<span class="likeNums">{{ $likeNums[$i] }}</span>)</a>
                        @endif
                        @if($dislikes[$i])
                            <a href="{{ $p->IdPost }}" class="like" data-id="dislike"><span class="dislikeText">Undislike</span>(<span class="dislikeNums">{{ $dislikeNums[$i] }}</span>)</a>
                        @else 
                            <a href="{{ $p->IdPost }}" class="like" data-id="dislike"><span class="dislikeText">Dislike</span>(<span class="dislikeNums">{{ $dislikeNums[$i] }}</span>)</a>
                        @endif
                        @if($data["user"]->username == $p->username)
                        <a href="{{ $p->IdPost }}" class="edit">Edit</a>
                        <a href="{{ $p->IdPost }}" class="del">Delete</a>
                        @endif
                    </div>
                </article>
                @php
                $i++;
                @endphp
            @endforeach
        </div>
    </section>

    <div class="modal" tabindex="-1" role="dialog" id="postModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Post</h5>
                <button type="button" class="close post-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="postModalForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="postModalId" id="postModalId">
                        <textarea id="postModalText"></textarea><br>
                        <img src="#" alt="post modal image" id="postModalImage"><br>
                        <input type="file" name="postModalPic" id="postModalPic">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="postEditBtn">Save edit</button>
                <button type="button" class="btn btn-secondary post-close" data-dismiss="modal" id="postCloseBtn">Close</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="profileModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profile Settings</h5>
                <button type="button" class="close profile-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="profileModalForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" id="profileModalId" value="{{ $data['user']->IdUser }}">
                        @if(!empty($data["pic"]->path))
                            <img src="{{ $data['pic']->path }}" alt="{{ $data['pic']->alt }} profile" id="profileModalImg"><br>
                        @else 
                            <img src="img/profile.png" alt="profile pic" id="profileModalImg"><br>
                        @endif
                        <span id="profileModalUsername">{{ $data["user"]->username }}</span><br>
                        <input type="text" id="profileModalEmail" value='{{ $data["user"]->email }}'><br>
                        <input type="password" id="profileModalPw1" placeholder="New password"><br>
                        <input type="password" id="profileModalPw2" placeholder="Confirm new password"><br>
                        <input type="file" id="profileModalPic">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="profileEditBtn">Change settings</button>
                <button type="button" class="btn btn-secondary profile-close" data-dismiss="modal" id="profileCloseBtn">Close</button>
            </div>
            </div>
        </div>
    </div>



<script src="{{ URL::asset('js/script.js') }}"></script>
@endsection