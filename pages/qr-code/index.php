<html>
<head>
    <title>Html-Qrcode Demo</title>
<body>
    <div id="qr-reader" style="width:400px;display: block;margin-left: auto;margin-right: auto;width: 50%;"></div>
    <div id="qr-reader-results"></div>
    
    <form method="get" action="../consultation/consultation-history-patient.php" target="_blank">
    <input type="text" id="qr-reader-results-1" name="patient_id" >
        <button type="submit" id="submit_btn">Save</button>
    </form>
    
</body>
<script src="html5-qrcode.min.js"></script>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var resultContainer1 = document.getElementById('qr-reader-results-1');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                resultContainer1.value = decodedText;
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
</head>
</html>
<?php
?>