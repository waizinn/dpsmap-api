<?php
include "includes/header.php";
?>


<div class="alert alert-warning alert-dismissible">

    <strong>Warning!</strong> If you change with the wrong information, the system will not be able to send email
    (notification to user mail, password reset mail, welcome mail, remainder mail, etc...). <br>
    SMTP settings are simply your outgoing mail server settings; this particular protocol only works for outgoing
    messages.

    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>

<div class="row">
    <div class="col-sm-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Configure SMTP Settings</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <!-- <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="" alt="">-->
                </div>
                <form method="post" action="/control/update" name="setting" id="setting" enctype='multipart/form-data'
                    id="form" onsubmit="loading();">

                    <input name="cat" type="hidden" value="settings">
                    <input name="act" type="hidden" value="edit">
                    <input name="token" type="hidden"
                        value="<?=token()?>">
                    <table class="table table-borderless">
                        <?php
$datas = getById("settings", "1");?>

                        <tr>
                            <td>SMTP Host </td>
                            <td><input class="form-control form-control-sm" type="text" name="host"
                                    value="<?=$datas['smtp_host']?>"
                                    required /></td>
                        </tr>

                        <tr>
                            <td>SMTP Port </td>
                            <td><input class="form-control form-control-sm" type="text" name="port"
                                    value="<?=$datas['smtp_port']?>"
                                    required /></td>
                        </tr>

                        <tr>
                            <td>Sender Name </td>
                            <td><input class="form-control form-control-sm" type="text" name="name"
                                    value="<?=$datas['sender_name']?>"
                                    required /></td>
                        </tr>

                        <tr>
                            <td>SMTP Username </td>
                            <td><input class="form-control form-control-sm" type="text" name="username"
                                    value="<?=$datas['smtp_username']?>"
                                    required /></td>
                        </tr>

                        <tr>
                            <td>SMTP Password </td>
                            <td><input class="form-control form-control-sm" type="password" name="password" value="<?php if ($datas['smtp_password'] != '') {
}?>" minlength="4" required /></td>
                        </tr>


                    </table>
                    <center>
                        <a href="javascript:window.history.back();" class="btn btn-primary btn-sm">&nbsp; &#x2770;
                            &nbsp; Back &nbsp;</a>
                        <input type="submit" onclick="Confirm();" value="&nbsp;&nbsp; &#x2713; Save &nbsp;&nbsp;"
                            class="btn btn-success btn-sm" style="margin-left:20px;" <?php if ($role == "HOD") {
    echo "disabled";
}?>>
                    </center>
                </form>

            </div>
        </div>
    </div>



</div>

<?php include "includes/footer.php";
