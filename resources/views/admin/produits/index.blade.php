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
						<h2>Produits</h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter</span></a>
						<a href="#deleteProduits" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Supprimer</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th >Num</th>
                        <th >Image</th>
						<th >Type</th>
						<th >Catégorie</th>
                        <th >Marque</th>
						<th >QuantiteStock</th>
						<th >Prix</th>						
                        {{-- <th >Decription</th> --}}
						<th ></th>
					</tr>
				</thead>
				<tbody>
                    @foreach ($produits as $produit)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox{{$loop->index+1}}" name="options[]" form="form1" value="{{ $produit->id }}">
                                    <label for="checkbox{{$loop->index+1}}"></label>
                                </span>
                            </td>
                            <td >{{$loop->index+1}}</td>
                            <td>
                                <img src="{{asset($produit->image)}}" alt="" style="max-width:50px;">
                            </td>
                            <td>
                                {{ $produit->sousCategorie->name }}
                            </td>
                            <td>
                                {{ $produit->sousCategorie->Categorie->name }}
                            </td>
                            <td>
                                {{ $produit->marque }}
                            </td>
                            <td> 
                                {{ $produit->Qstock }} 
                            </td>
                            <td> 
                                {{ $produit->prix }} 
                            </td>
                            <td>
                                <a href="#edit{{ $produit->id }}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i></a>
                                <a href="#delete{{ $produit->id }}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i></a>
                            </td>
                        </tr>  
                    @endforeach
				</tbody>
			</table>
			<div class="clearfix">
                {{ $produits->links() }}
			</div>
		</div>
	</div>        
</div>

<!-- add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('admin.produits.store')}}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Ajouter produit</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
                    <div class="form-group">
                        <label for="type">type</label>
                        <select class="form-control" id="type" name="sousCategorie">
                            @foreach ($categories as $categorie)
                                <optgroup label=" {{ $categorie->name }} ">
                                    @foreach ($categorie->sousCategories as $sousCategorie)
                                        <option value="{{ $sousCategorie->id }}">
                                            {{ $sousCategorie->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="designation" required></textarea>
					</div>
                    <div class="form-group">
						<label>Marque</label>
						<input type="text" class="form-control" name="marque" required>
					</div>
					<div class="form-group">
						<label>QuantiteStock</label>
						<input type="number" class="form-control" name="Qstock" required>
					</div>					
					<div class="form-group">
						<label>Prix</label>
						<input type="number" class="form-control" name="prix" required>
					</div>										
					<div class="form-group">
						<label>Image</label>
						<input type="file" id="avatar" name="image" accept="image/png, image/jpeg" > <br>
					</div>										
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Edit Modal HTML -->
@foreach ($produits as $produit)
    <div id="edit{{ $produit->id }}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.produits.update', $produit->id)}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">						
                        <h4 class="modal-title">Modifier Produit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">					
                        <div class="form-group">
                            <label for="type">type</label>
                            <select class="form-control" id="type" name="sousCategorie">
                                @foreach ($categories as $categorie)
                                    <optgroup label=" {{ $categorie->name }} ">
                                        @foreach ($categorie->sousCategories as $sousCategorie)
                                            <option value="{{ $sousCategorie->id }}">
                                                {{ $sousCategorie->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="designation" required>{{$produit->designation}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Marque</label>
                            <input type="text" class="form-control" name="marque" value="{{ $produit->marque }}" required>
                        </div>
                        <div class="form-group">
                            <label>QuantiteStock</label>
                            <input type="number" class="form-control" name="Qstock" value="{{ $produit->Qstock }}" required>
                        </div>					
                        <div class="form-group">
                            <label>Prix</label>
                            <input type="number" class="form-control" value="{{ $produit->prix }}" name="prix" required>
                        </div>										
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" id="avatar" name="image" accept="image/png, image/jpeg" > <br>
                        </div>					
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                        <input type="submit" class="btn btn-info" value="Enregistrer">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- Delete Modal HTML -->
@foreach ($produits as $produit)
    <div id="delete{{ $produit->id }}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.produits.delete', $produit->id)}}"
                    method="POST">
                    @csrf
                    <div class="modal-header">						
                        <h4 class="modal-title">Supprimer Prpduit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">					
                        <p>Vous êtes sûr de supprimer ce produit ?</p>
                        <p class="text-warning"><small>Cette action est irreverssible</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                        <input type="submit" class="btn btn-danger" value="Supprimer">
                    </div>
                </form>
            </div>
        </div>
    </div> 
@endforeach

<!-- Delete Modal HTML -->
<div id="deleteProduits" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.produits.delete.groupe')}}"
                method="POST" id="form1">
                @csrf
                <div class="modal-header">						
                    <h4 class="modal-title">Supprimer Prpduit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                    <p>Vous êtes sûr de supprimer ce produit ?</p>
                    <p class="text-warning"><small>Cette action est irreverssible</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                    <input type="submit" class="btn btn-danger" value="Supprimer">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('/js/admin/produits/script.js') }}" defer></script>
@endsection
