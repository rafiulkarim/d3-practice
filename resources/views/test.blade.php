<!DOCTYPE html>
<html>
<head>
    <!--giving the title to the titl-->
    <title>deprivation in Bangladesh</title>
    <!--CSS style link-->
{{--    <link rel="stylesheet" type="text/css" href="division.css">--}}
    <!--parsing d3.js-->
    <script src="https://unpkg.com/d3@5.9.2/dist/d3.min.js"></script>
    <!--loading json   -->
    <script src="https://unpkg.com/topojson@3"></script>
</head>
<body>
<content id="content"></content>
<svg width="900" height="600"></svg>
{{--<script src="{{ asset('resources/js/division.js') }}"></script>--}}
<script>
    const svg = d3.select('svg')
    const height = +svg.attr('height')
    const width = +svg.attr('width')

    const projection = d3.geoMercator().scale(4000).translate([-5850, 2000])
    const pathGenerator = d3.geoPath().projection(projection);

    const g = svg.append('g');

    svg.call(d3.zoom().on('zoom', (event) => {
        g.attr('transform', d3.event.transform)
    }))

    d3.json('division.json').then(data => {
        console.log(data)

        var myColor = d3.scaleLinear()
            .range(["green"])
            .domain([0, 8]);

        const getColor = (d) => {
            const divisionName = d.id;
            return myColor(divisionName)
        }

        const division = g.selectAll('path').data(data.features).enter().append('path')
            .style("fill", (d)=>getColor(d))
            .attr('class', 'division')
            .attr('d', pathGenerator)
            .append('title')
            .text(d =>  d.properties.ADM1_EN)

        svg.append("text")
            .attr("x", 0)
            .attr("y", 340)
            .attr("font-size", 90)
            .attr("font-weight", "bold")
            .attr("font-family", "Times New Roman")
            .attr("text-anchor", "middle")
            .attr("opacity", 0.5)
    })
</script>
</body>
</html>
