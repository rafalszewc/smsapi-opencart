<div class="row">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked" id="preSaleTabs">
            <h3 style="line-height: 22px; margin-left: 20px;"></span><?= $data['send_sms_message'] ?></h3>
        </ul>
    </div>
    <div class="col-md-9">
        <form action="<?= $data['action'] ?>" method="post" enctype="multipart/form-data">
            <div class="tab-content">
                <?php if ($data['logged_in']): ?>
                <table class="table">
                    <tr>
                        <td class="col-xs-3"><h5><?= $data['broadcaster'] ?>:</h5></td>
                        <td class="col-xs-9">
                            <div class="col-xs-12">
                                <select name="sender">
                                    <?php foreach ($data['senders'] as $key => $value): ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-3"><h5><?= $data['defined_recipient'] ?>:</h5></td>
                        <td class="col-xs-9">
                            <div class="col-xs-12">
                                <select name="defRecipient" id="slct1">
                                    <option value="number"><?= $data['number'] ?></option>
                                    <option value="client"><?= $data['client'] ?></option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-3">
                            <h5>
                                <?= $data['sms_recipient'] ?>:
                            </h5>
                            <small>
                                <?= $data['commas_information'] ?>
                            </small>
                        </td>
                        <td class="col-xs-9">
                            <div class="col-xs-12">
                                <input type="text" name="recipient" id="recipient">
                                <select name="definedRecipient" id="slct2">
                                    <?php foreach ($data['customers'] as $customer): ?>
                                        <option
                                            value="<?= $customer['telephone'] ?>"><?= $customer['firstname'] . ' ' . $customer['lastname'] . ' (' . $customer['telephone'] . ')' ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-3"><h5><?= $data['sms_message'] ?>:</h5></td>
                        <td class="col-xs-9">
                            <div class="col-xs-12">
                                <textarea rows="5" cols="40" name="message"></textarea>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <input type="submit" name="send" value="<?= $data['smsapi_send'] ?>" class="btn btn-primary">
            <?php else: ?>
            <table class="table">
                <tr>
                    <td class="col-xs-3"><h5><?= $data['not_connected']; ?></h5></td>
                </tr>
            </table>
    </div>
    <?php
    endif;
    ?>
    </form>
</div>
</div>
<script type="text/javascript">
    $(function () {
        var $s1 = $('#slct1');

        function changeRecipient() {
            if ($s1.val() == "number") {
                $('#recipient').show();
                $("#recipient").attr("required", "required");
                $("#slct2").hide();
            }
            else if ($s1.val() == "client") {
                $('#slct2').show();
                $("#recipient").removeAttr("required", "required");
                $('#recipient').hide();
            }
        };
        changeRecipient();

        $('#slct1').on('change', changeRecipient);
    });

</script>