@extends('layouts.app')

@section('content')

@include('includes.errors')


<div class="panel panel-default">
      <div class="panel-heading">
            Create a new Message
      </div>

      <div class="panel-body">
            <form action="{{ route('message.store') }}" method="post" id="createMessage">
                  {{ csrf_field() }}
                  <div class="form-group">
                        <label for="type">Select a Type</label>
                        <select name="type_id" id="type" class="form-control">
                              @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                              @endforeach
                        </select>
                  </div>               

                  <div class="form-group">
                              <label for="chatroom">Select a ChatRoom to Send (Joined Chat Rooms)</label>
                              @foreach($chatrooms as $chatroom)
                                    <div class="checkbox" id="checkboxesChatRooms">
                                          <label><input type="checkbox" name="chatrooms[]" value="{{ $chatroom->id }}">{{ "    ".$chatroom->name }}</label>
                                    </div>
                              @endforeach
                        </div>                   


                  <div class="form-group">
                              <label for="users">Select Users to send Extra</label>
                              @foreach($users as $user)
                                    <div class="checkbox" id="checkboxesPersonal">
                                          @if( $user->id!=Auth::id())
                                                <label><input type="checkbox" name="users[]" value="{{ $user->id }}">{{ "    ".$user->name }}</label>
                                          @endif
                                    </div>
                              @endforeach
                        </div>                  

               
                  <div class="form-group">
                        <label for="text">Text</label>
                        <textarea name="text" id="text" cols="5" rows="5" class="form-control"></textarea>
                  </div>


                  <div class="form-group">
                              <label for="datetimeExecute">Date Time to Execute Message</label>
                              <input id=date class=flatpickr data-enabletime=true name="sendAt"> </input>
                  </div>


                  <div class="form-group">
                        <div class="text-center">
                              <button class="btn btn-success" type="submit">
                                    Store post
                              </button>
                        </div>
                  </div>
            </form>
      </div>
</div>
@stop

@section('styles')

@stop

@section('scripts2')

<script>
    $(document).ready(function(){
      var conn = new WebSocket("ws://{{$ip}}:8090");


      conn.onopen = function(e) {
      console.log("Connection established!");
      };

      flatpickr('#date',{
            enableTime: true,
            dateFormat: "Y-m-d H:i",
      });

      $( "#createMessage" ).submit(function( event ) {
            if( !$("#date").val() ) {
                  var date=new Date();
                  selectType=$("#type option:selected").val();
                  if (selectType==1) {
                        $('#checkboxesChatRooms input:checked').each(function() {
                        conn.send(JSON.stringify({command: "messageFromForm", message:  $('#text').val(), channel: $(this).attr('value'),user: "{{ Auth::user()->name }}",
                        'datetime':date ,'user_id':"{{$user_id}}"                        
                        }));
                        });
                        $('#checkboxesPersonal input:checked').each(function() {  
                        conn.send(JSON.stringify({command: "messageFromForm", message:  $('#text').val(), channel: $(this).attr('value'),user: "{{ Auth::user()->name }}",
                        'datetime':date ,'user_id':"{{$user_id}}"                        
                        }));
                        });   
                  }
                  else {
                        $('#checkboxesChatRooms input:checked').each(function() { 
                        conn.send(JSON.stringify({command: "messageFromForm", message:  $('#text').val(), channel: $(this).attr('value'),user: "{{ Auth::user()->name }}",
                        'datetime':date ,'user_id':"{{$user_id}}"                        
                        }));
                        });    
                        $('#checkboxesChatRooms input:not(:checked)').each(function() { 
                        conn.send(JSON.stringify({command: "messageFromForm", message:  $('#text').val(), channel: $(this).attr('value'),user: "{{ Auth::user()->name }}",
                        'datetime':date ,'user_id':"{{$user_id}}"                        
                        }));
                        });                                             
                  }         

            }
      });



    })
</script>
@endsection
