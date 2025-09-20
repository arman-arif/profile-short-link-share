@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Users </h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">All Users</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mb-4">
                            <thead>
                            <tr>
                                <th nowrap>Avatar</th>
                                <th nowrap>Name</th>
                                <th nowrap>Email</th>
                                <th>About</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td nowrap>
                                        <img
                                            width="40" height="40"
                                            src="{{ $user->avatar_url }}"
                                            alt="{{ $user->name }}"
                                            class="object-fit-cover rounded-circle"
                                        />
                                    </td>
                                    <td nowrap>{{ $user->name }}</td>
                                    <td nowrap>{{ $user->email }}</td>
                                    <td>{{ Str::limit($user->about) }}</td>
                                    <td class="table-action">
                                        <form action="{{ route('admin.user.status', [$user, $user->is_disabled ? 'enable' : 'disable']) }}" method="POST" class="d-inline">
                                            <button class="btn {{ $user->is_disabled ? 'text-success' : 'text-danger' }}"
                                               onclick="return confirm('Are you sure? You want to {{ $user->is_disabled ? 'enable' : 'disable' }} this user?') || event.stopImmediatePropagation()"
                                            >
                                                <i class="align-middle" data-feather="power"></i>
                                            </button>
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                        <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn"
                                                    onclick="return confirm('Are you sure? You want to delete this user?') || event.stopImmediatePropagation()"
                                            >
                                                <i class="align-middle" data-feather="trash-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
