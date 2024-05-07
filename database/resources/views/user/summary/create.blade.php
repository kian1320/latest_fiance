@extends('layouts.usermaster')
@section('content')
@section('title', 'items')



<div class="container-fluid px-4">
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="">Add Monthly Budget</h4>
        </div>
        <div class="cardbody">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('budget.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="month">Month</label>
                    <select name="month" class="form-control">
                        @for ($month = 1; $month <= 12; $month++)
                            @php
                                $monthName = date('F', mktime(0, 0, 0, $month, 1));
                                $isSelected = $month == date('n') ? 'selected' : '';
                            @endphp
                            <option value="{{ $month }}" {{ $isSelected }}>{{ $monthName }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="year">Year</label>
                    <input type="text" name="year" id="year" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="type">Type (Cash or Check)</label>
                    <input type="text" name="type" id="type" class="form-control">
                </div>




                @foreach ($btypes as $btype)
                    <div class="mb-3">
                        <label><strong>{{ $btype->name }}</strong></label>

                        @foreach ($btype->bstypes as $bstype)
                            <div class="mb-2">
                                <label
                                    for="budgets[{{ $btype->id }}][{{ $bstype->id }}]">{{ $bstype->bsname }}</label>
                                <input type="text" name="budgets[{{ $btype->id }}][{{ $bstype->id }}]"
                                    class="form-control" placeholder="Input Amount for {{ $bstype->bsname }}">
                            </div>
                        @endforeach
                    </div>
                @endforeach






                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>





            </form>

        </div>

    </div>

</div>




@endsection
