<?php
include "includes/header.php";
if ($role == "Admin") {
    $message = '';
    $clear = token();

    if ($_FILES['uploadfile'] != '' && $_POST['token']) {
        if (valid_token($_POST['token']) == 'ok') {
            $uploadfile = $_FILES['uploadfile']['tmp_name'];
            ini_set('memory_limit', '-1');

            require_once './vendor/PHPExcel/Classes/PHPExcel.php';
            require_once './vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';

            $objExcel = PHPExcel_IOFactory::load($uploadfile);
            $record = 0;
            foreach ($objExcel->getWorksheetIterator() as $worksheet) {
                $highestrow = $worksheet->getHighestRow();

                for ($row = 0; $row <= $highestrow; $row++) {
                    $n0 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $n1 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $n2 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $n3 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $n4 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $n5 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $n6 = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $n7 = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $n8 = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $n9 = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $n10 = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $n11 = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $n12 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $n13 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $n14 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $n15 = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $n16 = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $n17 = $worksheet->getCellByColumnAndRow(17, $row)->getValue();

                    if ($n1 != '') {
                        $insertqry = "INSERT INTO `dps` (`ID`, `DPS_ID`, `HN_Eng`, `HN_Myn`, `Postal_Cod`, `St_N_Eng`, `St_N_Myn`, `Ward_N_Eng`, `Ward_N_Myn`, `Tsp_N_Eng`, `Tsp_N_Myn`, `Dist_N_Eng`, `Dist_N_Myn`, `S_R_N_Eng`, `S_R_N_Myn`, `Country_N`, `Longitude`, `Latitude`)
					 VALUES ('$n0','$n1','$n2','$n3','$n4','$n5','$n6','$n7','$n8','$n9','$n10','$n11','$n12'
					 ,'$n13','$n14','$n15','$n16','$n17')";
                        if (mysqli_query($link, $insertqry)) {
                            $record++;
                        }
                    }
                }

                if ($record >= 1) {
                    $message = " <div class='alert alert-success mt-3'>
  <strong>Success!</strong> You`ve inserted <b>$record</b> row(s).
</div>";
                } else {
                    $message = " <div class='alert alert-warning mt-3'>
  <strong>Error!</strong> Nothing Insert!
</div>";
                }

                // header("Location: upload");
            }
        }
    }?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-2">
                    <a href="home" class="btn btn-secondary btn-sm">
                        &#x2770; Back </a>
                </div>
                <div class="col-sm-10">
                    <h5><?=counting('dps', 'id');?> row(s) existing. You can upload via excel file. (csv)</h5>
                </div>
            </div>
            <hr>


<div class="alert alert-warning" role="alert">
  Note: The system only accept csv format to optimize memory while uploading. Please use character set: UTF-8 (Unicode) to keep Burmese language.
</div>

                <form method="post" action="" id="upload" onsubmit="$(':submit').attr('disabled', true);$('#loading').show();" enctype="multipart/form-data">
                    <input type="hidden" name="token"
                        value="<?=$clear?>">
                    <div class="btn-group btn-group-sm" role="group">
                        <input type="file" name="uploadfile"
                            accept=".csv"
                            required>
                        <div class="spinner-border text-primary ml-4"  id="loading" style="display:none" role="status">
                        <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </form>


                <form method="post" action="/control/update" id="clear" enctype="multipart/form-data">
                    <input type="hidden" name="token"
                        value="<?=$clear?>">
                    <input type="hidden" name="act" value="clear">

                </form>



                <div class="btn-group btn-group-sm mt-3  w-100" role="group">
                    <input type="button" onclick="window.location='/export/dps'" value="Export"
                        class="btn btn-sm btn-primary w-25 border" download>
                    <input type="submit" form="upload" onclick="return Confirm()" value="Upload"
                        class="btn btn-sm btn-primary w-25 border">
                    <input type="submit" form="clear" onclick="return Confirm()" value="Clear All"
                        class="btn btn-sm btn-primary w-25 border">

                    <input type="button" onclick="window.location='/src/sample.xlsx'" value="Download Sample"
                        class="btn btn-sm btn-primary w-25 border" download>
                </div>




                <?=$message?>

        </div>
    </div>
</div>
<?php
}
include "includes/footer.php";
