<div class="row">
    <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked" id="preSaleTabs">
            <h3 style="line-height: 22px; margin-left: 20px;"></span><?= $data['api_history'] ?></h3>
        </ul>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <?php if ($data['logged_in']): ?>
                <?php if ($data['history']): ?>
                    <table class="table">
                        <tr>
                            <th>
                                Data:
                            </th>
                            <th>
                                Treść wiadomości:
                            </th>
                        </tr>
                        <?php foreach ($data['history'] as $history): ?>
                            <tr>
                                <td class="col-xs-3"><h5><?= date("Y-m-d H:i:s", $history['date']) ?></h5></td>
                                <td class="col-xs-9">
                                    <h5><?= $history['message'] ?></h5>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>

                <?php else: ?>
                    <table class="table">
                        <tr>
                            <td class="col-xs-3"><h5> <?= $data['no_history'] ?> </h5></td>
                        </tr>
                    </table>
                <?php endif; ?>
            <?php else: ?>
                <table class="table">
                    <tr>
                        <td class="col-xs-3"><h5><?= $data['not_connected']; ?></h5></td>
                    </tr>
                </table>
            <?php endif ?>
        </div>
    </div>
</div>