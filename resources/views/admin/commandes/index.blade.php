@extends('layouts.admin.app')

@section('links')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('style')
    <!-- Styles -->
    <link href="{{ asset('/css/admin/produits/style.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('admin.includes.alerts.success')
@include('admin.includes.alerts.errors')
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Commandes</h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th >Num</th>
                        <th >Prix Total</th>
						<th >status</th>
						<th >Nombre de produits</th>						
                        {{-- <th >Decription</th> --}}
						<th ></th>
					</tr>
				</thead>
				<tbody>
                    @foreach ($commandes as $commande)
                        <tr>
                            <td >{{$loop->index+1}}</td>
                            <td>
                                {{ $commande->prixTotal }}
                            </td>
                            <td>
                                @if ($commande->status==1)
                                    validé
                                @else
                                    non validé
                                @endif
                            </td>
                            <td>
                                {{ $commande->produits->count() }}
                            </td>
                            <td>
                                <a href="{{route('admin.commandes.show', $commande->id )}}" class="btn btn-success" style="color: white">details</a>
                            </td>
                        </tr>  
                    @endforeach
				</tbody>
			</table>
			<div class="clearfix">
                {{ $commandes->links() }}
			</div>
		</div>
	</div>        
</div>

@endsection

@section('script')
<script src="{{ asset('/js/admin/produits/script.js') }}" defer></script>
@endsection
