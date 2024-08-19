<script>
    function hiddenPopup(e) {
        const popup = e.target.parentElement;
        const container = popup.parentElement;
        container.removeChild(popup); 
    }
</script>

<?php 
function popup($type, $msg) {
    echo "
        <div class='popup $type'>
            <span>$msg</span>
            <button onclick='hiddenPopup(event)'>x</button>
        </div>
    ";
}