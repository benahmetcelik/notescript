@extends('layouts.app')

@section('content')


<div class="b-header">
    <div class="note-title">
        <h1>
          {{ $note->title }}
        </h1>
    </div>
    <div class="social-icons">

        <a href="#" data-url="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}&quote={{ $note->title }}" class="sharers">
            <img src="{{ asset('assets/img/social-icons/facebook.png') }}" alt="Facebook" />
        </a>

        <a href="#" data-url="http://twitter.com/share?text={{ $note->title }}&url={{ request()->url() }}" class="sharers">
            <img src="{{ asset('assets/img/social-icons/twitter.png') }}" alt="twitter" />
        </a>



        <a href="#" data-url="https://www.linkedin.com/sharing/share-offsite/?url={{ request()->url() }}" class="sharers">
            <img src="{{ asset('assets/img/social-icons/linkedin.png') }}" alt="linkedin" />
        </a>

        <a href="#" data-url="whatsapp://send?text={{ $note->title.' | '.request()->url() }}" data-action="share/whatsapp/share" class="sharers">
            <img src="{{ asset('assets/img/social-icons/whatsapp.png') }}" alt="whatsapp" />
        </a>



    </div>
</div>
<div class="ads">
    @if ($banners->count() > 0)
        @foreach ($banners as $banner)
        @if ($banner->position == 0 || $banner->position == 0)
        @php
    $banner->view = $banner->view + 1;
    $banner->save();
@endphp
        <a href="{{ route('clickBanner',$banner->uid) }}" target="_blank">
            <img src="{{  $banner->image_link }}"  alt="{{  $banner->title }}" />
        </a>
        @endif

        @endforeach

    @endif
</div>
<div class="input">
    <textarea name="note" readonly>{{ $note->content }}</textarea>
</div>

@if ($banners->count() > 0)
@foreach ($banners as $banner)
@if ($banner->position == 2 || $banner->position == 3)
@php
    $banner->view = $banner->view + 1;
    $banner->save();
@endphp
<a href="{{ route('clickBanner',$banner->uid) }}" target="_blank">
    <img src="{{  $banner->image_link }}"  alt="{{  $banner->title }}" />
</a>
@endif

@endforeach

@endif
@endsection
