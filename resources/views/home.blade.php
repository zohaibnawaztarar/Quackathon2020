<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Corona Tracker</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/grayscale.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="css/style.css">

</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">

        <i class="fas fa-star-of-life fa-spin" style="color:#c9c9c9;"></i><a class="navbar-brand js-scroll-trigger" href="#page-top">Corona Tracker</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">Flights Tracker</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#projects">Statistics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#symptoms">Symptoms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#signup">Tips to Stay Safe</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Header -->
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">Corona Tracker</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">Tracking the Spread of the Outbreak</h2>
            <a href="#about" class="btn btn-primary js-scroll-trigger">Get Started</a>
            <!-- particles.js container -->
            <div id="particles-js"></div>
            <!-- scripts -->
            <script src="../js/particles.js"></script>
            <script src="../js/app.js"></script>
        </div>
    </div>
</header>

<!-- Flights Section -->
<section id="about" class="about-section text-center">
    <div class="container">
        <div class="row">
            <div class="mx-auto">
                <h2 class="text-white mb-4">Flight Tracker</h2>
                <p class="text-white-50">Flights departed from Wuhan, China till 1st of February 2020 since the outbreak of virus</p>
            </div>
        </div>
        <div>
        <!-- Styles -->
        <style>
            #chartdiv {
                width: 100%;
                height: 500px;
            }
        </style>

        <!-- Resources -->
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/maps.js"></script>
        <script src="https://www.amcharts.com/lib/4/geodata/worldLow.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

        <!-- Chart code -->
        <script>


        </script>

        <!-- HTML -->
        <div id="chartdiv"></div>
            <a href="#projects" class="btn btn-primary js-scroll-trigger">Check Statistics</a>
        </div>

    </div>
</section>

<!-- Stats Section -->

<section id="projects" class="projects-section text-center" style="background-color: #ffffff;">
    <div class="container">

        <!-- Featured Project Row -->
        <div class="container">
            <div class="row">
                <div class=" mx-auto">
                    <h2 class="text-black-50 mb-4">Statistics</h2>
                    <p class="text-black-50">Statistics till 1st of February 2020 since the outbreak of virus</p>
                    <div>
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


                        <div id="geochart-colors" style="width: 1000px; height: 700px;"></div>
                        <div class="slidecontainer">
                            <input type="range" min="1" max="3" value="1" class="slider" id="slider">
                        </div>

                        <button class="btn-primary" onclick="play()">Play</button>
                        <br><br>
                    </div>

                    <a href="#symptoms" class="btn btn-primary js-scroll-trigger">Check Symptoms</a>
                </div>
            </div>
            <script type="text/javascript">
                var chart;
                var options;

                var globalConcaps;

                var chart2;
                var options2;

                var data1, data2, data3;

                getCorona();
                drawChart();

                function play(){
                    document.getElementById('slider').value = 0;
                    setTimeout(() => { document.getElementById('slider').value++; updateMap(data2); }, 2000);
                    setTimeout(() => { document.getElementById('slider').value++; updateMap(data3); }, 4000);
                }

                function getCorona(){
                    $.ajax({
                        method: 'GET',
                        url: '{{route('concaps')}}',
                        data: {_token: '{{Session::token()}}'}
                    })
                        .done(function (msg) {
                            console.log(msg.data);
                            globalConcaps = msg.data;
                            createChart();
                            if(msg.success){
                            }
                        });
                }

                document.getElementById("slider").addEventListener("change", function() {
                    let temp = "data" + document.getElementById("slider").value;
                    console.log(temp);
                    updateMap(temp);
                }, false);

                function updateMap(data) {
                    chart2.draw(data, options2);
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

                        options2 = {
                            region: 'world', // world
                            colorAxis: {colors: ['#8EFF22','#B3FF22','#C7FF22', '#DEFF22', '#F9FF22', '#FFF122', '#FFDD22', '#FFCC22', '#FFBF22', '#FF8D22', '#FF7922', '#FF5E22', '#FF4722', '#FF3D22', '#FF2922', '#FF2222']},
                            backgroundColor: '#ffffff',
                            datalessRegionColor: '#DCDCDC',
                            defaultColor: '#f5f5f5',
                        };

                        chart2 = new google.visualization.GeoChart(document.getElementById('geochart-colors'));
                        chart2.draw(data1, options2);
                    }
                }

                function createChart() {
                    am4core.ready(function () {

// Themes begin
                        am4core.useTheme(am4themes_animated);
// Themes end

// Create map instance
                        var chart = am4core.create("chartdiv", am4maps.MapChart);
                        chart.geodata = am4geodata_worldLow;
                        chart.projection = new am4maps.projections.Miller();
                        chart.homeZoomLevel = 0;
                        chart.homeGeoPoint = {
                            latitude: 0,
                            longitude: 0
                        };

// Create map polygon series
                        var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
                        polygonSeries.useGeodata = true;
                        polygonSeries.mapPolygons.template.fill = chart.colors.getIndex(0).lighten(0.5);
                        polygonSeries.mapPolygons.template.nonScalingStroke = true;
                        polygonSeries.exclude = ["AQ"];

// Add line bullets
                        var cities = chart.series.push(new am4maps.MapImageSeries());
                        cities.mapImages.template.nonScaling = true;

                        var city = cities.mapImages.template.createChild(am4core.Circle);
                        city.radius = 6;
                        city.fill = chart.colors.getIndex(0).brighten(-0.2);
                        city.strokeWidth = 2;
                        city.stroke = am4core.color("#fff");

                        function addCity(coords, title) {
                            var city = cities.mapImages.create();
                            city.latitude = coords.latitude;
                            city.longitude = coords.longitude;
                            city.tooltipText = title;
                            return city;
                        }


                        //var wuh = addCity({"latitude": 30.5928, "longitude": 114.3055}, "Wuhan");
                        // var paris = addCity({"latitude": 48.8567, "longitude": 2.3510}, "Paris");
                        // var toronto = addCity({"latitude": 43.8163, "longitude": -79.4287}, "Toronto");
                        // var la = addCity({"latitude": 34.3, "longitude": -118.15}, "Los Angeles");
                        // var havana = addCity({"latitude": 23, "longitude": -82}, "Havana");
                        // var isb = addCity({"latitude": 33.6844, "longitude": 73.0479}, "Islamabad");

// Add lines
                        var lineSeries = chart.series.push(new am4maps.MapArcSeries());
                        lineSeries.mapLines.template.line.strokeWidth = 2;
                        lineSeries.mapLines.template.line.strokeOpacity = 0.5;
                        lineSeries.mapLines.template.line.stroke = city.fill;
                        lineSeries.mapLines.template.line.nonScalingStroke = true;
                        lineSeries.mapLines.template.line.strokeDasharray = "1,1";
                        lineSeries.zIndex = 10;

                        var shadowLineSeries = chart.series.push(new am4maps.MapLineSeries());
                        shadowLineSeries.mapLines.template.line.strokeOpacity = 0;
                        shadowLineSeries.mapLines.template.line.nonScalingStroke = true;
                        shadowLineSeries.mapLines.template.shortestDistance = false;
                        shadowLineSeries.zIndex = 5;

                        function addLine(from, to) {
                            var line = lineSeries.mapLines.create();
                            line.imagesToConnect = [from, to];
                            line.line.controlPointDistance = -0.3;

                            var shadowLine = shadowLineSeries.mapLines.create();
                            shadowLine.imagesToConnect = [from, to];

                            return line;
                        }

                        var wuh = addCity({"latitude": 30.5928, "longitude": 114.3055}, "Wuhan");

                        for (let i=0; i<globalConcaps.length; i++){
                            let city = addCity({"latitude": globalConcaps[i].CapitalLatitude, "longitude": globalConcaps[i].CapitalLongitude}, globalConcaps[i].CountryName);
                            addLine(wuh, city);
                        }

                        // addLine(wuh, paris);
                        // addLine(wuh, toronto);
                        // addLine(wuh, la);
                        // addLine(wuh, havana);

// Add plane
                        var plane = lineSeries.mapLines.getIndex(0).lineObjects.create();
                        plane.position = 0;
                        plane.width = 48;
                        plane.height = 48;

                        plane.adapter.add("scale", function (scale, target) {
                            return 0.5 * (1 - (Math.abs(0.5 - target.position)));
                        });

                        var planeImage = plane.createChild(am4core.Sprite);
                        planeImage.scale = 0.08;
                        planeImage.horizontalCenter = "middle";
                        planeImage.verticalCenter = "middle";
                        planeImage.path = "m2,106h28l24,30h72l-44,-133h35l80,132h98c21,0 21,34 0,34l-98,0 -80,134h-35l43,-133h-71l-24,30h-28l15,-47";
                        planeImage.fill = am4core.color("#fa0003");
                        planeImage.strokeOpacity = 0;

                        var shadowPlane = shadowLineSeries.mapLines.getIndex(0).lineObjects.create();
                        shadowPlane.position = 0;
                        shadowPlane.width = 48;
                        shadowPlane.height = 48;

                        var shadowPlaneImage = shadowPlane.createChild(am4core.Sprite);
                        shadowPlaneImage.scale = 0.05;
                        shadowPlaneImage.horizontalCenter = "middle";
                        shadowPlaneImage.verticalCenter = "middle";
                        shadowPlaneImage.path = "m2,106h28l24,30h72l-44,-133h35l80,132h98c21,0 21,34 0,34l-98,0 -80,134h-35l43,-133h-71l-24,30h-28l15,-47";
                        shadowPlaneImage.fill = am4core.color("#000");
                        shadowPlaneImage.strokeOpacity = 0;

                        shadowPlane.adapter.add("scale", function (scale, target) {
                            target.opacity = (0.6 - (Math.abs(0.5 - target.position)));
                            return 0.5 - 0.3 * (1 - (Math.abs(0.5 - target.position)));
                        });

// Plane animation
                        var currentLine = 0;
                        var direction = 1;

                        function flyPlane() {

                            // Get current line to attach plane to
                            plane.mapLine = lineSeries.mapLines.getIndex(currentLine);
                            plane.parent = lineSeries;
                            shadowPlane.mapLine = shadowLineSeries.mapLines.getIndex(currentLine);
                            shadowPlane.parent = shadowLineSeries;
                            shadowPlaneImage.rotation = planeImage.rotation;

                            // Set up animation
                            var from, to;
                            var numLines = lineSeries.mapLines.length;
                            if (direction == 1) {
                                from = 0
                                to = 1;
                                if (planeImage.rotation != 0) {
                                    planeImage.animate({to: 0, property: "rotation"}, 1000).events.on("animationended", flyPlane);
                                    return;
                                }
                            } else {
                                from = 1;
                                to = 0;
                                if (planeImage.rotation != 180) {
                                    planeImage.animate({to: 180, property: "rotation"}, 1000).events.on("animationended", flyPlane);
                                    return;
                                }
                            }

                            // Start the animation
                            var animation = plane.animate({
                                from: from,
                                to: to,
                                property: "position"
                            }, 4000, am4core.ease.sinInOut);
                            animation.events.on("animationended", flyPlane)
                            /*animation.events.on("animationprogress", function(ev) {
                              var progress = Math.abs(ev.progress - 0.5);
                              //console.log(progress);
                              //planeImage.scale += 0.2;
                            });*/

                            shadowPlane.animate({
                                from: from,
                                to: to,
                                property: "position"
                            }, 4000, am4core.ease.sinInOut);

                            // Increment line, or reverse the direction
                            currentLine += direction;
                            if (currentLine < 0) {
                                currentLine = 0;
                                direction = 1;
                            } else if ((currentLine + 1) > numLines) {
                                currentLine = numLines - 1;
                                direction = -1;
                            }
                        }
// Go!
                        flyPlane();
                    }); // end am4core.ready()
                }

            </script>

        </div>
</section>


<!-- Symptoms Section -->

<section id="symptoms" class="projects-section bg-dark text-center">
    <div class="container">

        <!-- Featured Project Row -->
        <div class="container">
            <div class="row">
                <div class=" mx-auto">
                    <h2 class="text-white-50 mb-4">Symptoms of Corona Virus</h2>
                    <p class="text-white-50">Symtoms appear in as few as 2 days or as long as 14 after exposure. This is based on what has been seen previously as the incubation period of MERS viruses</p>
                    <div>
                        <!-- Styles -->
                        <style>
                            #chartdiv3 {
                                width: 100%;
                                height: 500px;
                            }
                        </style>

                        <!-- Resources -->

                        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
                        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

                        <!-- Chart code -->
                        <script>
                            am4core.ready(function() {

// Themes begin
                                am4core.useTheme(am4themes_animated);
// Themes end

                                var iconPath = "M53.5,476c0,14,6.833,21,20.5,21s20.5-7,20.5-21V287h21v189c0,14,6.834,21,20.5,21 c13.667,0,20.5-7,20.5-21V154h10v116c0,7.334,2.5,12.667,7.5,16s10.167,3.333,15.5,0s8-8.667,8-16V145c0-13.334-4.5-23.667-13.5-31 s-21.5-11-37.5-11h-82c-15.333,0-27.833,3.333-37.5,10s-14.5,17-14.5,31v133c0,6,2.667,10.333,8,13s10.5,2.667,15.5,0s7.5-7,7.5-13 V154h10V476 M61.5,42.5c0,11.667,4.167,21.667,12.5,30S92.333,85,104,85s21.667-4.167,30-12.5S146.5,54,146.5,42 c0-11.335-4.167-21.168-12.5-29.5C125.667,4.167,115.667,0,104,0S82.333,4.167,74,12.5S61.5,30.833,61.5,42.5z"



                                var chart = am4core.create("chartdiv3", am4charts.SlicedChart);
                                chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

                                chart.data = [{
                                    "name": "Headache",
                                    "value": 40
                                }, {

                                    "name": "Cough",
                                    "value": 50
                                }, {
                                    "name": "Sore Throat",
                                    "value": 50
                                }, {
                                    "name": "Shortness of Breath",
                                    "value": 100
                                }, {
                                    "name": "Fever",
                                    "value": 100
                                }, {
                                    "name": "General feeling of being unwell",
                                    "value": 100
                                }, {
                                    "name": "Feeling Tired",
                                    "value": 100
                                }];

                                var series = chart.series.push(new am4charts.PictorialStackedSeries());
                                series.dataFields.value = "value";
                                series.dataFields.category = "name";
                                series.alignLabels = true;

                                series.maskSprite.path = iconPath;
                                series.ticks.template.locationX = 0.6;
                                series.ticks.template.locationY = 0.5;

                                series.labelsContainer.width = 300;

                                chart.legend = new am4charts.Legend();
                                chart.legend.position = "left";
                                chart.legend.valign = "bottom";

                            }); // end am4core.ready()
                        </script>

                        <!-- HTML -->
                        <div id="chartdiv3" style="width: 1000px; height: 700px;"></div>
                    </div>
                    <a href="#signup" class="btn btn-primary js-scroll-trigger">Stay Safe</a>
                </div>
            </div>


        </div>
</section>






<!-- Tips Section -->
<section id="signup" class="projects-section bg-light text-center">
    <div class="container">
        <div class="row">
            <div class="mx-auto">

                <h2 class="text-black-50 mb-4">Tips to Stay Safe</h2>

                <p class="text-black-50">There is currently no vaccine to prevent 2019-nCoV infection. The best way to prevent infection is to avoid being exposed to this virus. However, as a reminder, we recommend everyday preventive actions to help prevent the spread of respiratory viruses.</p>

                <div id="dd2">

                    <!-- Styles -->
                    <style>
                        #chartdiv2 {
                            max-width: 100%;
                            height: 500px;
                        }
                    </style>

                    <!-- Resources -->

                    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
                    <script src="https://www.amcharts.com/lib/4/plugins/timeline.js"></script>
                    <script src="https://www.amcharts.com/lib/4/plugins/bullets.js"></script>
                    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

                    <!-- Chart code -->
                    <script>
                        am4core.ready(function() {

// Themes begin
                            am4core.useTheme(am4themes_animated);
// Themes end

                            var alarm = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjQ1Ljc3M3B4IiBoZWlnaHQ9IjQ1Ljc3M3B4IiB2aWV3Qm94PSIwIDAgNDUuNzczIDQ1Ljc3MyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDUuNzczIDQ1Ljc3MzsiDQoJIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik01LjA4MSwxMy43MzdjMi41ODItMy45NDIsNi42MDktNi44NDksMTEuMzItNy45ODhjMC4zNjMtMC4wODcsMC42NjItMC4zNDQsMC44MDItMC42ODkNCgkJCWMwLjE0MS0wLjM0NiwwLjEwNy0wLjczOC0wLjA5MS0xLjA1NUMxNS42MDQsMS42MDEsMTIuOTM2LDAsOS44ODgsMEM1LjE3NiwwLDEuMzU0LDMuODIsMS4zNTQsOC41MzJjMCwyLDAuNjkxLDMuODM3LDEuODQ1LDUuMjkNCgkJCWMwLjIzMSwwLjI5MywwLjU4OSwwLjQ1NSwwLjk2MiwwLjQzOFM0Ljg3NywxNC4wNDgsNS4wODEsMTMuNzM3eiIvPg0KCQk8cGF0aCBkPSJNMzUuODg2LDBjLTMuMDM0LDAtNS42OTMsMS41ODYtNy4yMDQsMy45NzRjLTAuMiwwLjMxNi0wLjIzNSwwLjcxMS0wLjA5NCwxLjA1OWMwLjE0MiwwLjM0OSwwLjQ0MiwwLjYwNSwwLjgwOSwwLjY5MQ0KCQkJYzQuNzI0LDEuMTEyLDguNzY1LDMuOTk5LDExLjM2OSw3LjkyOGMwLjIwNywwLjMxMiwwLjU1MiwwLjUwNSwwLjkyNywwLjUxOGMwLjM3NSwwLjAxNCwwLjczMS0wLjE1NCwwLjk2MS0wLjQ1MQ0KCQkJYzEuMTA1LTEuNDM2LDEuNzY2LTMuMjMyLDEuNzY2LTUuMTg2QzQ0LjQxNywzLjgyLDQwLjU5OCwwLDM1Ljg4NiwweiIvPg0KCQk8cGF0aCBkPSJNNDEuNzUyLDI2LjEzMmMwLTMuMjk0LTAuODU3LTYuMzktMi4zNTEtOS4wODRjLTIuNzY5LTQuOTktNy43NDItOC41NzctMTMuNTk1LTkuNDc1Yy0wLjkzMy0wLjE0My0xLjg4LTAuMjQtMi44NTMtMC4yNA0KCQkJYy0xLjAxNiwwLTIuMDA2LDAuMTA0LTIuOTc5LDAuMjZDMTQuMTQ2LDguNTI4LDkuMTk4LDEyLjEzLDYuNDU4LDE3LjEyNmMtMS40NjcsMi42NzYtMi4zMDQsNS43NDQtMi4zMDQsOS4wMDYNCgkJCWMwLDUuNTg2LDIuNDYzLDEwLjU5Nyw2LjM0MywxNC4wNDFsLTEuNTg0LDIuMjMxYy0wLjY4MiwwLjk2MS0wLjQ1NiwyLjI5MSwwLjUwNSwyLjk3NWMwLjM3NSwwLjI2NiwwLjgwNiwwLjM5NSwxLjIzMywwLjM5NQ0KCQkJYzAuNjY4LDAsMS4zMjYtMC4zMTMsMS43NDEtMC44OThsMS41ODMtMi4yM2MyLjY2OSwxLjQ1Nyw1LjcyOCwyLjI4Nyw4Ljk3OCwyLjI4N2MzLjI0OSwwLDYuMzA4LTAuODMsOC45NzctMi4yODdsMS41ODMsMi4yMw0KCQkJYzAuNDE2LDAuNTg2LDEuMDczLDAuODk4LDEuNzQxLDAuODk4YzAuNDI3LDAsMC44NTctMC4xMjksMS4yMzItMC4zOTVjMC45NjEtMC42ODQsMS4xODgtMi4wMTQsMC41MDYtMi45NzVsLTEuNTg0LTIuMjMxDQoJCQlDMzkuMjg4LDM2LjcyOSw0MS43NTIsMzEuNzE4LDQxLjc1MiwyNi4xMzJ6IE0yMi45NTQsMzkuNjc0Yy03LjQ2OCwwLTEzLjU0Mi02LjA3NC0xMy41NDItMTMuNTQyDQoJCQljMC0yLjMyOCwwLjU5MS00LjUxOSwxLjYyOS02LjQzNWMxLjk3Ni0zLjY0NCw1LjU4LTYuMjY5LDkuODI2LTYuOTNjMC42ODItMC4xMDYsMS4zNzUtMC4xNzgsMi4wODctMC4xNzgNCgkJCWMwLjY3LDAsMS4zMjUsMC4wNjUsMS45NywwLjE2YzQuMjgyLDAuNjI4LDcuOTI1LDMuMjUzLDkuOTI0LDYuOTEzYzEuMDUsMS45MjMsMS42NDcsNC4xMjYsMS42NDcsNi40NjkNCgkJCUMzNi40OTUsMzMuNiwzMC40MjEsMzkuNjc0LDIyLjk1NCwzOS42NzR6Ii8+DQoJCTxwYXRoIGQ9Ik0zMC41NCwyOS4zbC01LjE2Ni0zLjE5Yy0wLjEwNy0wLjYwNC0wLjQzNC0xLjEyNS0wLjg5My0xLjQ5NGwwLjIzNi02LjQ4MmMwLjAyOS0wLjgyOC0wLjYxNy0xLjUyMy0xLjQ0NC0xLjU1NA0KCQkJYy0wLjgyNS0wLjAzOC0xLjUyMywwLjYxNi0xLjU1NCwxLjQ0NGwtMC4yMzcsNi40ODljLTAuNjQxLDAuNDUyLTEuMDYzLDEuMTk2LTEuMDYzLDIuMDQxYzAsMS4zODEsMS4xMTksMi40OTksMi41LDIuNDk5DQoJCQljMC4zOTMsMCwwLjc2LTAuMDk5LDEuMDktMC4yNmw0Ljk1NSwzLjA2MmMwLjI0NiwwLjE1LDAuNTE5LDAuMjIzLDAuNzg3LDAuMjIzYzAuNTAzLDAsMC45OTMtMC4yNTIsMS4yNzgtMC43MTENCgkJCUMzMS40NjUsMzAuNjYsMzEuMjQ1LDI5LjczNiwzMC41NCwyOS4zeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K";
                            var water = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik00NDMuODgyLDUuMjhDNDQwLjg0MiwxLjkyLDQzNi41NTQsMCw0MzIuMDEsMGgtMzUyYy00LjUxMiwwLTguODMyLDEuOTItMTEuODcyLDUuMjgNCgkJCWMtMy4wMDgsMy4zMjgtNC41MTIsNy44MDgtNC4wNjQsMTIuMzJsNDgsNDgwYzAuODMyLDguMTkyLDcuNzEyLDE0LjQsMTUuOTM2LDE0LjRoMjU2YzguMjI0LDAsMTUuMTA0LTYuMjA4LDE1LjkwNC0xNC40bDQ4LTQ4MA0KCQkJQzQ0OC4zOTQsMTMuMDg4LDQ0Ni45MjIsOC42MDgsNDQzLjg4Miw1LjI4eiBNNDAxLjI5LDE2Mi40OTZjLTQwLjY3MiwxMy4xNTItOTMuNiwxOS4yMzItMTM1LjEzNi0xNC44NDgNCgkJCWMtNTIuMDY0LTQyLjcyLTExNS44NzItMzUuMzYtMTU5LjEzNi0yMi40OTZMOTcuNzA2LDMyaDMxNi42MDhMNDAxLjI5LDE2Mi40OTZ6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=";
                            var exercise = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE4LjEuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNjEuODU4IDYxLjg1OCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNjEuODU4IDYxLjg1ODsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIHN0eWxlPSJmaWxsOiMwMTAwMDI7IiBkPSJNNTAuMDk3LDAuMDE0Yy05LjkxNywwLjg3NC0xNy4yMzUsNS44MjQtMjEuNTAxLDEyLjk4Yy0yLjg1OSwzLjU4NC04LjU3LDE0LjUyNi0xMC42NDcsMjAuMjU0DQoJCQljLTMuNzY2LDcuMTIzLTcuMDUsMTUuNTk4LTkuNjIsMjMuMjM4Yy0xLjU3MSw0LjY3Miw1LjQ4Myw3LjcyLDcuMDYzLDMuMDI3YzEuOTIyLTUuNzE2LDQuMjQ0LTExLjg5Niw2Ljg2OC0xNy42MzENCgkJCWMyLjYwNCw1LjgyOCw1LjI1LDExLjYzNyw4LjA5MSwxNy4zNTRjMi4yMDIsNC40MzgsOC44MjgsMC41NDYsNi42MzQtMy44NzdjLTIuOTI1LTUuODg1LTUuNjQyLTExLjg2NC04LjMxOS0xNy44NjMNCgkJCWMwLjAzNC0wLjExNiwwLjA3Ny0wLjIyOSwwLjExMy0wLjM0NGMwLjQ0NiwwLjEyNywwLjkzOCwwLjE2NiwxLjQ4LDAuMDYzYzQuMDk2LTAuNzY5LDguMTkyLTEuNTM2LDEyLjI5MS0yLjMwNQ0KCQkJYzEuNzUxLTAuMzI5LDIuNDIyLTIuMjQ1LDIuMTQ2LTMuNzc5Yy0wLjgyOC00LjU5Ny0zLjQ0Ny03Ljc5NS02LjcwNy0xMC44MjFjLTAuNDg0LTEuNjQ2LTIuMDk4LTMuMTAyLTMuODg5LTQuNTQ5DQoJCQljMy42MzEtNS44Nyw5LjU1OS05LjA1NiwxNy4yNzUtOS43MzZDNTUuMzEzLDUuNjgsNTQuMDAxLTAuMzI5LDUwLjA5NywwLjAxNHogTTM1LjE3MywyNi4xNDMNCgkJCWMxLjAxMywxLjA1NCwxLjg3NSwyLjE2MywyLjUyNiwzLjQ0N2MtMS45ODIsMC4zNzItMy45NjUsMC43NDMtNS45NDcsMS4xMTVDMzIuNzUyLDI5LjA5NSwzMy45MDMsMjcuNTc1LDM1LjE3MywyNi4xNDN6Ii8+DQoJCTxjaXJjbGUgc3R5bGU9ImZpbGw6IzAxMDAwMjsiIGN4PSI0My42NTMiIGN5PSIxNS42MzUiIHI9IjUuMjc1Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=";
                            var breakfast = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjQ1LjY5MnB4IiBoZWlnaHQ9IjQ1LjY5MXB4IiB2aWV3Qm94PSIwIDAgNDUuNjkyIDQ1LjY5MSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDUuNjkyIDQ1LjY5MTsiDQoJIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik0yOS40MywyNi42NDVjLTAuMzY5LTAuNDI1LTAuOTA2LTAuNzg1LTEuNDctMC43ODVIMTcuNzg5Yy0wLjU2NCwwLTEuMTAxLDAuMzYtMS40NzEsMC43ODUNCgkJCWMtMC4zNjksMC40MjYtMC41MzUsMS4wNDktMC40NTYsMS42MDdsMS43MDEsMTEuOTE3YzAuMTM3LDAuOTU4LDAuOTU3LDEuNjkyLDEuOTI0LDEuNjkyaDYuNzczYzAuOTY3LDAsMS43ODktMC43MDUsMS45MjQtMS42NjQNCgkJCWwxLjcwMS0xMS45NDhDMjkuOTY0LDI3LjY5MSwyOS43OTcsMjcuMDcsMjkuNDMsMjYuNjQ1eiIvPg0KCQk8cGF0aCBkPSJNMTQuMDY2LDMwLjQyOGMtMC42MTgtMC4yNzEtMS4zMzMtMC4yMDUtMS44ODksMC4xNzhsLTQuNTU0LDMuMTQxYy0wLjg4NSwwLjYwOS0xLjEwNiwxLjgyLTAuNDk3LDIuNzAzbDMuOTMxLDUuNzAxDQoJCQljMC41NjgsMC44MjQsMS42NzEsMS4wODIsMi41NDcsMC41OTRsMS43MDEtMC45NDhjMC42OTgtMC4zOSwxLjA4OC0xLjE2OCwwLjk3OS0xLjk2MWwtMS4wNzgtNy44OTINCgkJCUMxNS4xMTcsMzEuMjc1LDE0LjY4NCwzMC43MDEsMTQuMDY2LDMwLjQyOHoiLz4NCgkJPHBhdGggZD0iTTcuNzg0LDM5Ljg1NWMtMC4yMTctMC4yOTEtMC41ODUtMC40MjctMC45MzktMC4zNDZjLTAuMzUzLDAuMDgxLTAuNjI3LDAuMzYxLTAuNjk4LDAuNzE3bC0wLjg3OCw0LjM2MQ0KCQkJYy0wLjA3MiwwLjM1NywwLjA3NCwwLjcyMywwLjM3LDAuOTM0YzAuMjk5LDAuMjExLDAuNjksMC4yMjcsMS4wMDQsMC4wNDFsMi44Ny0xLjcwN2MwLjIyNS0wLjEzMywwLjM4My0wLjM1NSwwLjQzNC0wLjYxMQ0KCQkJYzAuMDUyLTAuMjU4LTAuMDA5LTAuNTIzLTAuMTY2LTAuNzMyTDcuNzg0LDM5Ljg1NXoiLz4NCgkJPHBhdGggZD0iTTM4LjA2NywzMy43NDZsLTQuNTU1LTMuMTQxYy0wLjU1Ny0wLjM4My0xLjI3MS0wLjQ1MS0xLjg5LTAuMTc4Yy0wLjYxNywwLjI3MS0xLjA0OSwwLjg0OC0xLjE0MiwxLjUxNmwtMS4wNzcsNy44OTINCgkJCWMtMC4xMDgsMC43OTMsMC4yOCwxLjU3MSwwLjk3OSwxLjk2MWwxLjcsMC45NDhjMC44NzYsMC40ODgsMS45NzksMC4yMywyLjU0Ny0wLjU5NGwzLjkzMS01LjcwMQ0KCQkJQzM5LjE3MiwzNS41NjYsMzguOTUsMzQuMzU1LDM4LjA2NywzMy43NDZ6Ii8+DQoJCTxwYXRoIGQ9Ik00MC40MjIsNDQuNTg3bC0wLjg3OC00LjM2Yy0wLjA3MS0wLjM1Ny0wLjM0NS0wLjYzNy0wLjY5OC0wLjcxOHMtMC43MjMsMC4wNTYtMC45MzgsMC4zNDVsLTEuOTk2LDIuNjU1DQoJCQljLTAuMTU2LDAuMjA5LTAuMjE4LDAuNDc2LTAuMTY2LDAuNzMxYzAuMDUxLDAuMjU3LDAuMjA5LDAuNDc5LDAuNDM1LDAuNjEzbDIuODY5LDEuNzA3YzAuMzEzLDAuMTg2LDAuNzA1LDAuMTcsMS4wMDQtMC4wNDENCgkJCUM0MC4zNSw0NS4zMTEsNDAuNDk1LDQ0Ljk0Myw0MC40MjIsNDQuNTg3eiIvPg0KCQk8cGF0aCBkPSJNMjMuMDE4LDIzLjk0NWMxLjQzMywwLDEzLjk4OC0wLjEyMywxMy45ODgtNC40MWMwLTEuOTEtMi40OTUtMi45OTMtNS4zODktMy42MDZjMC4xMTItMC4xODUsMC4yMTgtMC4zNzYsMC4zMTctMC41Nw0KCQkJbDEuOTg1LTAuMTc4YzEuNTkzLTAuMDM4LDIuOTIxLTEuMjM2LDMuMDk5LTIuNzk5bDAuMzk4LTMuNDAyYzAuMTAyLTAuODgxLTAuMTU2LTEuNjA0LTAuNzktMi4zMTQNCgkJCWMtMC43MjgtMC44MTMtMS43MjYtMC43NjgtMi4zODctMC43NjhoLTAuOTA3bDAuMTk1LTIuNzk2YzAuMDAyLTAuMDE0LDAuMDAyLTAuMDU2LDAuMDAzLTAuMDY5DQoJCQljMC4wMDEtMC4wMjMsMC4wMDMtMC4wNjIsMC4wMDMtMC4wODVDMzMuNTM0LDEuMzI0LDI4LjgyNSwwLDIzLjAxNywwUzEyLjUwMiwxLjMxNCwxMi41MDIsMi45MzljMCwwLjAyNCwwLDAuMDQ2LDAuMDAzLDAuMDY5DQoJCQljMCwwLjAxNCwwLDAuMDI2LDAuMDAyLDAuMDM5bDAuNjMyLDguODQ0YzAuMTA0LDEuNDc2LDAuNTYsMi44NDgsMS4yNzgsNC4wMzljLTIuODkxLDAuNjE0LTUuMzg4LDEuNjk3LTUuMzg4LDMuNjA2DQoJCQlDOS4wMywyMy44MjIsMjEuNTg2LDIzLjk0NSwyMy4wMTgsMjMuOTQ1eiBNMzIuODk3LDEyLjAwN0wzMy4yLDcuOTA2aDEuMzMzYzAuODMyLDAsMS4wODYsMC44MTEsMS4wNTMsMS4xMDNsLTAuNDExLDMuMjg3DQoJCQljLTAuMDc4LDAuNjY3LTAuNjAyLDAuOTQ1LTEuMjk2LDAuOTczYy0wLjI5OCwwLjAxMi0xLjE5LDAuMDgyLTEuMTksMC4wODJDMzIuODExLDEyLjg0OSwzMi44NTgsMTIuNTQxLDMyLjg5NywxMi4wMDd6DQoJCQkgTTIzLjAxOCwyLjE0YzMuODA4LDAsNi44OTQsMC42NDYsNi44OTQsMS40NDRjMCwwLjgtMy4wODYsMS40NDYtNi44OTQsMS40NDZjLTMuODA2LDAtNi44OTQtMC42NDYtNi44OTQtMS40NDYNCgkJCUMxNi4xMjQsMi43ODcsMTkuMjExLDIuMTQsMjMuMDE4LDIuMTR6IE0xNi4yNDIsMTcuODg1YzEuNTk2LDEuMzg0LDMuNjc2LDIuMDA5LDUuOTM4LDIuMDA5aDEuNjc1DQoJCQljMi4yNjQsMCw0LjM0NC0wLjYyNSw1LjkzOS0yLjAwOWMyLjUxLDAuNDExLDQuMTIyLDEuMSw0LjY0NSwxLjU0N2MtMC44OTksMC43NzEtNS4wMzQsMi4wMDMtMTEuNDIsMi4wMDMNCgkJCWMtNi4zODQsMC0xMC41MjEtMS4yNTItMTEuNDE4LTIuMDI0QzEyLjExOSwxOC45NjMsMTMuNzMsMTguMjk2LDE2LjI0MiwxNy44ODV6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=";
                            var work = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9Ijc3OS4xMXB4IiBoZWlnaHQ9Ijc3OS4xMXB4IiB2aWV3Qm94PSIwIDAgNzc5LjExIDc3OS4xMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNzc5LjExIDc3OS4xMTsiDQoJIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik02NjIuOTE0LDYzMi4zNTFINTMwLjA3SDI1NC40NzRjLTExLjQ5LDAtMjAuODA2LDkuMzE1LTIwLjgwNiwyMC44MDZ2MTIuODA1YzAsMTEuNDksOS4zMTUsMjAuODEsMjAuODA2LDIwLjgxaDI3NS41OTgNCgkJCWgxMzIuODQ0aDY4Ljgydi01NC40MThMNjYyLjkxNCw2MzIuMzUxTDY2Mi45MTQsNjMyLjM1MXoiLz4NCgkJPGNpcmNsZSBjeD0iMjExLjE4NyIgY3k9IjE4OS42MjUiIHI9IjExNS4xOSIvPg0KCQk8cGF0aCBkPSJNNDkyLjIzNCw0NzIuMTQ3bC0yNjMuOTY5LTAuMTQ2bC02LjI1LTAuMDJ2LTMwLjYzMmwtMC4yMTctMjUuNjRjMC02MS4yNDUtNDkuNjUxLTExMC44OTgtMTEwLjg5OS0xMTAuODk4DQoJCQljLTIuMDc1LDAtNC4xMzYsMC4wNy02LjE4NCwwLjE4MmwtMC4xNTYtMC4xODJDNDYuODEzLDMwNC44MTMsMCwzNTEuNjI1LDAsNDA5LjM3MnYyOTUuMzAzaDIyMi4wMTVWNTc4Ljg3NmwtMi45MzctMC4yMzENCgkJCWMtMC4yMDktMC4wMTktMC4yNjEsMC4wMDItMC4zOTEsMC4wMDJjLTE1LjAyMSwwLTI5LjQxNy02LjMyNC0zOS41NjItMTcuMzk5bC05MC4xMTItOTguMzYzDQoJCQljLTIuODczLTMuMTM1LTIuNjYtOC4wMDMsMC40NzYtMTAuODc0YzMuMTMzLTIuODczLDguMDAzLTIuNjU5LDEwLjg3NCwwLjQ3Nmw5MC4xMTEsOTguMzYyDQoJCQljNy4zMjIsNy45OTMsMTcuNjQ4LDEyLjg4MSwyOC41MjEsMTMuMDM5YzAuNzIzLDAuMDEsMTAuNTk0LDAuMTUyLDEwLjU5NCwwLjE1MmgyNjIuNjQ1YzI1LjM3NSwwLDQ1Ljk0Ny0yMC41NzEsNDUuOTQ3LTQ1Ljk0Nw0KCQkJQzUzOC4xODIsNDkyLjcxNyw1MTcuNjA5LDQ3Mi4xNDcsNDkyLjIzNCw0NzIuMTQ3eiIvPg0KCQk8cGF0aCBkPSJNNzY1LjE5NywzMDkuMTExYy0xMC43NDQtMy42ODEtMjIuNDM5LDIuMDQ5LTI2LjEyMywxMi43OTRsLTg3LjIwOSwyNTQuNTlIMzM5LjgwM2MtMTEuMzU2LDAtMjAuNTY3LDkuMjA2LTIwLjU2NywyMC41NjQNCgkJCXM5LjIxMSwyMC41NjYsMjAuNTY3LDIwLjU2NmgzMjYuNTA3YzYuOTk0LDAsMTMuMTY4LTMuNTAzLDE2Ljg3OS04Ljg0MWMxLjI4My0xLjY5NCwyLjMzLTMuNjA3LDMuMDU5LTUuNzI5TDc3OCwzMzUuMjI1DQoJCQlDNzgxLjY3LDMyNC40ODYsNzc1Ljk0NywzMTIuNzksNzY1LjE5NywzMDkuMTExeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K";
                            var car = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE4LjEuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNjEyLjAwMSA2MTIuMDAxIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MTIuMDAxIDYxMi4wMDE7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGQ9Ik01ODkuMzMzLDI3Ni4wMzNjLTExLjIzNC0zLjc1Ni04OS4zNzgtMjAuODM0LTg5LjM3OC0yMC44MzRzLTE0NC44Ni04Mi4zNzUtMTYyLjI0NS04Mi4zNzVzLTEzNi42MzksMC4wNTMtMTM2LjYzOSwwLjA1Mw0KCQljLTI5LjEzNywwLTUzLjQ4NywyMi4yMDMtODEuNjgsNDcuOTA5Yy0xMy4yODcsMTIuMTEyLTI3Ljk1MywyNS40NDItNDQuMTMsMzcuMjk5bC02MC4yNDksOC4wMTENCgkJQzYuMzA2LDI2OC44NzIsMCwyNzcuMDE4LDAsMjg2LjY0M3Y2OS4wM2MwLDExLjkxMyw5LjY1NiwyMS41NzEsMjEuNTcsMjEuNTcxaDQxLjQwMWMzLjAwNywzNC42NSwzMi4xNTMsNjEuOTMyLDY3LjU3LDYxLjkzMg0KCQljMzUuNDE1LDAsNjQuNTYzLTI3LjI4Myw2Ny41Ny02MS45MzFoMTk3LjY4N2MzLjAwNywzNC42NSwzMi4xNTMsNjEuOTMxLDY3LjU3LDYxLjkzMXM2NC41NjMtMjcuMjgzLDY3LjU3LTYxLjkzMWgzNC4wMTMNCgkJYzI2Ljk1LDAsNDAuMTE5LTExLjY0LDQzLjQyNi0yMi41NjZDNjE2LjczOSwzMjcuMDMsNjEwLjcyNCwyODMuMTg1LDU4OS4zMzMsMjc2LjAzM3ogTTEzMC41NDEsNDA2LjQ4DQoJCWMtMTkuMzgsMC0zNS4xNDgtMTUuNzY2LTM1LjE0OC0zNS4xNDZzMTUuNzY2LTM1LjE0OCwzNS4xNDgtMzUuMTQ4YzE5LjM4LDAsMzUuMTQ2LDE1Ljc2NiwzNS4xNDYsMzUuMTQ4DQoJCUMxNjUuNjg4LDM5MC43MTQsMTQ5LjkyMSw0MDYuNDgsMTMwLjU0MSw0MDYuNDh6IE0yNjEuMDA4LDI1NS4yMDFIMTQzLjEzNGM4LjUyNi02LjczNiwxNi40MDktMTMuODg2LDIzLjY3MS0yMC41MDUNCgkJYzE5LjA4Ni0xNy40MDIsMzUuNTctMzIuNDMyLDU1LjI5NC0zMi40MzJjMCwwLDE3Ljg1LTAuMDA4LDM4LjkxLTAuMDE3VjI1NS4yMDF6IE0yODkuNzExLDIwMi4yMzYNCgkJYzE0LjU4OC0wLjAwNSwyNy41OTItMC4wMDksMzQuMTE2LTAuMDA5YzE2LjI0NSwwLDgyLjEzNSwzOC4yNjQsMTA2Ljg2NCw1Mi45NzVoLTE0MC45OEwyODkuNzExLDIwMi4yMzZMMjg5LjcxMSwyMDIuMjM2eg0KCQkgTTQ2My4zNjcsNDA2LjQ4Yy0xOS4zOCwwLTM1LjE0Ni0xNS43NjYtMzUuMTQ2LTM1LjE0NnMxNS43NjYtMzUuMTQ4LDM1LjE0Ni0zNS4xNDhjMTkuMzgsMCwzNS4xNDgsMTUuNzY2LDM1LjE0OCwzNS4xNDgNCgkJQzQ5OC41MTUsMzkwLjcxNCw0ODIuNzQ3LDQwNi40OCw0NjMuMzY3LDQwNi40OHoiLz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K";
                            var coffee = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDUxMS45OTkgNTExLjk5OSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTExLjk5OSA1MTEuOTk5OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8Zz4NCgkJPHBhdGggZD0iTTE3OS4zNjEsOTkuOTAzYy0xMS40MS0xMS40MS0xNi40NTQtMTcuMDA1LTE2LjQ1Mi0zMC4wODljLTAuMDAyLTEzLjA3OSw1LjA0NC0xOC42NzQsMTYuNDU3LTMwLjA4OQ0KCQkJYzkuMDg5LTkuMDg3LDkuMDg5LTIzLjgyLDAuMDAyLTMyLjkwOWMtOS4wODctOS4wOS0yMy44MjUtOS4wODctMzIuOTE0LTAuMDAyYy0xMi42OTksMTIuNjk4LTMwLjA5NSwzMC4wOS0zMC4wOSw2Mi45OTkNCgkJCWMtMC4wMDUsMzIuOTE0LDE3LjM4OCw1MC4zMDUsMzAuMDg5LDYzLjAwMWMxMS40MTEsMTEuNDEzLDE2LjQ1NywxNy4wMTEsMTYuNDU3LDMwLjA5MmMwLDEyLjg1NCwxMC40MiwyMy4yNzMsMjMuMjczLDIzLjI3Mw0KCQkJczIzLjI3My0xMC40MTgsMjMuMjczLTIzLjI3M0MyMDkuNDU0LDEyOS45OTMsMTkyLjA2MiwxMTIuNjAxLDE3OS4zNjEsOTkuOTAzeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMjg3Ljk2Nyw5OS45MDNjLTExLjQxLTExLjQxLTE2LjQ1NC0xNy4wMDUtMTYuNDUyLTMwLjA4OWMtMC4wMDItMTMuMDc5LDUuMDQ0LTE4LjY3NCwxNi40NTctMzAuMDg5DQoJCQljOS4wODktOS4wODcsOS4wODktMjMuODIsMC4wMDItMzIuOTA5Yy05LjA4Ny05LjA5LTIzLjgyNS05LjA4Ny0zMi45MTQtMC4wMDJjLTEyLjY5OSwxMi42OTgtMzAuMDk1LDMwLjA5Mi0zMC4wOSw2Mi45OTkNCgkJCWMtMC4wMDUsMzIuOTE0LDE3LjM4OCw1MC4zMDUsMzAuMDg5LDYzLjAwMWMxMS40MTEsMTEuNDEzLDE2LjQ1NywxNy4wMTEsMTYuNDU3LDMwLjA5MmMwLDEyLjg1NCwxMC40MiwyMy4yNzMsMjMuMjczLDIzLjI3Mw0KCQkJczIzLjI3My0xMC40MTgsMjMuMjczLTIzLjI3M0MzMTguMDYxLDEyOS45OTMsMzAwLjY2OCwxMTIuNjAxLDI4Ny45NjcsOTkuOTAzeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMzgxLjQwMSw0MDMuMzkzaDIxLjk5M2MwLjAyMiwwLDAuMDM5LTAuMDAzLDAuMDYxLTAuMDAzYzQ3LjAyMy0wLjAzMSw4NS4yNzMtMzguMjk4LDg1LjI3My04NS4zMzENCgkJCWMwLTQ3LjA1My0zOC4yODEtODUuMzM0LTg1LjMzNC04NS4zMzRoLTMxLjAzSDYyLjA2Yy0xMi44NTMsMC0yMy4yNzMsMTAuNDIyLTIzLjI3MywyMy4yNzN2NzcuNTc2DQoJCQljMCw1Mi4xOTMsMjIuNTI4LDk5LjIyMSw1OC4zNywxMzEuODc5SDQ2LjU0NWMtMTIuODUzLDAtMjMuMjczLDEwLjQxOC0yMy4yNzMsMjMuMjczYzAsMTIuODUxLDEwLjQyLDIzLjI3MywyMy4yNzMsMjMuMjczDQoJCQloMTcwLjY2N2gxNzAuNjY3YzEyLjg1MywwLDIzLjI3My0xMC40MjIsMjMuMjczLTIzLjI3M2MwLTEyLjg1NC0xMC40Mi0yMy4yNzMtMjMuMjczLTIzLjI3M2gtNTAuNjEyDQoJCQlDMzU2LjEwNCw0NDguMjg5LDM3MS4yNTcsNDI3LjE1OCwzODEuNDAxLDQwMy4zOTN6IE0zOTUuNjM3LDMzMy41NzV2LTU0LjMwM2g3Ljc1OGMyMS4zODgsMCwzOC43ODgsMTcuNCwzOC43ODgsMzguNzg4DQoJCQlzLTE3LjQsMzguNzg4LTM4Ljc4OCwzOC43ODhjLTAuMDExLDAtMC4wMiwwLTAuMDMxLDBoLTkuMjQ1QzM5NS4xMTUsMzQ5LjIyOSwzOTUuNjM3LDM0MS40NjEsMzk1LjYzNywzMzMuNTc1eiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K";
                            var dinner = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMjY0LjE4MSw3Ni45MDljLTkzLjY0NiwwLTE2OS41NjEsNzUuOTE1LTE2OS41NjEsMTY5LjU2MXM3NS45MTUsMTY5LjU2MSwxNjkuNTYxLDE2OS41NjENCgkJCXMxNjkuNTYxLTc1LjkxNSwxNjkuNTYxLTE2OS41NjFTMzU3LjgyNyw3Ni45MDksMjY0LjE4MSw3Ni45MDl6IE0yNjQuMTgsMzc1LjEyOWMtNzAuOTQyLDAtMTI4LjY1OC01Ny43MTYtMTI4LjY1OC0xMjguNjU4DQoJCQlzNTcuNzE2LTEyOC42NTgsMTI4LjY1OC0xMjguNjU4czEyOC42NTgsNTcuNzE2LDEyOC42NTgsMTI4LjY1OFMzMzUuMTIzLDM3NS4xMjksMjY0LjE4LDM3NS4xMjl6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik0yNjQuMTgsMTUyLjI5OWMtNTEuOTI2LDAtOTQuMTcxLDQyLjI0NS05NC4xNzEsOTQuMTcxYzAsNTEuOTI2LDQyLjI0NSw5NC4xNzEsOTQuMTcxLDk0LjE3MQ0KCQkJYzUxLjkyNiwwLDk0LjE3MS00Mi4yNDUsOTQuMTcxLTk0LjE3MVMzMTYuMTA3LDE1Mi4yOTksMjY0LjE4LDE1Mi4yOTl6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik01MDEuMzE1LDI2MC42ODdWNTQuNjRjMC0xLjk4OC0xLjI2OS0zLjc1NS0zLjE1NS00LjM5Yy0xLjg4NC0wLjYzNC0zLjk2MywwLjAwNy01LjE2NiwxLjU5MQ0KCQkJYy0yNS43MDgsMzMuOTAzLTM5LjYyMiw3NS4yODMtMzkuNjIyLDExNy44M3Y3NS4zNzhjMCw4LjY0NSw3LjAwOCwxNS42NTQsMTUuNjU0LDE1LjY1NGg2LjUyNg0KCQkJYy02LjQzMyw2Ni40NDMtMTAuNjg0LDE1OS4zNy0xMC42ODQsMTcwLjI1MWMwLDE3LjE0MiwxMC41NTEsMzEuMDM4LDIzLjU2NiwzMS4wMzhjMTMuMDE1LDAsMjMuNTY2LTEzLjg5NywyMy41NjYtMzEuMDM4DQoJCQlDNTEyLDQyMC4wNzIsNTA3Ljc0OSwzMjcuMTMsNTAxLjMxNSwyNjAuNjg3eiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNNjguNDE3LDIxOS44NDNjMTMuMDQyLTcuOSwyMS43NTktMjIuMjI0LDIxLjc1OS0zOC41ODZsLTYuNDYtMTA1LjYyMWMtMC4yNDctNC4wMjYtMy41ODQtNy4xNjUtNy42MTgtNy4xNjUNCgkJCWMtNC4zNjMsMC03LjgzOSwzLjY1NS03LjYyMiw4LjAxbDQuMjAxLDg0LjcwOWMwLDQuNzYyLTMuODYxLDguNjIxLTguNjIxLDguNjIxYy00Ljc2MSwwLTguNjIxLTMuODYxLTguNjIxLTguNjIxbC0yLjA5OS04NC42NzQNCgkJCWMtMC4xMTEtNC40NzUtMy43Ny04LjA0NC04LjI0Ny04LjA0NGMtNC40NzcsMC04LjEzNSwzLjU3LTguMjQ3LDguMDQ0bC0yLjA5OSw4NC42NzRjMCw0Ljc2Mi0zLjg2MSw4LjYyMS04LjYyMSw4LjYyMQ0KCQkJYy00Ljc2MSwwLTguNjIxLTMuODYxLTguNjIxLTguNjIxbDQuMjAxLTg0LjcwOWMwLjIxNi00LjM1Ny0zLjI2Mi04LjAxLTcuNjIyLTguMDFjLTQuMDM0LDAtNy4zNzEsMy4xMzktNy42MTcsNy4xNjVMMCwxODEuMjU4DQoJCQljMCwxNi4zNjIsOC43MTYsMzAuNjg1LDIxLjc1OSwzOC41ODZjOC40ODgsNS4xNDEsMTMuMjIsMTQuNzUzLDEyLjEyNiwyNC42MTdjLTcuMzYzLDY2LjM1OC0xMi4zNjMsMTc0LjY5My0xMi4zNjMsMTg2LjQ5NA0KCQkJYzAsMTcuMTQyLDEwLjU1MSwzMS4wMzgsMjMuNTY2LDMxLjAzOGMxMy4wMTUsMCwyMy41NjYtMTMuODk3LDIzLjU2Ni0zMS4wMzhjMC0xMS44MDEtNS4wMDEtMTIwLjEzNi0xMi4zNjMtMTg2LjQ5NA0KCQkJQzU1LjE5NiwyMzQuNjAyLDU5LjkzMywyMjQuOTgyLDY4LjQxNywyMTkuODQzeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K";
                            var book = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDI5Ni45OTkgMjk2Ljk5OSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk2Ljk5OSAyOTYuOTk5OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8Zz4NCgkJPGc+DQoJCQk8cGF0aCBkPSJNNDUuNDMyLDM1LjA0OWMtMC4wMDgsMC0wLjAxNywwLTAuMDI1LDBjLTIuODA5LDAtNS40NTEsMS4wOTUtNy40NDYsMy4wODVjLTIuMDE3LDIuMDEyLTMuMTI4LDQuNjkxLTMuMTI4LDcuNTQzDQoJCQkJdjE1OS4zNjVjMCw1Ljg0NCw0Ljc3MywxMC42MSwxMC42NDEsMTAuNjI1YzI0LjczOCwwLjA1OSw2Ni4xODQsNS4yMTUsOTQuNzc2LDM1LjEzNlY4NC4wMjNjMC0xLjk4MS0wLjUwNi0zLjg0Mi0xLjQ2MS01LjM4Mg0KCQkJCUMxMTUuMzIyLDQwLjg0OSw3MC4yMjYsMzUuMTA3LDQ1LjQzMiwzNS4wNDl6Ii8+DQoJCQk8cGF0aCBkPSJNMjYyLjE2NywyMDUuMDQyVjQ1LjY3NmMwLTIuODUyLTEuMTExLTUuNTMxLTMuMTI4LTcuNTQzYy0xLjk5NS0xLjk5LTQuNjM5LTMuMDg1LTcuNDQ1LTMuMDg1Yy0wLjAwOSwwLTAuMDE4LDAtMC4wMjYsMA0KCQkJCWMtMjQuNzkzLDAuMDU5LTY5Ljg4OSw1LjgwMS05My4zNTcsNDMuNTkzYy0wLjk1NSwxLjU0LTEuNDYsMy40MDEtMS40Niw1LjM4MnYxNjYuNzc5DQoJCQkJYzI4LjU5Mi0yOS45MjEsNzAuMDM4LTM1LjA3Nyw5NC43NzYtMzUuMTM2QzI1Ny4zOTQsMjE1LjY1MSwyNjIuMTY3LDIxMC44ODUsMjYyLjE2NywyMDUuMDQyeiIvPg0KCQkJPHBhdGggZD0iTTI4Ni4zNzMsNzEuODAxaC03LjcwNnYxMzMuMjQxYzAsMTQuOTIxLTEyLjE1NywyNy4wODgtMjcuMTAxLDI3LjEyNWMtMjAuOTgzLDAuMDUtNTUuNTgxLDQuMTUzLTgwLjA4NCwyNy4zNDQNCgkJCQljNDIuMzc4LTEwLjM3Niw4Ny4wNTItMy42MzEsMTEyLjUxMiwyLjE3MWMzLjE3OSwwLjcyNCw2LjQ2NC0wLjAyNCw5LjAxMS0yLjA1NGMyLjUzOC0yLjAyNSwzLjk5NC01LjA1MiwzLjk5NC04LjMwMVY4Mi40MjcNCgkJCQlDMjk3LDc2LjU2OCwyOTIuMjMyLDcxLjgwMSwyODYuMzczLDcxLjgwMXoiLz4NCgkJCTxwYXRoIGQ9Ik0xOC4zMzIsMjA1LjA0MlY3MS44MDFoLTcuNzA2QzQuNzY4LDcxLjgwMSwwLDc2LjU2OCwwLDgyLjQyN3YxNjguODk3YzAsMy4yNSwxLjQ1Niw2LjI3NiwzLjk5NCw4LjMwMQ0KCQkJCWMyLjU0NSwyLjAyOSw1LjgyNywyLjc4LDkuMDExLDIuMDU0YzI1LjQ2LTUuODAzLDcwLjEzNS0xMi41NDcsMTEyLjUxMS0yLjE3MWMtMjQuNTAyLTIzLjE5LTU5LjEtMjcuMjkyLTgwLjA4My0yNy4zNDINCgkJCQlDMzAuNDksMjMyLjEzLDE4LjMzMiwyMTkuOTYzLDE4LjMzMiwyMDUuMDQyeiIvPg0KCQk8L2c+DQoJPC9nPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=";
                            var home = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE4LjEuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgMjcuMDIgMjcuMDIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDI3LjAyIDI3LjAyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8cGF0aCBzdHlsZT0iZmlsbDojMDMwMTA0OyIgZD0iTTMuNjc0LDI0Ljg3NmMwLDAtMC4wMjQsMC42MDQsMC41NjYsMC42MDRjMC43MzQsMCw2LjgxMS0wLjAwOCw2LjgxMS0wLjAwOGwwLjAxLTUuNTgxDQoJCWMwLDAtMC4wOTYtMC45MiwwLjc5Ny0wLjkyaDIuODI2YzEuMDU2LDAsMC45OTEsMC45MiwwLjk5MSwwLjkybC0wLjAxMiw1LjU2M2MwLDAsNS43NjIsMCw2LjY2NywwDQoJCWMwLjc0OSwwLDAuNzE1LTAuNzUyLDAuNzE1LTAuNzUyVjE0LjQxM2wtOS4zOTYtOC4zNThsLTkuOTc1LDguMzU4QzMuNjc0LDE0LjQxMywzLjY3NCwyNC44NzYsMy42NzQsMjQuODc2eiIvPg0KCTxwYXRoIHN0eWxlPSJmaWxsOiMwMzAxMDQ7IiBkPSJNMCwxMy42MzVjMCwwLDAuODQ3LDEuNTYxLDIuNjk0LDBsMTEuMDM4LTkuMzM4bDEwLjM0OSw5LjI4YzIuMTM4LDEuNTQyLDIuOTM5LDAsMi45MzksMA0KCQlMMTMuNzMyLDEuNTRMMCwxMy42MzV6Ii8+DQoJPHBvbHlnb24gc3R5bGU9ImZpbGw6IzAzMDEwNDsiIHBvaW50cz0iMjMuODMsNC4yNzUgMjEuMTY4LDQuMjc1IDIxLjE3OSw3LjUwMyAyMy44Myw5Ljc1MiAJIi8+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==";
                            var beer = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjIwLjQ5NXB4IiBoZWlnaHQ9IjIwLjQ5NXB4IiB2aWV3Qm94PSIwIDAgMjAuNDk1IDIwLjQ5NSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAuNDk1IDIwLjQ5NTsiDQoJIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik0xNi4xOTcsOC41NWgtMC45MTFjLTAuMTg4LDAtMC4zNywwLjAxOS0wLjU0OCwwLjA1MlY2LjU0NWMwLTAuMTEyLTAuMDEzLTAuMjIxLTAuMDMzLTAuMzI3DQoJCQljMC41OTktMC40NDMsMC45OTEtMS4xNDgsMC45OTEtMS45NDhjMC0xLjQ5LTEuMzcyLTIuNjg1LTIuODgzLTIuMzg2Yy0wLjUtMC41MjYtMS4yMTMtMC44MjMtMS45NDYtMC43ODYNCgkJCUMxMC4zOTksMC40Miw5LjYyLDAsOC43ODksMEM4LjExNCwwLDcuNDc2LDAuMjY4LDcuMDA2LDAuNzM0QzYuODgxLDAuNjgzLDYuNzUzLDAuNjQyLDYuNjIzLDAuNjEyTDYuNDU5LDAuNTgNCgkJCUM2LjMzMywwLjU2LDYuMjA3LDAuNTQ5LDYuMDc4LDAuNTQ3Yy0wLjE4OS0wLjAxNS0wLjM3MS0wLjAxNC0wLjU1LDAuMDAxSDUuNDc5djAuMDA0QzQuNDA1LDAuNjYsMy41LDEuMjk2LDMuMTQ1LDIuMTgzDQoJCQlDMi4wOSwyLjM4MywxLjI5LDMuMzEyLDEuMjksNC40MjJjMCwwLjc3NSwwLjM5LDEuNDU4LDAuOTgyLDEuODdDMi4yNiw2LjM3NSwyLjI0Nyw2LjQ1OCwyLjI0Nyw2LjU0NXYxMi4zMDkNCgkJCWMwLDAuOTA1LDAuNzM2LDEuNjQyLDEuNjQxLDEuNjQyaDkuMjA4YzAuOTA1LDAsMS42NDItMC43MzYsMS42NDItMS42NDJWMTYuMzRjMC4xNzgsMC4wMzMsMC4zNiwwLjA1MywwLjU0OCwwLjA1M2gwLjkxMQ0KCQkJYzEuNjU5LDAsMy4wMDktMS4zNTEsMy4wMDktMy4wMXYtMS44MjJDMTkuMjA2LDkuOTAxLDE3Ljg1Niw4LjU1LDE2LjE5Nyw4LjU1eiBNMTMuNjQzLDE4Ljg1NGMwLDAuMzAyLTAuMjQ0LDAuNTQ3LTAuNTQ3LDAuNTQ3DQoJCQlIMy44ODhjLTAuMzAyLDAtMC41NDctMC4yNDUtMC41NDctMC41NDdWNi41NDVjMC0wLjMwMiwwLjI0NS0wLjU0NywwLjU0Ny0wLjU0N2g5LjIwOGMwLjMwMywwLDAuNTQ3LDAuMjQ1LDAuNTQ3LDAuNTQ3VjE4Ljg1NHoNCgkJCSBNMTQuMTMsNS4yOEwxNC4xMyw1LjI4Yy0wLjI4Mi0wLjIzMi0wLjY0LTAuMzc3LTEuMDM0LTAuMzc3SDMuODg4Yy0wLjQxNywwLTAuNzkzLDAuMTYxLTEuMDgzLDAuNDE3DQoJCQlDMi41NDksNS4xMDMsMi4zODQsNC43ODMsMi4zODQsNC40MjJjMC0wLjY1MSwwLjUyOS0xLjE4MiwxLjE4MS0xLjE4NGwwLjQ0OC0wLjAwMkw0LjEsMi43OTdDNC4yMDIsMi4yODMsNC43MzUsMS43NCw1LjU1MiwxLjY0NQ0KCQkJaDAuNjAzYzAuMjQ1LDAuMDE3LDAuNDgxLDAuMDk3LDAuNjg5LDAuMjM0bDAuNDUyLDAuMjk5bDAuMzAzLTAuNDQ5QzcuODY3LDEuMzMyLDguMzEyLDEuMDk0LDguNzksMS4wOTQNCgkJCWMwLjU1NiwwLDEuMDUsMC4zMTUsMS4yOTIsMC44MjNsMC4xODQsMC4zODdsMC40Mi0wLjA4NmMwLjU3MS0wLjExNSwxLjE1NCwwLjEyNCwxLjQ3OCwwLjU5N2wwLjIzOSwwLjM1MmwwLjQtMC4xNDcNCgkJCWMwLjE2MS0wLjA1OSwwLjMxMi0wLjA4OCwwLjQ2MS0wLjA4OGMwLjczNywwLDEuMzM4LDAuNiwxLjMzOCwxLjMzOEMxNC42MDIsNC42NzUsMTQuNDE2LDUuMDM1LDE0LjEzLDUuMjh6IE0xNy41NjUsMTMuMzgzDQoJCQljMCwwLjc1NC0wLjYxMywxLjM2OC0xLjM2OCwxLjM2OGgtMC45MTFjLTAuMTk1LDAtMC4zOC0wLjA0Mi0wLjU0OC0wLjExNnYtNC4zMjZjMC4xNjgtMC4wNzQsMC4zNTMtMC4xMTYsMC41NDgtMC4xMTZoMC45MTENCgkJCWMwLjc1NCwwLDEuMzY4LDAuNjEzLDEuMzY4LDEuMzY4VjEzLjM4M3oiLz4NCgkJPHJlY3QgeD0iMy44ODgiIHk9IjguMDAzIiB3aWR0aD0iOS4yMSIgaGVpZ2h0PSIxMC44NTEiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==";
                            var dance = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjI0OC45MTRweCIgaGVpZ2h0PSIyNDguOTE0cHgiIHZpZXdCb3g9IjAgMCAyNDguOTE0IDI0OC45MTQiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDI0OC45MTQgMjQ4LjkxNDsiDQoJIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik0yMDEuNzExLDQ5LjU4M2MtNS40NiwwLTkuODk1LDMuNzcxLTkuODk1LDguNDE5YzAsNC42NTMsNC40MzUsOC40MTksOS44OTUsOC40MTljNS4zMTYsMCw5LjY0My0zLjU2Niw5Ljg3Ni04LjAzMg0KCQkJYzUuMTA1LTEzLjYsNC4xMDYtMjQuMDc4LDMuMDQzLTI5LjEzN2MtMC43NDctMy41MzMtNC4yLTYuMjk1LTcuODUxLTYuMjk1bC0yMy4yNy0wLjAxYy0xLjg1NywwLTMuNTk0LDAuNzI0LTQuOSwyLjAzDQoJCQljLTEuMzgyLDEuMzkxLTIuMTM4LDMuMjc2LTIuMTI5LDUuMzJjMC4wMzgsNS42OTktMS4yMjMsMTMuMzA2LTIuMzA1LDE4Ljc3NmMtMC45MDYtMC4yMzMtMS44NzctMC4zNjQtMi44ODUtMC4zNjQNCgkJCWMtNS40NjEsMC05Ljg5NSwzLjc3MS05Ljg5NSw4LjQyNGMwLDQuNjQ4LDQuNDM4LDguNDE5LDkuODk1LDguNDE5YzUuMDU1LDAsOS4yMTMtMy4yMiw5LjgxOS03LjM3OGwwLjA3NSwwLjAxOQ0KCQkJYzAuMTYzLTAuNjUzLDMuODI2LTE1LjUyMyw0LjA3OS0yNi40NTNsMjAuODk4LDAuMDA5YzAuNjY4LDMuNjE3LDEuMTExLDkuOTgzLTEuMTI0LDE4LjMyMw0KCQkJQzIwMy45ODgsNDkuNzY1LDIwMi44NzgsNDkuNTgzLDIwMS43MTEsNDkuNTgzeiIvPg0KCQk8cGF0aCBkPSJNMzUuODY0LDEzNy44MzJjMi4wMjEsNC4xOTEsNy42NDksNS42NjEsMTIuNTY4LDMuMjk1YzQuNzkzLTIuMzAxLDcuMTQxLTcuMzkzLDUuNDE0LTExLjUxOQ0KCQkJYy0xLjMtMTQuNDcyLTYuNzQ0LTIzLjQ3NS05Ljg5Ni0yNy41NzdjLTIuMjA4LTIuODUyLTYuNTE1LTMuODUxLTkuODA4LTIuMjY0bC0yMC45NjksMTAuMDg1DQoJCQljLTEuNjczLDAuODAzLTIuOTI2LDIuMjA4LTMuNTMzLDMuOTU4Yy0wLjY0NCwxLjg0OS0wLjUwMSwzLjg4MywwLjM5Miw1LjcxN2MyLjUwNCw1LjEyLDQuNjY5LDEyLjUyMiw2LjA2LDE3LjkyMQ0KCQkJYy0wLjkyMSwwLjE4My0xLjg1MSwwLjQ4NS0yLjc1MywwLjkyNWMtNC45MTcsMi4zNjYtNy4yNzMsNy42ODctNS4yNTUsMTEuODc3YzIuMDIxLDQuMTkxLDcuNjQ1LDUuNjY2LDEyLjU2OSwzLjI5NQ0KCQkJYzQuNTQ4LTIuMTg4LDYuOS02LjkwMiw1LjY0Mi0xMC45MDZsMC4wNzctMC4wMTVjLTAuMTMzLTAuNjYyLTMuMjg4LTE1LjY0NC03Ljc5OS0yNS42MDhsMTguODMtOS4wNTQNCgkJCWMyLjE3LDIuOTczLDUuMzM0LDguNTEzLDYuOTM1LDE2Ljk5OGMtMS4wNzYsMC4xNjgtMi4xNTYsMC40OS0zLjIwOCwwLjk5NEMzNi4yMDIsMTI4LjMyLDMzLjg0NiwxMzMuNjQyLDM1Ljg2NCwxMzcuODMyeiIvPg0KCQk8Y2lyY2xlIGN4PSIxMTAuNTY1IiBjeT0iMzguMTM2IiByPSIyMS4wMDQiLz4NCgkJPHBhdGggZD0iTTE0LjMzNywyMzIuODY4aDIyMC4yMzljNy45MjEsMCwxNC4zMzgtNi4yNzIsMTQuMzM4LTE0LjAyMWMwLTcuNzQ3LTYuNDE3LTE0LjAyNC0xNC4zMzgtMTQuMDI0aC02Ny4yNjINCgkJCWMwLjM5My0wLjE0NSwwLjc5NC0wLjI4LDEuMTc2LTAuNTA0YzMuMjkxLTEuOTkzLDQuMzUxLTYuMjc3LDIuMzU3LTkuNTcybC0zOS4yNzgtNjUuMDE3di0zMi4xMQ0KCQkJYzE3Ljg4LDE2LjEzOSwyNi41MjMsNDEuOTg1LDI2LjY3Nyw0Mi40NTdjMC45NTcsMi45NDksMy42OTIsNC44MjUsNi42MzcsNC44MjVjMC43MDUsMCwxLjQzNC0wLjEwNiwyLjEzOC0wLjMzNg0KCQkJYzMuNjczLTEuMTgxLDUuNjgtNS4xMTUsNC40OTQtOC43NzNjLTAuNTg4LTEuODA3LTEyLjY2MS0zOC4yNjEtMzkuOTY5LTU1LjY5N2MtMC4xMTEtOS41MjUtNy44NTItMTcuMjE3LTE3LjQwNi0xNy4yMTdoLTcuMTU5DQoJCQljLTQuNTg3LDAtOC43MzIsMS44MTEtMTEuODQzLDQuNzA5Yy0yMS40NjQtMTUuMzIyLTMxLjc5LTQ2LjE5NC0zMS45NjItNDYuNzE3Yy0xLjE5LTMuNjU0LTUuMTA4LTUuNjctOC43NzQtNC40ODUNCgkJCWMtMy42NzEsMS4xODUtNS42NzgsNS4xMTUtNC40OTIsOC43NzRjMC41ODEsMS44MDEsMTIuNTY0LDM3Ljk4LDM5LjY0Miw1NS41MDF2NTUuNzkxTDc2LjA0NSwxNjAuMTUNCgkJCWMtMS4xMDQsMS45MzctMS4yMTgsNC4yNzktMC4yOTYsNi4zMTlsMTUuNjgxLDM0Ljc1MWMwLjc5MywxLjc2LDIuMjQ1LDIuOTc4LDMuOTE4LDMuNjAzSDE0LjMzNw0KCQkJQzYuNDE5LDIwNC44MjMsMCwyMTEuMTA1LDAsMjE4Ljg0OEMwLDIyNi41OTEsNi40MTksMjMyLjg2OCwxNC4zMzcsMjMyLjg2OHogTTg5LjkxNCwxNjMuOTY4bDEzLjMwMS0yMy4zMzVoMTguNjQ3bDM3LjA0Nyw2MS4zMjUNCgkJCWMwLjg0NSwxLjM5NiwyLjExNCwyLjMzOCwzLjUyOCwyLjg3aC02Mi4xNTZjMC4xMTktMC4wNDcsMC4yNDgtMC4wNjUsMC4zNjctMC4xMTdjMy41MDctMS41ODIsNS4wNzUtNS43MTIsMy40ODktOS4yMjINCgkJCUw4OS45MTQsMTYzLjk2OHoiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==";
                            var drink = "data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMyIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNjQgNjQiIGhlaWdodD0iNTEyIiB2aWV3Qm94PSIwIDAgNjQgNjQiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0ibTE3LjYwNiAxLjIwNS0xLjIxMiAxLjU5IDEzLjM5MyAxMC4yMDVoMy4zMDF6Ii8+PHBhdGggZD0ibTIzIDI0YzAgNC45NjIgNC4wMzcgOSA5IDlzOS00LjAzOCA5LTl2LTJjMC0uNTUyLjQ0Ny0xIDEtMSA0LjYyNSAwIDguNDQ1LTMuNTA2IDguOTQ0LThoLTE3Ljg1Nmw1LjUxOCA0LjIwNS0xLjIxMyAxLjU5MS03LjYwNi01Ljc5NmgtMTYuNzMxYy40OTkgNC40OTQgNC4zMTkgOCA4Ljk0NCA4IC41NTMgMCAxIC40NDggMSAxem02LThjMi4yMDYgMCA0IDEuNzk0IDQgNHMtMS43OTQgNC00IDQtNC0xLjc5NC00LTQgMS43OTQtNCA0LTR6Ii8+PHBhdGggZD0ibTMzIDU3di0yMi4wNTFjLS4zMy4wMy0uNjYyLjA1MS0xIC4wNTFzLS42Ny0uMDIxLTEtLjA1MXYyMi4wNTFjMCAuNDA0LS4yNDMuNzY4LS42MTUuOTIzbC03LjM4NSAzLjA3N2gxOGwtNy4zODUtMy4wNzdjLS4zNzItLjE1NS0uNjE1LS41MTktLjYxNS0uOTIzeiIvPjxjaXJjbGUgY3g9IjI5IiBjeT0iMjAiIHI9IjIiLz48Y2lyY2xlIGN4PSI0MyIgY3k9IjQ5IiByPSIyIi8+PGNpcmNsZSBjeD0iNTIiIGN5PSIzOCIgcj0iNSIvPjxjaXJjbGUgY3g9IjE3IiBjeT0iNDQiIHI9IjIiLz48Y2lyY2xlIGN4PSI4IiBjeT0iMzMiIHI9IjUiLz48L3N2Zz4=";
                            var drunk = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDI5OS40NTMgMjk5LjQ1MyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk5LjQ1MyAyOTkuNDUzOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8ZyBpZD0iWE1MSURfMTQ1NF8iPg0KCTxnPg0KCQk8Zz4NCgkJCTxjaXJjbGUgY3g9IjE3Ny42NjciIGN5PSIzMy41MDciIHI9IjMzLjUwOCIvPg0KCQkJPHBhdGggZD0iTTIzNC4xOTQsOTYuNjE1bC00OS43MzIsMTYuODY2bC0zOC45Ny0zMC4wNzZsMzQuMjI0LDE0LjQxMmMtMC4xMDctOS44ODUtNi43MjMtMTguODk3LTE2LjczNi0yMS41OTlsLTM4Ljk3Mi0xMC41MTUNCgkJCQljLTEyLjA2OS0zLjI1Ny0yNC40OTMsMy44ODgtMjcuNzUsMTUuOTU4Yy0wLjY5NCwyLjU3Mi0xNi44NDQsNjEuMjktMjcuMDgzLDk4LjU0MmMtMi40MTEsOC43NzQtMi41MDEsMTguMDY0LTAuMjE4LDI2Ljg3Mw0KCQkJCWMzLjMxOCwxMi44MDQsNy45NzksMzAuNzk0LDE0LjQ2NCw1NS44MTlsLTUxLjc1NS0wLjI3MWMtMC4wMzIsMC0wLjA2NSwwLTAuMDk3LDBjLTEwLjAxNiwwLTE4LjE2Miw4LjA5My0xOC4yMTUsMTguMTIxDQoJCQkJYy0wLjA1MywxMC4wNjEsOC4wNjEsMTguMjYsMTguMTIxLDE4LjMxMmw3NS40MjEsMC4zOTVjMC4wMzEsMCwwLjA2NCwwLDAuMDk1LDBjMTEuOTE3LTAuMDAxLDIwLjYxOS0xMS4yNjksMTcuNjM1LTIyLjc4Ng0KCQkJCWwtMTguNjg0LTcyLjEwNmwxMi42ODYsMy40MjNsMTcuMDU1LDY1LjgxOGMyLjI4LDguOCwwLjMyNSwxOC4zMzMtNS4yMjMsMjUuNTMxbDIyLjc5NiwwLjEyYzAuMDMxLDAsMC4wNjQsMCwwLjA5NSwwDQoJCQkJYzExLjkxNi0wLjAwMSwyMC42MTktMTEuMjY5LDE3LjYzNS0yMi43ODZsLTE4LjkzMS03My4wNjJsMTIuNzI5LTQ3LjE3OWMtMS40MTktMS40MTksMS40NDcsMi4xODUtMzcuODQtNDguOTg1bDQ1LjQxMywzNS4wNDkNCgkJCQljNC4wMjksMy4xMSw5LjM0MSwzLjk4OSwxNC4xNTEsMi4zNTlsNTcuNDM5LTE5LjQ4MWM3Ljk0MS0yLjY5MiwxMi4xOTUtMTEuMzExLDkuNTAyLTE5LjI1Mg0KCQkJCUMyNTAuNzUzLDk4LjE3NywyNDIuMTM0LDkzLjkyMywyMzQuMTk0LDk2LjYxNXoiLz4NCgkJCTxwYXRoIGQ9Ik0yODAuNzI2LDYzLjgxM2gtNDEuNjU3Yy0yLjk2OSwwLTUuMzc1LDIuNDA2LTUuMzc1LDUuMzc1YzAsMi45NjksMi40MDcsNS4zNzUsNS4zNzUsNS4zNzVoMC40NjRsMC41MjYsNi4wODENCgkJCQljMTIuMjc1LDAuNDAzLDIzLjU4NSw4LjI3OSwyNy43NjMsMjAuNTk3YzMuNjYxLDEwLjc5NiwwLjg5NiwyMi4yMTYtNi4yMzYsMzAuMTE3aDEwLjA2NmMyLjA5MiwwLDMuODM2LTEuNiw0LjAxNi0zLjY4NA0KCQkJCWw0LjU5Mi01My4xMTFoMC40NjVjMi45NjksMCw1LjM3NS0yLjQwNiw1LjM3NS01LjM3NVMyODMuNjk0LDYzLjgxMywyODAuNzI2LDYzLjgxM3oiLz4NCgkJPC9nPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K";
                            var bed = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNDkwLjcgNDkwLjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ5MC43IDQ5MC43OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8Zz4NCgkJPHBhdGggZD0iTTQzNi4yLDE1NC42SDE4Mi40Yy0xMi40LDAtMzMuMSw0LjctMzMuMSwzNi42VjI0MGgzMjB2LTQ4LjhDNDY5LjMsMTU5LjQsNDQ4LjYsMTU0LjYsNDM2LjIsMTU0LjZ6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQoJPGc+DQoJCTxwb2x5Z29uIHBvaW50cz0iODAuMywyNTAuNiAzMiwyNTAuNiAzMiw4MCAwLDgwIDAsNDEwLjcgMzIsNDEwLjcgMzIsMzI1LjMgNDU4LjcsMzI1LjMgNDU4LjcsNDEwLjYgNDkwLjcsNDEwLjYgNDkwLjcsMjUwLjYgCQkNCgkJCSIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KCTxnPg0KCQk8Y2lyY2xlIGN4PSI4NS4zIiBjeT0iMTk3LjMiIHI9IjQ0LjciLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==";
                            var hand = "data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjYyNnB0IiB2aWV3Qm94PSItMjggLTE5IDYyNiA2MjYuNjY4MTYiIHdpZHRoPSI2MjZwdCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJtNDQuMjQ2MDk0IDQxNC45MzM1OTRoNDUuODk4NDM3YzguNzM0Mzc1IDkuOTk2MDk0IDE5LjcwMzEyNSAxNS44NzEwOTQgMzEuNjcxODc1IDE5LjQxNzk2OC0xMy4zNDc2NTYgMTYuNTgyMDMyLTEzLjMwNDY4NyA0MC4yMzQzNzYuMTA1NDY5IDU2Ljc1NzgxM2w0MS4wNzgxMjUgNTAuNDE0MDYzYzE1LjY2NDA2MiAxOS4xODM1OTMgNDMuOTAyMzQ0IDIyLjA2NjQwNiA2My4xMTMyODEgNi40NDUzMTJsMzUuNDg4MjgxLTI4LjkyOTY4OGMxOC41ODIwMzIgMS45ODQzNzYgMzcuMTc5Njg4LTMuNTM5MDYyIDUxLjY3MTg3Ni0xNS4zMzU5MzdsNjMuMzY3MTg3LTUxLjY5NTMxM2MxMC4xNDA2MjUgMTUuMDgyMDMyIDI3LjExMzI4MSAyNC4xNDA2MjYgNDUuMjg5MDYzIDI0LjE2NDA2M2g5My41OTc2NTZjMTQuMzk4NDM3LS4wMDc4MTMgMjguMTk5MjE4LTUuNzUzOTA2IDM4LjM1NTQ2OC0xNS45NjQ4NDQgMTAuMTYwMTU3LTEwLjIwNzAzMSAxNS44MzIwMzItMjQuMDM5MDYyIDE1Ljc2OTUzMi0zOC40NDE0MDZ2LTIyMy43MjI2NTZjLjE4NzUtMjUuMDkzNzUtMTYuODc4OTA2LTQ3LjAzOTA2My00MS4yNDYwOTQtNTMuMDM5MDYzdi0yNS41Yy0uMjE0ODQ0LTE0LjI0NjA5NC0xMS43ODUxNTYtMjUuNjk5MjE4LTI2LjAyNzM0NC0yNS43Njk1MzFoLTMuOTY0ODQ0di0xOS45OTYwOTRoOC4xNzE4NzZjNC44MzIwMzEgMCA5LjMyNDIxOC0zLjczNDM3NSA5LjMyNDIxOC04LjU2NjQwNnYtNTYuNTE1NjI1YzAtNC44MzIwMzEtNC41LTguNjU2MjUtOS4zMjQyMTgtOC42NTYyNWgtNzUuNzEwOTM4Yy0yLjMwNDY4OC0uMDE5NTMxMi00LjUyNzM0NC44ODI4MTItNi4xNTYyNSAyLjUwNzgxMi0xLjYzNjcxOSAxLjYyODkwNy0yLjU1NDY4OCAzLjgzOTg0NC0yLjU0Mjk2OSA2LjE0ODQzOHYyMC44MzIwMzFjLTcuNS01LjA5Mzc1LTE1LjM1OTM3NS04LjQwNjI1LTI0LjU1ODU5My04LjU1ODU5M2wtNjQuOTQ1MzEzLS45MzM1OTRoLS4wOTc2NTZjLTQuODM1OTM4LjExMzI4MS04LjcxMDkzOCA0LjA1NDY4Ny04Ljc0NjA5NCA4Ljg5MDYyNS0uMDU4NTk0IDQuODU5Mzc1IDMuODAwNzgxIDguODUxNTYyIDguNjU2MjUgOC45NjQ4NDNsNjQuODcxMDk0Ljc0NjA5NGMxMy43NDYwOTMuMjU3ODEzIDI0LjY5OTIxOSAxMS41ODk4NDQgMjQuNDg4MjgxIDI1LjMzNTkzOC0uMDE1NjI1Ljk1MzEyNS4xMzY3MTkgMS45MDYyNS40NDUzMTIgMi44MDQ2ODcuODA4NTk0IDQuMDkzNzUgNC40MTAxNTcgNy4wMzUxNTcgOC41ODIwMzIgN2g3LjU1MDc4MXYxOS45OTYwOTRoLTMuMzQzNzVjLTE0LjExNzE4Ny4xMjEwOTQtMjUuNDgwNDY5IDExLjY0NDUzMS0yNS40MDIzNDQgMjUuNzY5NTMxdjI1LjVjLTIzLjc0NjA5MyA1LjY0MDYyNS00Mi40OTIxODcgMjcuMjczNDM4LTQyLjQ5MjE4NyA1My4wMzkwNjN2NjQuOTUzMTI1Yy0uNzI2NTYzLS4yMjI2NTYtMS40NzY1NjMtLjM0Mzc1LTIuMjM4MjgyLS4zNTkzNzUtNy4wNTQ2ODctLjc0MjE4OC0xNC4xMDkzNzQgMS4zODI4MTItMTkuNTg5ODQzIDUuODk0NTMxbC0zNS45MzM1OTQgMjkuMzMyMDMxYy0uMTA1NDY5LTEwLjQ0MTQwNi0zLjc2MTcxOS0yMC41MjczNDMtMTAuMzcxMDk0LTI4LjU5Mzc1LTIuNzQyMTg3LTMuMzkwNjI1LTYuNzIyNjU2LTUuNTM1MTU2LTExLjA1ODU5My01Ljk2MDkzNy00LjI5Njg3Ni0uNTQ2ODc1LTguNjI4OTA3LjY2MDE1Ni0xMi4wMjczNDQgMy4zNDc2NTZsLTguOTY0ODQ0IDcuMDUwNzgxaC0uMTQ0NTMxYzYuNTcwMzEyLTguMDk3NjU2IDEwLjExNzE4Ny0xOC4yMjY1NjIgMTAuMDQ2ODc1LTI4LjY0ODQzNy0uMDE1NjI1LTkuMDUwNzgyLTcuMzY3MTg4LTE2LjM3MTA5NC0xNi40MTc5NjktMTYuMzQ3NjU2aC0xMjcuNzYxNzE5Yy0yMi43OTY4NzUtLjExNzE4OC00My43ODkwNjIgMTIuMzkwNjI0LTU0LjUzNTE1NiAzMi40OTYwOTNoLTMzLjk0MTQwNmMtMTEuODAwNzgyLS4wOTM3NS0yMy4xNTIzNDQgNC41NDY4NzUtMzEuNTExNzE5IDEyLjg3ODkwNy04LjM2MzI4MSA4LjMyODEyNC0xMy4wMzkwNjMgMTkuNjYwMTU2LTEyLjk4ODI4MSAzMS40NjA5Mzd2NjUuMDA3ODEzYy0uMDUwNzgyIDExLjgwNDY4NyA0LjYyNSAyMy4xNDA2MjQgMTIuOTg0Mzc1IDMxLjQ3MjY1NiA4LjM1OTM3NSA4LjMzOTg0NCAxOS43MTA5MzcgMTIuOTg4MjgxIDMxLjUxNTYyNSAxMi45MDYyNXptNDcxLjI4MTI1IDQzLjc0MjE4N2gtOTMuNTk3NjU2Yy0xMi45Mjk2ODgtLjAyMzQzNy0yNC45MTc5NjktNi43ODEyNS0zMS42MzI4MTMtMTcuODM1OTM3bDEzLjM5NDUzMS0xMC45MTAxNTZoNjUuMDM5MDYzYzIuMjgxMjUgMCA0LjQ2NDg0My0uOTIxODc2IDYuMDU4NTkzLTIuNTYyNSAxLjU4NTkzOC0xLjYzNjcxOSAyLjQ0NTMxMy0zLjg0NzY1NyAyLjM3ODkwNy02LjEyODkwN3YtMTM5LjQxMDE1NmwuNjI1LjEzMjgxM2M1LjAxMTcxOSAxLjQyOTY4NyAxMC4xOTUzMTIgMi4xNTYyNSAxNS40MDYyNSAyLjE1NjI1IDguODM5ODQzLS4wMDM5MDcgMTcuNTU0Njg3LTIuMTEzMjgyIDI1LjQxNDA2Mi02LjE0NDUzMiA4LjQ3NjU2My00LjM5MDYyNSAxOC4zMDQ2ODgtNS4zOTQ1MzEgMjcuNDkyMTg4LTIuODE2NDA2bDYuMDQ2ODc1IDEuNzIyNjU2djE0NC44ODY3MTljLjA3MDMxMiA5Ljc2MTcxOS0zLjc2MTcxOSAxOS4xNDg0MzctMTAuNjM2NzE5IDI2LjA3NDIxOS02Ljg3NSA2LjkyOTY4Ny0xNi4yMjY1NjMgMTAuODMyMDMxLTI1Ljk4ODI4MSAxMC44MzU5Mzd6bS04NC45MTQwNjMtODUuMjI2NTYyYy0yLjAxOTUzMS0yLjQ2MDkzOC00LjQ1MzEyNS00LjUzNTE1Ny03LjIwMzEyNS02LjEzNjcxOWw4LjUzNTE1Ni02Ljk1NzAzMWM2LjkyOTY4OC01LjY0NDUzMSAxMC41OTM3NS0xNC4zNzUgOS43NTc4MTMtMjMuMjgxMjUtLjgzNTkzNy04Ljg5ODQzOC02LjA2MjUtMTYuODAwNzgxLTEzLjkyOTY4Ny0yMS4wNTA3ODEgNy45ODgyODEtMTAuODc1IDYuNjQ0NTMxLTI1Ljk5MjE4OC0zLjEzMjgxMy0zNS4yODkwNjMtOS43ODUxNTYtOS4yOTI5NjktMjQuOTUzMTI1LTkuODY3MTg3LTM1LjQwMjM0NC0xLjMzMjAzMWwtMS42Njc5NjkgMS4yNWMtLjY5NTMxMi0yLjAzOTA2My0xLjY2Nzk2OC0zLjk4NDM3NS0yLjg5MDYyNC01Ljc2NTYyNXYtNDguNjcxODc1aDc0Ljk4ODI4MXYxODYuMjE4NzVoLTM0LjUxNTYyNWwxLjYyMTA5NC0xLjI5Mjk2OWMxMS40NzI2NTYtOS4zNDc2NTYgMTMuMTkxNDA2LTI2LjIyMjY1NiAzLjgzOTg0My0zNy42OTE0MDZ6bTkuMDU4NTk0LTM1NS45NTMxMjVoNTguNzQyMTg3djM4Ljc0NjA5NGgtNTguNzQyMTg3em0xNi4yNDYwOTQgNTYuMjQyMTg3aDI0Ljk5NjA5M3YxOS45OTYwOTRoLTI0Ljk5NjA5M3ptLTIwLjgzOTg0NCAzNy40OTIxODhoNjcuMzAwNzgxYzQuNTg1OTM4LjA1ODU5MyA4LjMyODEyNSAzLjY4NzUgOC41MzEyNSA4LjI3MzQzN3YyNC4yMjI2NTZoLTgzLjczNDM3NXYtMjQuMjIyNjU2Yy0uMDg5ODQzLTQuNDY0ODQ0IDMuNDQ1MzEzLTguMTYwMTU2IDcuOTAyMzQ0LTguMjczNDM3em0tMTMuMTQ4NDM3IDQ5Ljk5MjE4N2g5My41OTc2NTZjOS43NS0uMDA3ODEyIDE5LjEwNTQ2OCAzLjg3MTA5NCAyNS45ODQzNzUgMTAuNzg1MTU2IDYuODc1IDYuOTE0MDYzIDEwLjcwNzAzMSAxNi4yODUxNTcgMTAuNjQwNjI1IDI2LjAzNTE1N3Y2MC42Nzk2ODdsLTEuMzQ3NjU2LS40MjU3ODFjLTEzLjQ0MTQwNy0zLjc1MzkwNi0yNy44MTI1LTIuMjg5MDYzLTQwLjIyMjY1NyA0LjEwNTQ2OS04LjY2MDE1NiA0LjQzNzUtMTguNjc1NzgxIDUuNDE0MDYyLTI4LjAyNzM0MyAyLjczODI4MWwtNS4zODY3MTktMS41MDc4MTN2LTQ1LjcxMDkzN2MwLTQuODMyMDMxLTMuNjA1NDY5LTkuMjA3MDMxLTguNDM3NS05LjIwNzAzMWgtODQuMDUwNzgxdi0xMC42NzE4NzVjLjE2NDA2Mi0yMC40MzM1OTQgMTYuODE2NDA2LTM2Ljg5MDYyNSAzNy4yNS0zNi44MjAzMTN6bS0xMzAuMTA5Mzc2IDE0MC4xNjAxNTZjLS43NSA3LjU4NTkzOC00LjUwMzkwNiAxNC41NTA3ODItMTAuNDIxODc0IDE5LjM1NTQ2OWwtMzMuMjczNDM4IDI3LjEyNWMtMi40NDUzMTIgMS45Njg3NS0zLjY0ODQzOCA1LjA5NzY1Ny0zLjE1MjM0NCA4LjE5NTMxMy40OTIxODggMy4xMDE1NjIgMi42MTMyODIgNS42OTkyMTggNS41NDY4NzUgNi44MDg1OTQgMi45Mzc1IDEuMTA1NDY4IDYuMjQyMTg4LjU1NDY4NyA4LjY2NDA2My0xLjQ0MTQwN2wzMy4yNjU2MjUtMjcuMTI1IDY0LjAzNTE1Ni01Mi4yMDMxMjVjMy45ODA0NjktMy4yNDYwOTQgOS44NDM3NS0yLjY1MjM0NCAxMy4wOTM3NSAxLjMzMjAzMiAzLjI1IDMuOTg0Mzc0IDIuNjUyMzQ0IDkuODQ3NjU2LTEuMzI4MTI1IDEzLjA5Mzc1bC04My4yNjk1MzEgNjcuODk0NTMxYy0yLjQ0NTMxMyAxLjk2ODc1LTMuNjQ0NTMxIDUuMDkzNzUtMy4xNTIzNDQgOC4xOTE0MDYuNDkyMTg3IDMuMTAxNTYzIDIuNjA5Mzc1IDUuNjk5MjE5IDUuNTUwNzgxIDYuODA0Njg3IDIuOTMzNTk0IDEuMTA5Mzc2IDYuMjM4MjgyLjU2MjUgOC42NjAxNTYtMS40Mzc1bDgzLjI2NTYyNi02Ny44OTg0MzcgMjAuOTg4MjgxLTE3LjExNzE4N2MzLjk4ODI4MS0zLjI0NjA5NCA5Ljg1MTU2Mi0yLjY1MjM0NCAxMy4xMDE1NjIgMS4zMzIwMzEgMy4yNDYwOTQgMy45ODQzNzUgMi42NDg0MzggOS44NDc2NTYtMS4zMzU5MzcgMTMuMDk3NjU2bC0xMy45OTIxODggMTEuNDA2MjUtMjAuOTkyMTg3IDE3LjExMzI4MS02OS4yNzM0MzggNTYuNDg4MjgyYy0yLjQ2NDg0MyAxLjk2MDkzNy0zLjY4NzUgNS4wOTM3NS0zLjE5OTIxOSA4LjIxMDkzNy40OTIxODggMy4xMDkzNzUgMi42MTcxODggNS43MTg3NSA1LjU3MDMxMyA2LjgyNDIxOSAyLjk0OTIxOSAxLjEwOTM3NSA2LjI2OTUzMS41NDI5NjggOC42ODM1OTQtMS40ODA0NjlsODkuMTIxMDkzLTcyLjY2NDA2MyAxLjE0NDUzMi0uOTI5Njg3YzIuNTc0MjE4LTIuMTQ0NTMxIDYuMDk3NjU2LTIuNzM0Mzc1IDkuMjMwNDY4LTEuNTU4NTk0IDMuMTM2NzE5IDEuMTc5Njg4IDUuMzk0NTMyIDMuOTQ5MjE5IDUuOTE3OTY5IDcuMjUzOTA3LjUyMzQzOCAzLjMwODU5My0uNzY1NjI1IDYuNjQwNjI0LTMuMzgyODEyIDguNzMwNDY4bC0yNC41IDE5Ljk3MjY1NmMtLjQyMTg3NS4zNDM3NS0uODEyNS43MzQzNzYtMS4xNjc5NjkgMS4xNjAxNTctLjgwODU5NC41MTk1MzEtMS41ODIwMzEgMS4wODU5MzctMi4zMjQyMTkgMS42OTE0MDZsLTQ4LjI4NTE1NiAzOS4zNjcxODdjLTIuNDQ1MzEzIDEuOTY4NzUtMy42NTIzNDQgNS4wOTc2NTctMy4xNTIzNDQgOC4xOTUzMTMuNDkyMTg4IDMuMDk3NjU2IDIuNjA5Mzc1IDUuNjk1MzEzIDUuNTQ2ODc1IDYuODA0Njg3IDIuOTM3NSAxLjEwOTM3NiA2LjI0MjE4OC41NTg1OTQgOC42NjQwNjMtMS40Mzc1bDQ4LjI3NzM0My0zOS4zNzEwOTNjMy45ODgyODItMy4yNSA5Ljg1MTU2My0yLjY1MjM0NCAxMy4wOTc2NTcgMS4zMjgxMjUgMy4yNTM5MDYgMy45ODgyODEgMi42NTIzNDMgOS44NTE1NjItMS4zMzIwMzEgMTMuMTAxNTYybC0xMTMuNDkyMTg4IDkyLjU0Njg3NWMtMTEuNDE0MDYyIDkuMzAwNzgxLTI2LjIwNzAzMSAxMy4zODI4MTMtNDAuNzczNDM4IDExLjI0NjA5NC0yLjc0MjE4Ny0uNzY1NjI1LTUuNjg3NS0uMTU2MjUtNy44OTQ1MzEgMS42NDg0MzdsLTM4LjQ4NDM3NSAzMS4zNzVjLTExLjcyMjY1NiA5LjUzNTE1Ny0yOC45NDUzMTIgNy43ODEyNS0zOC41MDM5MDYtMy45MTc5NjhsLTQxLjA3ODEyNS01MC4zODI4MTNjLTkuNTUwNzgxLTExLjcxNDg0My03Ljc5Njg3NS0yOC45NTMxMjUgMy45MTQwNjMtMzguNWwyMy4zNzEwOTMtMTkuMDU0Njg3Yy4xNDg0MzgtLjEyODkwNi4yOTI5NjktLjI1LjQyOTY4OC0uMzc1bDYuODYzMjgxLTYuMzgyODEzYzIuMzI0MjE5LTIuMTY0MDYyIDMuMjk2ODc1LTUuNDE0MDYyIDIuNTM5MDYyLTguNS00LjE0ODQzNy0xNy4wNDY4NzUgMS44Mzk4NDQtMzQuOTY0ODQzIDE1LjQwNjI1LTQ2LjA5Mzc1bDk4LjE2NDA2My04MC4wMzUxNTZjNC4zODI4MTMgNS43NzM0MzcgNi40MDYyNSAxMyA1LjY0ODQzNyAyMC4yMTA5Mzd6bS0yNzQuNTc4MTI0IDQuMTY0MDYzYy0uMDU0Njg4LTcuMTY0MDYzIDIuNzc3MzQzLTE0LjA0Njg3NSA3Ljg1OTM3NC0xOS4wOTM3NSA1LjA4MjAzMi01LjA1NDY4NyAxMS45ODA0NjktNy44NDc2NTYgMTkuMTQ0NTMyLTcuNzVoMjcuMTEzMjgxYy0xLjA3MDMxMyA0LjQ0NTMxMy0xLjU4NTkzNyA4Ljk5MjE4Ny0xLjU0Njg3NSAxMy41NjI1LS4wNTg1OTQgMjAuMjEwOTM3IDcuOTk2MDk0IDM5LjYwNTQ2OSAyMi4zNDc2NTYgNTMuODM1OTM3bDMuNjg3NSAzLjYxNzE4OGMzLjQyOTY4OCAzLjQxNzk2OSA4Ljk4MDQ2OSAzLjQwMjM0NCAxMi4zOTg0MzgtLjAzMTI1IDMuNDE3OTY4LTMuNDI5Njg4IDMuNDAyMzQ0LTguOTgwNDY5LS4wMjczNDQtMTIuMzk4NDM4bC0zLjY3OTY4OC0zLjY5MTQwNmMtMTEuMDc0MjE4LTExLjA3ODEyNS0xNy4yNzM0MzctMjYuMTEzMjgxLTE3LjIzMDQ2OC00MS43NzM0MzcuMDE1NjI1LTI1LjEwOTM3NSAyMC4zMDQ2ODctNDUuNDkyMTg4IDQ1LjQxNDA2Mi00NS42MTMyODFoMTI2LjY2MDE1NmMtLjU3MDMxMiAxNi4yNDYwOTMtMTMuMjI2NTYyIDI3LjQ5NjA5My0yOC43MDMxMjQgMjcuNDk2MDkzaC01MS45MTAxNTdjLTQuODc4OTA2LjEyMTA5NC04Ljc2OTUzMSA0LjEyNS04Ljc1IDkuMDAzOTA3LS4wMDM5MDYgMTMuNjQwNjI0LTExLjAxOTUzMSAyNC43MTQ4NDMtMjQuNjUyMzQzIDI0Ljc5Mjk2OC00Ljg0Mzc1LjAyNzM0NC04Ljc1MzkwNyAzLjk2ODc1LTguNzUgOC44MTI1LjAwNzgxMiAyLjI5Mjk2OS45NDE0MDYgNC40OTIxODggMi41ODU5MzcgNi4wOTc2NTYgMS42NDQ1MzEgMS42MDE1NjMgMy44NjcxODcgMi40NzI2NTcgNi4xNjQwNjMgMi40MjE4NzYgMjAuMDc0MjE4LjIzODI4MSAzNy40Mzc1LTEzLjkyNTc4MiA0MS4yNDIxODctMzMuNjMyODEzaDU4LjkzMzU5NGwtMjIuODM1OTM4IDE4Ljc0NjA5NGgtMTYuODQ3NjU2Yy00LjE1MjM0NC4wNzgxMjUtNy42OTUzMTMgMy4wMDM5MDYtOC41NjI1IDcuMDU4NTkzLS44NjcxODcgNC4wNTQ2ODggMS4xNzU3ODEgOC4xNzE4NzYgNC45Mjk2ODcgOS45NDE0MDdsLTI1LjI4MTI1IDIwLjY1NjI1Yy0xNy4zMjAzMTIgMTQuMjE4NzUtMjUuODI4MTI0IDM2LjU0Njg3NS0yMi4zNzg5MDYgNTguNjkxNDA2bC0zLjA3NDIxOCAyLjg3NS0xMy4wOTc2NTcgMTAuNjg3NWMtMjMuMjY5NTMxLTEuMjMwNDY5LTQ0LjM2NzE4Ny0xOC43MjI2NTYtNDkuNzE4NzUtNDEuNjYwMTU2LTEuMTA1NDY5LTQuNjk5MjE5LTUuODA0Njg3LTcuNjI1LTEwLjUxMTcxOS02LjUyNzM0NC0yLjI0MjE4Ny40Njg3NS00LjE5OTIxOCAxLjgyMDMxMy01LjQyOTY4NyAzLjc1MzkwNi0xLjIzMDQ2OSAxLjkzMzU5NC0xLjYyNSA0LjI4MTI1LTEuMTAxNTYzIDYuNTE1NjI1IDEuMjk2ODc2IDUuMzgyODEzIDMuMjUzOTA3IDEwLjU5Mzc1IDUuODM5ODQ0IDE1LjQ5MjE4OGgtMzMuMjI2NTYyYy03LjE2Nzk2OS4wODk4NDQtMTQuMDY2NDA2LTIuNzE0ODQ0LTE5LjE0ODQzOC03Ljc2OTUzMi01LjA3ODEyNS01LjA1NDY4Ny03LjkxMDE1Ni0xMS45NDE0MDYtNy44NTU0NjgtMTkuMTA5Mzc0em0wIDAiLz48cGF0aCBkPSJtMzUzLjEwMTU2MiAxODAuNjQwNjI1YzEyLjE0NDUzMi0xMi4xNjQwNjMgMTUuMjU3ODEzLTMwLjY3NTc4MSA3Ljc2NTYyNi00Ni4xNDA2MjUtLjE0MDYyNi0uMjkyOTY5LS4yOTY4NzYtLjU3ODEyNS0uNDcyNjU3LS44NTE1NjJsLTI4LjQxNzk2OS00NS4wMzkwNjNjLTEuNjA5Mzc0LTIuNTM5MDYzLTQuMzk4NDM3LTQuMDc4MTI1LTcuNDAyMzQzLTQuMDc4MTI1LTMuMDAzOTA3IDAtNS43OTY4NzUgMS41MzkwNjItNy40MDIzNDQgNC4wNzgxMjVsLTI4LjQxNzk2OSA0NS4wNDY4NzVjLS4xNzU3ODEuMjc3MzQ0LS4zMzIwMzEuNTU4NTk0LS40NzI2NTYuODUxNTYyLTguNTk3NjU2IDE3LjcxODc1LTMuMTQ0NTMxIDM5LjA1NDY4OCAxMi44OTg0MzggNTAuNDc2NTYzIDE2LjA0Njg3NCAxMS40MTc5NjkgMzcuOTkyMTg3IDkuNTg5ODQ0IDUxLjkyMTg3NC00LjMzOTg0NHptLTQ0LjY4MzU5My0xMi4zNzVjLTYuNzYxNzE5LTYuNzY5NTMxLTguNTg5ODQ0LTE3LjAzMTI1LTQuNTg1OTM4LTI1LjcxODc1bDIwLjc0NjA5NC0zMi44Nzg5MDYgMjAuNzUgMzIuODc4OTA2YzQuNjMyODEzIDEwLjA0Njg3NSAxLjM5NDUzMSAyMS45NzY1NjMtNy42Nzk2ODcgMjguMzA0Njg3LTkuMDgyMDMyIDYuMzMyMDMyLTIxLjM5NDUzMiA1LjI0MjE4OC0yOS4yMTg3NS0yLjU4MjAzMXptMCAwIi8+PHBhdGggZD0ibTE3OS41OTc2NTYgMTcxLjE2MDE1NmMwIDE4LjcyMjY1NiAxNS4xNzk2ODggMzMuOTAyMzQ0IDMzLjkwNjI1IDMzLjkwMjM0NCAxOC43MjI2NTYgMCAzMy44OTg0MzgtMTUuMTc1NzgxIDMzLjg5ODQzOC0zMy45MDIzNDQgMC0xOC43MjI2NTYtMTUuMTc1NzgyLTMzLjkwNjI1LTMzLjg5ODQzOC0zMy45MDYyNS0xOC43MTg3NS4wMjM0MzgtMzMuODg2NzE4IDE1LjE4NzUtMzMuOTA2MjUgMzMuOTA2MjV6bTUwLjMwODU5NCAwYy4wMDM5MDYgOS4wNTg1OTQtNy4zMzk4NDQgMTYuNDA2MjUtMTYuNDAyMzQ0IDE2LjQwNjI1cy0xNi40MTAxNTYtNy4zNDc2NTYtMTYuNDEwMTU2LTE2LjQwNjI1YzAtOS4wNjI1IDcuMzQ3NjU2LTE2LjQxMDE1NiAxNi40MTAxNTYtMTYuNDEwMTU2IDkuMDU0Njg4LjAxMTcxOSAxNi4zOTQ1MzIgNy4zNTE1NjIgMTYuNDAyMzQ0IDE2LjQxMDE1NnptMCAwIi8+PHBhdGggZD0ibTg3LjExMzI4MSAxMjEuMTY3OTY5YzAgMTguNzIyNjU2IDE1LjE3OTY4OCAzMy45MDYyNSAzMy45MDYyNSAzMy45MDYyNSAxOC43MjI2NTcgMCAzMy44OTg0MzgtMTUuMTc5Njg4IDMzLjg5ODQzOC0zMy45MDYyNSAwLTE4LjcyMjY1Ny0xNS4xNzU3ODEtMzMuOTA2MjUtMzMuODk4NDM4LTMzLjkwNjI1LTE4LjcxODc1LjAyMzQzNy0zMy44ODY3MTkgMTUuMTg3NS0zMy45MDYyNSAzMy45MDYyNXptNTAuMzA4NTk0IDBjLjAwMzkwNiA5LjA1ODU5My03LjM0Mzc1IDE2LjQwNjI1LTE2LjQwMjM0NCAxNi40MDYyNS05LjA2MjUgMC0xNi40MTAxNTYtNy4zNDc2NTctMTYuNDEwMTU2LTE2LjQwNjI1IDAtOS4wNjI1IDcuMzQ3NjU2LTE2LjQxMDE1NyAxNi40MTAxNTYtMTYuNDEwMTU3IDkuMDU0Njg4LjAxMTcxOSAxNi4zOTQ1MzEgNy4zNTE1NjMgMTYuNDAyMzQ0IDE2LjQxMDE1N3ptMCAwIi8+PHBhdGggZD0ibTMwOS41NzgxMjUgNTUzLjU5NzY1NmMwIDE4LjcxODc1IDE1LjE3NTc4MSAzMy45MDIzNDQgMzMuOTAyMzQ0IDMzLjkwMjM0NCAxOC43MjI2NTYgMCAzMy45MDIzNDMtMTUuMTc1NzgxIDMzLjkwMjM0My0zMy45MDIzNDQgMC0xOC43MjI2NTYtMTUuMTc5Njg3LTMzLjkwNjI1LTMzLjkwMjM0My0zMy45MDYyNS0xOC43MTQ4NDQuMDIzNDM4LTMzLjg4MjgxMyAxNS4xODc1LTMzLjkwMjM0NCAzMy45MDYyNXptNTAuMzA4NTk0IDBjLjAwMzkwNiA5LjA1ODU5NC03LjM0Mzc1IDE2LjQwNjI1LTE2LjQwNjI1IDE2LjQwNjI1LTkuMDU4NTk0IDAtMTYuNDA2MjUtNy4zNDc2NTYtMTYuNDA2MjUtMTYuNDA2MjUgMC05LjA2MjUgNy4zNDc2NTYtMTYuNDEwMTU2IDE2LjQwNjI1LTE2LjQxMDE1NiA5LjA1ODU5My4wMDc4MTIgMTYuMzk0NTMxIDcuMzUxNTYyIDE2LjQwNjI1IDE2LjQxMDE1NnptMCAwIi8+PHBhdGggZD0ibTQxMy4zMDg1OTQgNTQ2LjA5NzY1NmMwIDE4LjcyMjY1NiAxNS4xNzk2ODcgMzMuOTA2MjUgMzMuOTA2MjUgMzMuOTA2MjUgMTguNzIyNjU2IDAgMzMuOTAyMzQ0LTE1LjE3OTY4NyAzMy45MDIzNDQtMzMuOTA2MjUgMC0xOC43MjI2NTYtMTUuMTc5Njg4LTMzLjkwNjI1LTMzLjkwMjM0NC0zMy45MDYyNS0xOC43MTg3NS4wMjM0MzgtMzMuODg2NzE5IDE1LjE4NzUtMzMuOTA2MjUgMzMuOTA2MjV6bTUwLjMwODU5NCAwYy4wMDc4MTIgOS4wNTg1OTQtNy4zMzk4NDQgMTYuNDA2MjUtMTYuNDAyMzQ0IDE2LjQwNjI1cy0xNi40MDYyNS03LjM0NzY1Ni0xNi40MDYyNS0xNi40MDYyNWMwLTkuMDYyNSA3LjM0Mzc1LTE2LjQxMDE1NiAxNi40MDYyNS0xNi40MTAxNTYgOS4wNTQ2ODcuMDExNzE5IDE2LjM5NDUzMSA3LjM1MTU2MiAxNi40MDIzNDQgMTYuNDEwMTU2em0wIDAiLz48L3N2Zz4="
                            var mask = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MDUuMDAzIDUwNS4wMDMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUwNS4wMDMgNTA1LjAwMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIj4KPGc+Cgk8cGF0aCBkPSJNMTc3LjU2NywyMzYuMjgxYy00LjE0MywwLTcuNSwzLjM1OC03LjUsNy41djMzLjU5M2MwLDQuMTQyLDMuMzU3LDcuNSw3LjUsNy41czcuNS0zLjM1OCw3LjUtNy41di0zMy41OTMgICBDMTg1LjA2NywyMzkuNjM5LDE4MS43MSwyMzYuMjgxLDE3Ny41NjcsMjM2LjI4MXoiLz4KCTxwYXRoIGQ9Ik0zMzIuMDkzLDI4NC44NzVjNC4xNDMsMCw3LjUtMy4zNTgsNy41LTcuNXYtMzMuNTkzYzAtNC4xNDItMy4zNTctNy41LTcuNS03LjVzLTcuNSwzLjM1OC03LjUsNy41djMzLjU5MyAgIEMzMjQuNTkzLDI4MS41MTcsMzI3Ljk1LDI4NC44NzUsMzMyLjA5MywyODQuODc1eiIvPgoJPHBhdGggZD0iTTQzOS42ODMsMjA0LjY4di0xOC4yNTJjMC00OS4zNjQtMTkuMjI5LTk1Ljc4Ni01NC4xNDUtMTMwLjcxMmMtMjYuMjUzLTI2LjI2NC01OS4zMTQtNDMuODM0LTk1LjYwNi01MC44MTMgICBjLTExLjQ4Ny0yLjIxMy0yMy4zLTMuMzM1LTM1LjEwOC0zLjMzNWMtMTAxLjkyMSwwLTE4NC44NCw4Mi45MjgtMTg0Ljg0LDE4NC44NnYxOC4zOTNjLTEuNDUtMC4wOTQtMi45MDktMC4xNDUtNC4zNjgtMC4xNDUgICBDMjkuNDM1LDIwNC42NzYsMCwyMzQuMTA1LDAsMjcwLjI3OGMwLDM2LjE4LDI5LjQzNSw2NS42MTUsNjUuNjE1LDY1LjYxNWMyLjIwNywwLDQuNDAyLTAuMTE0LDYuNTc0LTAuMzMgICBjMy41NzQsMjMuMDk2LDExLjQ3LDQ1LjM2OSwyMy4zODksNjUuNTQ0YzE1Ljg5NCwyNi45LDM4LjQ2NCw0OS40MzQsNjUuMzM5LDY1LjMxN2wwLjgyOCwxLjQ3NiAgIGMxMi4zLDIxLjkxOSwzNS41NTUsMzUuNTM1LDYwLjY4OCwzNS41MzVoNjQuNzkyYzI1LjEzNCwwLDQ4LjM4OS0xMy42MTYsNjAuNjg4LTM1LjUzNWwwLjgzLTEuNDc5ICAgYzI2Ljg3OC0xNS44ODgsNDkuNDQ5LTM4LjQyMSw2NS4zNDItNjUuMzE3YzExLjg2OS0yMC4wODgsMTkuNzUtNDIuMjU2LDIzLjM0Ni02NS4yNDZjMC42NDksMC4wMTksMS4yOTksMC4wMzUsMS45NSwwLjAzNSAgIGMzNi4xODMsMCw2NS42Mi0yOS40MzMsNjUuNjItNjUuNjFDNTA1LjAwMywyMzQuMjA1LDQ3NS43MjcsMjA0Ljg0Myw0MzkuNjgzLDIwNC42OHogTTI1NC44MjMsMTYuNTY4ICAgYzEwLjg1OCwwLDIxLjcxNiwxLjAzMSwzMi4yNzMsMy4wNjVjMzMuMzM3LDYuNDEsNjMuNzA5LDIyLjU1NCw4Ny44MzMsNDYuNjg4YzMyLjA4NCwzMi4wOTMsNDkuNzUzLDc0Ljc0OSw0OS43NTMsMTIwLjEwN3YxOC42MTEgICBjLTY0LjU1Ni0wLjcyNS0xMjEuOTMxLTkuNzE2LTE3MC41OTUtMjYuODAyYy0zLjkwOS0xLjM3MS04LjE4OSwwLjY4NC05LjU2MSw0LjU5MmMtMS4zNzIsMy45MDgsMC42ODQsOC4xODksNC41OTIsOS41NjEgICBjNTAuMjUyLDE3LjY0MywxMDkuMjk5LDI2LjkxOSwxNzUuNTYzLDI3LjY0OXYxNS4zNzhsLTQwLjcsNjMuNTI2bC0xMjguMjQxLTE1LjcwMmMtMC42MDUtMC4wNzQtMS4yMTctMC4wNzQtMS44MjIsMCAgIGwtMTI4LjI0MSwxNS43MDJsLTQwLjY5NS02My41MTd2LTE3LjUzMWMxOC43ODYtNy4xMzcsMzYuNDgyLTE5LjMzNyw1MC4yOTEtMzQuNzg5YzExLjQ2NS0xMi44MjksMTkuMjE2LTI2Ljg2NywyMi42NDYtNDAuNzIzICAgYzExLjAxMiw5LjU5NiwzMC41NzMsMjQuMDE4LDYwLjk2MywzNy44NzZjMy43NjcsMS43MTcsOC4yMTYsMC4wNTYsOS45MzYtMy43MTJjMS43MTktMy43NjksMC4wNTctOC4yMTctMy43MTMtOS45MzYgICBjLTI0Ljc1OS0xMS4yOS00MS42MjYtMjIuODk2LTUxLjQxNi0zMC42NDRjLTEwLjU5Ny04LjM4Ny0xNS40MS0xNC4xODMtMTUuNDQyLTE0LjIyMmMtMi4wMDItMi40NjMtNS4zNC0zLjM5OS04LjMzLTIuMzM3ICAgYy0yLjk5MSwxLjA2Mi00Ljk5LDMuODkzLTQuOTksNy4wNjdjMCwxNS4wMzktNy40LDMxLjYwMS0yMC44MzcsNDYuNjM2Yy0xMC43MzUsMTIuMDEyLTI0LjYwMiwyMi4wOC0zOS4xMDYsMjguNTYzdi0xNS4yNDcgICBDODQuOTgzLDkyLjc2NywxNjEuMTczLDE2LjU2OCwyNTQuODIzLDE2LjU2OHogTTY1LjYxNSwzMjAuODkzQzM3LjcwNiwzMjAuODkzLDE1LDI5OC4xODcsMTUsMjcwLjI3OCAgIGMwLTI3LjkwMiwyMi43MDYtNTAuNjAyLDUwLjYxNS01MC42MDJjMS40NjcsMCwyLjkyNCwwLjA4Myw0LjM2OCwwLjIwNXYzMC4yNTFjLTExLjQyLTAuNDk0LTI2LjE2LDMuMTQzLTMzLjAxMywxOC45MDQgICBjLTEuNjUxLDMuNzk5LDAuMDg5LDguMjE3LDMuODg4LDkuODY5YzAuOTc0LDAuNDIzLDEuOTg4LDAuNjI0LDIuOTg2LDAuNjI0YzIuODk2LDAsNS42NTMtMS42ODcsNi44ODItNC41MTEgICBjNC4wNjctOS4zNTQsMTMuMjQ4LTEwLjM1NiwxOS4yNTctOS44ODh2NDIuMDY5YzAsNC41MDEsMC4xNzgsOC45ODgsMC41MDMsMTMuNDU3QzY4Ljg3OSwzMjAuODA4LDY3LjI1MywzMjAuODkzLDY1LjYxNSwzMjAuODkzeiAgICBNMzM0LjgzMiw0NjAuNTU5Yy05LjY0OCwxNy4xOTUtMjcuODksMjcuODc2LTQ3LjYwNiwyNy44NzZoLTY0Ljc5MmMtMTkuNzE3LDAtMzcuOTU4LTEwLjY4MS00Ny42MDYtMjcuODc1bC00NS40Mi04MC45NDJWMzY0LjY3ICAgYzAtNC4xNDItMy4zNTctNy41LTcuNS03LjVzLTcuNSwzLjM1OC03LjUsNy41djE2LjkwOGMwLDEuMjg1LDAuMzMsMi41NDksMC45NTksMy42N2wyOC4yMzEsNTAuMzEgICBjLTEzLjg0MS0xMi4wMDgtMjUuNzM0LTI2LjIyMS0zNS4xMDQtNDIuMDgxYy0xNS4zOC0yNi4wMzItMjMuNTEtNTUuODY2LTIzLjUxLTg2LjI3OXYtNDMuOTY1bDI5LjQyNCw0NS45MjV2MjUuNTEgICBjMCw0LjE0MiwzLjM1Nyw3LjUsNy41LDcuNXM3LjUtMy4zNTgsNy41LTcuNXYtMjEuMDY5bDEyNS40MjMtMTUuMzU2bDEyNS40MjMsMTUuMzU2djY2LjAxOEwzMzQuODMyLDQ2MC41NTl6IE00MDEuMTcyLDM5My40NzMgICBjLTkuMzcsMTUuODU3LTIxLjI2MywzMC4wNjktMzUuMTA1LDQyLjA3OGwyOC4yMjctNTAuMzAzYzAuNjI5LTEuMTIxLDAuOTU5LTIuMzg1LDAuOTU5LTMuNjd2LTcyLjQxOWwyOS40My00NS45MzR2NDMuOTc0ICAgQzQyNC42ODMsMzM3LjYxLDQxNi41NTMsMzY3LjQ0Myw0MDEuMTcyLDM5My40NzN6IE00MzkuMzgzLDMyMC44OTJjLTAuMDc1LDAtMC4xNDktMC4wMDQtMC4yMjMtMC4wMDQgICBjMC4zMzYtNC41NDYsMC41MjMtOS4xMTEsMC41MjMtMTMuNjl2LTQyLjA2OWM2LjAwOS0wLjQ2NiwxNS4xODUsMC41MzcsMTkuMjUsOS44ODdjMS4yMjgsMi44MjUsMy45ODYsNC41MTIsNi44ODIsNC41MTIgICBjMC45OTgsMCwyLjAxMy0wLjIwMSwyLjk4Ni0wLjYyNGMzLjc5OS0xLjY1MSw1LjUzOS02LjA2OSwzLjg4OC05Ljg2OGMtNi44NTEtMTUuNzU4LTIxLjU4NS0xOS4zOTctMzMuMDA2LTE4LjkwNFYyMTkuNjggICBjMjcuNzc0LDAuMTYzLDUwLjMyLDIyLjc5Nyw1MC4zMiw1MC42MDJDNDkwLjAwMywyOTguMTg5LDQ2Ny4yOTUsMzIwLjg5Miw0MzkuMzgzLDMyMC44OTJ6Ii8+CjwvZz4KCgoKCgoKCgoKCgoKCgoKPC9zdmc+Cg=="

                            am4core.ready(function() {
                                var chart = am4core.create("chartdiv2", am4plugins_timeline.CurveChart);
                                chart.curveContainer.padding(100, 20, 50, 20);
                                chart.maskBullets = false;


                                var colorSet = new am4core.ColorSet();

                                chart.dateFormatter.inputDateFormat = "yyyy-MM-dd HH:mm";
                                chart.dateFormatter.dateFormat = "HH";

                                chart.data = [{
                                    "category": "",
                                    "start": "2019-01-10 05:00",
                                    "end": "2019-01-10 05:30",
                                    "color": colorSet.getIndex(15),
                                    "icon": bed,
                                    "text": "Wake up!"
                                }, {
                                    "category": "",
                                    "start": "2019-01-10 05:35",
                                    "end": "2019-01-10 05:40",
                                    "color": colorSet.getIndex(14),
                                    "icon": water,
                                    "text": "Drink water"
                                },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 05:45",
                                        "end": "2019-01-10 06:15",
                                        "color": colorSet.getIndex(13),
                                        "icon": exercise,
                                        "text": "Exercise"
                                    },
                                        {
                                        "category": "",
                                        "start": "2019-01-10 06:30",
                                        "end": "2019-01-10 06:40",
                                        "color": colorSet.getIndex(15),
                                        "icon": hand,
                                        "text": "Wash Hands"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 06:50",
                                        "end": "2019-01-10 07:00",
                                        "color": colorSet.getIndex(12),
                                        "icon": breakfast,
                                        "text": "Have breakfast"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 07:30",
                                        "end": "2019-01-10 07:40",
                                        "color": colorSet.getIndex(14),
                                        "icon": mask,
                                        "text": "Wear Mask before going Out"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 07:50",
                                        "end": "2019-01-10 08:10",
                                        "color": colorSet.getIndex(11),
                                        "icon": car,
                                        "text": "Drive to work"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 08:30",
                                        "end": "2019-01-10 17:00",
                                        "color": colorSet.getIndex(10),
                                        "icon": work,
                                        "text": "Work"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 09:40",
                                        "end": "2019-01-10 09:45",
                                        "color": colorSet.getIndex(15),
                                        "icon": hand,
                                        "text": "Wash Hands"
                                    },
                                    {
                                        "category": "e",
                                        "start": "2019-01-10 10:00",
                                        "end": "2019-01-10 10:15",
                                        "color": colorSet.getIndex(10),
                                        "icon": coffee,
                                        "text": "Coffee"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 11:50",
                                        "end": "2019-01-10 12:00",
                                        "color": colorSet.getIndex(15),
                                        "icon": hand,
                                        "text": "Wash Hands"
                                    },
                                    {
                                        "category": "e",
                                        "start": "2019-01-10 12:00",
                                        "end": "2019-01-10 13:00",
                                        "color": colorSet.getIndex(10),
                                        "icon": dinner,
                                        "text": "Dinner"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 13:45",
                                        "end": "2019-01-10 13:50",
                                        "color": colorSet.getIndex(15),
                                        "icon": hand,
                                        "text": "Wash Hands"
                                    },
                                    {
                                        "category": "e",
                                        "start": "2019-01-10 14:00",
                                        "end": "2019-01-10 14:15",
                                        "color": colorSet.getIndex(10),
                                        "icon": coffee,
                                        "text": "Coffee"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 17:00",
                                        "end": "2019-01-10 18:00",
                                        "color": colorSet.getIndex(8),
                                        "icon": car,
                                        "text": "Drive home"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 18:00",
                                        "end": "2019-01-10 21:30",
                                        "color": colorSet.getIndex(7),
                                        "icon": home,
                                        "text": "Home!"
                                    },
                                    {
                                        "category": "e",
                                        "start": "2019-01-10 19:30",
                                        "end": "2019-01-10 20:30",
                                        "color": colorSet.getIndex(7),
                                        "icon": book,
                                        "text": "Read a bit"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 21:30",
                                        "end": "2019-01-10 22:00",
                                        "color": colorSet.getIndex(6),
                                        "icon": beer,
                                        "text": "Have a beer"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 22:00",
                                        "end": "2019-01-10 22:15",
                                        "color": colorSet.getIndex(5),
                                        "icon": beer,
                                        "text": "Have another beer"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 22:15",
                                        "end": "2019-01-10 23:00",
                                        "color": colorSet.getIndex(4),
                                        "icon": dance,
                                        "text": "Dance!"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-10 23:00",
                                        "end": "2019-01-11 00:00",
                                        "color": colorSet.getIndex(3),
                                        "icon": drink,
                                        "text": "Martini!"
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-11 00:00",
                                        "end": "2019-01-11 01:00",
                                        "color": colorSet.getIndex(2),
                                        "icon": drunk,
                                        "text": "Damn..."
                                    },
                                    {
                                        "category": "",
                                        "start": "2019-01-11 01:00",
                                        "end": "2019-01-11 01:00",
                                        "color": colorSet.getIndex(1),
                                        "icon": bed,
                                        "text": "Bye bye"
                                    }];

                                chart.fontSize = 10;
                                chart.tooltipContainer.fontSize = 10;

                                var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
                                categoryAxis.dataFields.category = "category";
                                categoryAxis.renderer.grid.template.disabled = true;
                                categoryAxis.renderer.labels.template.paddingRight = 25;
                                categoryAxis.renderer.minGridDistance = 10;
                                categoryAxis.renderer.innerRadius = 20;
                                categoryAxis.renderer.radius = 30;

                                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());


                                dateAxis.renderer.points = getPoints();


                                dateAxis.renderer.autoScale = false;
                                dateAxis.renderer.autoCenter = false;
                                dateAxis.renderer.minGridDistance = 70;
                                dateAxis.baseInterval = { count: 5, timeUnit: "minute" };
                                dateAxis.renderer.tooltipLocation = 0;
                                dateAxis.renderer.line.strokeDasharray = "1,4";
                                dateAxis.renderer.line.strokeOpacity = 0.5;
                                dateAxis.tooltip.background.fillOpacity = 0.2;
                                dateAxis.tooltip.background.cornerRadius = 5;
                                dateAxis.tooltip.label.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
                                dateAxis.tooltip.label.paddingTop = 7;
                                dateAxis.endLocation = 0;
                                dateAxis.startLocation = -0.5;
                                dateAxis.min = new Date(2019, 0, 9, 23, 55).getTime();
                                dateAxis.max = new Date(2019, 0, 11, 7, 10).getTime();

                                var labelTemplate = dateAxis.renderer.labels.template;
                                labelTemplate.verticalCenter = "middle";
                                labelTemplate.fillOpacity = 0.6;
                                labelTemplate.background.fill = new am4core.InterfaceColorSet().getFor("background");
                                labelTemplate.background.fillOpacity = 1;
                                labelTemplate.fill = new am4core.InterfaceColorSet().getFor("text");
                                labelTemplate.padding(7, 7, 7, 7);

                                var series = chart.series.push(new am4plugins_timeline.CurveColumnSeries());
                                series.columns.template.height = am4core.percent(30);

                                series.dataFields.openDateX = "start";
                                series.dataFields.dateX = "end";
                                series.dataFields.categoryY = "category";
                                series.baseAxis = categoryAxis;
                                series.columns.template.propertyFields.fill = "color"; // get color from data
                                series.columns.template.propertyFields.stroke = "color";
                                series.columns.template.strokeOpacity = 0;
                                series.columns.template.fillOpacity = 0.6;

                                var imageBullet1 = series.bullets.push(new am4plugins_bullets.PinBullet());
                                imageBullet1.background.radius = 18;
                                imageBullet1.locationX = 1;
                                imageBullet1.propertyFields.stroke = "color";
                                imageBullet1.background.propertyFields.fill = "color";
                                imageBullet1.image = new am4core.Image();
                                imageBullet1.image.propertyFields.href = "icon";
                                imageBullet1.image.scale = 0.7;
                                imageBullet1.circle.radius = am4core.percent(100);
                                imageBullet1.background.fillOpacity = 0.8;
                                imageBullet1.background.strokeOpacity = 0;
                                imageBullet1.dy = -2;
                                imageBullet1.background.pointerBaseWidth = 10;
                                imageBullet1.background.pointerLength = 10
                                imageBullet1.tooltipText = "{text}";

                                series.tooltip.pointerOrientation = "up";

                                imageBullet1.background.adapter.add("pointerAngle", (value, target) => {
                                    if (target.dataItem) {
                                        var position = dateAxis.valueToPosition(target.dataItem.openDateX.getTime());
                                        return dateAxis.renderer.positionToAngle(position);
                                    }
                                    return value;
                                });

                                var hs = imageBullet1.states.create("hover")
                                hs.properties.scale = 1.3;
                                hs.properties.opacity = 1;

                                var textBullet = series.bullets.push(new am4charts.LabelBullet());
                                textBullet.label.propertyFields.text = "text";
                                textBullet.disabled = true;
                                textBullet.propertyFields.disabled = "textDisabled";
                                textBullet.label.strokeOpacity = 0;
                                textBullet.locationX = 1;
                                textBullet.dy = - 100;
                                textBullet.label.textAlign = "middle";

                                chart.scrollbarX = new am4core.Scrollbar();
                                chart.scrollbarX.align = "center"
                                chart.scrollbarX.width = am4core.percent(75);
                                chart.scrollbarX.parent = chart.curveContainer;
                                chart.scrollbarX.height = 300;
                                chart.scrollbarX.orientation = "vertical";
                                chart.scrollbarX.x = 128;
                                chart.scrollbarX.y = -140;
                                chart.scrollbarX.isMeasured = false;
                                chart.scrollbarX.opacity = 0.5;

                                var cursor = new am4plugins_timeline.CurveCursor();
                                chart.cursor = cursor;
                                cursor.xAxis = dateAxis;
                                cursor.yAxis = categoryAxis;
                                cursor.lineY.disabled = true;
                                cursor.lineX.disabled = true;

                                dateAxis.renderer.tooltipLocation2 = 0;
                                categoryAxis.cursorTooltipEnabled = false;

                                chart.zoomOutButton.disabled = true;

                                var previousBullet;

                                chart.events.on("inited", function() {
                                    setTimeout(function() {
                                        hoverItem(series.dataItems.getIndex(0));
                                    }, 2000)
                                })

                                function hoverItem(dataItem) {
                                    var bullet = dataItem.bullets.getKey(imageBullet1.uid);
                                    var index = dataItem.index;

                                    if (index >= series.dataItems.length - 1) {
                                        index = -1;
                                    }

                                    if (bullet) {

                                        if (previousBullet) {
                                            previousBullet.isHover = false;
                                        }

                                        bullet.isHover = true;

                                        previousBullet = bullet;
                                    }
                                    setTimeout(
                                        function() {
                                            hoverItem(series.dataItems.getIndex(index + 1))
                                        }, 1000);
                                }

                            });


                            function getPoints() {

                                var points = [{ x: -1000, y: 200 }, { x: 0, y: 200 }];

                                var w = 400;
                                var h = 400;
                                var levelCount = 4;

                                var radius = am4core.math.min(w / (levelCount - 1) / 2, h / 2);
                                var startX = radius;

                                for (var i = 0; i < 25; i++) {
                                    var angle = 0 + i / 25 * 90;
                                    var centerPoint = { y: 200 - radius, x: 0 }
                                    points.push({ y: centerPoint.y + radius * am4core.math.cos(angle), x: centerPoint.x + radius * am4core.math.sin(angle) });
                                }


                                for (var i = 0; i < levelCount; i++) {

                                    if (i % 2 != 0) {
                                        points.push({ y: -h / 2 + radius, x: startX + w / (levelCount - 1) * i })
                                        points.push({ y: h / 2 - radius, x: startX + w / (levelCount - 1) * i })

                                        var centerPoint = { y: h / 2 - radius, x: startX + w / (levelCount - 1) * (i + 0.5) }
                                        if (i < levelCount - 1) {
                                            for (var k = 0; k < 50; k++) {
                                                var angle = -90 + k / 50 * 180;
                                                points.push({ y: centerPoint.y + radius * am4core.math.cos(angle), x: centerPoint.x + radius * am4core.math.sin(angle) });
                                            }
                                        }

                                        if (i == levelCount - 1) {
                                            points.pop();
                                            points.push({ y: -radius, x: startX + w / (levelCount - 1) * i })
                                            var centerPoint = { y: -radius, x: startX + w / (levelCount - 1) * (i + 0.5) }
                                            for (var k = 0; k < 25; k++) {
                                                var angle = -90 + k / 25 * 90;
                                                points.push({ y: centerPoint.y + radius * am4core.math.cos(angle), x: centerPoint.x + radius * am4core.math.sin(angle) });
                                            }
                                            points.push({ y: 0, x: 1300 });
                                        }

                                    }
                                    else {
                                        points.push({ y: h / 2 - radius, x: startX + w / (levelCount - 1) * i })
                                        points.push({ y: -h / 2 + radius, x: startX + w / (levelCount - 1) * i })
                                        var centerPoint = { y: -h / 2 + radius, x: startX + w / (levelCount - 1) * (i + 0.5) }
                                        if (i < levelCount - 1) {
                                            for (var k = 0; k < 50; k++) {
                                                var angle = -90 - k / 50 * 180;
                                                points.push({ y: centerPoint.y + radius * am4core.math.cos(angle), x: centerPoint.x + radius * am4core.math.sin(angle) });
                                            }
                                        }
                                    }
                                }

                                return points;
                            }


                        }); // end am4core.ready()
                    </script>

                    <!-- HTML -->
                    <div id="chartdiv2" style="width: 1000px; height: 700px;"></div>

                </div>


            </div>
        </div>
    </div>
</section>



<!-- Contact Section -->


<section class="contact-section bg-black text-center">
    <div class="container">

        <div class="row">

            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Address</h4>
                        <hr class="my-4">
                        <div class="small text-black-50">Any Nearby Hospital</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-envelope text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Email</h4>
                        <hr class="my-4">
                        <div class="small text-black-50">
                            <a href="#">scotland.contactus@nhs.net</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-mobile-alt text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Phone</h4>
                        <hr class="my-4">
                        <div class="small text-black-50">0800 22 44 88</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="social d-flex justify-content-center">
            <a href="#" class="mx-2">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="mx-2">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="mx-2">
                <i class="fab fa-github"></i>
            </a>
        </div>

    </div>
</section>

<!-- Footer -->
<footer class="bg-black small text-center text-white-50">
    <div class="container">
        Copyright &copy; Quackathon 2020
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/grayscale.min.js"></script>

</body>

</html>
