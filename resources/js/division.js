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
        .range(["lightblue", "blue"])
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
})

