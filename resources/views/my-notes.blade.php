@extends('layouts.app')


@section('content')
<div class="statistics">
    <div class="stat">
        <h1>{{ $count }}</h1>
        <span>Notes</span>
    </div>
    <div class="stat">
        <h1>{{ $views }}</h1>
        <span>Views</span>
    </div>
</div>



    <div class="my-notes">




        <table>
            <tr>
                <th>Title</th>
                <th>Created At</th>
                <th>View</th>
                <th>Actions</th>
            </tr>
            @foreach ($notes as $note)
            <tr>
                <td>{{ $note->getShortTitle() }}</td>
                <td>{{ $note->created_at->format('d/m/y') }}</td>
                <td>{{ $note->view }}</td>
                <td>
                    <a href="{{ route('get-note',['note'=>$note->link]) }}" target="_blank">View</a>
                    <a href="{{ route('delete-note',['note'=>$note->link]) }}">Delete</a>
                </td>
            </tr>
            @endforeach


            <tfoot>
                <tr>

                    <td colspan="3">
                            {!! $notes->links('pagination::default') !!}

                    </td>

                </tr>
            </tfoot>
        </table>
    </div>




@endsection
