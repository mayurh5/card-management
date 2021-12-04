@extends('layout')


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<style>
.img {
    height: 150px !important;
    max-height: 150px !important;
    max-width: 150px !important;
    width: 150px !important;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
  border-radius: 5px;
  color:black;
  padding: 2px 16px;
}

</style>


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="card-header">
            <h4 class="card-title text-primary">{{ isset($edit_card) ? 'Update Card' : 'Add Card' }} </h4>
        </div>
        <div class="pull-right">

        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-md-8">

            <form action="{{route('card.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <input type="hidden" name="id" value="{{ isset($edit_card) ? $edit_card->id : ''}}">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <div class="controls">
                            <label>Full Name</label>
                            <input type="text" class="form-control"
                                value="{{ isset($edit_card) ? $edit_card->person_name : ''}}" id="Pname"
                                placeholder="Full Name" required name="person_name">
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <div class="controls">
                            <label>Designation</label>
                            <input type="text" class="form-control"
                                value="{{ isset($edit_card) ? $edit_card->designation : ''}}" id="Pdesignation"
                                placeholder="Designation" required name="designation">
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <div class="controls">
                            <label>Business Name</label>
                            <input type="text" class="form-control"
                                value="{{ isset($edit_card) ? $edit_card->business_name : ''}}" id="Pbusiness_name"
                                placeholder="Business Name" required name="business_name">
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <div class="controls">
                            <label>Whatsapp Number</label>
                            <input type="text" class="form-control"
                                value="{{ isset($edit_card) ? $edit_card->whatsapp_number : ''}}"
                                placeholder="Whatsapp Number" required id="Pwhatsapp_number" name="whatsapp_number">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Profile Pic </label>
                        <input type="file" name="image" class="form-control" id="profile_pic_1"
                            accept="image/x-png, image/jpeg">

                           
                    </div>

                    <div class="col-md-6 form-group">
                        <div class="controls">
                            <label>Short Description</label>
                            <textarea type="text" class="form-control" name="short_description" rows="1"
                                cols="2">{!!  isset($edit_card) ? $edit_card->short_description : '' !!}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
                        <div class="controls">
                            <label>Address</label>
                            <textarea type="text" class="form-control" name="single_address" rows="2"
                                cols="2">{!!  isset($edit_card) ? $edit_card->single_address : '' !!}</textarea>
                        </div>
                    </div>

                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                        <button type="submit" 
                            class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                        </button>
                        <a class="btn btn-danger" href="{{ route('card.index') }}"> Back</a>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-4">

            <div class="card " style="width: 30rem; border:black;">
                <label for="image">Image</label>

               
                @if(isset($edit_card->image))
                    <div id="profile_pic_1_preview" class="image-fixed"><img src="{{asset('images/card/'.$edit_card->image)}}" alt="" style ="object-fit: cover;" height="110" width="110"></div>
                @else
                <div id="profile_pic_1_preview" class="card-img-top img"></div> 
                @endif

                <div class="card-body"><br>
                    <div><label for="person_name">Name : <span class="person_name">{{ isset($edit_card) ? $edit_card->person_name : ''}}    </span></label></div>
                    <div><label for="designation">Designation : <span class="designation">{{ isset($edit_card) ? $edit_card->designation : ''}}</span></label></div>
                    <div><label for="business_name">Business : <span class="business_name">{{ isset($edit_card) ? $edit_card->business_name : ''}}</span></label></div>
                    <div><label for="whatsapp_number">Whatsapp Number : <span class="whatsapp_number">{{ isset($edit_card) ? $edit_card->whatsapp_number : ''}}</span></label>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

<script>

$(document).ready(function() {

    $("#Pname").keypress(function() {

        $(".person_name").html($(this).val());

    });

    $("#Pdesignation").keypress(function() {

        $(".designation").html($(this).val());

    });

    $("#Pbusiness_name").keypress(function() {

        $(".business_name").html($(this).val());

    });

    $("#Pwhatsapp_number").keypress(function() {

        $(".whatsapp_number").html($(this).val());

    });

    $('#profile_pic_1').on('change', function(e) {

        if (this.files && this.files[0]) {
            var selector = $(this).attr('id');
            var allowedExtensions = /(\jpg|\jpeg|\png|\gif|\JPG|\svg)$/i;
            var ext = this.files[0].type.split('/').pop();

            $('#' + selector + '_preview').html('');
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + selector + '_preview').append('<img class="img-fluid img" style="object-fit:cover"  src="' + e.target
                    .result + '">');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });



});
</script>