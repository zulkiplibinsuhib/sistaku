@extends('layout')
@section('title')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
@if(Auth::user()->level == 'admin')
    <div class="col-6">
        <!-- small box -->
        <div class="small-box bg-info text-center">
            <div class="inner">
                <h3>Program Studi</h3>
                
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="prodi" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif
    <!-- ./col -->
    <div class="col-6">
    <!-- small box   -->
    <div class="small-box bg-success text-center">
        <div class="inner">
        <h3>Kelas</h3>
        </div>
        <div class="icon">
        <i class="ion ion-stats-bars"></i>
        </div>
        <a href="kelas" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-6">
    <!-- small box -->
    <div class="small-box bg-warning text-center">
        <div class="inner">
        <h3>Mata Kuliah</h3>

        </div>
        <div class="icon">
        <i class="ion ion-pie-graph"></i>
        </div>
        <a href="matkul" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    
    <div class="col-6">
    <div class="small-box bg-danger text-center">
        <div class="inner">
            <h3>Sebaran</h3>
        </div>
            <div class="icon">
        <i class="ion ion-pie-graph"></i>
        </div>
        <a href="sebaran" class="small-box-footer">  <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-6">
    <!-- small box -->
    <div class="small-box bg-orange text-center">
        <div class="inner">
        <h3>Dosen</h3>

        </div>
        <div class="icon">
        <i class="ion ion-pie-orange"></i>
        </div>
        <a href="dosen" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    
</div>
<!-- /.row -->
@endsection()
