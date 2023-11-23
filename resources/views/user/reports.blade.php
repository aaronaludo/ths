@extends('layouts.user')
@section('title', 'Reports')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Reports</h2></div>
            </div>
            <div class="col-lg-6">
                <div class="box">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box">
                    <canvas id="myChart2" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        var data = {
            labels: ['Successful', 'Pending', 'Failed'],
            datasets: [
                {
                    label: "Document Tracks",
                    data: [{{ $successRequestDocuments }}, {{ $pendingRequestDocuments }}, {{ $failedRequestDocuments }}],
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                },
            ],
        };
  
        var data2 = {
          labels: ['Succesfull', 'Pending', 'Failed'],
          datasets: [
            {
              label: "Document Requests",
              data: [{{ $successTrackDocuments }}, {{ $pendingTrackDocuments }}, {{ $failedTrackDocuments }}],
              backgroundColor: "rgba(75, 192, 192, 0.2)",
              borderColor: "rgba(75, 192, 192, 1)",
              borderWidth: 1,
            },
          ],
        };

        var options = {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        };
  
        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx, {
          type: "bar",
          data: data,
          options: options,
        });
        
        var ctx = document.getElementById("myChart2").getContext("2d");
        var myChart = new Chart(ctx, {
          type: "bar",
          data: data2,
          options: options,
        });

    </script>
@endsection