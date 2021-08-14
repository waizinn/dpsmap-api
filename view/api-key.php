<?php
include "includes/header.php";

if ($role == "Admin") {
    ?>

<a class="btn btn-primary btn-sm" href="edit-api-key?act=add"> <i class="glyphicon glyphicon-plus-sign"></i>
    Create</a>

<a class="btn btn-primary btn-sm" href="api-usage"> <i class="glyphicon glyphicon-stats"></i> API Usage</a>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#guideline">
    <i class="glyphicon glyphicon-question-sign"></i> Guidelines
</button>

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


<div class="modal" id="guideline">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="width:85% !important;">
        <div class="modal-content">


            <div class="modal-body">
                <pre>
    URL:https://dps.ethicaldigit.com/api/ (HTTP Method: POST OR GET)
<hr/>
    //Search by keyword
    <b>Request: </b>
        token=your_token,
        value=text what the user want to search (minimum 3 characters)

    <b>Response : </b>
        DPS_ID,
        HN_Eng,
        HN_Myn,
        Postal_Cod,
        St_N_Eng,
        St_N_Myn,
        Ward_N_Eng,
        Ward_N_Myn,
        Tsp_N_Eng,
        Tsp_N_Myn,
        Dist_N_Eng,
        Dist_N_Myn,
        S_R_N_Eng,
        S_R_N_Myn,
        Country_N,
        Longitude,
        Latitude"

    <b>Example Request with GET Method : </b>
    https://dps.ethicaldigit.com/api/?token=aLy1EiehhwJF7SJ10Hb1Vxx7&value=1st%20street

<hr/>
    //Search by Latitude & Longitude
    <b>Request: </b>
          token=your_token,
          lat=Latitude,
          lon=Longitude

    <b>Response : </b>
          DPS_ID,
          HN_Eng,
          HN_Myn,
          Postal_Cod,
          St_N_Eng,
          St_N_Myn,
          Ward_N_Eng,
          Ward_N_Myn,
          Tsp_N_Eng,
          Tsp_N_Myn,
          Dist_N_Eng,
          Dist_N_Myn,
          S_R_N_Eng,
          S_R_N_Myn,
          Country_N,
          Longitude,
          Latitude"

    <b>Example Request with GET Method : </b>
    https://dps.ethicaldigit.com/api/?token=aLy1EiehhwJF7SJ10Hb1Vxx7&lon=96.083618&lat=16.877551

    <hr/>

    <b>Example Response  (JSON): </b>
    {
    "code": 200,
    "message": "Ok",
    "data": [
    {
          "DPS_ID": "G_AP0045446",
          "HN_Eng": "10",
          "HN_Myn": "၁၀",
          "Postal_Cod": "11411",
          "St_N_Eng": "Aung Chan Thar Street",
          "St_N_Myn": "အောင်ချမ်းသာလမ်း",
          "Ward_N_Eng": "Ward-3",
          "Ward_N_Myn": "(၃)ရပ်ကွက်",
          "Tsp_N_Eng": "Hlaingtharya",
          "Tsp_N_Myn": "လှိုင်သာယာ",
          "Dist_N_Eng": "Yangon North District",
          "Dist_N_Myn": "ရန်ကုန်မြောက်ပိုင်းခရိုင်",
          "S_R_N_Eng": "Yangon Region",
          "S_R_N_Myn": "ရန်ကုန်တိုင်းဒေသကြီး",
          "Country_N": "Myanmar",
          "Longitude": "96.083618",
          "Latitude": "16.877551"
    },
    {
          "DPS_ID": "G_AP0083405",
          "HN_Eng": "109",
          "HN_Myn": "၁၀၉",
          "Postal_Cod": "11401",
          "St_N_Eng": "Aung Chan Thar Street",
          "St_N_Myn": "အောင်ချမ်းသာလမ်း",
          "Ward_N_Eng": "Ward-6",
          "Ward_N_Myn": "(၆)ရပ်ကွက်",
          "Tsp_N_Eng": "Hlaingtharya",
          "Tsp_N_Myn": "လှိုင်သာယာ",
          "Dist_N_Eng": "Yangon North District",
          "Dist_N_Myn": "ရန်ကုန်မြောက်ပိုင်းခရိုင်",
          "S_R_N_Eng": "Yangon Region",
          "S_R_N_Myn": "ရန်ကုန်တိုင်းဒေသကြီး",
          "Country_N": "Myanmar",
          "Longitude": "96.057003",
          "Latitude": "16.865725"
    }
            ]
    }

    <hr>
    //Response for Not Found
    {
    "code": 404,
    "message": "Not Found"
    }

    //Response  for Unauthorized Access
    {
    "code": 401,
    "message": "Unauthorized!"
    }
    </pre>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?php include "includes/footer.php";
