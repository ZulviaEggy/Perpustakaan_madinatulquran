 <!-- Grid -->
 
 <div class="row">
 @foreach($datas as $new)
 @if($new->status_id != null)
            <div class="col-xl-3 col-sm-4">
                <div class="card">  
                    <div class="card-body" id="tag_container">
                        <div class="card-img-actions">
                            <a href="{{ url('/uploads/'.$new->cover) }}" data-popup="lightbox">
                                <img class="card-img" width="180px" src="{{ url('/uploads/'.$new->cover) }}">
                                <span class="card-img-actions-overlay card-img">
                                    <i class=" icon-2x"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="card-body bg-light text-left">
                    <h6 class="font-weight-semibold">{{$new->judul_buku}}</h6>
                    Penulis : {{$new->penulis}}  <br>
					Penerbit : {{$new->penerbit}}  <br>
					Tahun terbit : {{$new->tahun_terbit}}  <br>
					Edisi : {{$new->edisi}}  <br>
					ISBN : {{$new->ISBN}}  <br>
                    Volume : {{$new->volume}}  <br>
                    Deskrpsi : {{$new->deskripsi}}  <br>
					<div class="font-weight-semibold"> Jumlah:
						<span> {{ $new->jumlah }}</span></div>
                    </div>
                    <div class="card-footer font-weight-semibold"> Status: 
                    <span class="{{ $new->class }}"> {{ $new->name }}</span>
					</div>  
                </div>       
                </div>  
            @else
            <div class="row">
                <div class="col-xl-9">
				    <div class="card">
						<div class="embed-responsive embed-responsive-16by9 card-img-top">
							<iframe class="embed-responsive-item" src="https://player.vimeo.com/video/173541384?title=0&byline=0&portrait=0" allowfullscreen frameborder="0" mozallowfullscreen></iframe>
						</div>

							<div class="card-body">
								<h6 class="card-title">No Data Entry</h6>
									<p class="card-text">Tidak ada riwayat peminjaman buku</p>
							</div>

								
							</div>
						</div>	
                    </div>
                @endif
            @endforeach
        </div>
        <!-- /grid -->
        <?php echo $datas->appends(['sort' => 'votes'])->links();?>
 