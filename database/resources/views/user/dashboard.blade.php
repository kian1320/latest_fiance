@extends('layouts.usermaster')
@section('content')
@section('title', 'Financial Report')

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ URL('assets/js/calendar.js') }}"></script>




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

<div class="container-fluid px-4">
    <h1 class="mt-4">HELLO</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ strtoupper(Auth::user()->name) }}</li>
    </ol>
</div>

<div id="calendar"></div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include FullCalendar and Moment.js -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Your JavaScript code for FullCalendar -->
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            dayClick: function(date, jsEvent, view) {
                // Display a form to input notes, date, and time
                var note = prompt('Add a note for ' + date.format('YYYY-MM-DD'));
                if (note !== null) {
                    var time = prompt('Add a time (e.g., 14:30):');
                    if (time !== null) {
                        var dateTime = date.format('YYYY-MM-DD') + ' ' + time;

                        // Send a POST request to save the note with date and time
                        $.ajax({
                            type: 'POST',
                            url: '/save-note',
                            data: {
                                note: note,
                                date: date.format('YYYY-MM-DD'),
                                time: time
                            },

                            success: function(response) {
                                // Handle the response (e.g., display a success message)
                                alert('Note saved successfully');
                                // You can optionally update the calendar here to show the new note
                                // However, this depends on your specific implementation
                            },
                            error: function(xhr, status, error) {
                                // Handle any errors that occur during the request
                                console.error(error);
                                alert('Error saving note. Please try again.');
                            }
                        });
                    }
                }
            }
        });
    });
</script>
@endsection
