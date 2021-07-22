<!-- success popup -->

<div class="success-popup">
    <!-- icon of the success -->
    <?php echo $icon; ?>
    <div id="success-text">
        <!-- title of the success -->
        <b>
            <?php echo $title; ?>
        </b>
        <!-- message of the success -->
        <br>
            <?php echo $mssg;?>
        </div>
        <!-- cross mark to close the success popup -->
        <span id="successCloseMark" onclick="closesuccessPopUp()">&times;</span>
    </div>
</div>