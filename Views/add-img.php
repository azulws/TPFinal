<?php
 require_once(VIEWS_PATH . "validate-session.php");
?>

<div > 

</div>
</div>
<div  >
<main  style="width: 95%;"> 
    <!-- main body -->
    <div class="content" > 
    <div id="comments" style="align-items:center;">
    <br>
        <h2 align="center"><?php echo $pet->getName() ?></h2>
        <form align="center" action="<?php echo FRONT_ROOT."Pet/UploadImg" ?>" method="post"  enctype="multipart/form-data">
        <br>
        <table class="customTable"> 
            <thead>              
            <tr>
                <th >Perfil</th>
                <th >Vaccination</th>
                <th >Video</th>
            </tr>
            </thead>
            <tbody align="center">
            <tr>
                <td style="max-width: 120px;">
                <input type="file" name="petImg" >
                </td>
                <td style="max-width: 120px;">
                <input type="file" name="vaccination" >
                </td> 
                <td style="max-width: 120px;">
                <input type="file" name="video" >
                </td>
                <input type="hidden" name="id" value="<?php echo $pet->getId() ?>">
            </tr>
            </tbody>
        </table>
        <br>
        <br>
        <div align="center">
            <button type="submit" class="btn-encriptar" name="id" value="<?php echo $pet->getId() ?>"  placeholder ="Save">save</button>
        </div>
        <div>
        </form>
    </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
</main>
</div>

<?php 
    include_once('footer.php');
?>