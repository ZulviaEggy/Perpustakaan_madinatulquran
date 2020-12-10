<html>
    <body>
        <div class="container">
            <div style="margin-left: 5%; padding-bottom:10%">
                <center><h1>Barcode Buku </h1></center><br>
                <div class="col-md-2">
                <?php
                    for($i=1;$i<=$book->print_qty;$i++){
                    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("$book->kode_buku", 'C128',2,48,array(1,1,1), true) . '" alt="barcode" style="padding-bottom: 25px;padding-left: 20px"/>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="{{asset('/js')}}/sweetalert2.all.js"></script>
@include('sweetalert::alert')
