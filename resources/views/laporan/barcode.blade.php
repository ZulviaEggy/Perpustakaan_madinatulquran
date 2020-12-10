<html>
    <body>
        <div class="container">
            <div style="margin-left: 7%; padding-bottom:10%">
                <center><h1>Barcode Buku </h1></center>
                <div class="col-md-2">
                <?php
                    for($i=1;$i<=$book->print_qty;$i++){
                    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("$book->kode_buku", 'C128',2,48,array(1,1,1), true) . '" alt="barcode" style="padding-bottom: 15px;"/>&nbsp&nbsp&nbsp&nbsp&nbsp';
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>


