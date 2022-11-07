<div class="wrapper row4">
<main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
    <div class="scrollable">
    <form action="<?php echo FRONT_ROOT . "Reservation/Remove" ?>" method="post" enctype="multipart/form-data">
        <table  class="customTable">
        <thead>
        <thead>              
            <tr>
                <th>Keeper</th>
                <th>Pet</th>
                <th>Start Date</th>
                <th>End Date</th>       
                <th>Price</th>
                <th>State</th>      
        
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($reservationList as $reservation)
            {
                ?>
                <tr>
                    <td><?php echo $reservation->getKeeper()->getUserName() ?></td>
                    <td><?php echo $reservation->getPet()->getName() ?></td>
                    <td><?php echo $reservation->getStartDate() ?></td>
                    <td><?php echo $reservation->getEndDate() ?></td>
                    <td><?php echo $reservation->getPrice() ?></td>
                    <td><?php echo $reservation->getState() ?></td>
                    
                    <td>
                        <?php 
                        if($reservation->getState()== 'PENDING') 
                        {
                        ?>
                        <button type="submit" name ="id" class="removeBtn" value="<?php echo $reservation->getId() ?>"> Cancel </button>
                        <?php 
                        }
                        ?>

                    </td>
                </tr>
                <?php
            }
            ?>                          
        </tbody>
        </table>
    </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
</main>
</div>

<?php 
include('footer.php');
?>