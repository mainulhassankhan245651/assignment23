@extends('layouts.app')

@section('content')
    <h2>Income Records</h2>

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
            @foreach ($incomes as $income)
                <tr>
                    <td>{{ $income->amount }}</td>
                    <td>{{ $income->description }}</td>
                    <td>{{ $income->date }}</td>
                    <td>
                        <a href="{{ route('incomes.edit', $income) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('incomes.destroy', $income) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $incomes->links() }}
@endsection
