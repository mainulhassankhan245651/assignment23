@extends('layouts.app')

@section('content')
    <h2>Edit Income Record</h2>

    <form action="{{ route('incomes.update', $income) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" name="amount" class="form-control" value="{{ $income->amount }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" class="form-control" value="{{ $income->description }}" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" value="{{ $income->date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Income</button>
    </form>
@endsection
