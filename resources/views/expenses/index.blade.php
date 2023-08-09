@extends('layouts.app')

@section('content')
    <h2>Expense Records</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Description</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>
                        <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $expenses->links() }}
@endsection
