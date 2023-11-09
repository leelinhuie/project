@extends('layout')

@section('content')

<style>

h3 {
        color: #28A828;
  text-shadow: 3px 3px 3px white, 0 0 20px white, 0 0 10px white;
  }

h1 {
  color: #28A828;
  text-shadow: 3px 3px 3px white, 0 0 20px white, 0 0 10px green;
}

    body{
        background-color: beige;
        font-family: Arial;
    }
    .card{

        background-color: white;
        background-repeat: no-repeat;
        background-size: auto;
        padding: 25px;
        width: 85rem;
        left: 5.5%;
        border-radius: 20px;
    }
    #column{
        float: center;
        width: 75%;
    }
    h5{
        font-size: small;
        font-style: italic;
    }
    h6{
        font-weight: bold;
    }
    #float-right{
        float: right;
    }
    button{
        background-color: white;
        font-style: italic;
        border: none;
        color: red;
    }

    *,
*::before,
*::after {
  box-sizing: border-box;
}

:root {
  --color-primary: #f6aca2;
  --color-secondary: #f49b90;
  --color-tertiary: #f28b7d;
  --color-quaternary: #f07a6a;
  --color-quinary: #ee6352;
}

.content {
  display: flex;
  align-content: center;
  justify-content: center;
}

.text_shadows {
  text-shadow: 3px 3px 0 var(--color-secondary), 6px 6px 0 var(--color-tertiary),
    9px 9px var(--color-quaternary), 12px 12px 0 var(--color-quinary);
  font-family: bungee, sans-serif;
  font-weight: 400;
  text-transform: uppercase;
  font-size: calc(0.8rem + 4vw);
  text-align: center;
  margin: 0;
  color: var(--color-primary);
  /*color: transparent;
  //background-color: white;
  //background-clip: text;*/
  animation: shadows 1.2s ease-in infinite, move 1.2s ease-in infinite;
  letter-spacing: 0.5rem;
}

@keyframes shadows {
  0% {
    text-shadow: none;
  }
  10% {
    text-shadow: 3px 3px 0 var(--color-secondary);
  }
  20% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary);
  }
  30% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary), 9px 9px var(--color-quaternary);
  }
  40% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary), 9px 9px var(--color-quaternary),
      12px 12px 0 var(--color-quinary);
  }
  50% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary), 9px 9px var(--color-quaternary),
      12px 12px 0 var(--color-quinary);
  }
  60% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary), 9px 9px var(--color-quaternary),
      12px 12px 0 var(--color-quinary);
  }
  70% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary), 9px 9px var(--color-quaternary);
  }
  80% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary);
  }
  90% {
    text-shadow: 3px 3px 0 var(--color-secondary);
  }
  100% {
    text-shadow: none;
  }
}

@keyframes move {
  0% {
    transform: translate(0px, 0px);
  }
  40% {
    transform: translate(-12px, -12px);
  }
  50% {
    transform: translate(-12px, -12px);
  }
  60% {
    transform: translate(-12px, -12px);
  }
  100% {
    transform: translate(0px, 0px);
  }
}

#scroll-down-button {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      font-size: 18px;
      border: none;
      outline: none;
      background-color: #555;
      color: white;
      cursor: pointer;
      padding: 15px;
      border-radius: 4px;
    }

    .custom-modal-size {
    max-width: 1300px; /* Adjust the width as needed */
    max-height: 600px; /* Adjust the height as needed */
  }
</style>

<script>

</script>

<br>
<br><br>


@if (session()->has('massege'))
    <div class="w-4/5 m-auto mt-10 pl-2">
        <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded2xl py-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif
<br><br>

<button onclick="scrollToBottom()" id="scroll-down-button" title="Scroll Down">▼</button>

@foreach($posts as $post)

<div class="row">
    <div class="column">
        <div class="card">
            <br>
            <div><center>
                <img src="{{ asset('images/' . $post->image_path) }}" style="height: 500px; width: 700px;" class="img-fluid" alt="">
            </div></center><br>

            <div class="text">
                    <h6><a href="{{ $post->user->avatar }}"><img class="rounded-circle" height="70" width="70" src="{{$post->user->avatar}}"
                    alt="User profile picture"></a>  &nbsp;&nbsp;{{ $post->user->name }}</h6>
            <h5>
                {{ date('d/m/Y', strtotime($post->updated_at)) }} &nbsp;
            {{ date('H:i A', strtotime($post->updated_at)) }}

            </h5>
            </div>

            <p>
                {{ $post->description }}
            </p>

            <span>
            @guest
        <i class="fas fa-thumbs-up" aria-hidden="true"></i>{{ $post->likedUsers->count() }} liked
    @else
        <a href="#" onclick="document.getElementById('like-form-{{ $post->id }}').submit();"><i class="fas fa-thumbs-up"
        aria-hidden="true"></i></a>
        {{ $post->likedUsers->count() }} liked

        <form action="{{ route('post.like', $post->id) }}" method="POST" style="display: none;" id="like-form-{{ $post->id }}">
        @csrf
        </form>
    @endguest
           &nbsp;&nbsp;

            <i class="fas fa-comment-dots" aria-hidden="true"></i>
            <a href="#exampleModal"  data-toggle="modal" style="color: black;">{{ $post->comments->count() }} Comments</a>
            </span>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog custom-modal-size" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
       <h3 class="modal-title" id="exampleModalLabel">Comments</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
      </div>
      <div class="modal-body">
      @if (Auth::check())
        <form method="post" action="{{ route( 'comments.store' ) }}">
        @csrf
            <div class="form-group">
                <textarea class="form-control-first" name="body" rows="2" cols="120.5" style="margin-right: 200px;"></textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" style="font-style: italic; background-color:#28A828; font-size:medium;
                padding: 8px; border:2px solid white; color: white; margin-right: 50px;" value="Add Comment" /><br><br>
            </div>
        </form>

<hr style="width:85%">

        @include('blog.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
@endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

            <a href="/blog/{{ $post->slug }}" class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            View Full Post
            </a>

            @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <span class="float-right" style="font-style:italic;">
                            <a href="/blog/{{ $post->slug }}/edit"
                            class="text-gray-700 hover:text-gray-900 pb-1 border-b-2">
                            Edit
                            </a>
                        </span>
                    </div><br>
                    &nbsp;
                    &nbsp;
            <span class="float-right">
                <form
                    action="/blog/{{ $post->slug }}"
                    method="POST">
                    @csrf
                    @method('delete')

                    <div class="col-sm" style="font-style:italic;">
                        <div>
                            <button type="submit" onclick="return confirm('Are you sure to delete this post?')">
                                Delete
                            </button>
                        </div>
                    </div>
                </form>
            </span>
            </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("scroll-down-button").style.display = "block";
    } else {
      document.getElementById("scroll-down-button").style.display = "none";
    }
  }

  function scrollToBottom() {
    document.body.scrollTop = document.body.scrollHeight;
    document.documentElement.scrollTop = document.documentElement.scrollHeight;
  }
</script>
<br><br>
@endforeach
@endsection
