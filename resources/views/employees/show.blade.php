@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
<div class="container">
    <h2>Employee Details</h2>
    <div class="card p-3">
        <p><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>
        <p><strong>Phone:</strong> {{ $employee->phone }}</p>
        <p><strong>Address:</strong> {{ $employee->address }}</p>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
