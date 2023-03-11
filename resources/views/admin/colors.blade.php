@extends('layouts.app')


@section('content')

<div class="content">
    <div class="content-header">
        <div class="header-item">
            <h1>Colors</h1>
            <small>Add Color</small>
        </div>

        <div class="header-item">
            <form action="{{ route('admin.colors.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="primary">Primary Color</label>
                    <input type="color" name="colors[primary]" id="primary" value="{{ $colors->primary }}" />
                </div>
                <div class="form-group">
                    <label for="second">Second Color</label>
                    <input type="color" name="colors[second]" id="second" value="{{ $colors->second }}"/>
                </div>
                <div class="form-group">
                    <label for="tertiary">Tertiary Color</label>
                    <input type="color" name="colors[tertiary]" id="tertiary" value="{{ $colors->tertiary }}"/>
                </div>
                <button type="submit">Kaydet</button>
            </form>
        </div>

    </div>

</div>


@endsection

