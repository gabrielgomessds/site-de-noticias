const valueChart = document.querySelector(".values_chart").value;
const DateChart = valueChart.split(',');

var optionsProfileVisit = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: 'visitas',
		data: DateChart
	}],
	colors: '#435ebe',
	xaxis: {
		categories: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul", "Ago","Set","Out","Nov","Dez"],
	},
}
console.log(optionsProfileVisit)

var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
chartProfileVisit.render();
