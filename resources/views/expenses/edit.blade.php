@extends('layouts.app')

@section('content')
    <h2>Edit Expense Record</h2>

    <form action="{{ route('expenses.update', $expense) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" name="amount" class="form-control" value="{{ $expense->amount }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" class="form-control" value="{{ $expense->description }}" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" value="{{ $expense->date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Expense</button>
    </form>
@endsection
