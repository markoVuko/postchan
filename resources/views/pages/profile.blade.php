@extends("layouts.master")

@section("content")
    @if(empty($data["viewing"]))
        <div id="profiles">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="userSearch">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="searchBtn">Search</button>
            </form>
            <div id="user-list">
                @php
                    $imgs = $data["imgs"];
                    $doIFollow = $data["doIFollow"];
                    $followNums = $data["followNums"];
                    $i=0;
                @endphp
                @foreach($data["users"] as $u)
                @php 
                 $v=0;
                @endphp
                    @if($u->username!=$data["user"]->username)
                        <div class="user">
                            @foreach($imgs as $im)
                                @if($im->IdImg==$u->IdImg)
                                    <img src="{{ $im->path }}" alt="{{ $im->alt }}" class="userListPic">
                                    @php 
                                        $v=1;
                                    @endphp
                                @endif
                            @endforeach
                            @if($v==0)
                                <img src="img/profile.png" alt="{{ $u->username }} picture" class="userListPic">
                            @endif

                            <a href="profiles/{{ $u->IdUser }}" class="userListName">{{ $u->username }}</a>
                            <span>{{ $u->email}}</span><br>
                            <span class="followers">Followers: <span class="folNum">{{ $followNums[$i] }}</span></span>
                            @if($doIFollow[$i])
                            <a href="{{ $u->IdUser }}" class="follow">Unfollow</a>
                            @else
                                <a href="{{ $u->IdUser }}" class="follow">Follow</a>
                            @endif
                        </div>
                    @endif

                    @php 
                        $i++;
                    @endphp
                @endforeach
            </div>
        </div>
    @else
    <div id="user-profile">
        @if(!empty($data["pic"]->path))
            <img src="{{ url('/')}}/{{$data['pic']->path }}" alt="{{ $data['pic']->alt }} profile" id="userProfilePic">
        @else 
            <img src="{{ url('/') }}/img/profile.png" alt="profile pic" id="userProfilePic">
        @endif
        <input type="hidden" id="hidProf" value="1">
        <div id="user-profile-info">
            Username: {{ $data["user"]->username }}
            E-Mail: {{ $data["user"]->email }}
            @if($data["user"]->IdRole==1)
                Role: Administrator
            @else
                Role: User
            @endif
            Followers: <span class="folNum">{{ $data["followNums"] }}</span>
            Follows: {{ $data["followedNums"] }}
            @if($data["doIFollow"])
                <a href="{{ $data['user']->IdUser }}" class="follow">Unfollow</a>
            @else
                <a href="{{ $data['user']->IdUser }}" class="follow">Follow</a>
            @endif
        </div>
    </div>

    <section class="row" id="posts">
        <h3>{{ $data['user']->username }}'s posts...</h3>
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
                    <img src="{{ url('/')}}/{{ $p->path }}" alt="{{ $p->alt }}">
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
    @endif
    

    <script src="{{ URL::asset('js/profile.js') }}"></script>     <script src="{{ URL::asset('js/like.js') }}"></script>
@endsection