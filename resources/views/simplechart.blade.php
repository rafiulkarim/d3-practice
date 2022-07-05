<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/d3@5.9.2/dist/d3.min.js"></script>
    <style>
        .bar{
            fill: green;
        }
    </style>
</head>
<body>
<svg id="visualisation" width="300" height="300"></svg>
</body>
<script>
    const svg = d3.select('svg')
    const height = +svg.attr('height')
    const width = +svg.attr('width')
    svg.attr("viewBox", [0, 0, width, height]);
    const margin = { top: 20, right: 30, bottom: 55, left: 70 }

    const x_scale = d3
        .scaleBand()
        .range([margin.left, width - margin.right])
        .padding(0.1);
    const y_scale = d3.scaleLinear().range([height - margin.bottom, margin.top]);

    let x_axis = d3.axisBottom(x_scale);

    let y_axis = d3.axisLeft(y_scale);

    d3.json("http://127.0.0.1:8000/simple-bar")
        .then(response => {
            responseData = response.data
            x_scale.domain(responseData.map((d) => +d.x));
            y_scale.domain([0, d3.max(responseData, (d) => +d.y)]);

            svg
                .selectAll("rect")
                .data(responseData)
                .join("rect")
                .attr("class", "bar")
                .attr("x", (d) => x_scale(d.x))
                .attr("y", (d) => y_scale(d.y))
                .attr("width", x_scale.bandwidth())
                .attr("height", (d) => height - margin.bottom - y_scale(d.y));

            svg
                .append("g")
                .attr("transform", `translate(0,${height - margin.bottom})`)
                .call(x_axis)
                .selectAll("text")
                .style("text-anchor", "end")
                .attr("dx", "-.8em")
                .attr("dy", ".15em")
                .attr("transform", "rotate(-65)");

            svg.append("g").attr("transform", `translate(${margin.left},0)`).call(y_axis);

        }).catch(error => {
            console.log(error)
    });
</script>
</html>
