 

Highcharts.chart('userGrowthByMonthContainer', {
	chart: {
		type: 'column'
	},
	title: {
		text: 'Users Registerations'
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
			text: 'Number of New Users'
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
		name: 'Users',
		colorByPoint: true,
		data: userData
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