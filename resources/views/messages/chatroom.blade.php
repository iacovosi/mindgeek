@extends('layouts.app')

@section('content')
<h1>Chat Room Messages = {{$chatroomname}}</h1>

@include('includes.errors')
<?php
$count=1;
?>
<div id="chatRoom">
@foreach($messages as $message)
      @if($count%2)
            <div class="container2">
      @else
            <div class="container2 darker">
      @endif

      <p>({{ $message['username']}} )<br/> {{ $message['message']}}</p>

      @if($count%2)
        <span class="time-right">{{ $message['datetime']}}</span>
        @else
        <span class="time-left">{{ $message['datetime']}}</span>
      @endif


      </div>
      <?php $count++;?>
@endforeach        
</div>
<div class="panel panel-default">
    <div class="panel-heading">
          Create a Message in Chat Room
    </div>

    <div class="panel-body">		                      
                <div class="form-group">
                      <label for="text">Text</label>
                      <textarea name="text" id="text" cols="1" rows="1" class="form-control"></textarea>
                </div>

                <div class="form-group">
                      <div class="text-center">
                            <button class="btn btn-success" type="submit" id="submitButton">
                                  Store Message
                            </button>
                      </div>
                </div>
    </div>
</div>

@endsection


@section('styles')
<style>
            
            .container2 {
                border: 2px solid #dedede;
                background-color: #f1f1f1;
                border-radius: 5px;
                padding: 10px;
                margin: 10px 0;
            }
            
            .darker {
                border-color: #ccc;
                background-color: #ddd;
            }
            
            .container2::after {
                content: "";
                clear: both;
                display: table;
            }
            
           
            .time-right {
                float: right;
                color: #aaa;
            }
            
            .time-left {
                float: left;
                color: #999;
            }
            </style>
@stop

@section('scripts2')
<script>
      
    $(document).ready(function(){
          var count="{{$count}}";
var conn = new WebSocket("ws://{{$ip}}:8090");

conn.onopen = function(e) {
  console.log("Connection established!");
  conn.send(JSON.stringify({command: "subscribe", channel: "{{$id}}"}));
};


conn.onmessage = function(e) {
  console.log(e.data);
  var msg = JSON.parse(e.data); 
  if ((count % 2) ==0) {
      var date=new Date(msg.datetime);
        msgin = '<div class="container2"><p>' + msg.user + '<br/>' + msg.message+ '</p><span class="time-right">'+date+'</span>' + '</div>';
        $('#chatRoom').append(msgin);
    }
    else {
      var date=new Date(msg.datetime);
      msgin= '<div class="container2 darker"><p>' + msg.user + '<br/>' + msg.message+ '</p><span class="time-left">'+date+'</span>' + '</div>';
        $('#chatRoom').append(msgin);
    }
    count++;

};

$('#submitButton').click(function() {
      var date=new Date();
      if ((count % 2) ==0) {          
        msgout = '<div class="container2"><p>'+"{{ Auth::user()->name }}" + '<br/>' +$('#text').val()+ '</p><span class="time-right">'+date+'</span>' + '</div>';
        $('#chatRoom').append(msgout);

      }
      else {            
      msgout = '<div class="container2 darker"><p>' +"{{ Auth::user()->name }}" + '<br/>' +$('#text').val()+ '</p><span class="time-right">'+date+'</span>'  + '</div>';
        $('#chatRoom').append(msgout);
      }       

   conn.send(JSON.stringify({command: "message", message:  $('#text').val(), channel: "{{$id}}",user: "{{ Auth::user()->name }}",
            'datetime':date ,'chatroom_id':"{{$id}}",'user_id':"{{$user_id}}" 
      }));   
      $('#text').val(""); 
      count++;
  
});



    });

  </script>
@endsection  