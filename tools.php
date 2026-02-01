<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$message = '';


/*if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_type'])) {
    $type_name = $_POST['type_name'];
    $type_name_uppercase = strtoupper($type_name);
    $query = "INSERT INTO booking_types (type_name) VALUES (?)";

    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("s", $type_name_uppercase);
        if ($stmt->execute()) {
            $message = 'Booking type successfully added!';
        } else {
            $message = 'Error in adding booking type: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = 'Error in preparing statement: ' . $connection->error;
    }
}
*/
$message = '';

// Check if it's an edit or add operation
$is_edit = isset($_GET['type_id']);
$type_id = isset($_GET['type_id']) ? $_GET['type_id'] : null;

// Handle form submission
if (($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_type'])) || ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_type'])) ) {
    $type_name = $_POST['type_name'];
    $type_name_uppercase = strtoupper($type_name);

    if (isset($_POST['add_type'])) {
        // Add new booking type
        $query = "INSERT INTO booking_types (type_name) VALUES (?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $type_name_uppercase);
        if ($stmt->execute()) {
            $message = '<p style="color:green;"> Booking type successfully added!</p>';
        } else {
            $message = 'Error in adding booking type: ' . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['edit_type'])) {
        // Edit existing booking type
        if ($is_edit && isset($type_id)) {
            $query = "UPDATE booking_types SET type_name = ? WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("si", $type_name_uppercase, $type_id);
if ($stmt->execute()) {
    $message = '<p style="color:blue;">Booking type successfully updated!</p>';
    
} else {
    $message = 'Error in updating booking type: ' . $stmt->error;
}
$stmt->close();
        } else {
            $message = 'Invalid type_id or booking type does not exist!!!';
        }
    }
}

if (isset($_POST['confirmed_delete'])) {
    try {
        $type_id = $_POST['type_id'];

        $query = "DELETE FROM booking_types WHERE id = ?";

        // Prepare statement
        $stmt = $connection->prepare($query);
        if (!$stmt) {
            throw new Exception('Error in preparing statement: ' . $connection->error);
        }

        // Bind parameters
        $stmt->bind_param("i", $type_id);

        // Execute statement
        if (!$stmt->execute()) {
            throw new Exception('Error in executing statement: ' . $stmt->error);
        }

        // Success message
        $message = '<p style="color:red;">Booking type successfully deleted!</p>';

        // Close statement
        $stmt->close();
    } catch (Exception $e) {
        $message = 'Error: Cannot delete this booking type because it is referenced in other records.';
    }
}


// Fetch booking types
$query = "SELECT * FROM booking_types";
$result = mysqli_query($connection, $query);

$booking_types = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $booking_types[$row['id']] = $row; // Using 'id' as key for easier access
    }
} else {
    $message = 'Error in fetching booking types: ' . mysqli_error($connection);
}

mysqli_close($connection);
?>



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
        <li><a href="index.php"><em class="fa fa-home"></em></a></li>
            <li class="active">Tools</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <?php if (!empty($message)): ?>
                <div class="alert alert-warning" role="alert"><?php echo $message; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $is_edit ? 'Edit' : 'Add New'; ?> Booking Type</div>
                <div class="panel-body">
                    <form method="post" action="index.php?tools<?php echo $is_edit ? '&type_id=' . $type_id : ''; ?>">
                        <div class="form-group">
                            <label for="type_name">Type Name</label>
                            <input type="text" class="form-control" id="type_name" name="type_name" value="<?php echo $is_edit && isset($booking_types[$type_id]) ? $booking_types[$type_id]['type_name'] : ''; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="<?php echo $is_edit ? 'edit_type' : 'add_type'; ?>"><?php echo $is_edit ? 'Update Booking Type' : 'Add Booking Type'; ?></button>
                    </form>
                </div>
                
            </div>

            
        </div>



        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Booking Types List</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <?php foreach ($booking_types as $type): ?>
                            <li class="list-group-item">
                                <?php echo $type['type_name']; ?>
                                <form id="deleteForm" method="post" style="display: inline;">
                                    <input type="hidden" name="type_id" value="<?php echo $type['id']; ?>">
                                    <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete(<?php echo $type['id']; ?>)">Delete</button>
                                    <input type="hidden" name="confirmed_delete">
                                </form>
                                <button class="btn btn-info btn-xs" onclick="editBookingType(<?php echo $type['id']; ?>)">Edit</button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function confirmDelete(type_id) {
        if (confirm('Are you sure you want to delete this booking type?')) {
            document.querySelector('input[name="type_id"]').value = type_id;
            document.querySelector('input[name="confirmed_delete"]').value = 'true';
            document.getElementById('deleteForm').submit();
        }
    }
    function editBookingType(type_id) {
       
        window.location.href = 'index.php?tools&type_id=' + type_id;
    }
</script>

</body>
</html>
