@extends('layouts.usermaster')
@section('content')
@section('title', 'Financial Report')


<link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="styles.css">
<div class="container-fluid">
    <br>
    <div class="card">
        <div class="card-header">
            <h4>View summary<a href="{{ 'add-summary' }}" class="btn btn-primary btn-sm float-end">Add sum</a></h4>
            <button onclick="window.print()">Print this page</button>
        </div>

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif



        <div class="container-fluid">
            <table class="table">
                <tbody>
                    <!-- First Container -->
                    <tr>
                        <th scope="row">Month</th>
                        @foreach ($summary as $item)
                            <td>{{ \Carbon\Carbon::createFromFormat('m', $item->month)->format('F') }}
                                {{ $item->year }}
                            </td>
                        @endforeach
                    </tr>

                    <tr>
                        <th scope="row">Starting balance:</th>
                        @foreach ($summary as $item)
                            <td>
                                <p>PHP: {{ number_format($item->beginbal ?? 0, 0, '.', ',') }}</p>
                            </td>
                        @endforeach
                    </tr>

                    <!-- Second Container -->




                    @foreach ($btypes as $btype)
                        <tr>
                            <th colspan="{{ count($months) + 1 }}">{{ $btype->name }}</th>
                        </tr>
                        @foreach ($btype->bstypes as $bstype)
                            <tr>
                                <td>{{ $bstype->bsname }}</td>
                                @foreach ($months as $year => $month)
                                    <td>
                                        @if (isset($totalBudgetAmountByMonth[$month][$btype->name][$bstype->bsname]))
                                            {{ number_format($totalBudgetAmountByMonth[$month][$btype->name][$bstype->bsname], 2) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach



















                    <tr>
                        <th scope="row">Total Starting</th>
                        @foreach ($summary as $item)
                            <td><strong> PHP: {{ number_format($item->totalstr, 0, '.', ',') }}.00</strong></td>
                        @endforeach
                    </tr>
                    <br>

                    <tr>
                        <th scope="row">Expenses</th>
                    </tr>


                    <!-- Third Container -->
                    @foreach ($types as $type)
                        <tr>
                            <th scope="row">{{ $type->name }}</th>
                        </tr>
                        @foreach ($type->stypes as $stype)
                            <tr>
                                <td scope="row">{{ $stype->sname }}</td>
                                @foreach ($months as $month)
                                    <td>
                                        @if (isset($totalExpensesByStypeAndType[$stype->id][$type->id][$month]))
                                            {{ number_format($totalExpensesByStypeAndType[$stype->id][$type->id][$month], 2) }}
                                        @else
                                            @if ($month == $currentMonth)
                                                - <!-- Display nothing for the current month with no data -->
                                            @else
                                                0.00 <!-- Display 0.00 for the previous month with no data -->
                                            @endif
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach








                    <tr>
                        <th scope="row">Total Expenses</th>
                        @foreach ($months as $month)
                            @php
                                $totalAmount = 0;
                                foreach ($totalExpensesByMonth as $expense) {
                                    if ($expense['month'] == $month) {
                                        $totalAmount = $expense['total_amount'];
                                        break;
                                    }
                                }
                            @endphp
                            <td>
                                PHP: {{ $totalAmount > 0 ? number_format($totalAmount, 0, '.', ',') : '-' }}
                            </td>
                        @endforeach
                    </tr>





                    <tr>
                        <th scope="row">Ending Balance</th>
                        @foreach ($summary as $item)
                            <td><strong> PHP: {{ number_format($item->aftexpenses, 0, '.', ',') }}.00</strong></td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

    @endsection
