<html>
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
    var chart;
    var options;

    var data1, data2, data3;

    function play(){
        document.getElementById('slider').value = 0;
        setTimeout(() => { document.getElementById('slider').value++; updateMap(data2); }, 2000);
        setTimeout(() => { document.getElementById('slider').value++; updateMap(data3); }, 4000);
    }

    google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
    });
    google.charts.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {

        data1 = google.visualization.arrayToDataTable([
            ['Country', 'Total Cases', 'Total Deaths'],
            ['China',11901, 259], ['Japan',20 , 0], ['Thailand', 19, 0], ['Singapore', 18, 0], ['Hong Kong', 13, 0], ['Australia', 12, 0], ['South Korea', 12, 0], ['Taiwan', 10, 0], ['Malaysia', 8, 0], ['United States', 8, 0], ['Germany', 7, 0], ['Macao', 7, 0], ['Vietnam', 6, 0],
            ['France', 6, 0],  ['United Arab Emirates', 4, 0],  ['Canada', 4, 0],  ['Italy', 2, 0],  ['Russia', 2, 0],  ['United Kingdom', 2, 0],  ['Sri Lanka', 1, 0],  ['Nepal', 1, 0],  ['Sweden', 1, 0],  ['Cambodia', 1, 0],  ['India', 1, 0],  ['Finland', 1, 0],  ['Philippines', 1, 0],  ['Spain', 1, 0]
        ]);

        data2 = google.visualization.arrayToDataTable([
            ['Country',   'Corona Cases', 'Future Prediction'],
            ['United Kingdom', 0, 0], ['Hong Kong', 8, 2], ['Russia', 12, 10*2], ['China', 17, 17*3]
        ]);

        data3 = google.visualization.arrayToDataTable([
            ['Country',   'Corona Cases', 'Future Prediction'],
            ['United Kingdom', 20, 20], ['Hong Kong', 8, 2], ['Russia', 12, 10*2], ['China', 17, 17*3]
        ]);

        options = {
            region: 'world', // world
            colorAxis: {colors: ['#00853f', '#e31b23']},
            backgroundColor: '#ffffff',
            datalessRegionColor: '#DCDCDC',
            defaultColor: '#f5f5f5',
        };

        chart = new google.visualization.GeoChart(document.getElementById('geochart-colors'));
        chart.draw(data1, options);
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
</html>
