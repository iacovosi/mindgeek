@extends('layouts.app')

@section('content')
<h1>Personal Messages</h1>
@include('includes.errors')
<?php
//var_dump($messages);
$count=1;
?>
<div id="chatRoom">
@foreach($messages as $message)
    @if($count%2)
    <div class="container2">
    @else
    <div class="container2 darker">
    @endif

    <p>({{ $message['username']}}) <br/> {{ $message['message']}}</p>

    @if($count%2)
    <span class="time-right">{{ $message['datetime']}}</span>
    @else
    <span class="time-left">{{ $message['datetime']}}</span>
    @endif


    </div>
    <?php $count++;?>
@endforeach        
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
            
            .container2 img {
                float: left;
                max-width: 60px;
                width: 100%;
                margin-right: 20px;
                border-radius: 50%;
            }
            
            .container2 img.right {
                float: right;
                margin-left: 20px;
                margin-right:0;
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
    conn.send(JSON.stringify({command: "subscribe", channel: "{{ Auth::id() }}"}));
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


  </script>
@endsection  