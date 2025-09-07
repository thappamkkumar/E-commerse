 

Highcharts.chart('customerGrowthByMonthContainer', {
	chart: {
		type: 'column'
	},
	title: {
		text: 'Customers Registerations'
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
			text: 'Number of New Customers'
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
		name: 'Customers',
		colorByPoint: true,
		data: customerData
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