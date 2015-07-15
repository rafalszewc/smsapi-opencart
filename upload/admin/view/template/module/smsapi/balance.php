<div class="row">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked" id="preSaleTabs">
            <h3 style="line-height: 22px; margin-left: 20px;"></span><?= $data['smsapi_balance'] ?></h3>
        </ul>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <?php if ($data['logged_in']): ?>
                <table class="table">
                    <tr>
                        <td class="col-xs-3"><h5><?= $data['smsapi_balance'] ?>:</h5></td>
                        <td class="col-xs-9">
                            <div class="col-xs-12"><h5><?= $data['balance'] ?></h5></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-3">
                            <h5><?= $data['messages'] ?> ECO:</h5>
                            <h5><?= $data['messages'] ?> PRO:</h5>
                            <h5><?= $data['messages'] ?> MMS:</h5>
                            <h5><?= $data['messages'] ?> VMS GSM:</h5>
                            <h5><?= $data['messages'] ?> VMS <?= $data['Land.'] ?>:</h5>
                        </td>
                        <td class="col-xs-9">
                            <div class="col-xs-12">
                                <h5><?= $data['ecoCount'] ?></h5>
                                <h5><?= $data['proCount'] ?></h5>
                                <h5><?= $data['mmsCount'] ?></h5>
                                <h5><?= $data['vmsGsmCount'] ?></h5>
                                <h5><?= $data['vmsLandCount'] ?></h5>
                            </div>
                        </td>
                    </tr>
                </table>
            <?php else: ?>
                <table class="table">
                    <tr>
                        <td class="col-xs-3"><h5><?= $data['not_connected']; ?></h5></td>
                    </tr>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>