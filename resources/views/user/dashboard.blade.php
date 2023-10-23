@extends('layouts.user')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row gy-3">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Dashboard</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Track Documents</div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">{{ $totalTrackDocuments }}</h2>
                            </div>
                            <div class="tile-footer"><a href="#">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Pending Track Documents</div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">{{ $pendingTrackDocuments }}</h2>
                            </div>
                            <div class="tile-footer"><a href="#">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Sucessfull Track Documents</div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">{{ $successTrackDocuments }}</h2>
                            </div>
                            <div class="tile-footer"><a href="#">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Failed Track Documents</a></span></div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">{{ $failedTrackDocuments }}</h2>
                            </div>
                            <div class="tile-footer"><a href="#">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Request Documents</a></span></div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">{{ $totalRequestDocuments }}</h2>
                            </div>
                            <div class="tile-footer"><a href="#">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Pending Request Documents</a></span></div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">{{ $pendingRequestDocuments }}</h2>
                            </div>
                            <div class="tile-footer"><a href="#">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Successful Request Documents</a></span></div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">{{ $successRequestDocuments }}</h2>
                            </div>
                            <div class="tile-footer"><a href="#">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Failed Request Documents</a></span></div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">{{ $failedRequestDocuments }}</h2>
                            </div>
                            <div class="tile-footer"><a href="#">View more...</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>Latest Track Documents</h5>
                                <a href="{{ route('track-documents.index') }}">see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($shortTrackDocuments as $document)
                                            <tr>
                                                <td>{{ $document->id }}</td>
                                                <td>{{ $document->subject }}</td>
                                                <td>{{ date("F j, Y, g:i a", strtotime($document->created_at)) }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('track-documents.view', $document->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
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
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>Latest Request Documents</h5>
                                <a href="{{ route('request-documents.index') }}">>see more</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>Type of Document</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($shortRequestDocuments as $document)
                                            <tr>
                                                <td>{{ $document->id }}</td>
                                                <td>{{ $document->type_of_document }}</td>
                                                <td>{{ $document->status->name }}</td>
                                                <td>{{ date("F j, Y, g:i a", strtotime($document->created_at)) }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('request-documents.view', $document->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
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