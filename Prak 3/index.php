<?php
// Array untuk menyimpan semua pesan error
$errors = [];

// Variabel untuk menyimpan nilai input
$name = $gender = $email = $address = $postalCode = "";

// Mengecek apakah form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $errors['name'] = "Nama tidak boleh kosong.";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["gender"])) {
        $errors['gender'] = "Jenis kelamin harus dipilih.";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["email"])) {
        $errors['email'] = "Email tidak boleh kosong.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid.";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["address"])) {
        $errors['address'] = "Alamat tidak boleh kosong.";
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["postalCode"])) {
        $errors['postalCode'] = "Kode pos tidak boleh kosong.";
    } elseif (!preg_match("/^\d{5}$/", $_POST["postalCode"])) {
        $errors['postalCode'] = "Kode pos harus 5 digit angka.";
    } else {
        $postalCode = test_input($_POST["postalCode"]);
    }

    // Jika tidak ada error, tampilkan pesan sukses
    if (empty($errors)) {
        echo "<script>alert('Form berhasil di-submit!');</script>";
    }
}

// Fungsi untuk membersihkan input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Validation with Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="d-flex justify-content-center align-items-center bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Form Validasi</h1>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
                            <!-- Nama -->
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" placeholder="Nama lengkap" required />
                                <div class="invalid-feedback"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="mb-3">
                                <label class="form-label" for="gender">Jenis Kelamin</label>
                                <select id="gender" name="gender" class="form-select <?php echo isset($errors['gender']) ? 'is-invalid' : ''; ?>" required>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="male" <?php if ($gender == "male") echo "selected"; ?>>Laki-laki</option>
                                    <option value="female" <?php if ($gender == "female") echo "selected"; ?>>Perempuan</option>
                                </select>
                                <div class="invalid-feedback"><?php echo isset($errors['gender']) ? $errors['gender'] : ''; ?></div>
                            </div>
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo $email; ?>" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" placeholder="Alamat email" required />
                                <div class="invalid-feedback"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></div>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label class="form-label" for="address">Alamat</label>
                                <textarea id="address" name="address" class="form-control <?php echo isset($errors['address']) ? 'is-invalid' : ''; ?>" placeholder="Alamat lengkap" required><?php echo $address; ?></textarea>
                                <div class="invalid-feedback"><?php echo isset($errors['address']) ? $errors['address'] : ''; ?></div>
                            </div>

                            <!-- Kode Pos -->
                            <div class="mb-3">
                                <label class="form-label" for="postalCode">Kode Pos</label>
                                <input type="text" id="postalCode" name="postalCode" value="<?php echo $postalCode; ?>" class="form-control <?php echo isset($errors['postalCode']) ? 'is-invalid' : ''; ?>" placeholder="Masukkan kode pos (5 digit)" required />
                                <div class="invalid-feedback"><?php echo isset($errors['postalCode']) ? $errors['postalCode'] : ''; ?></div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>