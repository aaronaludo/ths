@extends('layouts.recipient')
@section('styles')
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Qr Scanner')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Qr Scanner</h2></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="container">
                                <div id="scanner-container">
                                    <video id="scanner" playsinline></video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const scannerContainer = document.getElementById('scanner-container');
    const scanner = new Instascan.Scanner({ video: document.getElementById('scanner') });

    scanner.addListener('scan', function (content) {
        // Content contains the scanned QR code data.
        // You can process it or send it to the server via AJAX.
        
        // Send the scanned data to the server using AJAX
        sendScannedData(content);
    });

    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function (error) {
        console.error(error);
    });

    function sendScannedData(content) {
        const csrfToken = document.querySelector("meta[name='csrf-token']").getAttribute('content');

        // Send a POST request to the server
        fetch("{{ route('recipient.track-document-reviews.qr-scanner-result') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ result: content })
        })
        .then(response => response.json())
        .then(data => {
            if (data.trackDocument === 'No recipient found') {
                alert('Recipient not found');
            } else {
                // Redirect to another page with the trackDocument data
                window.location.href = '{{ route('recipient.track-document-reviews.view', '') }}/' + data.trackDocument.id;
            }
        })
        .catch(error => {
            console.error(error);
        });
    }
</script>
@endsection
