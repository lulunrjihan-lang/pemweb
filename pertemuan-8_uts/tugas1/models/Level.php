<?php

class Level
{
    private $koneksi;

    public function __construct()
    {
        global $dbh;
        $this->koneksi = $dbh;
    }

    public function index()
    {
        return $this->koneksi->query("SELECT * FROM level ORDER BY id DESC");
    }

    public function getLevel($id)
    {
        $sql = "SELECT * FROM level WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
        return $ps->fetch(PDO::FETCH_ASSOC);
    }

    public function countStudi($levelId)
    {
        $sql = "SELECT COUNT(*) AS total FROM studi WHERE idlevel = ?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$levelId]);
        $row = $ps->fetch(PDO::FETCH_ASSOC);
        return $row ? (int) $row['total'] : 0;
    }

    public function simpan($data)
    {
        $sql = "INSERT INTO level (nama) VALUES (?)";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute($data);
    }

    public function ubah($data)
    {
        $sql = "UPDATE level SET nama=? WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute($data);
    }

    public function hapus($id)
    {
        try {
            $sql = "DELETE FROM level WHERE id=?";
            $ps = $this->koneksi->prepare($sql);
            return $ps->execute([$id]);
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                return false;
            }
            throw $e;
        }
    }
}

?>