@extends('layouts.master')

@section('title')
    Virus Simulator
@endsection

@section('content')
    <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
    <script src={{asset('js/datamaps.js')}}></script>


    <div id="container" style="position: relative; width: 500px; height: 300px;"></div>








    <script>
        var map = new Datamap({element: document.getElementById('container')});
    </script>
@endsection
