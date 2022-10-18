<?php
 include('nav-bar.php');
 require_once(VIEWS_PATH . "validate-session.php");
?>

<div id="breadcrumb" class="hoc clear"> 
    <h6 class="heading">Join Pet</h6>
</div>
</div>
<div class="wrapper row3" >
<main class="container" style="width: 95%;"> 
    <!-- main body -->
    <div class="content" > 
    <div id="comments" style="align-items:center;">
        <h2 align="center"><?php echo $pet->getName() ?></h2>
        <form align="center" action="<?php echo FRONT_ROOT."Pet/UploadImg" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;" enctype="multipart/form-data">
        <table > 
            <thead>              
            <tr>
                <th >Perfil</th>
                <th >Vaccination</th>
                



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
            </tr>
            </tbody>
        </table>
        <div>
            <button type="submit" class="btn" value="<?php echo $pet->getId() ?>" style="background-color:#DC8E47;color:white;" placeholder ="Save">save</button>
        </div>
        <div>
        </form>
    </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
</main>
</div>