@extends('master')
<?php
$namePage = 'User';
$type_page = 'user';
?>
@section('title')
    {{$namePage}}
@endsection
@section('custom-css')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <?php
                if($message) {
                    echo "<h2>$message</h2>";
                }else {


            ?>
            <div class="col-12 section-title">

                <h3 class="title">Your account</h3>
            </div>
            <div class="row form-user">

                <label class="c-field__label col-4">Email Address: </label>
                <div class="col-8"><strong>{{ Auth::user()->email }}</strong></div>

                <label class="c-field__label col-4">Name: </label>
                <div class="col-8"><strong>{{ Auth::user()->name }}</strong></div>

            </div>
            <?php }?>
        </div>
    </div>
@endsection
