@extends('layouts.master')
@section('title','Own Creation')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Own CreationS</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>Own Creation</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<!-- Main Content Wrapper Start -->
<div id="content" class="main-content-wrapper bg-image">

    <div class="container">
        <div class="row ptb--40 ptb-md--30 ptb-sm--20">

            <div id="canvas-wrapper" class="editor-area">
                <div class="canvas-bg-wrapper">
                    <img class="canvas-bg" alt=""
                        src="https://drive.google.com/uc?export=view&id=0B3ubyt3iIvkaUlpHVEpDTGhjQzg">
                    <canvas width="260" height="360" id="c"></canvas>
                </div>
            </div>

            <div class="controls ">

                <input class="inputfile " type="file" id="imgLoader">

                <input type="file" name="file" id="file" class="inputfile" id="imgLoader" />
                <label for="file">Choose a file</label>

                <button class="button-cla " onClick="insertText()">Add Text</button>

                <div id="textMenu" class="hideOperations">
                    <button class="button-cla " id="underline">Underline</button>
                    <input type="range" min="5" max="150" value="40" id="size">
                    <input type="range" min="0.1" max="5" value="0.1" id="height">
                    <input type="color" id="color">
                    <input type="color" id="bg-color">
                    <button class="button-cla " id="italic">Italic</button>
                    <button class="button-cla " id="centered">Center</button>
                    <button class="button-cla " id="left">Left</button>
                    <button class="button-cla " id="right">Right</button>
                </div>
                <button class="button-cla " onClick="insertShape()">Insert Shape</button>
                <button class="button-cla " onClick="deleteObjects()">Alert Message</button>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Wrapper Start -->

@endsection

@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.5/fabric.min.js"></script>
<script src="{!! asset('assets/js/own-creation.js') !!}"></script>
@endsection
