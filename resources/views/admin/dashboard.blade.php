@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Admin Dashboard - Message Approvals</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Content</th>
                <th>Status</th>
                <th>Approve</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->sender_id }}</td>
                    <td>{{ $message->receiver_id }}</td>
                    <td>{{ $message->content }}</td>
                    <td>{{ $message->status }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.approveMessage', $message->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
