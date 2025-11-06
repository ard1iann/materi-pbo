<?php
session_start();

// fungsi buat generate kursi acak (true = terisi, false = kosong)
function generateKursi($jumlah) {
    $kursi = [];
    for ($i = 0; $i < $jumlah; $i++) {
        $kursi[] = (bool)rand(0, 1);
    }
    return $kursi;
}

// fungsi rekursif buat cari kursi kosong
function hitungKursiKosong($kursi, $index = 0, $hasil = []) {
    if ($index >= count($kursi)) return $hasil;
    if ($kursi[$index] === false) $hasil[] = $index + 1;
    return hitungKursiKosong($kursi, $index + 1, $hasil);
}

// --- LOGIC ---
if (isset($_POST['jumlah'])) {
    $jumlah = (int)$_POST['jumlah'];
    $_SESSION['kursi'] = generateKursi($jumlah);
}

// update status kursi (AJAX)
if (isset($_POST['toggle'])) {
    $index = (int)$_POST['toggle'];
    if (isset($_SESSION['kursi'][$index])) {
        $_SESSION['kursi'][$index] = !$_SESSION['kursi'][$index];
    }
    echo json_encode($_SESSION['kursi']);
    exit;
}

// ambil data kursi dari session
$kursi = $_SESSION['kursi'] ?? [];
$kursiKosong = hitungKursiKosong($kursi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Simulasi Kursi Bioskop</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .kursi { 
            display: inline-block; width: 40px; height: 40px; 
            margin: 5px; text-align: center; line-height: 40px;
            border-radius: 8px; cursor: pointer; color: white;
            transition: 0.2s;
        }
        .kosong { background: #f44336; }
        .isi { background: #4caf50; }
        .kursi:hover { opacity: 0.8; transform: scale(1.05); }
        .wrap { margin-top: 20px; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Simulasi Kursi Bioskop</h2>
    <form method="post">
        <label>Masukkan jumlah kursi:</label>
        <input type="number" name="jumlah" min="1" required>
        <button type="submit">Generate Kursi</button>
    </form>

    <?php if (!empty($kursi)): ?>
        <div class="wrap">
            <h3>Kursi:</h3>
            <div id="kursiContainer">
                <?php foreach ($kursi as $index => $status): ?>
                    <div 
                        class="kursi <?= $status ? 'isi' : 'kosong' ?>" 
                        data-index="<?= $index ?>">
                        <?= $index + 1 ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <p><strong>Jumlah kursi kosong:</strong> <span id="jumlahKosong"><?= count($kursiKosong) ?></span></p>
            <p><strong>Nomor kursi kosong:</strong> <span id="nomorKosong"><?= empty($kursiKosong) ? 'Tidak ada' : implode(', ', $kursiKosong) ?></span></p>
        </div>
    <?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const kursiContainer = document.getElementById("kursiContainer");
    if (!kursiContainer) return;

    kursiContainer.addEventListener("click", e => {
        const target = e.target;
        if (!target.classList.contains("kursi")) return;

        const index = target.dataset.index;

        // kirim update ke server
        fetch("", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "toggle=" + index
        })
        .then(res => res.json())
        .then(data => {
            // update tampilan kursi
            const kursiKosong = [];
            kursiContainer.querySelectorAll(".kursi").forEach((div, i) => {
                if (data[i] === true) {
                    div.className = "kursi isi";
                } else {
                    div.className = "kursi kosong";
                    kursiKosong.push(i + 1);
                }
            });
            // update info
            document.getElementById("jumlahKosong").textContent = kursiKosong.length;
            document.getElementById("nomorKosong").textContent = 
                kursiKosong.length ? kursiKosong.join(", ") : "Tidak ada";
        });
    });
});
</script>
</body>
</html>
