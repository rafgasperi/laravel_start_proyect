 <!-- START X-NAVIGATION -->
 <ul class="x-navigation">
   <li class="xn-logo">
      <a href="{{ route('dashboard') }}">
               LOGO HERE
         {{--}}<img src="{{ url('img/logo2.png') }}" >{{--}}
      </a>
      <a href="#" class="x-navigation-control"></a>
   </li>
   @if(Sentinel::check())
       <li class="xn-profile">

          <a href="#" class="profile-mini">
             {{--<img src="assets/images/users/avatar.jpg" alt="{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}"/>--}}
             <i class="fa fa-user" title="{{ Sentinel::getUser()->email }}"></i>
          </a>
          <div class="profile">

             <div class="profile-image">
                 @if(Sentinel::getUser()->foto <> "")
                <img src="{{ Sentinel::getUser()->foto  }}" alt="{{ Sentinel::getUser()->email }}"/>
                 @else
                <i class="fa fa-user fa-5x" title="{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}"></i>
                @endif
             </div>
             <div class="profile-data">
                <div class="profile-data-name">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</div>

                 <div class="widget-big-int" style="color:#fff;font-size:14px;">{{ date('d F H:i') }}</div>
             </div>

             <div class="profile-controls">
                 <a href="{{ route('user.perfil',array(Sentinel::getUser()->id)) }}" class="profile-control-left"><span class="fa fa-info"></span></a>

             </div>
          </div>

       </li>
       <li class="xn-title" style="color: #fff;text-align: left;font-weight: bold">MENÚ</li>
           <li class="@if(Request::is('dashboard')) active @endif">
              <a href="{{ URL::to('dashboard') }}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
           </li>

           <!--   --------------------- SEGURIDAD MENU ------------------------------>
           @if(Sentinel::getUser()->hasAccess(["user.index","user.create"]))
           <li class="xn-openable @if(Request::is('user') || Request::is('user/*')) active @endif" >
             <a href="{{ URL::route("user.index") }}"><span class="fa fa-unlock"></span> <span class="xn-text">Usuarios</span></a>
               <ul>
                   @if(Sentinel::getUser()->hasAccess("user.index"))
                        <li><a href="{{ URL::route('user.index') }}"><span class="fa fa-list"></span> Ver usuarios</a></li>
                   @endif
                   @if(Sentinel::getUser()->hasAccess("user.create"))
                        <li><a href="{{ URL::route('user.create') }}"><span class="fa fa-plus"></span> Crear usuario</a></li>
                   @endif

               </ul>
           </li>
           @endif
           @if(Sentinel::getUser()->hasAccess(["role.index"]))
             <li class="xn-openable @if(Request::is('role')) active @endif" >
                 <a href=""><span class="fa fa-users"></span> <span class="xn-text">Roles</span></a>
                 <ul>
                     @if(Sentinel::getUser()->hasAccess("role.index"))
                         <li><a href="{{ URL::route('role.index') }}"><span class="fa fa-list"></span> Ver Roles</a></li>
                     @endif
                     @if(Sentinel::getUser()->hasAccess("role.create"))
                         <li><a href="{{ URL::route('role.create') }}"><span class="fa fa-plus"></span> Crear Rol</a></li>
                     @endif
                 </ul>
             </li>
         @endif
   @endif

 </ul>
 <!-- END X-NAVIGATION -->