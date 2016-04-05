@extends('layouts.default')

@section('header')
      
      <span class="mdl-layout-title">{{Lang::get("general.Contact")}}</span>

@stop

@permission('view.contact')

@include('contact.filter')

@section('content')

<div class="mdl-grid demo-content">

    <div class="mdl-cell mdl-cell--12-col mdl-grid">
    
    	<table class="mdl-data-table mdl-js-data-table mdl-cell--12-col mdl-shadow--2dp">
    	  <thead>
    		<tr>
    		  	<th class="col-sm-1"><a href="{{url('/')}}/{{$filters['sort_url']['id']}}">{{Lang::get("general.id")}} <i class="fa fa-fw {{$filters['sort_icon']['id']}}"></i></a></th>
                <th><a href="{{url('/')}}/{{$filters['sort_url']['name']}}">{{Lang::get("general.name")}} <i class="fa fa-fw {{$filters['sort_icon']['name']}}"></i></th>
                <th><a href="{{url('/')}}/{{$filters['sort_url']['contact-type']}}">{{Lang::get("general.contact_type")}} <i class="fa fa-fw {{$filters['sort_icon']['contact-type']}}"></i></th>
                <th><a href="{{url('/')}}/{{$filters['sort_url']['city']}}">{{Lang::get("general.city")}} <i class="fa fa-fw {{$filters['sort_icon']['city']}}"></i></th>
                <th></th>
    		</tr>
    	  </thead>
    	  <tbody>
    	  
    	  @foreach($contacts as $contact)         
            <tr>
                <td class="mdl-data-table__cell--non-numeric">@if (!empty($contact->id)) {{$contact->id}} @endif</td>
                <td>@if (!empty($contact->name)) {{$contact->name}} @endif</td>  
                <td>@if (!empty($contact->contact_type)) {{$contact->contact_type}} @endif</td>   
                <td>@if (!empty($contact->city)) {{$contact->city}} @endif</td>   
                @permission('delete.contact|update.contact')
                <td>
                	@permission('update.contact')
                    	{!!Form::buttonLink( route('contact.edit', $contact->id) , 'primary' , 'mode_edit' , 'Editar' )!!}
                    @endpermission
                	@permission('delete.contact')
                        {!!Form::buttonLink( url('contact/destroy',$contact->id) , 'danger show-confirm-operation' , 'delete' , 'Excluir' )!!}
                    	@include('includes.confirmoperation', ['url' => url('contact/destroy',$contact->id), 'confirm' => Lang::get("general.areyousuredelete")]) 
                    @endpermission
                </td>
                @endpermission
            </tr>
        @endforeach
    		@include('includes.pagination', ['paginator' => $contacts->appends($filters['pagination'])]) 
    	  </tbody>
    	</table>
	</div>
     
</div>

@stop

@endpermission