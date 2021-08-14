function pschange() {
    var checkBox = document.getElementById("Change_");
    var inp = document.getElementById("pschange_");
    if (checkBox.checked == true) {
        inp.style.display = "block";
    } else {
        inp.style.display = "none";
    }
}



function navConfirm(loc) {
    if (confirm("Are you sure?")) {
        window.location.href = loc;
    }
    return false;
}

function Confirm() {
    if (confirm("Are you sure?")) { $return = true; } else { $return = false; }
    return $return;
}

function loading() {
    $("#loading").show();
    $("#form").hide();
}



function funs(sts, table, no) {
    document.getElementById("md").innerHTML = "Loading...";
    $.ajax({
        type: "POST",
        url: "control/load",
        data: { sts: sts, table: table, no: no },
        cache: false,
        success: function(data) {
            document.getElementById("md").innerHTML = data;
            // return;
            //  $('#Address').editableSelect();
            // $("#log").html(data);
        }
    });

}

function copy_(d) {

    var copyText = document.getElementById(d);

    copyText.select();
    copyText.setSelectionRange(0, 99999);

    document.execCommand("copy");
    alert("Copied the key: " + copyText.value);

}

if (document.getElementById('ed_')) {
    var date_sys = new Date();
    var year_sys = date_sys.getFullYear();
    document.getElementById("ed_").style.display = "block";
    document.getElementById("ed_").innerHTML = "Copyright @ " + year_sys + " DPS Co., Ltd.<br> Developed by Wai Zin Ko";
    document.getElementById("ed_").style.fontSize = "11px";
    document.getElementById("ed_").style.textAlign = "center";
    document.getElementById("ed_").style.color = "white";
} else {
    alert('Copyright Error!');

    if (document.getElementById('content')) {
        document.getElementById("content").style.display = "none";
    } else { alert('Error'); }

    if (document.getElementById('sidebar')) {
        document.getElementById("sidebar").style.display = "none";
    } else { alert('Error'); }

}




$(document).ready(function() {

    $("#sidebarCollapse, #sidebarExtend").on("click", function() {
        // sessionStorage.setItem("status", "active");
        // sessionStorage.getItem("status");
        $("#sidebar").toggleClass("active");
        var act = $('#sidebar').hasClass("active");
        if (act) {
            sessionStorage.setItem("status", "active");
        } else {
            sessionStorage.setItem("status", "");
        }



    });

    $("#sorted").DataTable({
        "bStateSave": true,
        "sPaginationType": "full_numbers"
    });


    $('[data-toggle="tooltip"]').tooltip();
});