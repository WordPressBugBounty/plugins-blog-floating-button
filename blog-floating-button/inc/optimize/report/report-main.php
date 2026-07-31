<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$table_html = '';
$get_optimize_id = filter_input(INPUT_GET, 'optimize_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if( !empty($get_optimize_id) && $this->is_validate($get_optimize_id,'opt_id') ){
	//ABテストの詳細データ
	$optimize_id = $get_optimize_id;
	$optData = $this->get_tableData('','',$optimize_id);

	//プレビューデータ
	$preview_datas = $this->read_optimize($optimize_id)[$optimize_id];

}else{
	//ABテスト全体のデータ
	$optDatas = $this->read_optimize();

	if( isset($optDatas) && $optDatas){
		foreach( $optDatas as $opt_id => $optData ){

			$start_date = '2020-01';
			$optData = $this->get_tableData($start_date,'',$opt_id);

			$table_html .= '<tr>';
			$table_html .= '<td><a href="' . esc_url( '?page=blog-floating-button-optimize-report&optimize_id=' . $opt_id ) . '">' . esc_html( $optData['optimize_name'] ) . '</a></td>';
			$table_html .= '<td>' . esc_html( $optData['device'] ) . '</td>';
			$table_html .= '<td>' . esc_html( intval( $optData['main_access'] ) + intval( $optData['sub_access'] ) ) . '</td>';
			$table_html .= '<td>' . esc_html( intval( $optData['main_click'] ) ) . '(' . esc_html( $optData['main_clickRate'] ) . '%)</td>';
			$table_html .= '<td>' . esc_html( intval( $optData['sub_click'] ) ) . '(' . esc_html( $optData['sub_clickRate'] ) . '%)</td>';
			$table_html .= '<td>' . esc_html( $optData['created_date'] ) . '</td>';
			$table_html .= '<td>' . esc_html( $optData['finished_date'] ) . '</td>';
			$table_html .= '</tr>';
		}
	}
}

?>

<div id="bfb_wrap" class="optimize">

<?php if( !empty($optimize_id) ): ?>

	<h1 class="bfb_h1">「<?php echo esc_html( $optData['optimize_name'] ); ?>」のA/Bテストの詳細</h1>

	<?php 

	if( !empty($optData['search_span']) ){

		$table_html = '';

		$access_num_sum = 0;
		$click_num_sum = 0;
		$access_mainNum_sum = 0;
		$access_subNum_sum = 0;
		$click_mainNum_sum = 0;
		$click_subNum_sum = 0;

		foreach( $optData['search_span'] as $date ){

			$today = $date->format('Y-m-d');
			$access_mainNum = 0;
			$access_subNum = 0;
			$click_mainNum = 0;
			$click_subNum = 0;

			if( isset($optData['access_mainData'][$today]) ){
				$access_mainNum = $optData['access_mainData'][$today];
			}
			if( isset($optData['access_subData'][$today]) ){
				$access_subNum = $optData['access_subData'][$today];
			}
			if( isset($optData['click_mainData'][$today]) ){
				$click_mainNum = $optData['click_mainData'][$today]; 
			}
			if( isset($optData['click_subData'][$today]) ){
				$click_subNum = $optData['click_subData'][$today]; 
			}
					
			$access_entireNum = $access_mainNum + $access_subNum; //最適化テストの合計アクセス
			$access_num_sum += $access_entireNum;

			$access_mainNum_sum += $access_mainNum; //最適化テストのメインへのアクセス
			$click_mainNum_sum += $click_mainNum;
			$click_mainRate = $this->report->calc_click_rate($access_mainNum,$click_mainNum);

			$access_subNum_sum += $access_subNum; //最適化テストのサブへのアクセス
			$click_subNum_sum += $click_subNum;
			$click_subRate = $this->report->calc_click_rate($access_subNum,$click_subNum);

			$table_html = sprintf(
				'<tr><td>%1$s</td><td>%2$s</td><td>%3$s(%4$s%%)</td><td>%5$s(%6$s%%)</td></tr>%7$s',
				esc_html( $today ),
				esc_html( intval( $access_entireNum ) ),
				esc_html( intval( $click_mainNum ) ),
				esc_html( $click_mainRate ),
				esc_html( intval( $click_subNum ) ),
				esc_html( $click_subRate ),
				$table_html
			);

			$optData['main_maxClickRate'][] = $click_mainRate;
			$optData['sub_maxClickRate'][] = $click_subRate;

		}

		if( !empty($access_mainNum_sum) ){
			$click_mainRate_sum = round(($click_mainNum_sum/$access_mainNum_sum)*100,1);
		}else{
			$click_mainRate_sum = 0;
		}
		if( !empty($access_subNum_sum) ){
			$click_subRate_sum = round(($click_subNum_sum/$access_subNum_sum)*100,1);
		}else{
			$click_subRate_sum = 0;
		}
		$table_html .= sprintf(
			'<tr class="bold red"><td>合計</td><td>%1$s</td><td>%2$s(%3$s%%)</td><td>%4$s(%5$s%%)</td></tr>',
			esc_html( intval( $access_num_sum ) ),
			esc_html( intval( $click_mainNum_sum ) ),
			esc_html( $click_mainRate_sum ),
			esc_html( intval( $click_subNum_sum ) ),
			esc_html( $click_subRate_sum )
		);

	}

	$optData['main_maxClickRate'] = max($optData['main_maxClickRate']);
	$optData['sub_maxClickRate'] = max($optData['sub_maxClickRate']);

	if( $optData['main_maxClickRate'] > $optData['sub_maxClickRate'] ){
			$total_maxClickRate = $optData['main_maxClickRate'];
	}else{
		$total_maxClickRate = $optData['sub_maxClickRate'];
	}

	?>

	<?php include( dirname(__FILE__) . '/report-graph.php' ); ?>

	<table class="table th_yellow">
		<thead>
			<tr><th class="short_item">日付</th><th>合計ユーザー数</th><th>メインのクリック数(CTR)</th><th>サブのクリック数(CTR)</th></tr>
		</thead>
		<tbody>
			<?php echo wp_kses_post( $table_html ); ?>
		</tbody>
	</table>

<?php


//プレビュー出力
$device = $preview_datas['device'];
$mainBtnData['optimize_id'] = $optimize_id;
$mainBtnData['designType'] = $preview_datas['mainBtnDesign'];
$mainBtnData['optimize_type'] = 'mainBtnDesign';
foreach( $preview_datas as $key => $opt_data ){
	if( strpos($key,'_opt_mainBtn') > 0 ){
		$btnKey = str_replace(array('bfb_'.$mainBtnData['designType'].'_','_opt_mainBtn','_'.$device),'',$key);
		$mainBtnData[$btnKey] = str_replace('_opt_mainBtn','',$opt_data);
	}

}

$subBtnData['optimize_id'] = $optimize_id;
$subBtnData['designType'] = $preview_datas['subBtnDesign'];
$subBtnData['optimize_type'] = 'subBtnDesign';
foreach( $preview_datas as $key => $opt_data ){
	if( strpos($key,'_opt_subBtn') > 0 ){
		$btnKey = str_replace(array('bfb_'.$subBtnData['designType'].'_','_opt_subBtn','_'.$device),'',$key);
		$subBtnData[$btnKey] = str_replace('_opt_subBtn','',$opt_data);
	}

}

?>

<style type="text/css">
</style>

	<div id="bfb_sub" class="bfb_pro">
		<div class="preview_wrap">
			<div class="bfb_preview_<?php echo esc_attr( $device ); ?>">
				<h2>メインのプレビュー</h2>
				<div class="preview_area">
					<iframe srcdoc='<?php $this->generate_btn_html($device,$mainBtnData); ?>'></iframe>
				</div>
			</div>
			<div class="bfb_preview_<?php echo esc_attr( $device ); ?>">
				<h2>サブのプレビュー</h2>
				<div class="preview_area">
					<iframe srcdoc='<?php $this->generate_btn_html($device,$subBtnData); ?>'></iframe>
				</div>
			</div>
		</div>
	</div>

<?php else: ?>

	<h1 class="bfb_h1">A/Bテストの結果</h1>

	<table class="table th_yellow">
		<tr><th>テスト名</th><th>対象デバイス</th><th>合計ユーザー数</th><th>メインのクリック数(CTR)</th><th>サブのクリック数(CTR)</th><th>作成日</th><th>終了日</th></tr>
		<?php echo wp_kses_post( $table_html ); ?>
	</table>

<?php endif; ?>

</div><!--bfb_wrap-->
