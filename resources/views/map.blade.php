@extends('layouts.master')

@section('title')
    Virus Simulator
@endsection

@section('content')
<head>
    <style>
        .slidecontainer {
            width: 90%; /* Width of the outside container */
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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body>

<div id="geochart-colors" style="width: 1400px; height: 700px;"></div>
<br>
<div class="slidecontainer">
    <input type="range" min="1" max="3" value="1" class="slider" id="slider">
</div>

<button onclick="play()">Play</button>

<script type="text/javascript">
    var coronaData;
    var chart;
    var options;

    var data1, data2, data3;

    function getCorona(){
        $.ajax({
            method: 'GET',
            url: '{{route('corona')}}',
            data: {_token: '{{Session::token()}}'}
        })
            .done(function (msg) {
                console.log(msg.data);
                coronaData = msg.data;
                if(msg.success){
                }
            });
    }

    function play(){
        document.getElementById('slider').value = 0;
        setTimeout(() => { document.getElementById('slider').value++; updateMap(data2); }, 2000);
        setTimeout(() => { document.getElementById('slider').value++; updateMap(data3); }, 4000);
    }

    function predict(cases, density){
        let percent = (density/310)*100;
        //console.log(percent);
        return parseInt(cases+(cases*percent)/100);
    }

    function drawChart() {
        google.charts.load('current', {
            'packages': ['geochart'],
            // Note: you will need to get a mapsApiKey for your project.
            // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
            'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
        });
        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap() {

            // for(let i=0; i<coronaData.length; i++){
            //     data1[i+1] = [coronaData[i].country, coronaData[i].cases_day1, 1];
            // }

            // data1 = google.visualization.arrayToDataTable([
            //     ['Country', 'Total Cases', 'Total Deaths'],
            //     ['China', 11901, 259], ['Japan', 20, 0], ['Thailand', 19, 0], ['Singapore', 18, 0], ['Hong Kong', 13, 0], ['Australia', 12, 0], ['South Korea', 12, 0], ['Taiwan', 10, 0], ['Malaysia', 8, 0], ['United States', 8, 0], ['Germany', 7, 0], ['Macao', 7, 0], ['Vietnam', 6, 0],
            //     ['France', 6, 0], ['United Arab Emirates', 4, 0], ['Canada', 4, 0], ['Italy', 2, 0], ['Russia', 2, 0], ['United Kingdom', 2, 0], ['Sri Lanka', 1, 0], ['Nepal', 1, 0], ['Sweden', 1, 0], ['Cambodia', 1, 0], ['India', 1, 0], ['Finland', 1, 0], ['Philippines', 1, 0], ['Spain', 1, 0]
            // ]);
            //
            // data2 = google.visualization.arrayToDataTable([
            //     ['Country', 'Total Cases', 'Total Deaths'],
            //     ['China', 23802, 518*2], ['Japan', 41*2, 0], ['Thailand', 27*2, 0], ['Singapore', 503*2, 0], ['Hong Kong', 738*2, 0], ['Australia', 12*2, 0], ['South Korea', 31*2, 0], ['Taiwan', 30*2, 0], ['Malaysia', 10*2, 0], ['United States', 8*2, 0], ['Germany', 12*2, 0], ['Macao', 7*2, 0], ['Vietnam', 6*2, 0],
            //     ['France', 9, 0], ['United Arab Emirates', 5*2, 0], ['Canada', 4*2, 0], ['Italy', 3*2, 0], ['Russia', 2*2, 0], ['United Kingdom', 3*2, 0], ['Sri Lanka', 2*2, 0], ['Nepal', 1*2, 0], ['Sweden', 1*2, 0], ['Cambodia', 1*2, 0], ['India', 2*2, 0], ['Finland', 1*2, 0], ['Philippines', 2*2, 0], ['Spain', 1*2, 0]
            // ]);
            //
            // data3 = google.visualization.arrayToDataTable([
            //     ['Country', 'Total Cases', 'Total Deaths'],
            //     ['China', 29391, 1036], ['Japan', 85*2, 2*2], ['Thailand', 38*2, 0], ['Singapore', 14064*2, 16*2], ['Hong Kong', 41949/2, 67*2], ['Australia', 12*2, 0], ['South Korea', 81*2, 0], ['Taiwan', 92*2, 0], ['Malaysia', 13*2, 0], ['United States', 8*2, 0], ['Germany', 21*2, 0], ['Macao', 488*2, 0], ['Vietnam', 12*2, 0],
            //     ['France', 12*2, 0], ['United Arab Emirates', 6*2, 0], ['Canada', 4*2, 0], ['Italy', 4*2, 0], ['Russia', 2*2, 0], ['United Kingdom', 5*2, 0], ['Sri Lanka', 3*2, 0], ['Nepal', 1*2, 0], ['Sweden', 1*2, 0], ['Cambodia', 1*2, 0], ['India', 4*2, 0], ['Finland', 1*2, 0], ['Philippines', 4*2, 0], ['Spain', 1*2, 0]
            // ]);

            data1 = google.visualization.arrayToDataTable([
                ['Country', 'Total Cases', 'Total Deaths'],
                ['Japan', 20, 0], ['Thailand', 19, 0], ['Singapore', 18, 0], ['Hong Kong', 13, 0], ['Australia', 12, 0], ['South Korea', 12, 0], ['Taiwan', 10, 0], ['Malaysia', 8, 0], ['United States', 8, 0], ['Germany', 7, 0], ['Macao', 7, 0], ['Vietnam', 6, 0],
                ['France', 6, 0], ['United Arab Emirates', 4, 0], ['Canada', 4, 0], ['Italy', 2, 0], ['Russia', 2, 0], ['United Kingdom', 2, 0], ['Sri Lanka', 1, 0], ['Nepal', 1, 0], ['Sweden', 1, 0], ['Cambodia', 1, 0], ['India', 1, 0], ['Finland', 1, 0], ['Philippines', 1, 0], ['Spain', 1, 0]
            ]);

            data2 = google.visualization.arrayToDataTable([
                ['Country', 'Total Cases', 'Total Deaths'],
                ['Japan', 41*4, 0], ['Thailand', 27*4, 0], ['Singapore', 2*4, 0], ['Hong Kong', 2*4, 0], ['Australia', 12*4, 0], ['South Korea', 31*4, 0], ['Taiwan', 30*4, 0], ['Malaysia', 10*4, 0], ['United States', 8*4, 0], ['Germany', 12*4, 0], ['Macao', 7*4, 0], ['Vietnam', 6*4, 0],
                ['France', 9, 0], ['United Arab Emirates', 5*4, 0], ['Canada', 4*4, 0], ['Italy', 3*4, 0], ['Russia', 2*4, 0], ['United Kingdom', 3*4, 0], ['Sri Lanka', 2*4, 0], ['Nepal', 1*4, 0], ['Sweden', 1*4, 0], ['Cambodia', 1*4, 0], ['India', 2*4, 0], ['Finland', 1*4, 0], ['Philippines', 2*4, 0], ['Spain', 1*4, 0]
            ]);

            data3 = google.visualization.arrayToDataTable([
                ['Country', 'Total Cases', 'Total Deaths'],
                ['Japan', 85*4, 2*4], ['Thailand', 38*4, 0], ['Singapore', 0, 16*4], ['Hong Kong', 1/2, 67*4], ['Australia', 12*4, 0], ['South Korea', 81*4, 0], ['Taiwan', 92*4, 0], ['Malaysia', 13*4, 0], ['United States', 8*4, 0], ['Germany', 21*4, 0], ['Macao', 1*4, 0], ['Vietnam', 12*4, 0],
                ['France', 12*4, 0], ['United Arab Emirates', 6*4, 0], ['Canada', 4*4, 0], ['Italy', 4*4, 0], ['Russia', 2*4, 0], ['United Kingdom', 5*4, 0], ['Sri Lanka', 3*4, 0], ['Nepal', 1*4, 0], ['Sweden', 1*4, 0], ['Cambodia', 1*4, 0], ['India', 4*4, 0], ['Finland', 1*4, 0], ['Philippines', 4*4, 0], ['Spain', 1*4, 0]
            ]);

            options = {
                region: 'world', // world
                colorAxis: {colors: ['#8EFF22','#B3FF22','#C7FF22', '#DEFF22', '#F9FF22', '#FFF122', '#FFDD22', '#FFCC22', '#FFBF22', '#FF8D22', '#FF7922', '#FF5E22', '#FF4722', '#FF3D22', '#FF2922', '#FF2222']},
                backgroundColor: '#ffffff',
                datalessRegionColor: '#DCDCDC',
                defaultColor: '#f5f5f5',
            };

            chart = new google.visualization.GeoChart(document.getElementById('geochart-colors'));
            chart.draw(data1, options);
        }
    }

    document.getElementById("slider").addEventListener("change", function() {
        let temp = "data" + document.getElementById("slider").value;
        console.log(temp);
        updateMap(temp);
    }, false);

    function updateMap(data) {
        chart.draw(data, options);
    }
</script>
</body>
@endsection
