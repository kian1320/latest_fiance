@extends('layouts.usermaster')
@section('content')
@section('title', 'Financial Report')

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif




<link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<div class="container-fluid">
    <br>
    <div class="card">
        <div class="card-header">
            <h4>View Expense Types <a href="{{ 'add-types' }}" class="btn btn-primary btn-sm float-end">Add
                    Expense Type</a></h4>

        </div>

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <table id="Itemstable" class="table table-bordered table-striped">

            <thead>
                <tr>

                    <th>name</th>
                    <th>Sub Types</th>
                    <th>Edit</th>
                    <th>Delete</th>




                </tr>
            </thead>
            <tbody>
                @foreach ($types as $item)
                    <tr>

                        <td>{{ $item->name }}</td>






                        <td align="center">
                            <a href="{{ url('user/stypes/' . $item->id) }}" class="btn btn-outline-primary">Add/View</a>
                        </td>

                        <td align="center">
                            <a href="{{ url('user/edit-types/' . $item->id) }}" class="btn btn-outline-success">Edit</a>
                        </td>

                        <td align="center">
                            <a href="{{ url('user/delete-types/' . $item->id) }}" class="btn btn-outline-danger"
                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                Delete
                            </a>
                            <form id="delete-form-{{ $item->id }}"
                                action="{{ url('user/delete-btypes/' . $item->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>


                    </tr>
                @endforeach
            </tbody>


        </table>
        <div>


            <button onclick="window.print()">Print this page</button>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#Itemstable').DataTable({
            // DataTable options...
            // ...
            "initComplete": function() {
                calculateSum();
            },
            "drawCallback": function() {
                calculateSum();
            }
        });

        function calculateSum() {
            if (table && table.rows) {
                var sum = 0; // Initialize the sum variable
                var filteredData = table.rows({
                    search: 'applied'
                }).data();

                table.rows({
                    search: 'applied'
                }).data().each(function(row) {
                    var amount = parseFloat(row['amount']);
                    console.log('Amount:', amount); // Add this line for debugging

                    if (!isNaN(amount)) {
                        sum += amount;
                    }
                });

                console.log('Sum:', sum); // Add this line for debugging

                $('#totalDisplay').text(sum.toFixed(
                    2)); // Replace #totalDisplay with the element where you want to display the sum
            }
        }
    });
</script>
@endsection
