@extends('adminlte::page')

@section('title', 'BM | Cadastro de Produtos')

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
        <h4>Editar  Produto
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-3 col-lg-offset-4">
        <form method="post" action="{{url('produto/update',$produtos->id)}}" autocomplete="Active" accept-charset="UTF-8" >
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
             @if(isset($produtos))  
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$produtos->name}}" required autofocus>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Codigo do Produto</label>
                        <input type="text" name="codigoproduto" id="codigoproduto" class="form-control" value="{{$produtos->codigoproduto}}" required autofocus>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Codigo de Barras</label>
                        <input type="text" name="codigobarra" id="codigobarra" class="form-control" value="{{$produtos->codigobarra}}"  autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control" value="{{$produtos->brand}}" required autofocus>
                    </div>
            </div>       

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Descrição</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{$produtos->description}}" required autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Tipo de Unidade de Medida</label>
                        <input type="text" name="tipodeunidadedemedida" id="tipodeunidadedemedida" class="form-control" value="{{$produtos->tipodeunidadedemedida}}" required autofocus>
                    </div>
            </div>  

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Unidade de Medida</label>
                        <input type="number" name="unidadedemedida" id="unidadedemedida" class="form-control" value="{{$produtos->unidadedemedida}}" >
                    </div>
            </div> 
            
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control" value="{{old('status')}}" required autofocus>
                            @if($produtos->status==0)
                            <option selected="" value="{{$produtos->status}}">Desativado </option>
                            <option  value="1">Ativado </option> 
                            @elseif($produtos->status=1)
                            <option selected="" value="{{$produtos->status}}">Ativado </option> 
                            <option  value="0">Desativado </option> 
                           
                            @endif
                        </select>

                    </div>
            </div> 

            <div class="row">

                <div class="from-group text-right col-md-12">
                     <label></label>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>
            </div>   
                
           @endif
        </form>
        

    </div>
    
</div>

</div>
@stop

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
