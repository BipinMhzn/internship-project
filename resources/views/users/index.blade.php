@extends('layouts.app')

@section('content')
    <section class="main-content w-100">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-10">
                    <h2 class="page-title">Users</h2>
                    <p>List of Users</p>
                </div>
                <div class="col-md-2 text-right">
                    <a href="/register" class="btn btn-lg btn-outline-theme"">
                        <i class="fa fa-paper-plane-o"></i> Invite
                    </a>
                </div>
            </div>

            @include('partials.session.success')

            <div class="table-responsive mb-4">
                <table class="table table-hover table-theme table-events-records">
                    <thead>
                    <tr>
                        <th class="cursor-link">Name </th>
                        <th class="cursor-link">Email Address </th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role == 1)
                                    Manager
                                @else
                                    Employee
                                @endif
                            </td>
                            <td>
                                @if(Auth()->user()->id != $user->id)
                                    <div class="row" >
                                        <div class="col-md-2">
                                            <a href="/users/{{ $user->id }}/edit" class="btn btn-outline-theme"><i class="fa fa-edit"></i></a>
                                        </div>
                                        <div class="col-md-10">
                                            <form action="/users/{{$user->id}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger" onclick="return destroy()"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('footer-scripts')
    <script>
        function destroy() {
            return confirm('Are you sure to delete this user?');
        }
    </script>
@endpush
