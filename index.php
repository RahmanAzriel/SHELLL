<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shell</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container">
    <div class="text-center mt-5 d-flex justify-content-center">
        <div class="w-50">
            <div class="">
                <form method="post" class="border border-secondary rounded p-3">
                    <h2 class="text-center mb-3">Bengsin Shellosxyz</h2>
                    <div class="mb-3">
                        <label for="jumliter" class="form-label">Masukkan Jumlah Liter:</label>
                        <input class="form-control" name="liter" id="jumliter" type="number" required>
                    </div>
                    <div class="mb-3">
                        <label for="tbhanbkar" class="form-label">Pilih Tipe Bahan Bakar:</label>
                        <select class="form-select" name="jenis" id="tbhanbkar">
                            <option value="Shell Super">Shell Super: Rp. 15.420,00</option>
                            <option value="Shell V-Power">Shell V-Power: Rp. 16.130,00</option>
                            <option value="Shell V-Power Diesel">Shell V-Power Diesel: Rp. 18.310,00</option>
                            <option value="Shell V-Power Nitro">Shell V-Power Nitro: Rp. 16.510,00</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary w-100" type="submit" name="proses">Proses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php

class Shell
{
    private $harga;
    private $jenis;
    private $ppn;

    public function __construct($harga, $jenis, $ppn)
    {
        $this->harga = $harga;
        $this->jenis = $jenis;
        $this->ppn = $ppn;
    }

    public function getHarga()
    {
        return $this->harga;
    }

    public function getJenis()
    {
        return $this->jenis;
    }

    public function getPpn()
    {
        return $this->ppn;
    }
}

class Beli extends Shell
{
    private $jumlah;
    private $totalBayar;
    public $Literan;

    public function __construct($harga, $jenis, $ppn, $jumlah)
    {
        parent::__construct($harga, $jenis, $ppn);
        $this->jumlah = $jumlah;
        $this->totalBayar = $this->calculateTotalBayar();
    }

    private function calculateTotalBayar()
    {
        $hargaPerLiter = $this->getHarga();
        $this->Literan = $this->jumlah;
        $ppnPercentage = $this->getPpn() / 100;
        $subTotal = $hargaPerLiter * $this->Literan;
        $ppnAmount = $subTotal * $ppnPercentage;
        $totalBayar = $subTotal + $ppnAmount;
        return $totalBayar;
    }

    public function getTotalBayar()
    {
        return $this->totalBayar;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proses'])) {
    $jenis = $_POST["jenis"];
    $Literan = $_POST["liter"];

    $harga = 0;
    $ppn = 10;

    switch ($jenis) {
        case "Shell Super":
            $harga = 15420;
            break;
        case "Shell V-Power":
            $harga = 16130;
            break;
        case "Shell V-Power Diesel":
            $harga = 18310;
            break;
        case "Shell V-Power Nitro":
            $harga = 16510;
            break;
    }

    $beli = new Beli($harga, $jenis, $ppn, $Literan);
    echo "<div class = 'd-flex justify-content-center'>";
    echo "<div class='border mt-5 w-50 text-center rounded'>";
      echo "<h2 class='text-center mb-3'>Struk Hasil</h2>";
      
      echo "<p>Anda membeli bahan bakar minyak tipe" . $beli->getJenis() . "</p>";
      
      echo "<p>Dengan jumlah: " . $beli->Literan . " Liter</p> ";
      
      echo "<p>Total yang harus anda bayar: Rp. " . number_format($beli->getTotalBayar(), 2, '.', ',') . "</p>";
    echo "</div>";
    echo "</div>";
}

?>
