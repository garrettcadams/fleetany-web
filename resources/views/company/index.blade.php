@extends('layouts.default')
@extends('layouts.table')


@section("title")
<h1>{{Lang::get("general.States")}}</h1>
@stop

@section("sub-title")
{{Lang::get("general.Companies")}}
@stop

@section('breadcrumbs', Breadcrumbs::render('company'))

@permission('create.company') 
@section('actions')
{!!Form::actions(array('new' => route("company.create")))!!}
@stop
@endpermission

@section('table')
@permission('view.company')  
@if (count($companies) > 0)

<form method="get" id="search">

<div class="form-group col-sm-10">
<select name="paginate">
	<option @if ($filters['paginate'] == 10) selected @endif value="10">10</option>
	<option @if ($filters['paginate'] == 25) selected @endif value="25">25</option>
	<option @if ($filters['paginate'] == 50) selected @endif value="50">50</option>
	<option @if ($filters['paginate'] == 100) selected @endif value="100">100</option>
</select>
{{Lang::get("general.resultsperpage")}}
</div>

<input type="submit" value="Pesquisar" />
<input type="hidden" name="sort" value="{{$filters['sort']}}-{{$filters['order']}}" />

<table class='table table-striped table-bordered table-hover'>
    <thead>
        <tr>
            <th class="col-sm-1"><a href="{{url('/')}}/{{$filters['sort_url']['id']}}">{{Lang::get("general.id")}} <i class="fa fa-fw {{$filters['sort_icon']['id']}}"></i></a></th>
            <th><a href="{{url('/')}}/{{$filters['sort_url']['contact-id']}}">{{Lang::get("general.contact_id")}} <i class="fa fa-fw {{$filters['sort_icon']['contact-id']}}"></i></th>
            <th><a href="{{url('/')}}/{{$filters['sort_url']['name']}}">{{Lang::get("general.name")}} <i class="fa fa-fw {{$filters['sort_icon']['name']}}"></i></th>
            <th><a href="{{url('/')}}/{{$filters['sort_url']['measure-units']}}">{{Lang::get("general.measure_units")}} <i class="fa fa-fw {{$filters['sort_icon']['measure-units']}}"></i></th>
            <th><a href="{{url('/')}}/{{$filters['sort_url']['api-token']}}">{{Lang::get("general.api_token")}} <i class="fa fa-fw {{$filters['sort_icon']['api-token']}}"></i></th>
            @permission('delete.company|update.company')
            <th class="col-sm-1">{{Lang::get("general.Actions")}}</th>
            @endpermission
        </tr>
        
        <tr>
            <th>
            	<div class="form-group col-sm-10">
                </div>
            </th>
            <th>
            	<div class="form-group col-sm-10">
                  <input type="search" class="form-control" name="contact-id" value="{{$filters['contact-id']}}" placeholder='{{Lang::get("general.contact_id")}}'>
                </div>
            </th>    
            <th>
            	<div class="form-group col-sm-10">
                  <input type="search" class="form-control" name="name" value="{{$filters['name']}}" placeholder='{{Lang::get("general.name")}}'>
                </div>
            </th>    
            <th>
            	<div class="form-group col-sm-10">
                  <input type="search" class="form-control" name="measure-units" value="{{$filters['measure-units']}}" placeholder='{{Lang::get("general.measure_units")}}'>
                </div>
            </th> 
            <th>
            	<div class="form-group col-sm-10">
                  <input type="search" class="form-control" name="api-token" value="{{$filters['api-token']}}" placeholder='{{Lang::get("general.api_token")}}'>
                </div>
            </th> 
            @permission('delete.company|update.company')
            <th>
            	<div class="form-group col-sm-10">
                </div>
            </th>
            @endpermission
        </tr>
    </thead>
    @foreach($companies as $company) 
        <tr>
            <td>{{$company->id}}</td>
            <td>{{$company->contact_id}}</td>  
            <td>{{$company->name}}</td>  
            <td>{{$company->measure_units}}</td>   
            <td>{{$company->api_token}}</td>   
            @permission('delete.company|update.company')
            <td>
            	@permission('update.company')
                	{!!Form::buttonLink( route('company.edit', $company->id) , 'primary' , 'pencil' , 'Editar' )!!}
                @endpermission
            	@permission('delete.company')
            		@if ($company->id != 1)
                        {!!Form::buttonLink( url('company/destroy',$company->id) , 'danger' , 'trash' , 'Excluir' )!!}
                	@endif
                @endpermission
            </td>
            @endpermission
        </tr>
    @endforeach
</table>
</form>
{!! $companies->appends($filters)->links() !!}

@else
<div class="alert alert-info">
    {{Lang::get("general.norecordsfound")}}
</div>
@endif
@else
<div class="alert alert-info">
	{{Lang::get("general.acessdenied")}}
</div>
@endpermission
                           
@stop

@section("script")

$(document).ready(function(){
    $(document).on('submit', '.delete-form', function(){
        return confirm("{{Lang::get("general.areyousure")}}");
    });
});

@stop