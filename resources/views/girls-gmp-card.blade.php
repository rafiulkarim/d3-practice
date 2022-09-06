<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--    <script src="https://d3js.org/d3.v4.js"></script>--}}
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/d3@5.9.2/dist/d3.min.js"></script>
    <style>
        .axis-grid line {
            stroke: lightgrey;
            opacity: 0.8;
        }

        div.tooltip {
            position: absolute;
            text-align: center;
            padding: .2rem;
            background: #313639;
            color: #f9f9f9;
            border: 0px;
            border-radius: 8px;
            pointer-events: none;
            font-size: .7rem;
        }
    </style>
</head>
<body>
<button id="z3neg" value="z3n">z3n</button>
<button id="z2neg" value="z2n">z2n</button>
<div id="my_dataviz"></div>
</body>

<script>
    $('#z3neg').click(function () {
        var a = $(this).attr('value');
        if (a === 'z3n') {
            $(this).attr('value', '<del>z3n</del>');
            $(this).html('<del>z3n</del>')
            $('.z3n').css('display', 'none');
        }
        if (a === '<del>z3n</del>') {
            $(this).attr('value', 'z3n');
            $(this).html('z3n')
            $('.z3n').css('display', 'block');
        }
    })

    $('#z2neg').click(function () {
        var a = $(this).attr('value');
        if (a === 'z2n') {
            $(this).attr('value', '<del>z2n</del>');
            $(this).html('<del>z2n</del>')
            $('.z2n').css('display', 'none');
        }
        if (a === '<del>z2n</del>') {
            $(this).attr('value', 'z2n');
            $(this).html('z2n')
            $('.z2n').css('display', 'block');
        }
    })
</script>

<script>
    var margin = {top: 10, right: 30, bottom: 30, left: 50},
        width = 900 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;

    var svg = d3.select("#my_dataviz")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

    d3.json("http://127.0.0.1:8000/gmp_data").then((data) => {
        console.log(data.gmpData)


        // console.log(typeof data)

        var x = d3.scaleLinear()
            .domain([0, data.gmpData[60]['age']])
            .range([0, width]);

        svg.append("g")
            .attr('class', 'x axis-grid')
            .attr("transform", "translate(0," + (height) + ")")
            .call(d3.axisBottom(x).tickSize(-height).tickFormat('').ticks(30))

        svg.append("g")
            .attr("transform", "translate(0," + (height) + ")")
            .call(d3.axisBottom(x).ticks(30).tickSizeOuter(0))

        var y = d3.scaleLinear()
            .domain([0, data.gmpData[60]['z3n'] + 30])
            .range([height, 0]);

        svg.append("g")
            .attr('class', 'y axis-grid')
            // .attr("transform", "translate(0,0)")
            .call(d3.axisLeft(y).tickSize(-width).tickFormat(''))

        svg.append("g")
            .attr("transform", "translate(0,0)")
            .call(d3.axisLeft(y).tickSizeOuter(0))

        // area z2n
        svg.append("path")
            .datum(data.gmpData)
            .attr('class', 'z2n')
            .attr("fill", "blue")
            .attr("fill-opacity", .5)
            .attr("stroke", "none")
            .attr("d", d3.area()
                .x(d => x(d.age))
                .y0(height)
                .y1(d => y(d.z2n))
            )

        // area z3n
        svg.append("path")
            .datum(data.gmpData)
            .attr('class', 'z3n')
            .attr("fill", "#69b3a2")
            .attr("stroke", "none")
            .attr("d", d3.area()
                .x(d => x(d.age))
                .y0(height)
                .y1(d => y(d.z3n))
            )

        // line for z2n
        svg.append("path")
            .datum(data.gmpData)
            .attr('class', 'z2n')
            .attr("fill", "none")
            .attr("stroke", "#69b3a2")
            .attr("stroke-width", 2)
            .attr("d", d3.line()
                .x(d => x(d.age))
                .y(d => y(d.z2n))
            )

        // line for z3n
        svg.append("path")
            .datum(data.gmpData)
            .attr('class', 'z3n')
            .attr("fill", "none")
            .attr("stroke", "#69b3a2")
            .attr("stroke-width", 2)
            .attr("d", d3.line()
                .x(d => x(d.age))
                .y(d => y(d.z3n))
            )

        var div = d3.select("body").append("div")
            .attr("class", "tooltip")
            .style("opacity", 0);

        svg.selectAll("z2n")
            .data(data.gmpData)
            .join("circle")
            .attr('class', 'z2n')
            .attr("fill", "red")
            .attr("stroke", "none")
            .attr("cx", d => x(d.age))
            .attr("cy", d => y(d.z2n))
            .attr("r", 2)
            .style('cursor', 'pointer')
            .on('mouseover', function (d, i) {
                d3.select(this).transition()
                    .duration('100')
                    .attr("r", 7);
                div.transition()
                    .duration(100)
                    .style("opacity", 1);
                div.html("Age: " + d.age + " week<br>-2Z: " + d.z2n)
                    .style("left", (d3.event.pageX + 10) + "px")
                    .style("top", (d3.event.pageY - 15) + "px");
            })
            .on('mouseout', function (d, i) {
                d3.select(this).transition()
                    .duration('200')
                    .attr("r", 2);
                div.transition()
                    .duration('200')
                    .style("opacity", 0);
            })

        svg.selectAll("z3n")
            .data(data.gmpData)
            .join("circle")
            .attr('class', 'z3n')
            .attr("fill", "red")
            .attr("stroke", "none")
            .attr("cx", d => x(d.age))
            .attr("cy", d => y(d.z3n))
            .attr("r", 2)
            .style('cursor', 'pointer')
            .on('mouseover', function (d, i) {
                d3.select(this).transition()
                    .duration('100')
                    .attr("r", 7);
                div.transition()
                    .duration(100)
                    .style("opacity", 1);
                div.html("Age: " + d.age + " week<br>Z-score: " + d.z3n)
                    .style("left", (d3.event.pageX + 10) + "px")
                    .style("top", (d3.event.pageY - 15) + "px");
            })
            .on('mouseout', function (d, i) {
                d3.select(this).transition()
                    .duration('200')
                    .attr("r", 2);
                div.transition()
                    .duration('200')
                    .style("opacity", 0);
            })

        svg.selectAll("gmpHeight")
            .data(data.gmpHeight)
            .join("circle")
            // .attr('class', 'z3n')
            .attr("fill", "black")
            .attr("stroke", "none")
            .attr("cx", d => x(d.age))
            .attr("cy", d => y(d.height))
            .attr("r", 7)
            .style('cursor', 'pointer')
            .on('mouseover', function (d, i) {
                d3.select(this).transition()
                    .duration('100')
                    .attr("r", 10);
                div.transition()
                    .duration(100)
                    .style("opacity", 1);
                div.html("Age: " + d.age + " week<br>Z-score: " + d.height)
                    .style("left", (d3.event.pageX + 10) + "px")
                    .style("top", (d3.event.pageY - 15) + "px");
            })
            .on('mouseout', function (d, i) {
                d3.select(this).transition()
                    .duration('200')
                    .attr("r", 7);
                div.transition()
                    .duration('200')
                    .style("opacity", 0);
            })
    })
</script>
</html>
