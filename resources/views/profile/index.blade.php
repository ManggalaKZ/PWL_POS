@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile Settings</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center mb-4">
                                    <img class="rounded-circle"
                                         src="{{ asset($user->avatar) }}"
                                         alt="Profile Picture"
                                         style="width: 150px; height: 150px;">
                                    <div class="mt-2">
                                        <button onclick="modalAction('{{ url('/profile/' . session('user_id') . '/edit_foto') }}')"
                                                class="btn btn-primary">Edit Foto</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $user->user_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Level</th>
                                        <td>{{ $user->level->level_nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $user->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td>********</td>
                                    </tr>
                                </table>
                                <div class="text-center">
                                    <button onclick="modalAction('{{ url('/profile/' . session('user_id') . '/edit_ajax') }}')"
                                            class="btn btn-primary">Edit Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
    </script>
@endpush