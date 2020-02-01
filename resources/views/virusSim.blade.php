@extends('layouts.master')

@section('title')
    Virus Simulator
@endsection

@section('content')
    <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
    <script src={{asset('js/datamaps.js')}}></script>

    <style>
        .slidecontainer {
            width: 30%; /* Width of the outside container */
        }

        /* The slider itself */
        .slider {
            -webkit-appearance: none;  /* Override default CSS styles */
            appearance: none;
            width: 100%; /* Full-width */
            height: 25px; /* Specified height */
            background: #d3d3d3; /* Grey background */
            outline: none; /* Remove outline */
            opacity: 0.7; /* Set transparency (for mouse-over effects on hover) */
            -webkit-transition: .2s; /* 0.2 seconds transition on hover */
            transition: opacity .2s;
        }

        /* Mouse-over effects */
        .slider:hover {
            opacity: 1; /* Fully shown on mouse-over */
        }

        /* The slider handle (use -webkit- (Chrome, Opera, Safari, Edge) and -moz- (Firefox) to override default look) */
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none; /* Override default look */
            appearance: none;
            width: 25px; /* Set a specific slider handle width */
            height: 25px; /* Slider handle height */
            background: #4CAF50; /* Green background */
            cursor: pointer; /* Cursor on hover */
        }

        .slider::-moz-range-thumb {
            width: 25px; /* Set a specific slider handle width */
            height: 25px; /* Slider handle height */
            background: #4CAF50; /* Green background */
            cursor: pointer; /* Cursor on hover */
        }
    </style>

    <div id="map" style="position: relative; width: 500px; height: 300px;"></div>
    <div class="slidecontainer">
        <input type="range" min="1" max="8" value="1" class="slider" id="slider">
    </div>


    <script>
        function getCorona(){
            $.ajax({
                method: 'GET',
                url: '{{route('corona')}}',
                data: {_token: '{{Session::token()}}'}
            })
                .done(function (msg) {
                    console.log(msg.data);

                    if(msg.success){
                    }
                });
        }
    </script>

    <script>
        var data = {};
        getCorona();

        var basic_choropleth = new Datamap({
            element: document.getElementById("map"),
            projection: 'mercator',
            fills: {
                defaultFill: "#ABDDA4",
                authorHasTraveledTo: "#fa0fa0"
            },
            data: {
                USA: { fillKey: "authorHasTraveledTo" },
                JPN: { fillKey: "authorHasTraveledTo" },
                ITA: { fillKey: "authorHasTraveledTo" },
                CRI: { fillKey: "authorHasTraveledTo" },
                KOR: { fillKey: "authorHasTraveledTo" },
                DEU: { fillKey: "authorHasTraveledTo" },
            }
        });

        var colors = d3.scale.category10();

        function change() {
            basic_choropleth.updateChoropleth({
                USA: colors(Math.random() * 10),
                RUS: colors(Math.random() * 100),
                AUS: {fillKey: 'authorHasTraveledTo'},
                BRA: colors(Math.random() * 50),
                CAN: colors(Math.random() * 50),
                ZAF: colors(Math.random() * 50),
                IND: colors(Math.random() * 50),
            });
        }

        document.getElementById("slider").addEventListener("change", function() {
            change();
        }, false);
    </script>

@endsection
