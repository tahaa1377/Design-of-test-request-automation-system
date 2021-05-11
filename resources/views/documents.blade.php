@extends('main')

@section('section')

    <br>
    <a href="/amar" type="button" class="btn btn-dark fonting" style="float: left;margin-left: 10%">بازگشت</a>
    <br>
    <br>
    <div class="fonting">

    <? foreach ($documents as $document){ ?>

    <?
    $parts=explode(".",$document->messageMedia);
    if (!in_array($parts[1],['png','jpg','jpeg'])){
    ?>
    <div>
        <a style="border: 1px solid darkgray;width: 50%;padding: 10px 100px;" href="/img/<?=$document->messageMedia?>">مشاهده فایل</a>
    </div>
    <br>
    <?
    }else{
    ?>
    <div>
        <img style="max-width: 50%;padding: 10px;object-fit: scale-down;" src="/img/<?=$document->messageMedia?>" alt="">
    </div>
        <br>
        </div>
    <?}?>

    <?}?>

@endsection