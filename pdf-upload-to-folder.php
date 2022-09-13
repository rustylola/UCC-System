<?php

if(isset($_POST['data'])){
    $data = $_POST['data'];
    $b64 = $data;

    # Decode the Base64 string, making sure that it contains only valid characters
    $bin = base64_decode($b64, true);
    $filename = 'uploadpdf/'.strtoupper(uniqid())."".rand().'.pdf';
    # Perform a basic validation to make sure that the result is a valid PDF file
    # Be aware! The magic number (file signature) is not 100% reliable solution to validate PDF files
    # Moreover, if you get Base64 from an untrusted source, you must sanitize the PDF contents
    if (strpos($bin, '%PDF') !== 0) {
        throw new Exception('Missing the PDF file signature');
    }

    # Write the PDF contents to a local file
    # It save in server using this piece of code

    file_put_contents($filename, $bin);

    sleep(5);

    echo '<a href="'.$filename.'" download class="btn bg-primary" id="autodownload" hidden></a>
    <script>document.getElementById("autodownload").click();</script>';
}

?>