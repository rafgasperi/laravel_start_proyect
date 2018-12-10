@extends('main-layout')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Dashboard</li>
    </ul>
    <!-- END BREADCRUMB -->
    @include('partials.date_filter')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <!-- START WIDGETS -->
        <div class="row">
            <div class="col-md-3">

                <!-- START WIDGET SLIDER -->
                <div class="widget widget-default widget-carousel">
                    <div class="owl-carousel" id="owl-example">
                        <div>
                            <div class="widget-title">Total Visitors</div>
                            <div class="widget-subtitle">27/08/2015 15:23</div>
                            <div class="widget-int">3,548</div>
                        </div>
                        <div>
                            <div class="widget-title">Returned</div>
                            <div class="widget-subtitle">Visitors</div>
                            <div class="widget-int">1,695</div>
                        </div>
                        <div>
                            <div class="widget-title">New</div>
                            <div class="widget-subtitle">Visitors</div>
                            <div class="widget-int">1,977</div>
                        </div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                    </div>
                </div>
                <!-- END WIDGET SLIDER -->

            </div>
            <div class="col-md-3">

                <!-- START WIDGET MESSAGES -->
                <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                    <div class="widget-item-left">
                        <span class="fa fa-envelope"></span>
                    </div>
                    <div class="widget-data">
                        <div class="widget-int num-count">48</div>
                        <div class="widget-title">New messages</div>
                        <div class="widget-subtitle">In your mailbox</div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                    </div>
                </div>
                <!-- END WIDGET MESSAGES -->

            </div>
            <div class="col-md-3">

                <!-- START WIDGET REGISTRED -->
                <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
                    <div class="widget-item-left">
                        <span class="fa fa-user"></span>
                    </div>
                    <div class="widget-data">
                        <div class="widget-int num-count">375</div>
                        <div class="widget-title">Registred users</div>
                        <div class="widget-subtitle">On your website</div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                    </div>
                </div>
                <!-- END WIDGET REGISTRED -->

            </div>
            <div class="col-md-3">

                <!-- START WIDGET CLOCK -->
                <div class="widget widget-danger widget-padding-sm">
                    <div class="widget-big-int plugin-clock">00:00</div>
                    <div class="widget-subtitle plugin-date">Loading...</div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                    </div>
                    <div class="widget-buttons widget-c3">
                        <div class="col">
                            <a href="#"><span class="fa fa-clock-o"></span></a>
                        </div>
                        <div class="col">
                            <a href="#"><span class="fa fa-bell"></span></a>
                        </div>
                        <div class="col">
                            <a href="#"><span class="fa fa-calendar"></span></a>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET CLOCK -->

            </div>
        </div>

        <!-- END WIDGETS -->
        <div class="row">
            <h1>Vue DataTable Sample</h1>
            <data-viewer source="/api/idea" title="Ideas" per_page="5" show_new="idea" show_detail="idea" show_edit="idea" show_delete="idea"/>

            <filterable url="{{ url('api/users') }}"></filterable>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>User</th>
                    <th>First Name</th>
                    <th>Lasta Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
                </thead>
                @foreach(\App\User::all() as $u)
                <tr>
                    <td>{{$u->id}}</td>
                    <td>{{$u->first_name}}</td>
                    <td>{{$u->last_name}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->created_at}}</td>
                </tr>
                @endforeach
            </filterable>

        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
    @section('scripts')

        {{ Html::script('js/plugins/morris/raphael-min.js') }}
        {{ Html::script('js/plugins/morris/morris.min.js') }}
        {{ Html::script('js/plugins/rickshaw/d3.v3.js') }}
        {{ Html::script('js/plugins/rickshaw/rickshaw.min.js') }}
        {{ Html::script('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}
        {{ Html::script('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}

        {{ Html::script('js/plugins/owl/owl.carousel.min.js') }}
        {{ Html::script('js/plugins/moment.min.js') }}
        {{ Html::script('js/plugins/datatables/jquery.dataTables.min.js') }}
        {{ Html::script('js/plugins/daterangepicker/daterangepicker.js') }}

    @stop

@stop