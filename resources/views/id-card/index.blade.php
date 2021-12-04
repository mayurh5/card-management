@extends('layout')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Card Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('card.create')}}"> Create New Card</a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Image</th>
        <th>Name</th>
        <th>Mobile</th>
        <th width="280px">Action</th>
    </tr>
    <tbody>
        @foreach($card_list as $key => $card)
        <tr>
            <td>{{$key+1}}</td>
            <td><img src="{{asset('images/card/'.$card->image)}}" alt="users avatar"
                    class="users-avatar-shadow media-bordered rounded-circle" height="40" width="40"
                    onerror="this.src =  'images/no-image.png';"></td>


            <td>{{$card->person_name}}</td>
            <td>
                <p>{{$card->whatsapp_number}}</p>
            </td>

            <td>
                <a href="{{route('card.create',$card->slug)}}"><i class="btn btn-primary">Edit</i></a>
                <a href="{{route('card.delete',$card->id)}}"><i class="btn btn-danger">Delete</i></a>
            </td>


        </tr>
        @endforeach

    </tbody>

</table>



@endsection