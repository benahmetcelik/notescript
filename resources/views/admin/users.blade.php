@extends('layouts.app')


@section('content')

<div class="content">
    <div class="content-header">
        <div class="header-item">
            <h1>Users</h1>
            <small>Kullanıcı Ekleyebilrisinz</small>
            <button class="open-modal" data-modal-id="modal">Ekle</button>
        </div>

        <div class="header-item">
            <form action="" method="get">
                <input type="text" name="search" placeholder="Search" value="{{ request()->get('search') }}" />
                <button type="submit">Search</button>
            </form>
        </div>

    </div>


    <div class="content-body">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if (auth()->user()->id != $user->id)
                            <a href="{{ route('admin.users.delete',$user->id) }}">Delete</a>
                            @endif

                        </td>
                    </tr>
                    @endforeach


                </tbody>

            <tfoot>
                <tr>

                    <td colspan="3">
                            {!! $users->links('pagination::default') !!}

                    </td>

                </tr>
            </tfoot>




            </table>

        </div>

    </div>
</div>


@endsection


@push('modal')
<div class="modal " id="modal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title">Modal</div>
            <div class="modal-close" id="modal-close">X</div>
        </div>
        <div class="modal-body">
            <p>Add User Form</p>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="name" id="name" />
                </div>

                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" id="email" />
                </div>


                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>


            <div class="modal-footer">
                <button type="submit" class="modal-footer-btn">Save</button>
                <button class="modal-footer-btn">Cancel</button>
            </div>
        </form>
        </div>

    </div>

</div>

@endpush
