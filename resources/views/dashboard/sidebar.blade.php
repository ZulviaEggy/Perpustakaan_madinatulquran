
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="">	
					@if(in_array(Auth::user()->role_id,[1,2,3,4]))
                    	@if(Auth::user()->photo == '')
                     		<a href="#"><img src="{{asset('/global_assets')}}/images/placeholders/people.png" width="42" height="42" class="rounded-circle mr-2" alt=""></a>
                   		@else
							<img class="rounded-circle mr-2" src="{{ url('/photo/profile/'.Auth::user()->photo) }}" width="42" height="42" alt="">
                    	@endif
                    </div>
                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{Auth::user()->nama}}</div>
                        <div class="font-size-xs opacity-50">
                            <i class=" font-size-sm"></i> {{Auth::user()->role->privilege_level}}
                        </div>
					</div>
					
					<div class="">
					@elseif(Auth::user()->role_id == 6)
						@if(Auth::user()->guru->photo == '')
                            <a href="#"><img src="{{asset('/global_assets')}}/images/placeholders/people.png" width="42" height="42" class="rounded-circle mr-2" alt=""></a>
                        @else
                            <img class="rounded-circle mr-2" src="{{ url('/photo/guru/'.Auth::user()->guru->photo) }}" width="42" height="42" alt="">
                        @endif                                                                
					</div>
					<div class="media-body">
                        <div class="media-title font-weight-semibold">{{Auth::user()->role->privilege_level}}</div>
                        <div class="font-size-xs opacity-50">
                            <i class=" font-size-sm">{{Auth::user()->nip}}</i> 
                        </div>
					</div>
					
					<div class="mr-3">
					@elseif(Auth::user()->role_id == 5)
						@if(Auth::user()->siswa->photo == '')
                            <a href="#"><img src="{{asset('/global_assets')}}/images/placeholders/people.png" width="42" height="42" class="rounded-circle" alt=""></a>
                        @else
                            <img class="rounded-circle mr-2" src="{{ url('/photo/siswa/'.Auth::user()->siswa->photo) }}" width="42" height="42" alt="">
                        @endif                                                                
					</div>
					<div class="media-body" style="margin-left:10px">
                        <div class="media-title font-weight-semibold">{{Auth::user()->role->privilege_level}}</div>
                        <div class="font-size-xs opacity-50">
                            <i class=" font-size-sm">{{Auth::user()->nis}}</i> 
                        </div>
                    </div>
					@endif
                </div>
            </div>
        </div>
        <!-- /user menu -->

				<!-- Main navigation -->
                <div class="card-body p-0">
					<ul class="nav nav-sidebar" data-nav-type="accordion">
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Home</div> <i class="icon-menu" title="Forms"></i></li>

						<!-- Main -->
						@if(in_array(Auth::user()->role_id, [1,2,3,4]))
						<li class="nav-item ">
							<a href="{{ url('/') }}" class="nav-link {{ setActive('/') }} ">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
                        @endif
						
						@if(Auth::user()->role_id == 1)
						<li class="nav-item ">
							<a  class="nav-link {{ setActive(['staff*','tambah_staff']) }}" href="{{route('staff.index')}}">
								<i class="icon-user"></i>
								<span>
									Staff
								</span>
							</a>
						</li>
						@endif

						@if(in_array(Auth::user()->role_id, [1,2]))
							@if(setActive(['siswa*','guru*','tambah_siswa']))
							<li class="nav-item nav-item-submenu nav-item-expanded nav-item-open">
							@else
							<li class="nav-item nav-item-submenu">
							@endif
							<a href="#" class="nav-link {{ setActive(['siswa*','guru*','tambah_siswa']) }}">
									<i class="icon-users"></i> <span>Anggota</span></a>
								<ul class="nav nav-group-sub " data-submenu-title="Anggota">
									<li class="nav-item "><a href="{{ url('/siswa') }}" class="nav-link {{ setActive(['siswa*']) }}"><i class="icon-user"></i>Siswa</a></li>
									<li class="nav-item "><a href="{{ url('/guru') }}" class="nav-link {{ setActive(['guru*']) }}"><i class="icon-user"></i>Guru</a></li>
								</ul>
							</li>
						@endif

                        @if(in_array(Auth::user()->role_id, [1,4]))
						<li class="nav-item">
							<a href="{{ url('/kategori') }}" class="nav-link {{ setActive(['kategori*','tambah_kategori']) }}">
								<i class="icon-file-text"></i>
								<span>
									Kategori
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('/buku') }}" class="nav-link {{ setActive(['buku*']) }}">
								<i class="icon-book3"></i>
								<span>
								Buku
								</span>
							</a>
						</li>
						@endif

                        @if(in_array(Auth::user()->role_id, [1,3]))
						<li class="nav-item ">
							<a href="{{ url('/peminjaman') }}" class="nav-link {{ setActive(['peminjaman*', 'tambah_peminjaman','perpanjangan*','pengembalian*']) }} ">
                                <i class="icon-select2"></i> <span>Data Transaksi</span></a>
						</li>
						@endif

						@if(in_array(Auth::user()->role_id, [1,4]))
						<li class="nav-item ">
							<a href="{{ url('/noted') }}" class="nav-link {{ setActive('noted*') }} ">
								<i class="icon-book"></i>
								<span>
								Usulan
								</span>
								<span class="badge badge-success badge-pill align-self-center ml-auto">{{\App\Models\Noted::totalUsulan()}}</span>
							</a>
						</li>
						@endif

						@if(setActive(['laporan/transaksi','laporan/trs','laporan/buku','laporan/trs_peminjaman','laporan/trs_perpanjangan','laporan/trs_pengembalian']))
						<li class="nav-item nav-item-submenu nav-item-expanded nav-item-open">
						@else 
						<li class="nav-item nav-item-submenu">
						@endif

						@if(in_array(Auth::user()->role_id, [1,3,4]))
							<a href="" class="nav-link {{ setActive(['laporan/transaksi','laporan/trs','laporan/buku','laporan/trs_peminjaman','laporan/trs_perpanjangan','laporan/trs_pengembalian']) }}">
								<i class="icon-file-spreadsheet"></i>
								<span>
								Laporan
								</span>
							</a>
						@endif
							<ul class="nav nav-group-sub" data-submenu-title="Laporan">
								@if(in_array(Auth::user()->role_id, [4,1]))
								<li class="nav-item "><a href="{{ url('/laporan/buku') }}" class="nav-link {{ setActive('laporan/buku') }}"><i class="icon-book3"></i><span>Buku</span></a></li>
								@endif

								@if(in_array(Auth::user()->role_id, [1,3]))
									@if(setActive(['laporan/trs','laporan/trs_peminjaman','laporan/trs_perpanjangan','laporan/trs_pengembalian']))
									<li class="nav-item nav-item-expanded nav-item-open">
									@else
									<li class="nav-item">
									@endif
									<a href="{{ url('/laporan/transaksi') }}" class="nav-link {{ setActive('laporan/transaksi') }}"><i class="icon-select2"></i>Transaksi</a>
									<!-- <ul class="nav nav-group-sub">
										<li class="nav-item"><a href="{{ url('/laporan/trs') }}" class="nav-link {{ setActive('laporan/trs') }}">Semua Transaksi</a></li>
										<li class="nav-item"><a href="{{ url('/laporan/trs_peminjaman') }}" class="nav-link {{ setActive('laporan/trs_peminjaman') }}">Peminjaman</a></li>
										<li class="nav-item"><a href="{{ url('/laporan/trs_perpanjangan') }}" class="nav-link {{ setActive('laporan/trs_perpanjangan') }}">Perpanjangan</a></li>
										<li class="nav-item"><a href="{{ url('/laporan/trs_pengembalian') }}" class="nav-link {{ setActive('laporan/trs_pengembalian') }}">Pengembalian</a></li>									
									</ul> -->
									</li>					
								@endif
							</ul>
						</li>
						@if(in_array(Auth::user()->role_id, [5,6]))
						<li class="nav-item" class="active">
							<a href="{{ url('/') }}" class="nav-link {{ setActive('/') }} ">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						@if(Auth::user()->role_id == 6)
						<li class="nav-item">
							<a href="{{ url('/profile_guru') }}" class="nav-link {{ setActive(['profile_guru','profile*']) }} ">
								<i class="icon-user"></i>
								<span>
									Profile
								</span>
							</a>
						</li>
						@elseif(Auth::user()->role_id == 5)
						<li class="nav-item">
							<a href="{{ url('/profile_siswa') }}" class="nav-link {{ setActive(['profile_siswa','profile*']) }} ">
								<i class="icon-user"></i>
								<span>
									Profile
								</span>
							</a>
						</li>
						@endif
						<li class="nav-item">
							<a href="{{ url('/koleksi') }}" class="nav-link {{ setActive(['koleksi','buku_list*']) }} ">
								<i class="icon-book3"></i>
								<span>
								Koleksi Buku
								</span>
							</a>
						</li>
						<li class="nav-item">
								<a href="{{ url('/transaksi') }}" class="nav-link {{ setActive(['transaksi','detail_transaksi*']) }} "><i class="icon-exit3"></i><span>Data Transaksi</span></a></li>
						</li>
						@if(Auth::user()->role_id == 6)
						<li class="nav-item">
							<a href="{{ url('/usulan') }}" class="nav-link {{ setActive(['usulan*','kirim_usulan']) }} ">
								<i class="icon-file-text2"></i>
								<span>
									Usulan
								</span>
							</a>
						</li>
						@elseif(Auth::user()->role_id == 5)
						<li class="nav-item">
							<a href="{{ url('/usulan_siswa') }}" class="nav-link {{ setActive(['kirim_usulanSiswa','usulan_siswa*']) }} ">
								<i class="icon-file-text2"></i>
								<span>
									Usulan
								</span>
							</a>
						</li>
						@endif

                        <li class="nav-item">
							<a href="{{ url('/password/edit') }}" class="nav-link {{ setActive('password/edit') }} ">
								<i class="icon-lock4"></i>
								<span>
									Ganti Password
								</span>
							</a>
						</li>
					
						<li class="nav-item">
								<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> 
								<i class="icon-switch2"></i>
								<span>
							Log Out
								</span>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
								</a>
							</li>
							@endif
							
						<!-- /page kits -->
						</ul>
				</div>
				<!-- /main navigation -->

                </div>
            </div>
            <!-- /sidebar content -->

          </div>
    <!-- /main sidebar -->

