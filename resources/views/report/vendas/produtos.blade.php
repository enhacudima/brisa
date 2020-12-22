@extends('adminlte::page')

@section('title', 'BM | Report Produtos')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
@include('inc.messages')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Report Produtos
        </h4>
    </div>

    <div class="panel-body">

        <form id="myForm" name="myForm" action="{{url('/report_produto_venda_filter')}}" method="post">
                @csrf
                {{ csrf_field() }}
    <div class="">
        <div class="form-group col-sm-2">
                <label >Data Inicio</label>
                
                        <input class="form-control" type="date" tyle="width: 100%"  id="inicio"  name="inicio" required autofocus>
                

        </div>

        <div class="form-group  col-sm-2 ">
                <label >Data Fim</label>
            
                        <input class="form-control" type="date" tyle="width: 100%"  id="fim"  name="fim" required autofocus >
                

        </div>
        <div class="form-group  col-sm-2 col-sm-offset-1">
            <label >Data
            <label class="container">Data de Criação
              <input type="radio" checked="checked" value="criacao" id="radio" name="radio">
              <span class="checkmark"></span>
            </label>
            <label class="container">Data de Actualização
              <input type="radio" value="atualizacao" id="radio" name="radio">
              <span class="checkmark"></span>
            </label>    
            </label>             
        </div>

        </div>

        <div class="">
        <p class="submit col">
            <strong>
            <button type="submit" class="btnEmidio btn btn-primary bord0" value="1" id="gravar">Atualizar </button>
            </strong>
        </p>

        </div>   


    <input hidden="" htype="" name="idusuario" id="idusuario" value="{{ Auth::user()->id }}">
           


    </form> 

    

    <div class="col-lg-12">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Lista de ajustes
        </h4>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">     
        <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
            <thead >
            <tr>
                <th scope="col">Produto</th>
                <th scope="col">Preço Unitario (Mtn)</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Total Vendido</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($movimentos))  
            @php($p=0)  
            @php($t=0)  
            @foreach($movimentos as $cil)
                <tr>
                <td>{{$cil->name}}</td> 
                <td>{{$cil->preco}}</td> 
                <td>{{$cil->quantidade}}</td> 
                <td>{{$cil->quantidade*$cil->preco}}</td>
                </tr>
                @php($p=$cil->quantidade+$p)
                @php($t=$cil->quantidade*$cil->preco+$t)
            @endforeach 
                <tr>                    
                    <td></td>
                    <td>Total:</td>
                    <td>{{$p}} Uni</td>
                    <td>{{$t}} MTN</td>
                </tr>
            @endif   
            </tbody>
        </table>
    </div>    
        </div>
    </div>
</div>
</div>

</div>
@stop
@section('js')

<script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>


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

        } );
    } );
    </script>


@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.material.min.css">   

<style type="text/css">
    .dataTables_wrapper .dt-buttons {
  float:none;  
  text-align:center;
  margin-bottom: 30px;
}
</style>





    <!--Out radius bottons-->
    <style type="text/css">

    /*Global*/

        .bord0 {
        border-radius: 0;
        }

        
    </style>
@stop
