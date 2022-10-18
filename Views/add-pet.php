
<div> 
    <h1>Join Pet</h1>
</div>


<main class="main" style="width: 95%;"> 
    <!-- main body -->
     
    <div style="align-items:center;">
        <h2 align="center">Ingresar Datos</h2>
        <form align="center" action="<?php echo FRONT_ROOT."Pet/Add" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;" enctype="multipart/form-data">
        <table align="center"> 
            <thead>              
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>PetType</th>



            </tr>
            </thead>
            <tbody align="center">
            <tr>
                <td style="max-width: 120px;">
                <input type="text" name="name" size="22" min="0" required>
                </td>
                <td>
                <input type="text" name="description" required>
                </td>                
                <td>
                <div class="box" style="top:40%">    
                <select name="petType" id="petType" class="select">
                    <?php
                        /*$petTypeDAO = new PetTypeDAO();
                        $petTypeList = $petTypeDAO->GetAll();
                        var_dump($petTypeList);*/
                        foreach($petTypeList as $petType) {
                        echo "<option value=". $petType->getId() .">
                        ". $petType->getSize(). "
                        </option>";
                        }
                    ?>
                </select>
                </div>
            </tr>
            </tbody>
        </table>
        <div>
       
            <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;"/>
        </div>
        
        </form>
    </div>
    
    <!-- / main body -->
    <div class="clear"></div>
</main>

<?php
echo "<script> alert('agregado con exito')";
  echo "window.location: '../home.php';</script>";
?>


<?php 
    include_once('footer.php');
?>
  