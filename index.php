<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<style>

    .heading-data{
        text-align: center;
        margin-top: 25px;
        margin-bottom: 25px;
    }
    .click_member{
        text-align: center;
        margin-bottom: 25px;
    }
    .table{
        width: 75%;
        margin: 0 auto;
        margin-top: 50px;
    }
        
</style>

<?php 
// Start session 
session_start(); 
 
// Retrieve session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Include and initialize JSON class 
require_once 'Json.class.php'; 
$db = new Json(); 
 
// Fetch the member's data 
$members = $db->getRows(); 
 
// Get status message from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
?>

<!-- Display status message -->
<?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
<div class="col-xs-12">
    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
</div>
<?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
<div class="col-xs-12">
    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="row">
    <div class="col-md-12 head">
        <h5 class="heading-data">Data of all Members</h5>
        <!-- Add link -->
        <div class="click_member">
            <a href="addEdit.php" class="btn btn-success"><i class="plus"></i> New Member</a>
        </div>
    </div>
    
    <!-- List the users -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($members)){ $count = 0; foreach($members as $row){ $count++; ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="addEdit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">edit</a>
                    <a href="userAction.php?action_type=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');">delete</a>
                </td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="6">No member(s) found...</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>