@extends('layouts.app')

@section('content')
    <h2>Add New Income</h2>

    <form action="{{ route('incomes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" name="amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Income</button>
    </form>
@endsection
