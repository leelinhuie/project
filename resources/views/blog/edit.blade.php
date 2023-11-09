@extends('layout')

@section('content')

<style>
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
</style>

<br>
<br>
<br>
<br>
<div class="content">
  <h2 class="text_shadows">Update Post</h2>
</div><br><br>

@if ($errors->any())
    <div>
        <ul style="margin-left: 36em;">
            @foreach ($errors->all() as $error)
                <li style="color:red; font-style:italic;">
                    {{ $error }}
                </li><br>
            @endforeach
        </ul>
    </div>
@endif

<center>
<div class="w-4/5 m-auto pt-20">
    <form
        action="/blog/{{ $post->slug }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input
            style="width:60rem"
            type="text"
            name="title"
            value="{{ $post->title }}"
            class="bg-transparent block border-b-3 text-6xl outline-none"><br><br><br>

        <textarea
            style="height:25rem; width:60rem"
            name="description"
            placeholder="Description..."
            class="py-20 bg-transparent block border-b-2 text-xl outline-none">{{ $post->description }}</textarea> <br><br><br>

        <button
            type="submit"
            style="font-style:italic; font-size:large; background-color:green; border-style:none; color:white; width:5cm; height: 1cm;">
            Submit Post
        </button>
    </form>
</div>
</center>

@endsection
