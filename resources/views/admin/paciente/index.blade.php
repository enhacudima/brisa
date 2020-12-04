@extends('adminlte::page')

@section('title', ' | Pacientes')

@section('content_header')
     <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="">Clientes</li>
        <li class="active">Pacientes</li>
    </ol>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--model-->
<div class="modal fade bd-example-modal-lg" id="modal-default"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Novo paciente</h4>
      </div>
      <a class="btn btn-social-icon btn-github " style="margin: 10px"  href="{{ url('racas') }}"><i class="fa  fa-cog"></i></a>
      
        <form method="post" action="{{route('paciente.store')}}" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data" style="margin:15px">
            <div class="modal-body">
            {{ csrf_field() }}
            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>

                <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="form-control" value="{{old('cliente_id')}}" required autofocus>
                            <option disabled selected ></option>
                            @if(isset($clientes))
                                @foreach($clientes as $data)
                                    <option value="{{$data->id}}">{{$data->nome}} {{$data->apelido}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="row">
                        <div class="from-group col-lg-12">
                            <label>Nome do paciente</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{old('nome')}}" required autofocus>
                        </div>
                </div>

                <div class="row">
                        <div class="from-group col-lg-12">
                            <label>Caderneta</label>
                            <input type="text" name="caderneta" id="caderneta" class="form-control" value="{{old('caderneta')}}" required autofocus>
                        </div>
                </div>

                <div class="row">
                        <div class="from-group col-lg-12">
                            <label>Especie</label>
                            <select name="especie" id="especie" class="form-control" value="{{old('especie')}}" required autofocus>
                                <option disabled selected ></option>
                                @if(isset($especies))
                                    @foreach($especies as $data)
                                        <option value="{{$data->nome}}">{{$data->nome}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                </div>

                <div class="row">
                        <div class="from-group col-lg-12">
                            <label>Raça</label>
                            <select name="raca" id="raca" class="form-control" value="{{old('raca')}}" required autofocus>
                                <option disabled selected ></option>
                                @if(isset($racas))
                                    @foreach($racas as $data)
                                        <option value="{{$data->nome}}">{{$data->nome}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                </div>

                <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Sexo</label>
                        <select name="sexo" id="sexo" class="form-control" value="{{old('sexo')}}" required autofocus>
                            <option disabled selected ></option>
                            <option value="M">Macho</option>
                            <option value="F">Fémia</option>
                            <option value="O">Outro</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Data de Nascimento</label>
                        <input type="date" name="idade" id="idade" class="form-control" value="{{old('idade')}}"  autofocus>
                    </div>
                </div>

                <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Pelagem</label>
                        <select name="pelagem" id="pelagem" class="form-control" value="{{old('pelagem')}}" required autofocus>
                            <option disabled selected ></option>
                                @if(isset($pelagem))
                                    @foreach($pelagem as $data)
                                        <option value="{{$data->nome}}">{{$data->nome}}</option>
                                    @endforeach
                                @endif
                        </select>
                    </div>
                </div>
            
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


    <div class="panel panel-default">

    <div class="panel-heading">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                Novo Paciente
        </button>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">     
    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Paciente</th>
            <th scope="col">Ficha</th>
            <th scope="col">Especie</th>
            <th scope="col">Raça</th>
            <th scope="col">Sexo</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Idade (Mêses)</th>
            <th scope="col">Pelagem</th>
            <th scope="col">Data de atualização</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($pacientes))
        @foreach($pacientes as $cil)
            <tr>
             <td>{{$cil->id}}</td>
             <td>{{$cil->cliente->nome}} {{$cil->cliente->apelido}}</td>
             <td>
                <a class="btn btn btn-success btn-xs" href="{{route('paciente.edit', $cil->id)}}" style="width: 100%">
                    <i class="fa fa-pencil fa-fw"></i> {{$cil->nome}}
                </a>
            </td>
            <td>
                <a class="btn btn btn-info btn-xs" href="{{url('ficha_clinica/paciente', $cil->id)}}">
                    <i class="fa fa-stethoscope fa-fw"></i> Nova Ficha
                </a>
            </td>
             <td>{{$cil->especie}}</td>
             <td>{{$cil->raca}}</td>
             <td>{{$cil->sexo}}</td>
             <td>{{$cil->idade}}</td>
             <td>{{\Carbon\Carbon::parse($cil->idade)->DiffInMonths(\Carbon\Carbon::today())}}</td>
             <td>{{$cil->pelagem}}</td>
             <td>{{$cil->updated_at}}</td>
            </tr>
        @endforeach 
        @endif   
        </tbody>
    </table>
</div>
        </div>
    </div>


<script type="text/javascript">

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

</script>

    <script>
         
    $(document).ready(function() {
        $('#reclatodas').DataTable( {

            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            "order": [[ 0, "desc" ]],
            responsive: true,
            dom: 'lfBrtip',
            buttons: [
                'excel', 'print'
            ],

        } 
        );
    } );
    </script>

@section('css')
    <style>

        input, textarea {
            padding: 10px;
            border: 1px solid #E5E5E5;
            width: 100%;
            color: #999999;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
        }

    </style>

    
@stop
@stop
