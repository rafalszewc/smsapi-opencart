<?php echo $header;?>
<?php echo $column_left;?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1><i class="fa fa-mobile"></i>&nbsp;<?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger autoSlideUp" id="error"><i
                    class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success autoSlideUp"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <script>$('.autoSlideUp').delay(3000).fadeOut(600, function () {
                $(this).show().css({'visibility':'hidden'});
            }).slideUp(600);</script>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><img src="view/template/module/smsapi/smsapi.png"/>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                    <div class="tab-navigation form-inline">
                        <ul class="nav nav-tabs mainMenuTabs" id="mainTabs">
                            <li><a href="#balance" data-toggle="tab"><i class="fa fa-tachometer"></i>&nbsp;<?= $smsapi_balance ?></a>
                            </li>
                            <li><a href="#history" data-toggle="tab"><i class="fa fa-file-text-o"></i>&nbsp;<?= $smsapi_history ?></a>
                            </li>
                            <li><a href="#send_sms" data-toggle="tab"><span class="glyphicon glyphicon-phone"></span>&nbsp;<?= $smsapi_send ?>
                                    SMS</a></li>
                            <li><a href="#main_settings" data-toggle="tab"><i
                                            class="fa fa-cogs"></i>&nbsp;<?= $smsapi_settings ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.tab-navigation -->
                    <div class="tab-content">
                        <div id="balance"
                             class="tab-pane fade"><?php require_once(DIR_APPLICATION.'view/template/module/smsapi/balance.php'); ?></div>
                        <div id="history"
                             class="tab-pane fade"><?php require_once(DIR_APPLICATION.'view/template/module/smsapi/history.php'); ?></div>
                        <div id="send_sms"
                             class="tab-pane fade"><?php require_once(DIR_APPLICATION.'view/template/module/smsapi/send_sms.php'); ?></div>
                        <div id="main_settings"
                             class="tab-pane fade"><?php require_once(DIR_APPLICATION.'view/template/module/smsapi/settings.php'); ?></div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.tabbable -->
                <div class="box-heading" style="text-align:center">
                    <h5><?= $service ?> <a href="http://smsapi.pl" target="_blank"><img
                                    src="view/template/module/smsapi/smsapi.png" style="max-height:19px;"/></a>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>
<script type="text/javascript">
    $(function () {
        $('#mainTabs a:first').tab('show'); // Select first tab
        $('#preSaleTabs a:first').tab('show'); // Select first tab

        if (window.localStorage && window.localStorage['currentTab']) {
            $('.mainMenuTabs a[href="' + window.localStorage['currentTab'] + '"]').tab('show');
        }
        if (window.localStorage && window.localStorage['currentSubTab']) {
            $('a[href="' + window.localStorage['currentSubTab'] + '"]').tab('show');
        }
        $('.fadeInOnLoad').css('visibility', 'visible');
        $('.mainMenuTabs a[data-toggle="tab"]').click(function () {
            if (window.localStorage) {
                window.localStorage['currentTab'] = $(this).attr('href');
            }
        });
        $('a[data-toggle="tab"]:not(.mainMenuTabs a[data-toggle="tab"], .followup_tabs a[data-toggle="tab"])').click(function () {
            if (window.localStorage) {
                window.localStorage['currentSubTab'] = $(this).attr('href');
            }
        });
    });
</script>