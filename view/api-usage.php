<?php
include "includes/header.php";
?>


<p syle="width:100%;">
    <a href="javascript:window.history.back();" class="btn btn-primary btn-sm">&nbsp; &#x2770; &nbsp; Back
        &nbsp;</a>

    <spam style="margin-left:100px;" id='seconds-counter'> </spam>
</p>


<div id="iframe_" frameborder="0" width="auto" height="100%" style="display:none;"></div>

<script>
    var el = document.getElementById('seconds-counter');
    var seconds = 30;

    function incrementSeconds() {
        var url_ = window.location.href.split('?')[1];
        //alert(url_);
        if (seconds == 30) {
            $.get("iframe?" + url_, function(data, status) {
                $("#iframe_").html(data);
            });
            //$("#iframe_").load("iframe.php");
            $("#iframe_").slideDown("slow");
            seconds = seconds - 1;

        } else if (seconds == 0) {
            $.get("iframe?" + url_, function(data, status) {
                $("#iframe_").html(data);
            });
            $("#iframe_").slideDown("slow");
            seconds = 30;
        } else {
            seconds = seconds - 1;
        }
        el.innerText = "Refresh in " + seconds + " seconds.";
    }

    var counts = setInterval(incrementSeconds, 1000);
</script>
<?php include "includes/footer.php";
