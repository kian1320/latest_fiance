<!-- user/stypes/edit.blade.php -->
@extends('layouts.usermaster')
@section('content')
@section('title', 'items')

<div class="container-fluid px-4">
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="">Edit Stype</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ url('user/stypes/' . $stype->id) }}" method="post">
                @csrf
                @method('PUT')
                <!-- Method spoofing -->
                <label for="sname">Stype Name:</label>
                <input type="text" name="sname" value="{{ $stype->sname }}" class="form-control">

                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
