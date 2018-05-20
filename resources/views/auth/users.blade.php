@extends('layouts.app')

@section('content')
        <div class="panel panel-default">
                <div class="panel-heading">
                    Users
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                            <thead>
                                <th>
                                        Name
                                </th>
                                <th>
                                        Permissions
                                </th>
                            </thead>

                            <tbody>
                                @if($users->count() > 0)
                                        @foreach($users as $user)
                                            <tr>
                                                    <td>
                                                        {{ $user->name }}
                                                    </td>
                                                    <td>
                                                        @if ($user->isAdmin())
                                                            <a href="{{ route('user.not.admin', ['id' => $user->id]) }}" class="btn btn-primary" type="button">REMOVE ADMIN PERMISSION</a>
                                                        @else
                                                            <a href="{{ route('user.admin', ['id' => $user->id]) }}" class="btn btn-primary" type="button">MAKE USER ADMIN</a>
                                                        @endif
                                                    </td>
                                            </tr>
                                        @endforeach
                                @else
                                        <tr>
                                            <th colspan="5" class="text-center">No users</th>
                                        </tr>
                                @endif
                            </tbody>
                    </table>
                </div>
        </div>

@stop
