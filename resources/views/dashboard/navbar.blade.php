 <!-- Header with logos -->
 <nav class="navbar">
            <div class="container-fluid">
            <div class="navbar-header">     
            @if(Auth::user()->role_id == 1)
                <a class="navbar-brands text-uppercase" href="{{ url('sekolah/1/edit') }}" style="color: #fff">{{\App\Models\Profil::sekolah()}}</a>      
                @else
                <a class="navbar-brands text-uppercase" href="" style="color: #fff">{{\App\Models\Profil::sekolah()}}</a>    
                @endif 
            </div>
            </div>
        </nav>
        <!-- /header with logos -->
        