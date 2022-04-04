@extends('layouts.front')

@section('content')

<div class="discount" id="discount">
    <div class="image">
        <div class="content">
            <h2>We have A DISCOUNT</h2>
            <p>Lorem ipsum is placeholder text commonly used
                in the graphic, print, and publishing industries for previewing layouts and visual mockups.
            </p>
            <img src="front/images/video/discount.png" alt="">
        </div>
    </div>
    <div class="form">
        <div class="content">
            <x-flash-message />

            <h2>Request A Discount</h2>
                <style>
                    .alert {
                    padding: 15px;
                    margin-bottom: 20px;
                    border: 1px solid transparent;
                    border-radius: 4px;
                    }
                    .alert-success {
                    background-color: #dff0d8;
                    border-color: #d6e9c6;
                    color: #3c763d;
                    }
                    .alert-danger {
                    background-color: #f2dede;
                    border-color: #ebccd1;
                    color: #a94442;
                    }
                </style>

            <form action="{{ route('discount.store') }}" id="discount_form" enctype="multipart/form-data">
                {{-- @csrf --}}
                <input type="hidden" id="token" value="{{ @csrf_token() }}">
                <div id="res" ></div>
                <br>
                <x-form.input class="input" type="text" placeholder="Your Name" id="name" name="name" value="" />
                <x-form.input class="input" type="email" placeholder="Your Email" id="email" name="email" value=""/>
                <x-form.input class="input" type="text" placeholder="Your Mobile" id="mobile" name="mobile" value=""/>
                <x-form.textarea name="Details" class="input" id="Details"  placeholder="Tell us about your needs" value=""></x-form.textarea>
                <button type="submit" id="#btn" {{--onclick="event.preventDefault(); document.getElementById('discount_form').submit();"--}}>Send</button>

            </form>
            <script src="{{ asset('js/jquery-3.5.0.min.js') }}"></script>
            <script>
                $(document).ready(function(){
                    $('#discount_form').submit(function(e){
                        e.preventDefault();
                        let url=$(this).attr('action');
                        var form =this;
                        //alert(url);
                        $.post(url,{
                            '_token': $('#token').val(),
                            'name': $('#name').val(),
                            'email' : $('#email').val(),
                            'mobile' : $('#mobile').val(),
                            'Details' : $('#Details').val()
                        }, function(response){
                            //console.log(response);
                            if(response.code == 400){
                            $("#btn").attr('disabled', false);
                            let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                            $("#res").html(error);
                        }else if(response.code == 200){
                            $(form)[0].reset();
                            $("#btn").attr('disabled', false);
                            let success = '<span class="alert alert-success">'+response.msg.+'</span>';
                            $("#res").html(success);
                        }
                        });
                    })
                })





            </script>
        </div>
    </div>

</div>

@endsection

