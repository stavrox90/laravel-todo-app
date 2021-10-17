@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <h5 class="card-header">
                        <a href="{{ route('todo.create') }}" class="btn btn-sm btn-outline-primary">Add item</a>

                        <a href="{{ route('todo.show', 1) }}" class="btn btn-sm btn-outline-warning">Add item</a>
                    </h5>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-hover table-borderless">
                            <thead>
                                <th scope="col">Item</th>
                                <th scope="col">Action</th>
                            </thead>
                            <tbody>
                                @forelse ($todos as $todo)
                                    <tr>
                                        @if ($todo->completed)
                                            <td scope="row"><s>{{ $todo->title }}</s></td>
                                        @else
                                            <td scope="row">{{ $todo->title }}</td>
                                        @endif
                                        <td>
                                            <a href="{{ route('todo.edit', $todo->id) }}"
                                                class="btn btn-sm btn-outline-success">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            <a href="{{ route('todo.destroy', $todo->id) }}"
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No item!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
