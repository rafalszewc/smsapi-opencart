<div class="row">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked" id="preSaleTabs">
            <h3 style="line-height: 22px; margin-left: 20px;"></span><?= $data['general_settings'] ?></h3>
        </ul>
    </div>
    <div class="col-md-9">
        <form action="<?= $data['action'] ?>" method="post" enctype="multipart/form-data">
            <div class="tab-content">
                <table class="table">
                    <tr>
                        <td class="col-xs-7">
                            <h4><?= $data['account_settings'] ?>:</h4>
                            <h5><?= $data['account_in_smsapi'] ?>
                                : <?php if (isset($data['smsapi_username']) && $data['logged_in']) echo $data['smsapi_username']; ?></h5>

                            <p style="color: #FF0000;"><?php if (!$data['logged_in']) echo $data['not_connected']; ?></p>

                            <div id="change" style="margin-top: 10px;">
                                <input type="text" name="username" class="form-control"
                                       placeholder="<?= $data['username'] ?>"
                                       style="margin-bottom: 10px;" required>
                                <input type="password" name="password" class="form-control"
                                       placeholder="<?= $data['password'] ?>" required>
                                <br>
                                <button class="btn btn-success" name="change">[<?= $data['change_save'] ?>]</button>
                            </div>
                        </td>
                        <td class="col-xs-5">
                            <div class="col-xs-12">
                                <button class="btn btn-success" id="achange" name="change">
                                    <?php if ($data['logged_in']): ?>
                                        [<?= $data['change'] ?>]
                                    <?php else: ?>
                                        [<?= $data['connect'] ?>]
                                    <?php endif; ?>
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <?php if ($data['logged_in']): ?>
            <form action="<?= $data['action'] ?>" method="post" enctype="multipart/form-data">
                <div class="tab-content">
                    <table class="table">
                        <tr>
                            <td class="col-xs-7"><h4><?= $data['broadcaster'] ?>:</h4></td>
                            <td class="col-xs-5">
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
                            <td class="col-xs-7">
                                <h4><?= $data['sms_options'] ?>:</h4>
                                <h5><?= $data['replace_special_chars'] ?></h5>
                                <h5><?= $data['send_fast'] ?></h5>
                            </td>
                            <td class="col-xs-5">
                                <div class="col-xs-12">
                                    <br>
                                    <input type="checkbox" name="specialChars"
                                           value="1" <?php if ($data['special_chars']) echo 'checked'; ?>>
                                    <br>
                                    <input type="checkbox" name="fast"
                                           value="1" <?php if ($data['fast']) echo 'checked'; ?>>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-xs-7">
                                <h4><?= $data['owner_number'] ?>:</h4>
                                <h5><?= $data['insert_owner_number'] ?></h5>
                            </td>
                            <td class="col-xs-5">
                                <div class="col-xs-12">
                                    <input type="text" name="admin_phone" value="<?= $data['admin_phone'] ?>">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="table">
                        <tr>
                            <td class="col-xs-12">
                                <h4><?= $data['inform_owner'] ?></h4>

                                <div class="radio-inline">
                                    <input type="radio" name="newOrder"
                                           value="1" <?php if ($data['new_order']) echo 'checked'; ?>
                                           class="yes"> <?= $data['yes'] ?>
                                </div>
                                <div class="radio-inline">
                                    <input type="radio" name="newOrder"
                                           value="0" <?php if (!$data['new_order']) echo 'checked'; ?>
                                           class="no"> <?= $data['no'] ?>
                                </div>

                                <div id="newOrderMessage">
                                    <br>
                                    <label><?= $data['sms_message'] ?></label>
                                    <i class="glyphicon glyphicon-info-sign" data-toggle="popover"
                                       data-content="{customer} - <?= $data['var_customer'] ?>, {number} - <?= $data['var_number'] ?>, {total_price} - <?= $data['var_total_price'] ?>, {phone} - <?= $data['var_phone'] ?>"></i>
                                    <br>
                                    <textarea name="newOrderMessage" cols="50"
                                              rows="3"><?= $data['new_order_message']; ?></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-xs-12">
                                <h4><?= $data['inform_client'] ?></h4>

                                <div class="radio-inline">
                                    <input type="radio" name="changeOrderStatus"
                                           value="1" <?php if ($data['change_order_status']) echo 'checked'; ?>
                                           class="yes"> <?= $data['yes'] ?>
                                </div>
                                <div class="radio-inline">
                                    <input type="radio" name="changeOrderStatus"
                                           value="0" <?php if (!$data['change_order_status']) echo 'checked'; ?>
                                           class="no"> <?= $data['no'] ?>
                                </div>
                                <div id="status">
                                    <?php foreach ($data['statuses'] as $status): ?>
                                        <br>
                                        <input type="checkbox" name="check_list[<?= $status['status_id'] ?>]"
                                               id="<?= $status['status_id'] ?>"
                                               class="checkbox-to-hide" <?php if ($status['checked']) echo 'checked'; ?>> <?= $status['name'] ?>
                                        <br>
                                        <div class="sentStatus" id="<?= $status['status_id'] ?>"
                                             style="margin-top: 5px;">
                                            <label><?= $data['sms_message'] ?></label>
                                            <i class="glyphicon glyphicon-info-sign" data-toggle="popover"
                                               data-content="{customer} - <?= $data['var_customer'] ?>, {number} - <?= $data['var_number'] ?>, {total_price} - <?= $data['var_total_price'] ?>, {status} - <?= $data['var_status'] ?>"></i>
                                            <br>
                                            <textarea name="status_descriptions[<?= $status['status_id'] ?>]" cols="50"
                                                      rows="3"><?= $status['description'] ?></textarea>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <input type="submit" value="<?= $data['save_changes'] ?>" name="save" class="btn btn-primary">
            </form>
        <?php endif ?>
    </div>
</div>

<script>
    $(function () {
        var id;
        for (var i = 0; i < $('.checkbox-to-hide').size(); i++) {
            if (!$('.checkbox-to-hide').get(i).hasAttribute('checked')) {
                id = $('.checkbox-to-hide').get(i).getAttribute('id');
                $('#' + id + '.sentStatus').hide();
            }
        }
    });

    $('#change').hide();
    if ($('#error').is(':visible')) {
        $('#achange').hide();
        $('#change').show();
    }
    $('#achange').click(function () {
        $('#change').show();
        $('#achange').hide();
    });

    handleChangesOnCheckboxes($('#status'), $('.checkbox-to-hide'));

    function handleChangesOnCheckboxes($status, $class) {
        $status.find($class).on('click', function () {
                var id = $(this).attr('id');
                if (!$(this).is(':checked')) {
                    $('#' + id + '.sentStatus').hide();
                } else {
                    $('#' + id + '.sentStatus').show();
                }
            }
        );
    }

    handleChangesOfBoxVisibility($('#newOrderMessage'), $('input[name=newOrder]'));
    handleChangesOfBoxVisibility($('#status'), $('input[name=changeOrderStatus]'));

    function handleChangesOfBoxVisibility($box, $radio) {
        if ($radio.filter('.no').is(':checked'))
            $box.hide();

        $radio.change(function (ev) {
            if ($(ev.target).attr('class') === 'yes')
                $box.slideDown();
            else
                $box.slideUp();
        });
    }

    $("[data-toggle=popover]").popover({
        trigger: "manual"
    }).on("click", function (e) {
        e.preventDefault();
    }).on("mouseenter", function () {
        var _this = this;
        $(this).popover("show");
        $(this).siblings(".popover").on("mouseleave", function () {
            $(_this).popover('hide');
        });
    }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide")
            }
        }, 100);
    });

</script>