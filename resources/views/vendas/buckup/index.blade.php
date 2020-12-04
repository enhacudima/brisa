<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{URL::asset('imglogo/logoClinica.png')}}"/>

        <title>Pelos&Patas | Vendas</title>



        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
          <link rel="stylesheet" type="text/css" href="{{asset('src/bootstrap-duallistbox.css')}}">
          <script src="https://code.jquery.com/jquery-3.2.1.min.js"  ></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
          <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
          <script src="{{ asset('src/jquery.bootstrap-duallistbox.js') }}"></script>
          <!--sweetalert-->
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

          <!--jquery para autocomplet--> 


            
            <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
            <!--and js-->



        <!--Ajax-->  


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            
        </style>

        <style type="text/css">
            .center-block {
            padding:10px;
            color:#ec8007
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="row">
                <div class="col-md-12"  style="text-align: center">
                    <div class="center-block"><b><h2>Sala: {{$mesa->name}}; Operador: {{ Auth::user()->name }}</h2></b></div>
                </div>
            </div>
            <hr>

           


            
            <div class="row "  style="text-align: center">
                <div class="col-md-4">
                <a class="btn btn-primary " href="{{ url('home') }}" style="width: 50%; " > <i class="fa fa-arrow-circle-left"></i> Voltar</a> 
                    
                </div>

                <div class="col-md-4">
                <a class="btn btn-success " href="{{ url('venda/factura/'.$mesa_id) }}" style="width: 50%; " target="_blanck"><i class="fa fa-list-ol" ></i> Factura</a> 
                    
                </div>


                <div class="col-md-4">
                <a class="btn btn-danger " href="#ticket-edit-mesa-modal" data-toggle="modal" data-target="#ticket-edit-mesa-modal" style="width: 50%;"> Finalizar <i class="fa fa-arrow-circle-right"></i>
                </a>
                    
                </div>

            </div>   
            
        
            <hr>

            <div class="row "  style="text-align: center">
                <div class="col-md-6">
                    <form id="demoform" action="#" method="post" style="margin-left: 15px">
                         <h3>Lista</h3>
                         {{ csrf_field() }}

                         <input type="" name="formtype" id="formtype" value="venda" hidden="true">
                         <input type="" name="mesa_id" id="mesa_id" value="{{$mesa_id}}" hidden="true">
                         <input name="identificador_de_bulk" id="identificador_de_bulk" class="identificador_de_bulk" hidden="true">
                        <select multiple="multiple" size="20" name="duallistbox_demo1[]" title="duallistbox_demo1[]">
                              @foreach($produtos as $key => $cil)
                              <option value="{{$cil->id}}">{{$cil->codigoproduto}} - {{$cil->name}} - {{$cil->entrada_preco}} Mtn Q - ({{$cil->total_entrada-$cil->total_saida}})</option>
                              @endforeach
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block "><i class="fa fa-shopping-cart"></i> Adicionar no carrinho</button>
                      </form> 
                </div>

                <div class="col-md-6">
                <form id="carrinhoform" action="#" method="POST" style="margin-right: 15px; margin-left: 15px">
                    <h3>Carrinho</h3>
                    {{ csrf_field() }}
                        <div class="panel-body">

                            <div class="box-body table-responsive no-padding"> 
  

                                <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
                                    <thead >
                                    <tr>
                                        <th >Descrição do Produto</th>
                                        <th scope="col">Preço.(Mtn)</th>
                                        <th scope="col">Qua.t</th>
                                        <th scope="col">Total.(Mtn)</th>
                                        <th scope="col">Apagar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($data_mesa))  
                                    @foreach($data_mesa as $key => $value)
                                        <tr>
                                        <td style="width: 400px"> 
                                            <input type="" name="mesa_id" value="{{$mesa_id}}" hidden="true">
                                            <input type="text" id="idbulk" name="idbulk" hidden="true" value="{{$value->identificador_de_bulk}}">
                                            <input step="0.01" type="number" id="id[]" name="id[]" hidden="true" value="{{$value->id}}">
                                            <input style="width: 250px" class="form-control" type="text" name="produt" id="produt"  disabled="" value="{{$value->name}}"></td> 
                                        <td><input style="width: 100px" class="form-control" step="any" type="number"  name="preco_final[]" id="preco_final[]" disabled="true" value="{{$value->preco_final}}"></td> 
                                        <td><input style="width: 100px" class="form-control" step="any" type="number"  name="quantidade[]" id="quantidade[]"  value="{{$value->quantidade}}"></td> 
                                        <td><input style="width: 100px"  class="form-control" step="any" type="number"  name="total[]" id="total[]"  disabled="" value="{{$value->quantidade * $value->preco_final}}"></td>
                                        <td><a type="submit"class="btn btn-danger btn-xs"  data-value="{{$value->id}}" id="delete" href="#">
                                                <i class="fa fa-trash-o fa-lg" ></i> Delete
                                            </a>
                                        </td>


                                        </tr>
                                    @endforeach 

                                    @endif   
                                    </tbody>
                                        <tfoot>
                                          <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td><div class=""><input type="text"  class="total form-control" value="0" name="sum" id="sum" disabled="" /></div></td>
                                          </tr>
                                      </tfoot>
                                </table>
                            </div>   
                            </div>
                            <br>

                            @if ($data_mesa)
                            <button type="submit" class="btn btn-primary btn-block " style=" margin-bottom: 15px"><i class="fa fa-hourglass-start" ></i> Atualizar</button>
                            @endif 


                </form>
                    
                </div>

            </div>
        </div>  

            

            <!--modal edite Mesa-->
        <div class="modal fade bd-example-modal-lg" id="ticket-edit-mesa-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-mesa-modal-Label">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" >
                    <form method="POST" action="#" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="formfvenda">
                        {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title" id="ticket-edit-mesa-modal-Label">Finalização da Venda </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                    </div> 
                    <input type="hidden" id="inputs" name="formtype" value="venda" />

                    <div class="modal-body">

                        <div class="row">
   

                            <div class="center-block"> 
                                <h3> 
                                Total a Pagar:

                                <input class="form-control total col-md-6"   type="number" step="0.01" name="porpagar" id="porpagar" style="width: auto;" disabled="true" value="">
                                </h3>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Forma de Pagamento</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Detalhes</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Referência</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Valor</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control "  type="text" name="fpagamento[]" value="Cash" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input  class="form-control " type="text" name="detalhes[]" value="Dinheiro" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0" disabled="" >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor"  step="any" type="number"  name="valor[]" value="0" required="">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="Cartão" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <select class="form-control " value="" name="detalhes[]" autofocus required="" >
                                            <option disabled="" value="nan" selected>
                                                Seleciona..
                                            </option>
                                             
                                            <option value="Milennium BIM">
                                                Milennium BIM
                                            </option>    
                                            <option value="BancABC">
                                                BancABC
                                            </option>    
                                            <option value="Barclays">
                                                Barclays
                                            </option>    
                                            <option value="BCI">
                                                BCI
                                            </option>    
                                            <option value="Nosso Banco">
                                                Nosso Banco
                                            </option>    
                                            <option value="BNI">
                                                BNI
                                            </option>    
                                            <option value="Ecobank">
                                                Ecobank
                                            </option>    
                                            <option value="BancABC">
                                                BancABC
                                            </option>    
                                            <option value="CEP">
                                                CEP
                                            </option>    
                                            <option value="Unico">
                                                Unico
                                            </option>    
                                            <option value="Gapi">
                                                Gapi
                                            </option>    
                                            <option value="FNB">
                                                FNB
                                            </option>    
                                            <option value="CapitalBanck">
                                                CapitalBanck
                                            </option>    
                                            <option value="Moza Banco">
                                                Moza Banco
                                            </option>    
                                            <option value="Standard Bank">
                                                Standard Bank
                                            </option>    
                                            <option value="Societe Generale Moçambique">
                                                Societe Generale Moçambique
                                            </option> 

                                             
                                             
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0"  >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" step="any" type="number"  name="valor[]" value="0" required="">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="M-PESA" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="detalhes[]" value="Vodacom" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0" >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" step="any" type="number"  name="valor[]" value="0" required="">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="Conta Movel" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="detalhes[]" value="BCI" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0"  >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" step="any" type="number"  name="valor[]" value="0" required="">
                                    </div>
                                </div>                  

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="Outro" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="detalhes[]" value="Outro" >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0"  >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" step="any" type="number"  name="valor[]" value="0" required="">
                                    </div>
                                </div>
                                <hr>                 

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Total Pago:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " step="any" type="number"  name="pago" id="pago" value="0" required="" disabled="">
                                    </div>
                                </div>           

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Total Por pagar:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control total" step="any" type="number"  name="ppago" id="ppago" value="0" required="" disabled="">
                                    </div>
                                </div>           

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Troco:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control" step="any" type="number"  name="troco" id="troco" value="0" required="" disabled="">
                                    </div>
                                </div>
                              <!-- Custom Tabs -->


                              <!-- nav-tabs-custom -->
                            </div>
                            <!-- /.col -->

                    </div>
                          

                            <div class="clearfix"></div>

                            <div class="modal-footer">

                     
                                
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <input class="btn btn-primary" type="submit" data- value="Efectuar pagamento da conta">
                                <input class="btn btn-danger" id="credito" name="credito" type="submit" value="Creditar ao cliente">
                                </div>
                    </form>
                        </div>
                    </div>
        </div> 

        
        <script type="text/javascript">
           /*  $(document).ready(function (){
                $.ajax({
                   type:"GET",
                   url:"{{url('getstocktovenda')}}",
                   success:function(res){  

                       if (res) {
                        $("#selectProdut").empty();
                        $.each(res,function(key,value){
                             
                            $(".selectProdut").append('<option value="'+value.id+'">"'+value.codigoproduto+'" - "'+value.name+'" - "'+value.entrada_preco+'" Mtn Q - ("'+value.total_entrada-value.total_saida+'")</option>');
                        });
                   
                    }else{
                       $("#pessoa_contacto_state_id").empty();
                    }
                   }
                });

             });*/
        </script>


        <script type="text/javascript">
            $(document).ready(function (){
                $mesa_id=$('#mesa_id').val();
                $formtype=$('#formtype').val();
                $.ajax({
                    url:"{{url('vendas/find/bulck')}}",
                    type:'Get',
                    data:{formtype:$formtype,mesa_id:$mesa_id},
                    success: function(data){

                        $('.identificador_de_bulk').val(data.identificador_de_bulk);
                    },
                    error: function (error){
                        console.log(error);
                    }
                });


            }
        );
            function getIdBulck(){
                $mesa_id=$('#mesa_id').val();
                $formtype=$('#formtype').val();
                $.ajax({
                    url:"{{url('vendas/find/bulck')}}",
                    type:'Get',
                    data:{formtype:$formtype,mesa_id:$mesa_id},
                    success: function(data){

                        $('.identificador_de_bulk').val(data.identificador_de_bulk);
                    },
                    error: function (error){
                        console.log(error);
                    }
                });

            }


        </script>


            <script>

              var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
              $("#demoform").submit(function(e) {
                e.preventDefault();
                $dados=($('[name="duallistbox_demo1[]"]').val());
                $mesa_id=($('[name="mesa_id"]').val());
                $formtype=($('[name="formtype"]').val());
                $idbulk=($('[name="identificador_de_bulk"]').val());

                $.ajax({
                  url: "{{URL('saveselection')}}",
                  type:'POST',
                  data: {dados:$dados,mesa_id:$mesa_id,formtype:$formtype,idbulk:$idbulk},
                  success: function(data) {
                        $('#reclatodas > tbody') .html(data);

                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                            $(".total").val(_total);
                            getIdBulck();




                        


                    //alert(data);


                  }});
                return false;
              });
            </script>
            <script type="text/javascript">
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
            </script>

            <script type="text/javascript">
                //atualizando os dados na tabela temporaria 
                $("#carrinhoform").submit(function(e){
                    e.preventDefault();

                    var id = $('[name="id[]"]');
                    var quantidade = $('[name="quantidade[]"]');
                    $idbulk=($('[name="idbulk"]').val());
                    $mesa_id=($('[name="mesa_id"]').val());
                    var _id = [];
                    var _quantidade=[];


                    for (var i = 0; i < id.length; i++) {
                        _id.push($(id).eq(i).val());
                        _quantidade.push($(quantidade).eq(i).val())
                        
                    }
                    //alert(JSON.stringify(p));//or alert(p)
                    //alert(_id+''+_quantidade+''+idbulk);   

                $.ajax({
                  url: "{{URL('atualizarvendatemp')}}",
                  type:'POST',
                  data: {idbulk:$idbulk,mesa_id:$mesa_id,id:_id,quantidade:_quantidade},

                  success: function(data) {
                        $('#reclatodas > tbody') .html(data);

                            //retornando total
                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                                $(".total").val(_total);

                        


                    //alert(data);


                }});


                });
            </script>

            <script type="text/javascript">
                //Atualizando o preço final do carrinho
                $(window).on('load', function() {
                 // code here

                 var total=$('[name="total[]"]')
                 var __total=[];
                 var sum=0;
                 var _total=0;

                 for (var i=0;i<total.length;i++){
                    __total=$(total).eq(i).val();
                    _total=parseFloat(__total)+parseFloat(_total);
                 }
                //alert(parseFloat(_total))
                    $(".total").val(_total);
                 });

               

            </script>

            <script type="text/javascript">
                
            $(document).ready(function(){

                $('.valor').change(function(){

                     var total=$('[name="valor[]"]')
                     var __total=[];
                     var sum=0;
                     var _total=0;

                     for (var i=0;i<total.length;i++){
                        __total=$(total).eq(i).val();
                        _total=parseFloat(__total)+parseFloat(_total);
                     }
                    //alert(parseFloat(_total))
                    $("#pago").val(_total);

                    var porpagar=$('[name="porpagar"]').val();
                    var realporpagar=parseFloat(porpagar)-parseFloat(_total);
                    if (realporpagar<=0) {
                        var troco=realporpagar;
                        var realporpagar=0;
                        $("#troco").val(troco);

                    }


                        $("#ppago").val(realporpagar);

                    });
            });
            </script>


            <script type="text/javascript">
                //add venda

                $("#credito").click(function(e){
                    e.preventDefault();
                    $mesa_id=($('[name="mesa_id"]').val());

                    window.location.replace("{{ url('vendascreditoindex',$mesa_id) }}");//here double curly bracket

                });
            </script>




            <script type="text/javascript">
                //add venda




                $("#formfvenda").submit(function(e){
                    e.preventDefault();


                    var fpagamento = $('[name="fpagamento[]"]');
                    var detalhes = $('[name="detalhes[]"]');
                    var referencia = $('[name="referencia[]"]');
                    var valor = $('[name="valor[]"]');
                    $mesa_id=($('[name="mesa_id"]').val());
                    $porpagar=($('[name="porpagar"]').val());
                    $pago=($('[name="pago"]').val());
                    $ppago=($('[name="ppago"]').val());
                    $troco=($('[name="troco"]').val());
                    var _cliente=($('[name="cliente"]').val()); 
                    var $formtype=($('[name="formtype"]').val());
                  

                    var _fpagamento = [];
                    var _detalhes=[];
                    var _referencia = [];
                    var _valor=[];


                    for (var i = 0; i < fpagamento.length; i++) {
                        _fpagamento.push($(fpagamento).eq(i).val());
                        _detalhes.push($(detalhes).eq(i).val())
                        _referencia.push($(referencia).eq(i).val());
                        _valor.push($(valor).eq(i).val())
                        
                    }


                if (confirm("Tens a certeza que pretendes Efectuar o pagamento : " + $pago + "?"))
                {   
                 
                if ($ppago==0 & $pago!=0) 
                {
                  
                
                $.ajax({
                  url: "{{URL('efectuarpagamento')}}",
                  type:'POST',
                  data: {fpagamento:_fpagamento,detalhes:_detalhes,referencia:_referencia,valor:_valor,mesa_id:$mesa_id,porpagar:$porpagar,pago:$pago,ppago:$ppago,_troco:$troco,formtype:$formtype},

                  success: function(data) {
                        //zerando os campos
                        $porpagar=($('[name="porpagar"]').val(0));
                        $pago=($('[name="pago"]').val(0));
                        $ppago=($('[name="ppago"]').val(0));
                        $troco=($('[name="troco"]').val(0));
                        var referencia = $('[name="referencia[]"]').val(0);
                        var valor = $('[name="valor[]"]').val(0);

                        $('#reclatodas > tbody') .html(data);


                            //retornando total
                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                                $(".total").val(_total);

                                swal("Pagamento Aceito com Sucesso!", "Você adicionou um pagamento", "success");



                        


                    //alert(data);


                },

                error: function(data){
                    alert("Atenção algo de errado com a sua requizição, contacte o administrador");
                }
                });
                }else{
                    swal("Valores não aceites","Verfica se o valor a pagar é igual a zerro (0) ou o valor pago é diferente de zerro (0)", "error")

                };//end if pago =0

                }//end confirmation


                });
            </script>

            <script type="text/javascript">
            $(document).on('click', '#delete',(function() {//using delegaction to send event on dynamic datatable


                    $value=$(this).data("value");
                    //alert($value);
                    console.log($value);
                if (confirm("Clique 'Ok' para continuar"))
                {
                  $.ajax({
                  url: "{{URL('apagalinha')}}",
                  type:'post',
                  data: {linha_id:$value},

                  success: function(data) {
                    $('#reclatodas > tbody') .html(data);


                            //retornando total
                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                                $(".total").val(_total);
                       


                }}
                );

                }    


                
            }));
            </script>
        
    </body>
</html>
