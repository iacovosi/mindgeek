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
                        Join
                  </th>
                  <th>  
                        Leave
                  </th>                  
                  <th>  
                        Load Joined Room Messages
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
                                        @if (!($room['isInArray']))
                                            <a href="{{ route('chatroom.enter', ['room_id' => $room->id,'user_id' => Auth::user()->id]) }}" class="btn btn-primary" type="button">JOIN</a>
                                        @else
                                            Already Joinded
                                        @endif
                                    </td>
                                    <td>
                                            @if (($room['isInArray']))
                                                <a href="{{ route('chatroom.leave', ['room_id' => $room->id,'user_id' => Auth::user()->id]) }}" class="btn btn-primary" type="button">LEAVE</a>
                                            @else
                                                Not Join
                                            @endif
                                        </td>                                    
                                    <td>
                                        @if (($room['isInArray']) && (count($room['count'])>=2))
                                            <a href="{{ route('chatroom.show', ['room_id' => $room->id,'user_id' => Auth::user()->id]) }}" class="btn btn-primary" type="button" target="_blank">SHOW MESSAGES</a>
                                        @else
                                            Need 2 Part and Joined
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

@endsection
