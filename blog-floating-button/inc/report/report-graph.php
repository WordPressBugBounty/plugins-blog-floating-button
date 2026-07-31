<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="canvasWrapper">
	<canvas id="myChart"></canvas>
</div>

<script>
// Chart.js はフッターで読み込むため、DOM 構築と依存スクリプトの読み込み後に初期化する。
document.addEventListener("DOMContentLoaded", function() {
var chartData = {
	labels: <?php echo wp_json_encode( $graphData['date'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>,
	datasets: [
		{
			type: 'bar',
			label: 'ユーザー数',
			data: <?php echo wp_json_encode( $graphData['access'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>,
			yAxisID: "y-access",
		},
		{
			type: 'bar',
			label: 'クリック数',
			data: <?php echo wp_json_encode( $graphData['click'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>,
			yAxisID: "y-click",
		},
		{
			type: 'line',
			label: 'クリック率',
			data: <?php echo wp_json_encode( $graphData['click_rate'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>,
			yAxisID: "y-clickRate",
			fill: false,
		},
	],
};

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: chartData,
    options: {
		responsive: true,
		maintainAspectRatio: false,
		plugins: {
	      colorschemes: {
	        scheme: 'brewer.Paired12'
	      }
	    },
        scales: {
            yAxes: [
	            {
	                id: "y-access",
		            type: "linear",
		            position: "left",
		            ticks: {
		                max: <?php echo wp_json_encode( $this->report->ceil_1( $graphData['max_access'] ) ); ?>,
		                min: 0,
		            },
		        },
		        {
		            id: "y-click",
		            type: "linear", 
		            position: "right",
		            ticks: {
		                max: <?php echo wp_json_encode( $this->report->ceil_1( $graphData['max_access'] ) ); ?>,
		                min: 0,
		            },
					gridLines: {
	                	drawOnChartArea: false, 
	            	},
		        },
		        {
		            id: "y-clickRate",
		            type: "linear", 
		            ticks: {
		                max: 100,
		                min: 0,
		            },
					gridLines: {
	                	drawOnChartArea: false, 
	            	},
	            	display: false,
		        }
	        ],
        }
    }
});
});
</script>
