@extends('layouts.admin')
@php
    if($experience)
           {
           $experienceText="Deneyim  Düzenleme";

       }
       else
       {
           $experienceText="Yeni Deneyim  Ekleme";

       }

@endphp
@section('title')
   {{$experienceText}}
@endsection
@section('css')
@endsection
@section('content')
    <div class="page-header">
        <h3 class="page-title"> {{$experienceText}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{('admin.index')}}">Admin Panel</a></li>
                <li class="breadcrumb-item"><a href="{{('admin.experience.list')}}">Deneyim Bilgileri Listesi </a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{$experienceText}}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" >
                    <form class="forms-sample" id="createExperienceName" method="POST" action="">
                        @csrf
                        @if($experience)
                            <input type="hidden" name="experienceID" value="{{$experience->id}}">
                        @endif
                        <div class="form-group">
                            <label for="date">Çalışma Tarihi</label>
                            <input type="text" class="form-control" name="date" id="date" placeholder="Çalışma Tarihi" value="{{ $experience ? $experience->date:''}}">
                            <small>Örneğin 2012-2017</small>
                            @error('date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="task_name">Çalıştığınız Pozisyon</label>
                            <input type="text" class="form-control" name="task_name" id="task_name" placeholder="Çalıştığınız Pozisyon" value="{{ $experience ? $experience->task_name:''}}">
                            @error('task_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_name">Çalıştığınız Firma</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Çalıştığınız Firma" value="{{ $experience ? $experience->company_name:''}}" >
                            @error('company_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="order">Görüntülenecek Deneyim Sırası</label>
                            <input type="text" class="form-control" name="order" id="order" placeholder="Görüntülenecek Deneyim Sırası" value="{{ $experience ? $experience->order:''}}" >
                            @error('order')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="description">Açıklama</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="7" placeholder="Açıklama">{{ $experience ? $experience->description:''}}</textarea>
                        </div>
<div class="form-group">

    <div class="form-check form-check-success">
        <label class="form-check-label" for="status">
<?php
            if($experience)
                {
                    $checkStatus=$experience->status ? "checked" : '';
                }
            else
                {
                    $checkStatus=0;
                }
?>

            <input type="checkbox" class="form-check-input" id="status" name="status" {{$checkStatus}}> Deneyimin Anasayfada Gösterilme Durumu</label>
    </div>
</div>
                        <div class="form-group">

                            <div class="form-check form-check-success">
                                <label class="form-check-label" for="active">
                                    <?php
                                    if($experience)
                                    {
                                        $checkActive=$experience->active ? "checked" : '';
                                    }
                                    else
                                    {
                                        $checkActive=0;
                                    }
                                    ?>

                                    <input type="checkbox" class="form-check-input" id="active" name="active" {{$checkActive}}> İlgili Pozisyonda Çalışmaya Devam Ediyor musunuz?</label>
                            </div>
                        </div>

                        <button type="button" id="createButton" class="btn btn-primary mr-2">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let createButton=$('#createButton');
        createButton.click(function()
            {
                if($('#date').val().trim()=='')
                {
                    Swal.fire({
                        icon: 'info',
                        title: 'UYARI!',
                        text: 'Lütfen Çalışma Tarihini Kontrol Ediniz!',
                        confirmButtonText:'Tamam',

                    });

                }
                else if($('#task_name').val().trim()=='')
                {
                    Swal.fire({
                        icon: 'info',
                        title: 'UYARI!',
                        text: 'Lütfen Çalıştığınız Pozisyon Bilgisini Kontrol Ediniz!',
                        confirmButtonText:'Tamam',

                    });
                }
                else if($('#company_name').val().trim()=='')
                {
                    Swal.fire({
                    icon: 'info',
                    title: 'UYARI!',
                    text: 'Lütfen Çalıştığınız Firma Bilgisini Kontrol Ediniz!',
                    confirmButtonText:'Tamam',
                });
                }
                else {
                    $('#createExperienceName').submit();
                }
            });
    </script>
@endsection
