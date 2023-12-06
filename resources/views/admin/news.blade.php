@extends('layouts.admin')
@section('title', 'News')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">News</h1></div>
                <div class="d-flex align-items-center"><a class="btn btn-primary" href="{{ route('admin.news.add') }}"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Add</a></div>
            </div>
            <div class="col-lg-12 mb-20">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <div class="box">
                    <div class="row">
                        <div class="col-lg-10">
                            <form action="{{ route('admin.news.search') }}" method="GET">
                                <div class="input-group mb-3 mb-lg-0">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" class="form-control" name="search" placeholder="Search by Title" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary w-100">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($news as $new)
                                            <tr>
                                                <td>{{ $new->id }}</td>
                                                <td>{{ $new->title }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('admin.news.view', $new->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                        {{-- <div class="action-button"><a href="{{ route('admin.news.edit', $new->id) }}" title="Edit"><i class="fa-solid fa-pencil"></i></a></div> --}}
                                                        <form action="{{ route('admin.news.destroy', $new->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="action-button"><button type="submit" title="Delete" class="color-red"><i class="fa-solid fa-trash"></i></button></div>
                                                        </form>
                                                    </div>
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