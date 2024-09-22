<script>
//ライブプレビュー機能

var btnData = {};
var bfb_url = '<?php echo site_url('/wp-json/bfb/api/live_preview'); ?>';
var bfb_tabs1_name = '';
var bfb_tabs2_name = '';

(function($){

    //設定画面
    $(document).on("change", "#bfb_form", function () {
        bfb_preview();
    });
    $(document).on("click", "#bfb_form .bfb_load_preview,#edittag .bfb_load_preview,#editor .bfb_load_preview", function () {
        bfb_preview();
    });
    //編集画面
    $(document).on("change", "#bfb_wrap", function () {
       bfb_preview(); 
    });
    //最適化
    $(document).on("change", "#bfb_form_opt", function () {
        bfb_preview_opt();
    });
    $(document).on("click", "#bfb_form_opt .bfb_load_preview", function () {
        bfb_preview_opt();
    });

})(jQuery);

function bfb_preview(){

    bfb_btnData = {};

    bfb_tabs1_name = jQuery("#bfb_wrap li.ui-state-active").attr('aria-controls');
    bfb_tabs2_name =  jQuery("#"+bfb_tabs1_name+" li.ui-state-active").attr('aria-controls');

    jQuery("#"+bfb_tabs1_name+" #"+bfb_tabs2_name+" input").each(function(i, val) {
        if( jQuery(this).attr('name') != undefined ){
            bfb_btnData[jQuery(this).attr('name')] = jQuery(this).val();
        }
    });
    jQuery("#"+bfb_tabs1_name+" #"+bfb_tabs2_name+" select").each(function(i, val) {
        if( jQuery(this).attr('name') != undefined ){
            bfb_btnData[jQuery(this).attr('name')] = jQuery(this).val();
        }
    });
    bfb_btnData['designType'] = bfb_tabs2_name;

    if( bfb_btnData['designType'] == undefined ){
        //詳細設定時のライブプレビュー

        //詳細設定を取得        
        jQuery("#tabs-detail input").each(function(i, val) {
            if( jQuery(this).attr('name') != undefined ){
            bfb_btnData[jQuery(this).attr('name')] = jQuery(this).val();
            }
        });

        var bfb_designType_pc = jQuery('#tabs-common [name="bfb_designType_pc"]').val();
        if( bfb_designType_pc ){
            jQuery("#tabs-pc-"+bfb_designType_pc+" input").each(function(i, val) {
                if( jQuery(this).attr('name') != undefined ){
                    bfb_btnData[jQuery(this).attr('name')] = jQuery(this).val();
                }
            });
            jQuery("#tabs-pc-"+bfb_designType_pc+" select").each(function(i, val) {
                if( jQuery(this).attr('name') != undefined ){
                    bfb_btnData[jQuery(this).attr('name')] = jQuery(this).val();
                }
            });
            bfb_btnData['designType'] = bfb_designType_pc;
            bfb_preview_ajax(bfb_btnData,'pc');
        }

        var bfb_designType_sp = jQuery('#tabs-common [name="bfb_designType_sp"]').val();
        if( bfb_designType_sp ){
            jQuery("#tabs-sp-"+bfb_designType_sp+" input").each(function(i, val) {
                if( jQuery(this).attr('name') != undefined ){
                    bfb_btnData[jQuery(this).attr('name')] = jQuery(this).val();
                }
            });
            jQuery("#tabs-sp-"+bfb_designType_sp+" select").each(function(i, val) {
                if( jQuery(this).attr('name') != undefined ){
                    bfb_btnData[jQuery(this).attr('name')] = jQuery(this).val();
                }
            });
            bfb_btnData['designType'] = bfb_designType_sp;
            bfb_preview_ajax(bfb_btnData,'sp');
        }

    }else{

        if( bfb_tabs1_name.indexOf('-pc') > 0 ){
            bfb_preview_ajax(bfb_btnData,'pc')
        }
        if( bfb_tabs1_name.indexOf('-sp') > 0 ){
            bfb_preview_ajax(bfb_btnData,'sp')
        }

    }
    
}

function bfb_preview_opt(){

    var bfb_btnData = {};
    var device = jQuery("form#bfb_form_opt").attr('device');

    jQuery("#bfb_form_opt input").each(function(i, val) {
        if( jQuery(this).attr('name') != undefined ){
            bfb_btnData[jQuery(this).attr('name')] = jQuery(this).val();
        }
    });
    jQuery("#bfb_form_opt select").each(function(i, val) {
        if( jQuery(this).attr('name') != undefined ){
            bfb_btnData[jQuery(this).attr('name')] = jQuery(this).val();
        }
    });

    var btnDesign = jQuery("form#bfb_form_opt").attr('btnDesign');
    var optimize_step = jQuery("[name='optimize_step']").val();

    if( optimize_step.indexOf('mainBtn') > 0 ){
        bfb_btnData['designType'] = btnDesign;
        bfb_preview_ajax(bfb_btnData,device);
    }else if( optimize_step.indexOf('subBtn') > 0 ){
        bfb_btnData['designType'] = btnDesign;
        bfb_preview_ajax(bfb_btnData,device);
    }

}

function bfb_preview_ajax(bfb_btnData,device){

    jQuery.ajax({
        url: bfb_url,
        type: 'post',
        data: {
            'btnData': bfb_btnData,
            'device': device
        },
    })
    .done( function (res) {
        jQuery(".bfb_preview_"+device+" .preview_area").html('<iframe srcdoc=\''+res+'\'></iframe>');
    });
}

</script>