@extends('layouts.app')


@section('content')

<div class="content">
    <div class="content-header">
        <div class="header-item">
            <h1>Notes</h1>
            <small>All Notes</small>
         </div>


    </div>


    <div class="content-body">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>View</th>
                        <th>Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($notes as $note)
                    <tr>
                        <td>{{ Str::limit($note->title, 12, '...') }}</td>
                        <td>{{ $note->view }}</td>
                        <td>{{ $note->user ? $note->user->name : 'Guest' }}</td>
                        <td>

                            <a href="{{ route('admin.notes.delete',$note->link) }}">Delete</a>
                            <a href="{{ route('get-note',$note->link) }}">Show</a>

                        </td>
                    </tr>
                    @endforeach


                </tbody>

            <tfoot>
                <tr>

                    <td colspan="3">
                            {!! $notes->links('pagination::default') !!}

                    </td>

                </tr>
            </tfoot>




            </table>

        </div>

    </div>
</div>


@endsection

