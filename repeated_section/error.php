<!-- error popup -->

<div class="error-popup">
    <!-- icon of the error -->
    <?php echo $icon; ?>
    <div id="error-text">
        <!-- title of the error -->
        <b>
            <?php echo $title; ?>
        </b>
        <!-- message of the error -->
        <br>
            <?php echo $mssg;?>
        </div>
        <!-- cross mark to close the error popup -->
        <span id="errorCloseMark" onclick="closeErrorPopUp()">&times;</span>
    </div>
</div>