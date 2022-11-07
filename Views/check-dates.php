
<main >
    <div style="align-items:center;">
    <br>    
            <h2><?php echo $message ?></h2>
            <h1 align="center">Insert Dates </h1>
            <br>
            <form align="center" action="<?php echo FRONT_ROOT."Keeper/KeepersAvailables" ?>" method="post" enctype="multipart/form-data">
            <table class="searchTable" align="center"> 
                <thead>              
                <tr align="center">
                    <div align="center">
                     <th  ><h1 >Start Date:</h1></th>
                    </div>
                </tr>
                </thead>
                <br>
                <tbody align="center">
                <tr>
                    <td>
                        <br>
                        <input  class="date-search" type="date" name="startDate" required>
                    </td>
                </tr>
                </tbody>
                <tr align="center">
                    
                    <th ><h1 align="center" >End Date:</h1></th>
                    
                </tr>
                </thead>
                <tbody align="center">
                <tr>
                    <td>
                        <br>
                        <input class="date-search" type="date" name="endDate" required>
                        <input type="hidden" name="idPet" value="<?php echo $pet ?>" >
                    </td>
                </tr>
                </tbody>
            </table>
            <br>
            <div align="center">
    
                <input type="submit" class="btn-encriptar" value="Search"/>
            </div>
            <div>
            </form>
        </div>
    <?php /*<a class="btn-desencriptar" href="<?php echo FRONT_ROOT . "Keeper/checkAllDates"?>">  CHECK DATES</a>
    <br>*/?>

  </div>
</main>



<?php 
    include_once('footer.php');
?>