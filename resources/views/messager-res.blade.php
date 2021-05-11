<?
$predate=date('Y/m/d');

foreach ($messages as $message){
    ?>

        <? if ($predate != date('Y/m/d',strtotime($message->messageOn))){
            $predate = date('Y/m/d',strtotime($message->messageOn));
            ?>
                <div class="separator"><?=$predate?></div>
        <?}?>

<?if($message->messageFrom == $_SESSION['id']){?>

<?if($message->message != null){?>
<div class="right" >
    <?=$message->message?>
    <span style="font-size: 50%;position: absolute;right: 3px;bottom: 1px"><?=date('H:i',strtotime($message->messageOn))?></span>
</div>
<?}?>
<?if($message->messageMedia != null){?>

<?
        $parts=explode(".",$message->messageMedia);

        if (in_array($parts[1],['txt','docx','pdf'])){
?>
<div>
    <a style="border: 1px solid darkgray;width: 40%;position: absolute;right: 10px;padding: 10px 10px;" href="/img/<?=$message->messageMedia?>">مشاهده فایل</a>
</div>
<br>

<?
        }else{
           ?>
<div>
    <img class="img-thumbnail" style="max-width: 50%;height: 60%;position: absolute;right: 7px;padding: 10px;object-fit: scale-down;" src="/img/<?=$message->messageMedia?>" alt="">
</div>

<br>
<br>
<br>
<br>
<br>
<br>

<?
        }

?>



<?}?>
<br>

<?}else{?>

<?if($message->message != null){?>

<div class="left" >
    <?=$message->message;?>
    <span style="font-size: 50%;position: absolute;left: 3px;bottom: 1px"><?=date('H:i',strtotime($message->messageOn))?></span>

</div>
<?}?>
<?if($message->messageMedia != null){?>

<?
$parts=explode(".",$message->messageMedia);

if (!in_array($parts[1],['png','jpg','jpeg'])){
?>
<div>
    <a style="border: 1px solid darkgray;width: 40%;position: absolute;left: 10px;padding: 10px 10px;" href="/img/<?=$message->messageMedia?>">مشاهده فایل</a>
</div>
<br>
<?
}else{
?>
<div>
    <img class="img-thumbnail" style="max-width: 50%;height: 60%;position: absolute;left: 7px;padding: 10px;object-fit: scale-down;" src="/img/<?=$message->messageMedia?>" alt="">
</div>

<br>
<br>
<br>
<br>
<br>
<br>

<?
}

?>



<?}?>
<br>
<?}?>
<br>
<?}?>
