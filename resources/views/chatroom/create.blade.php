@extends('layouts.app')

@section('content')

@include('includes.errors')

<div class="panel panel-default">
    <div class="panel-heading">
          Existing Chat Rooms
    </div>

    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                  <th>
                        Name
                  </th>
                  <th>
                        Users
                  </th>
                  <th>  
                        Delete
                  </th>
            </thead>

            <tbody>
                  @if($rooms->count() > 0)
                        @foreach($rooms as $room)
                              <tr>
                                    <td>
                                          {{ $room->name }}
                                    </td>
                                    <td>
                                        {{ count($room['count'])}}
                                    </td>
                                    <td>
                                       @if(count($room['count'])==0)
                                            <a href="{{ route('chatroom.delete', ['id' => $room->id]) }}" class="btn btn-primary" type="button">DELETE IT</a>
                                       @else
                                            WE CAN NOT DELETE    
                                       @endif     
                                    </td>
                              </tr>
                        @endforeach
                  @else
                        <tr>
                              <th colspan="5" class="text-center">No Chat Rooms</th>
                        </tr>
                  @endif
            </tbody>
        </table>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">
          Create a new Chat Room
    </div>

    <div class="panel-body">
          <form action="{{ route('chatroom.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                      <div class="text-center">
                            <button class="btn btn-success" type="submit">
                                  Store chatroom
                            </button>
                      </div>
                </div>
          </form>
    </div>
</div>
@endsection
