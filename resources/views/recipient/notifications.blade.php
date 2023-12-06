@extends('layouts.recipient')
@section('title', 'Notification')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div><h2 class="title">Notification</h1></div>
            {{-- <div class="d-flex align-items-center"><a class="btn btn-primary" href="{{ route('admin.about.add') }}"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Add</a></div> --}}
        </div>
        <div class="col-lg-12 mb-20">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        </div>
        <div class="col-lg-12">
            <div class="box">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <th>ID</th>
                                    <th>Message</th>
                                    <th>Received Date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($notificationss as $notification)
                                        <tr>
                                            <td>{{ $notification->id }}</td>
                                            <td>{{ $notification->message }}</td>
                                            <td>{{ $notification->created_at }}</td>
                                            <td>
                                                <form action="{{ route('recipient.notifications.status', $notification->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')       
                                                    <div class="d-flex">         
                                                        <div class="me-2"><button type="submit" title="Delete" class="{{ $notification->read_status === 1 ? "btn btn-primary disabled" : "btn btn-primary"}}" value="1" name="read_status">Read</button></div>
                                                        <div><button type="submit" title="Delete" class="{{ $notification->read_status === 0 ? "btn btn-primary disabled" : "btn btn-primary"}}" value="0" name="read_status">Unread</button></div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection