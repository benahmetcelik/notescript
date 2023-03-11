@extends('layouts.app')


@section('content')

<div class="content">
    <div class="content-header">
        <div class="header-item">
            <h1>Settings</h1>
            <small>Update Setting</small>
        </div>

        <div class="header-item">
            <form action="{{ route('admin.settings.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="register">Register Status</label>
                    <select name="setting[register_status]" id="register">
                        <option value="0" @if ($settings->register_status == 0) selected  @endif>OFF</option>
                        <option value="1"  @if ($settings->register_status == 1) selected  @endif>ON</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="site_title">Site Title</label>
                    <input type="text" name="setting[site_title]" id="site_title" value="{{ $settings->site_title }}">
                </div>
                <div class="form-group">
                    <label for="site_description">Site Desc</label>
                    <input type="text" name="setting[site_description]" id="site_description" value="{{ $settings->site_description }}">

                </div>

                <div class="form-group">
                    <label for="site_footer">Site Footer</label>
                    <input type="text" name="setting[site_footer]" id="site_footer" value="{{ $settings->site_footer }}">
                </div>
                <div class="form-group">
                    <label for="site_keywords">Site Keywords</label>
                    <input type="text" name="setting[site_keywords]" id="site_keywords" value="{{ $settings->site_keywords }}">
                </div>
                <div class="form-group">
                    <label for="site_logo">Site Logo</label>
                    <input type="text" name="setting[site_logo]" id="site_logo" value="{{ $settings->site_logo }}">
                </div>

                <div class="form-group">
                    <label for="site_favicon">Site Favicon</label>
                    <input type="text" name="setting[site_favicon]" id="site_favicon" value="{{ $settings->site_favicon }}">
                </div>


                <button type="submit">Kaydet</button>
            </form>
        </div>

    </div>

</div>


@endsection

