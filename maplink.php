<!-- Button trigger modal -->
<?php
if (isset($_GET['mlink'])) {
    date_default_timezone_set('Asia/Kolkata');
    $link =  $_GET['mlink'];
    $expire_time  =  24 - (int) date("H");
    setcookie("map_link", $link, time() + (3600 * $expire_time), "/");
    $id = $_COOKIE['uid'];
    insert_link($link, $id);
    header("Location: index.php");
}
?>
<?php
if ($_COOKIE['map_link'] == "Undefined" || $_COOKIE['map_link'] == 'undefined') {
?>
    <script>
        $('document').ready(function() {
            $("#enterlink").modal('show');
        });
    </script>
<?php
} else {
?>
    <script>
        $('document').ready(function() {
            $("#enterlink").modal('hide');
        });
    </script>
<?php
}
?>

<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="enterlink" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Live Location</h5>
            </div>
            <div class="modal-body">
                <form onsubmit="save_link()">
                    <div class="form-group">
                        <input type="text" name="mlink" class="form-control" placeholder="Enter link here">
                    </div>

            </div>
            <div class="modal-footer">

                <button type="submit" name="submitlink" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    function save_link() {
        var link = document.getElementsByName("mlink").value;
        window.location.href = "index.php?mlink=" + link;
    }
</script>