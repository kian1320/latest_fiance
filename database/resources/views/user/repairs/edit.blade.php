@extends('layouts.usermaster')
@section('content')
@section('title', 'items')



<div class="container-fluid px-4">
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="">Edit Item</h4>
        </div>
        <div class="cardbody">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ url('user/update-repairs/' . $Repairs->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="">Repair</label>
                    <input type="text" name="repair" value="{{ $Repairs->repair }}" class="form-control">
                </div>






                <div class="mb-3">

                    <button type="submit" class="btn btn-success">Submit</button>
                </div>





            </form>

        </div>

    </div>

</div>




@endsection
