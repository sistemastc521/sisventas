@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-dm-12 col-xs-12">
	<h3>Nuevo Venta</h3>
	@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors-> all() as $error)
					<li>
					{{$error}}
					</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
		{!!Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
<div class="row">	
<div class="col-lg-12 col-md-6 col-dm-12 col-xs-12">
	<div class="form-group">
			  <label for="nombre">Cliente</label>
             <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
              @foreach($personas as $persona)
              <option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
              @endforeach
			</select>
		</div>
</div>

<div class="col-lg-3 col-md-4 col-dm-12 col-xs-12">
	<div class="form-group">
			<label>Tipo de Comprobante</label>
			<select name="tipo_comprobante" class="form-control">
				<option value="Factura"> Factura </option>
				<option value="Boleta"> Boleta </option>
				<option value="Ticket"> Ticket </option>
			</select>
		</div>
</div>

<div class="col-lg-3 col-md-4 col-dm-12 col-xs-12">
	<div class="form-group">
			<label for="serie_comprobante">Serie Comprobante</label>
			<input type="text" name="serie_comprobante" value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie de comprobante...">
	</div>
</div>

	<div class="col-lg-3 col-md-4 col-dm-12 col-xs-12">
		<div class="form-group">
				<label for="numero_comprobante">Numero de Comprobante</label>
				<input type="text" name="numero_comprobante" required value="{{old('numero_comprobante')}}" class="form-control" placeholder="Numero de comprobante...">
		</div>
	</div>	

<div class="col-lg-3 col-md-4 col-dm-12 col-xs-12">
		<div class="form-group">
				<label for="anticipo">Anticipo</label>
				<input type="text" name="anticipo" required value="{{old('anticipo')}}" class="form-control" placeholder="Valor anticipo...">
		</div>
	</div>
</div>	

<div class="row">
<div class="panel panel-primary">
<div class="panel-body">
	
<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
	<div class="form-group">	
	<label>Articulo</label>
	<select name="pidarticulo" id="pidarticulo" class="form-control selectpicker"  data-live-search="true">
		@foreach($articulos as $articulo)
		<option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}">{{$articulo->articulo}}</option>
		@endforeach
	</select>
	</div>
	</div>	
	<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
		<div class="form-group">
		<label for="cantidad">Cantidad</label>
		<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
		<div class="form-group">
		<label for="pstock">Stock</label>
		<input type="number" disabled name="pstock" id="pstock" class="form-control" placeholder="Stock">
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
	<div class="form-group">
		<label for="impuesto">impuesto</label>
			<select name="impuesto" id="piimpuesto" class="form-control">
			@foreach($impuestos as $impuesto)
			<option value= "{{$impuesto->porcentaje}}">{{$impuesto->descripccion}}</option>
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
		<div class="form-group">
		<label for="precio_venta">Precio de venta</label>
		<input type="number" min="0.01" step="0.01" max="2500" disabled name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="precio de venta">
		</div>
	</div>

	<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
		<div class="form-group">
		<label for="descuento">Descuento</label>
		<input type="number" name="pdescuento" id="pdescuento" class="form-control" placeholder="Descuento">
			</div>
	</div>

	
	<div class="col-lg-2 col-md-2 col-dm-12 col-xs-12">
		<div class="form-group">
		<button class="btn btn-primary" type="button"  id="bt_agregar" onclick="agregar()">Agregar</button>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-dm-12 col-xs-12">
		  <div class="table-responsive">
		<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
			<thead style="background-color:#caf5a9">
			<th>Opcciones</th>
			<th>Articulo</th>
			<th>Cantidad</th>
			<th>impuesto</th>
			<th>Precio Venta</th>
			<th>Descuento</th>
			<th>Subtotal</th>
		</thead>
			<tfoot>
				<th>Total</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th><h4 id="total">$/. 0.00</h4> <input type="hidden" name="total_venta" id="total_venta">
				</th>
			</tfoot>
		<tbody></tbody>
		</table>
		</div>
	</div>
	</div>
	</div>
		<div class="col-lg-6 col-md-6 col-dm-6 col-xs-12" id="guardar">
					<div class="form-group">
				<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
						<button class="btn btn-primary"  type="submit">Guardar</button>
						<button class="btn btn-danger" type="reset">Cancelar</button>
					</div>
				</div>
		</div>
   		{!!Form::close()!!}  
         @push ('scripts')
		<script>
		var total=0;
		cont=0;
		total=0;
		subtotal=[];
		$("#guardar").hide();
		$("#pidarticulo").change(mostrarValores);



		function mostrarValores()
		{
			datosArticulo=document.getElementById('pidarticulo').value.split('_');
			
			$("#pprecio_venta").val(datosArticulo[2]);
			$("#pstock").val(datosArticulo[1]);
		}


function agregar()
		{
			idarticulo=$("#pidarticulo").val();
			articulo=$("#pidarticulo option:selected").text();
			cantidad=$("#pcantidad").val();
			impuesto=$("#piimpuesto option:selected").val(); 
			precio_compra=$("#pprecio_compra").val();
			precio_venta=$("#pprecio_venta").val();
			  if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_venta!="")
		{
		subtotal[cont]=(cantidad*precio_compra);
		total=total+subtotal[cont];
		var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input name="impuesto[]" value="'+impuesto+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number"name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';
		cont++;
		limpiar();
		    $('#total').html("$/ " + total);
		evaluar();
		  $('#detalles').append(fila);
		
		}
	else
	{
		alert("Error al ingresar el detalle del articulo, revise los datos del articulo");
	}
		}


	function limpiar()
			 {
			    $("#pcantidad").val("");
				//$("#pprecio_compra").val("");
				$("#pprecio_venta").val("");
			 }

function evaluar()
	{
		if(total>0)
		{
			$("#guardar").show();
		}
		else
		{
			$("#guardar").hide();
		}	
	}
	function eliminar(index){
	total=total+subtotal[index];
	$('#total').html("$/. "+total);
	$('#fila'+index).remove();
	evaluar();
		}
</script>
@endpush
@endsection
