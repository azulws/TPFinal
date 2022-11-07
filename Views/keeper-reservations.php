<div class="wrapper row4">
<main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
    <div class="scrollable">
    <form action="<?php echo FRONT_ROOT . "Reservation/Confirm" ?>" method="post" enctype="multipart/form-data">
        <h2>PENDING RESERVATIONS</h2>
        <table  class="customTable">
        <thead>
        <thead>              
            <tr>
                <th><h3>Owner</h3></th>
                <th><h3>Pet</h3></th>
                <th><h3>Start Date</h3></th>
                <th><h3>End Date</h3></th>       
                <th><h3>Price</h3></th>
                <th><h3>Action</h3></th>      

        
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($reservationList as $reservation)
            {
                if($reservation->getState()== "PENDING"){
                ?>
                <tr>
                    <td><?php echo $reservation->getPet()->getOwner()->getUserName() ?></td>
                    <td><?php echo $reservation->getPet()->getName()."--".$reservation->getPet()->getPetType()->getBreed()."--".$reservation->getPet()->getSize() ?></td>
                    <td><?php echo $reservation->getStartDate() ?></td>
                    <td><?php echo $reservation->getEndDate() ?></td>
                    <td><?php echo $reservation->getPrice() ?></td>
                    <td>
                        <input  type="radio" name="state" value="CANCELED">CANCEL
                        <input  type="radio" name="state" value="ACCEPTED">ACCEPT
                    </td>
                    
                    <td>
                        
                        <button type="submit" name ="id" class="removeBtn" value="<?php echo $reservation->getId() ?>"> GO </button>
                        

                    </td>
                </tr>
                <?php
                }
            }
            ?>                          
        </tbody>
        </table>
        <br>
        <br>
        <br>
        <div>
        <h2>RECORD RESERVATIONS</h2>   
        <table  class="customTable">
        <thead>
        <thead>              
            <tr>
                <th><h3>Owner</h3></th>
                <th><h3>Pet</h3></th>
                <th><h3>Start Date</h3></th>
                <th><h3>End Date</h3></th>       
                <th><h3>Price</h3></th>
                <th><h3>State</h3></th>      

        
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($reservationList as $reservation)
            {
                if($reservation->getState()!= "PENDING"){
                ?>
                <tr>
                    <td><?php echo $reservation->getPet()->getOwner()->getUserName() ?></td>
                    <td><?php echo $reservation->getPet()->getName()."--".$reservation->getPet()->getPetType()->getBreed()."--".$reservation->getPet()->getSize()  ?></td>
                    <td><?php echo $reservation->getStartDate() ?></td>
                    <td><?php echo $reservation->getEndDate() ?></td>
                    <td><?php echo $reservation->getPrice() ?></td>
                    <td><?php echo $reservation->getState() ?>  </td>

                            
                </tr>
                <?php
                } 
            }
            ?>                          
        </tbody>
        </table>
        </div>
    </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
</main>
</div>

<?php 
include('footer.php');
?>