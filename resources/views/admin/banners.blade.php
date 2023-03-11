@extends('layouts.app')


@section('content')

<div class="content">
    <div class="content-header">
        <div class="header-item">
            <h1>Banners</h1>
            <small>Add Banners</small>
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
                        <th>Image</th>
                        <th>Title</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Position</th>
                        <th>Click</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($banners as $user)
                    <tr>
                        <td><img src="{{ $user->image_link }}" alt="" width="50"></td>
                        <td>{{ $user->title }}</td>
                        <td>{{ $user->start_date }}</td>
                        <td>{{ $user->end_date }}</td>
                        <td>{{ $user->status }}</td>
                        <td>{{ $user->position }}</td>
                        <td>{{ $user->click }}</td>
                        <td>
                            @if (auth()->user()->id != $user->id)
                            <a href="{{ route('admin.banners.delete',$user->id) }}">Delete</a>
                            @endif

                        </td>
                    </tr>
                    @endforeach


                </tbody>

            <tfoot>
                <tr>

                    <td colspan="3">
                            {!! $banners->links('pagination::default') !!}

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
            <p>Add Banner Form</p>
            <form action="{{ route('admin.banners.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="title" id="name" />
                </div>

                <div class="form-group">
                    <label for="name">Link</label>
                    <input type="text" name="link" id="name" />
                </div>

                <div class="form-group">
                    <label for="name">Image Link</label>
                    <input type="text" name="image_link" id="name" />
                </div>

                <div class="form-group">
                    <label for="name">Start Date</label>
                    <input type="date" name="start_date" id="name" />
                </div>

                <div class="form-group">
                    <label for="name">End Date</label>
                    <input type="date" name="end_date" id="name" />
                </div>

                <div class="form-group">
                    <label for="name">Status</label>
                    <select name="status" id="name">
                        <option value="0">Passive</option>
                        <option value="1">Active</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Position</label>
                    <select name="position" id="name">
                        <option value="0">Left Top</option>
                        <option value="1">Right Top</option>
                        <option value="2">Right Bottom</option>
                        <option value="3">Left Bottom</option>
                    </select>
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
