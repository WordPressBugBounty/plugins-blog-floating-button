<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	$data = array();
	$data = array( 'memo' => $memo, 'start_date' => $start_date, 'end_date' => $end_date, 'post_url' => $post_url, 'device' => $device );
	$condi = array( 'limit' => intval($this->bfb_get_data('limit','get')), 'paged' => intval($this->bfb_get_data('paged','get')) );
	$datas = $this->report->get_tracking_data('click',$data,$condi);

	$pagination = $this->report->pagination($datas,$condi); //ページネーション処理
?>

<h2>クリック詳細レポート</h2>

<?php
if( isset($pagination['html']) ){
	echo wp_kses_post( $pagination['html'] );
}
?>

<div class="bfb_pagination_count_text"><?php echo esc_html( $pagination['count_text'] ); ?></div>

<table class="table th_yellow scroll">
<tr><th class="w50">id</th><th>記事URL</th><th>遷移先URL</th><th>ユーザーエージェント</th><th class="w50">デバイス</th><th>メモ</th><th class="w100">日時</th></tr>

<?php 
foreach( $datas as $data ){
	if( !isset($data->id) ){ continue; }
	printf(
		'<tr><td>%1$d</td><td><a href="%2$s" target="_blank">%3$s</a></td><td><a href="%4$s" target="_blank">%5$s</a></td><td>%6$s</td><td>%7$s</td><td>%8$s</td><td>%9$s</td></tr>',
		intval( $data->id ),
		esc_url( $data->post_url ),
		esc_html( $data->post_url ),
		esc_url( $data->linked_url ),
		esc_html( $data->linked_url ),
		esc_html( $data->ua ),
		esc_html( $data->device ),
		esc_html( $data->memo ),
		esc_html( $data->date )
	);
}
?>
</table>

<?php
if( isset($pagination['html']) ){
	echo wp_kses_post( $pagination['html'] );
}
?>
