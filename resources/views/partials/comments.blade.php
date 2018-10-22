<div class="panel panel-default">
    {{Form::open(array("method" => "POST","action" => "ComentarioController@store","role" => "form",'class'=>'form-horizontal'))}}
    <div class="panel-heading">
        <div class="panel-title-box">
            <h3><strong><i class="fa fa-comment"></i> Comentar</strong> </h3>
        </div>
        <ul class="panel-controls" style="margin-top: 2px;">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="panel-body">
        {{Form::textarea("descripcion", null, array("class" => "form-control", 'required' => 'required', 'placeholder' => 'Escribe un Comentario'))}}
        <input type="hidden" class="form-control" name="modulo" value="{{ $module }}">
        <input type="hidden" class="form-control" name="record_id" value="{{ $data->id }}">
        <input type="hidden" class="form-control" name="redirect_to" value="{{ route($module.'.edit',array($data->id)) }}">

    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-custom btn-primary pull-right"><i class="fa fa-paper-plane"></i> Enviar</button>
    </div>
    {{ Form::close() }}
</div>

<!-- START TIMELINE -->
<div class="timeline">
<?php $i = 1 ?>
@foreach($data->comentarios() as $c)
    <!-- START TIMELINE ITEM -->
        <div class="timeline-item @if($i%2==0) timeline-item-right @endif ">
            <div class="timeline-item-info">{{ time_elapsed_string($c->created_at) }}</div>
            <div class="timeline-item-icon"><span class="fa fa-comment"></span></div>
            <div class="timeline-item-content">
                <div class="timeline-body comments">
                    <div class="comment-item">
                        @if(!empty($c->usuario()->first()->foto))
                            <img src="{{ $c->usuario()->first()->foto }}"/>
                        @else
                            <img src="http://lorempixel.com/30/30/people/"/>
                        @endif
                        <p class="comment-head">
                            <a href="#">{{ $c->usuario()->first()->first_name }} {{ $c->usuario()->first()->last_name }}</a>
                        </p>
                        <p>{{ $c->descripcion }}</p>
                    </div>
                    {{Form::open(array("method" => "POST","action" => "ComentarioController@store","role" => "form"))}}
                    <div class="col-md-10">
                        <div class="comment-write">
                            <input type="hidden" class="form-control" name="modulo" value="ordenes">
                            <input type="hidden" class="form-control" name="record_id" value="{{ $data->id }}">
                            <input type="hidden" class="form-control" name="redirect_to" value="{{ route('ordenes.edit',array($data->id)) }}">
                            <input type="hidden" class="form-control" name="padre_id" id="padre_id" value="{{ $c->id }}">
                            <textarea name="descripcion" class="form-control" placeholder="Escribe una respuesta" rows="1" required></textarea>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-rounded btn-condensed btn-sm" alt="guardar"><i class="fa fa-comment-o"></i> </button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- END TIMELINE ITEM -->
        <?php $i++ ?>
    @endforeach


</div>
<!-- END TIMELINE -->