<?php
require_once 'functions.php';
redirect_if_not_admin(); // Or allow GM if needed

// Fetch districts
$districts = $mysqli->query("SELECT * FROM districts")->fetch_all(MYSQLI_ASSOC);

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Collect form data
    $district_id      = intval($_POST['district_id']);
    $vendor_name      = trim($_POST['vendor_name']);
    $enterprise_name  = trim($_POST['enterprise_name']);
    $contact_person   = trim($_POST['contact_person']);
    $phone            = trim($_POST['phone']);
    $email            = trim($_POST['email']);
    $business_address = trim($_POST['business_address']);
    $registered_address = trim($_POST['registered_address']);
    $years_in_business = intval($_POST['years_in_business']);
    $gst_no            = trim($_POST['gst_no']);
    $certifications    = trim($_POST['certifications']);
    $additional_observations = trim($_POST['additional_observations']);

    // 2. Insert main vendor row
    $status = 'pending'; // Default status value
    
    $stmt = $mysqli->prepare("INSERT INTO vendors (
        district_id, vendor_name, enterprise_name, contact_person, phone, email, business_address, registered_address, years_in_business, gst_no, certifications, additional_observations, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssssss", $district_id, $vendor_name, $enterprise_name, $contact_person, $phone, $email, $business_address, $registered_address, $years_in_business, $gst_no, $certifications, $additional_observations, $status);

    if ($stmt->execute()) {
        $vendor_id = $stmt->insert_id;

        // 3. Product info (single or can be looped for multiple)
        $product_name = trim($_POST['product_name']);
        $product_description = trim($_POST['product_description']);
        $categories = trim($_POST['categories']);
        $shelf_life = trim($_POST['shelf_life']);
        $production_capacity = trim($_POST['production_capacity']);
        $current_markets = trim($_POST['current_markets']);

        $stmt2 = $mysqli->prepare("INSERT INTO vendor_products (
            vendor_id, product_name, product_description, categories, shelf_life, production_capacity, current_markets
        ) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("issssss", $vendor_id, $product_name, $product_description, $categories, $shelf_life, $production_capacity, $current_markets);
        $stmt2->execute();
        $product_id = $stmt2->insert_id;

        // 4. Handle file uploads
        $upload_dir = __DIR__ . '/uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        // Product photos
        if (!empty($_FILES['product_photos']['name'][0])) {
            foreach ($_FILES['product_photos']['name'] as $i => $name) {
                if ($_FILES['product_photos']['error'][$i] == 0) {
                    $tmp = $_FILES['product_photos']['tmp_name'][$i];
                    $newname = uniqid('product_') . '_' . basename($name);
                    $path = $upload_dir . $newname;
                    if (move_uploaded_file($tmp, $path)) {
                        $stmt3 = $mysqli->prepare("INSERT INTO product_photos (product_id, file_name, drive_web_link) VALUES (?, ?, ?)");
                        $link = 'uploads/' . $newname;
                        $stmt3->bind_param("iss", $product_id, $newname, $link);
                        $stmt3->execute();
                    }
                }
            }
        }

        // Packaging photos
        if (!empty($_FILES['packaging_photos']['name'][0])) {
            foreach ($_FILES['packaging_photos']['name'] as $i => $name) {
                if ($_FILES['packaging_photos']['error'][$i] == 0) {
                    $tmp = $_FILES['packaging_photos']['tmp_name'][$i];
                    $newname = uniqid('packaging_') . '_' . basename($name);
                    $path = $upload_dir . $newname;
                    if (move_uploaded_file($tmp, $path)) {
                        $stmt4 = $mysqli->prepare("INSERT INTO product_photos (product_id, file_name, drive_web_link, is_packaging_photo) VALUES (?, ?, ?, 1)");
                        $link = 'uploads/' . $newname;
                        $stmt4->bind_param("iss", $product_id, $newname, $link);
                        $stmt4->execute();
                    }
                }
            }
        }

        $success = "Vendor and product information saved successfully!";
    } else {
        $error = "Failed to save vendor: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<head>
    <title>Vendor Entry Form</title>
    <style>
    body { font-family: Arial,sans-serif; }
    form { max-width: 700px; margin: 30px auto; padding: 24px; border: 1px solid #ccc; border-radius: 8px; }
    label { display: block; margin-top: 16px; font-weight:bold; }
    input, select, textarea { width: 100%; padding: 7px; margin-top: 4px;}
    .success {color:green;}
    .error {color:red;}
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<h2 style="text-align:center;">Vendor Entry Form</h2>
<?php if ($success): ?><div class="success"><?= $success ?></div><?php endif; ?>
<?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <label>District</label>
    <select name="district_id" required>
        <option value="">Select District</option>
        <?php foreach ($districts as $district): ?>
            <option value="<?= $district['id'] ?>"><?= htmlspecialchars($district['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Vendor Name</label>
    <input type="text" name="vendor_name" required>
    <label>Enterprise Name</label>
    <input type="text" name="enterprise_name">
    <label>Contact Person</label>
    <input type="text" name="contact_person">
    <label>Phone</label>
    <input type="text" name="phone">
    <label>Email</label>
    <input type="email" name="email">
    <label>Business Address</label>
    <input type="text" name="business_address">
    <label>Registered Address</label>
    <input type="text" name="registered_address">
    <label>Years in Business</label>
    <input type="number" name="years_in_business">
    <label>GST/Trade License No.</label>
    <input type="text" name="gst_no">
    <label>Certifications (if any)</label>
    <input type="text" name="certifications">
    <label>Additional Observations & Comments</label>
    <textarea name="additional_observations"></textarea>

    <h3>Product Details</h3>
    <label>Product Name</label>
    <input type="text" name="product_name">
    <label>Product Description</label>
    <textarea name="product_description"></textarea>
    <label>Categories (comma separated)</label>
    <input type="text" name="categories">
    <label>Shelf Life</label>
    <input type="text" name="shelf_life">
    <label>Production Capacity (Monthly)</label>
    <input type="text" name="production_capacity">
    <label>Current Markets</label>
    <input type="text" name="current_markets">

    <h3>Photographs & Samples</h3>
    <label>Product Photographs</label>
    <input type="file" name="product_photos[]" multiple accept="image/*">
    <label>Packaging Photographs</label>
    <input type="file" name="packaging_photos[]" multiple accept="image/*">

    <br><br>
    <button type="submit">Submit</button>
</form>
</body>
</html>