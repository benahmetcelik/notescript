@extends('layouts.app')

@section('content')
<form action="{{ route('save-note') }}" method="POST">
@csrf
<div class="b-header">
    <input type="text" name="title" class="note-name" placeholder="Text Title" >
    <button type="submit" class="share-note">Share Note</button>
 </div>
 <div class="input">
     <textarea name="note" placeholder="{{ trans('Start text...') }}"></textarea>
 </div>


</form>
@endsection
