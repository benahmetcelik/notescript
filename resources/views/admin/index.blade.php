@extends('layouts.app')


@section('content')

<div class="admin-stats">
    <div class="admin-stats-item">
        <div class="admin-stats-item-title">
            <p>Toplam Kullanıcı</p>
        </div>
        <div class="admin-stats-item-value">
            <p>{{ $users }}</p>
        </div>
    </div>

    <div class="admin-stats-item">
        <div class="admin-stats-item-title">
            <p>Toplam Not</p>
        </div>
        <div class="admin-stats-item-value">
            <p>{{ $notes }}</p>
        </div>
    </div>

    <div class="admin-stats-item">
        <div class="admin-stats-item-title">
            <p>Toplam Görüntülenme</p>
        </div>
        <div class="admin-stats-item-value">
            <p>{{ $note_views }}</p>
        </div>
    </div>
</div>

<div class="admin-actions">

    <div class="admin-actions-item">
        <a href="{{ route('admin.users') }}">
            <img src="{{ asset('assets/img/admin/users.png') }}" alt="admin" />
            <p>Kullanıcılar</p>
        </a>
    </div>

    <div class="admin-actions-item">
        <a href="{{  route('admin.notes') }}">
            <img src="{{ asset('assets/img/admin/note.png') }}" alt="admin" />
            <p>Notlar</p>
        </a>
    </div>

    <div class="admin-actions-item">
        <a href="{{ route('admin.banners') }}">
            <img src="{{ asset('assets/img/admin/banner.png') }}" alt="admin" />
            <p>Banners</p>
        </a>
    </div>



</div>


<div class="admin-actions">

    <div class="admin-actions-item">
        <a href="{{ route('admin.colors') }}">
            <img src="{{ asset('assets/img/admin/color.png') }}" alt="admin" />
            <p>Renkler</p>
        </a>
    </div>

    <div class="admin-actions-item">
        <a href="{{ route('admin.settings') }}">
            <img src="{{ asset('assets/img/admin/setting.png') }}" alt="admin" />
            <p>Ayarlar</p>
        </a>
    </div>

    <div class="admin-actions-item">

        <a href="{{ route('admin.backup') }}">
            <img src="{{ asset('assets/img/admin/backup.png') }}" alt="admin" />
            <p>Backup</p>
        </a>
    </div>
</div>


@endsection
