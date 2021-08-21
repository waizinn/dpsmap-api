<?php
include "includes/header.php";

if ($role == "Admin") {
    ?>

<a class="btn btn-primary btn-sm" href="edit-api-key?act=add"> <i class="glyphicon glyphicon-plus-sign"></i>
    Create</a>

<a class="btn btn-primary btn-sm" href="api-usage"> <i class="glyphicon glyphicon-stats"></i> API Usage</a>


<p class="mt-3">
    There are <?=counting("api", "id")?> data
    accessable users. </p>

<table id="sorted" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th style="width:50%;">Token</th>

            <th>Status</th>
            <th colspan="2">Remark</th>


            <th class="not">Delete</th>
        </tr>
    </thead>


    <?php
$api = getAll("api");
    if ($api) {

        foreach ($api as $apis):
        ?>
    <tr>

        <td align="right"><?=$apis['id']?>
        </td>

        <td>
            <div
                id="<?='b' . $apis['id']?>">
                <input type="text" value="<?php $rest = substr($apis['token'], -7);
        echo "***" . $rest;?>" style="width:215px;border: none;" readonly>
                <div class="btn" style="height:20px;padding:1px;margin:5px;margin-top:0px;"><i
                        class="glyphicon glyphicon-hand-right"></i></div>
                <button type="button" class="btn btn-link" style="height:20px;padding:1px;margin:5px;margin-top:0px;"
                    onclick=" $('#<?='b' . $apis['id']?>').hide();$('#<?='c' . $apis['id']?>').show();">
                    <i class="glyphicon glyphicon-eye-close"></i></button>

            </div>

            <div id="<?='c' . $apis['id']?>"
                style="display:none">
                <input
                    id="<?='a' . $apis['id']?>"
                    type="text"
                    value="<?=$apis['token']?>"
                    style="width:215px;border: none;" readonly>

                <button type="button" class="btn btn-link" style="height:20px;padding:1px;margin:5px;margin-top:0px;"
                    onclick="copy_('<?='a' . $apis['id']?>')">
                    <i class="glyphicon glyphicon-floppy-saved"></i></button>
                <button type="button" class="btn btn-link"
                    style="height:20px;padding:1px;margin:5px;margin-top:0px;color:red"
                    onclick=" $('#<?='b' . $apis['id']?>').show();$('#<?='c' . $apis['id']?>').hide();">
                    <i class="glyphicon glyphicon-eye-open"></i></button>

            </div>

        </td>


        <?php

        if ($apis['status'] == "Active") {
            $st = "Suspend";
        } else {
            $st = "Active";
        }?>

        <td align="center"><a
                href="/control/update?act=api_change&id=<?=$apis['id']?>&cat=<?=$st?>"
                onclick="return navConfirm(this.href);">
                <?php if ($apis['status'] == "Active") {?>
                <i class="glyphicon glyphicon-ok-sign" style="color:#0f56fc;font-size:18px;"></i><?php } else {?>
                <i class="glyphicon glyphicon-remove-sign" style="color:#d10000;font-size:18px;"></i><?php }?>
            </a>
        </td>


        <td><?=$apis['remark']?>
        </td>



        <td align="center"><a
                href="edit-api-key?act=edit&id=<?=$apis['id']?>"><i
                    class="glyphicon glyphicon-edit"></i></a></td>
        <td align="center"><a
                href="/control/update?act=delete&id=<?=$apis['id']?>&cat=api-key"
                onclick="return navConfirm(this.href);"><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>



    <?php endforeach;}?>




</table>

<?php
} else {
    echo "<h3>User role can`t access the API Page.</h3> ";
}
?>




<?php include "includes/footer.php";
