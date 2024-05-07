@extends('layouts.master')
@section('content')
@section('title', 'Inventory')
<script src="
https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js
"></script>


<link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />


<style>
    .rectangle {
        height: 200px;
        width: 350px;
        margin-left: 10px;
        border-style: solid;
        align-content: center;
    }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4">HELLO</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ strtoupper(Auth::user()->name) }}</li>
    </ol>
</div>





<style>
    /* CSS to adjust the size of the calendar container */
    #calendar {
        width: 1200px;
        /* Set the width as needed */
        height: 1000px;
        /* Set the height as needed */
        margin: 0 auto;
        /* Center the calendar horizontally */
    }
</style>

<body>
    <!-- Calendar container -->
    <div id="calendar"></div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include FullCalendar and Moment.js -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>

    <!-- Your JavaScript code for FullCalendar -->
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },

            });
        });
    </script>
</body>
@endsection
