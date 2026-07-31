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
	labels: <?php echo wp_json_encode( $optData['graphData']['date'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>,
	datasets: [
		{
			type: 'line',
			label: 'クリック率(メイン)',
			data: <?php echo wp_json_encode( $optData['graphData']['main'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>,
			yAxisID: "y-clickRate",
			fill: false,
		},
		{
			type: 'line',
			label: 'クリック率(サブ)',
			data: <?php echo wp_json_encode( $optData['graphData']['sub'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>,
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
		            id: "y-clickRate",
		            type: "linear",
		            ticks: {
		                max: <?php echo wp_json_encode( $total_maxClickRate ); ?>,
		                min: 0,
		            },
					gridLines: {
	                	drawOnChartArea: false, 
	            	},
	            	//display: false,
		        }
	        ],
        }
    }
});
});
</script>
