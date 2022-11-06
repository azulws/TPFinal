<div class="wrapper row4">
<main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
    <div class="scrollable">
        <table style="text-align:center;">
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

                <tr>
                    <td><?php echo $keeper->getUserName() ?></td>
                    <td><?php echo $pet->getName() ?></td>
                    <td><?php echo $reservation->getStartDate() ?></td>
                    <td><?php echo $reservation->getEndDate() ?></td>
                    <td><?php echo $reservation->getPrice() ?></td>
                    <td><?php echo $reservation->getState() ?></td>
        
                </tr>
                
                                        
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