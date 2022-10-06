<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<style>

    .heading-addMember{
        margin-top: 25px;
        margin-bottom: 25px;
    }
    .custom-row{
        margin-left: 25px;
    }

    

</style>

<?php 
// Start session 
session_start(); 
 
// Retrieve session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Get member data 
$memberData = $userData = array(); 
if(!empty($_GET['id'])){ 
    // Include and initialize JSON class 
    include 'Json.class.php'; 
    $db = new Json(); 
     
    // Fetch the member data 
    $memberData = $db->getSingle($_GET['id']); 
} 
$userData = !empty($sessData['userData'])?$sessData['userData']:$memberData; 
unset($_SESSION['sessData']['userData']); 
 
$actionLabel = !empty($_GET['id'])?'Edit':'Add'; 
 
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

<div class="row custom-row">
    <div class="col-md-12">
        <h2 class="heading-addMember"><?php echo $actionLabel; ?> Member</h2>
    </div>
    <div class="col-md-6">
         <form method="post" action="userAction.php" class="custom-email">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control email-custom" name="name" placeholder="Enter your name" value="<?php echo !empty($userData['name'])?$userData['name']:''; ?>" required="">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php echo !empty($userData['email'])?$userData['email']:''; ?>" required="">
            </div>
            
            <a href="index.php" class="btn btn-secondary">Back</a>
            <input type="hidden" name="id" value="<?php echo !empty($memberData['id'])?$memberData['id']:''; ?>">
            <input type="submit" name="userSubmit" class="btn btn-success" value="Submit">
        </form>
    </div>
</div>