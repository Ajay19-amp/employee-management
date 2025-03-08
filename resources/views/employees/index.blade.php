@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="container">
    <h2 class="mb-4">Employee List</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <!-- Display both first_name and last_name -->
                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
