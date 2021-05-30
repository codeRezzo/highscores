<?php
function func_rust_admin(){


//file upload
echo '<p>Specific formatting and file naming conventions must be followed otherwise errors will occur when running composer. Please do not mess about with these controls.</p>';
echo '
<form action="./func/func_upload_control.php" method="post" enctype="multipart/form-data" class="padding-top-sm padding-bottom-sm">
    <div class="form-group">
        Select a data file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" class="btn btn-danger"  value="Upload" name="submit">
    </div>
</form>';

echo '<hr/>';

echo '  <form class="padding-top-sm padding-btm-sm">
            <div class="form-group">
                Run Experience Composer 
                <button type="submit" class="btn btn-danger">INSERT</button>
            </div>
        </form>';

echo '<hr/>';

echo '  <form class="padding-top-sm padding-btm-sm">
            <div class="form-group">
                Run Experience Composer
                <button type="submit" class="btn btn-danger">UPDATE</button>
            </div>
        </form>';


}
?>
