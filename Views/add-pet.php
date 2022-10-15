<?php 
    include_once('header.php');
    //include_once('nav-bar.php');
    use DAO\PetTypeDAO;
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
        <h2>Ingresar Datos</h2>
        <form action="<?php echo FRONT_ROOT."Pet/Add" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
        <table> 
            <thead>              
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>PetType</th>
                <th>Owner</th>


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
                <select name="petType" id="petType" class="select">
                    <?php
                        $petTypeDAO = new PetTypeDAO();
                        $petTypeList = $petTypeDAO->GetAll();
                        var_dump($petTypeList);

                        foreach($petTypeList as $petType) {
                        echo "<option value=". $petType->getId() .">
                        ". $petType->getSize(). "
                        </option>";
                        }
                    ?>
                </select>
                </td> 
                <td>
                 
                <input type="text" name="description" value ="
                <?php 

                foreach($_SESSION["loggedUser"] as $index => $value)
                {
                    {
                        
                        $owner = $value['userName'];
                    }
                }
                var_dump($owner);
                ?> 
                
                "  required>
                
                </td>  
                
                    
            </tr>
            </tbody>
        </table>
        <div>
       
            <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;"/>
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
echo "<script> alert('agregado con exito')";
  echo "window.location: '../home.php';</script>";
?>


<?php 
    include_once('footer.php');
?>
  