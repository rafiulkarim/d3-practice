<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/d3@5.9.2/dist/d3.min.js"></script>
</head>
<body>
<svg width="900" height="600"></svg>
</body>
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

    d3.json('http://127.0.0.1:8000/division-geojson').then(data => {
        console.log(data)

        // data.features.geometry.coordinates.forEach(d => console.log(typeof d[0]))

        var myColor = d3.scaleLinear()
            .range(["green", "red"])
            .domain([0, 8]);

        const getColor = (d) => {
            const divisionName = d.id;
            return myColor(divisionName)
        }

        const division = g.selectAll('path').data(data.features).enter().append('path')
            .style("fill", 'green')
            .attr('class', 'division')
            .attr('d', pathGenerator)
            .append('title')
            .text(d =>  d.name)
    })

</script>
</html>
