 

Highcharts.chart('productGrowthByMonthContainer', {
	chart: {
		type: 'column'
	},
	title: {
		text: 'Products'
	},
	subtitle: {
		text: ' '
	},
	xAxis: {
		categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
			'October', 'November', 'December'
		]
	},
	yAxis: {
		title: {
			text: 'Number of New Products'
		}
	},
	legend: {
		layout: 'vertical',
		align: 'right',
		verticalAlign: 'middle'
	},
	plotOptions: {
		series: {
			borderWidth: 0,
			dataLabels: {
				enabled: true,
				format: '{point.y:1f}'
			}
		}
		
	},
	series: [{
		name: 'Products',
		colorByPoint: true,
		data: productData
	}],
	responsive: {
		rules: [{
			condition: {
			   // maxWidth: 500
			},
			chartOptions: {
				legend: {
					layout: 'horizontal',
					align: 'center',
					verticalAlign: 'bottom'
				}
			}
		}]
	}
	  
});