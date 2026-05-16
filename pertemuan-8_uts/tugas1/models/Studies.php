<?php

class Studi
{
    // koneksi database
    private $koneksi;

    // constructor
    public function __construct()
    {
        global $dbh;
        $this->koneksi = $dbh;
    }

    // =========================
    // TAMPILKAN SEMUA DATA
    // =========================
    public function index()
    {
        $sql = "
            SELECT
                studi.*,
                level.nama AS jenjang
            FROM studi
            INNER JOIN level
            ON level.id = studi.idlevel
            ORDER BY studi.id DESC
        ";

        return $this->koneksi->query($sql);
    }

    public function getByLevel($levelId)
    {
        $sql = "
            SELECT
                studi.*,
                level.nama AS jenjang
            FROM studi
            INNER JOIN level
            ON level.id = studi.idlevel
            WHERE studi.idlevel = ?
            ORDER BY studi.id DESC
        ";

        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$levelId]);
        return $ps;
    }

    // =========================
    // SIMPAN DATA
    // =========================
    public function simpan($data)
    {
        $sql = "
            INSERT INTO studi
            (nama_sekolah, thn, ket, idlevel, foto)
            VALUES (?, ?, ?, ?, ?)
        ";

        $ps = $this->koneksi->prepare($sql);

        return $ps->execute($data);
    }


    // =========================
    // DETAIL DATA
    // =========================
    public function getStudi($id)
    {
        $sql = "
            SELECT
                studi.*,
                level.nama AS jenjang
            FROM studi
            INNER JOIN level
            ON level.id = studi.idlevel
            WHERE studi.id = ?
        ";

        $ps = $this->koneksi->prepare($sql);

        $ps->execute([$id]);

        return $ps->fetch(PDO::FETCH_ASSOC);
    }


    // =========================
    // UPDATE DATA
    // =========================
    public function ubah($data)
    {
        $sql = "
            UPDATE studi SET
                nama_sekolah = ?,
                thn = ?,
                ket = ?,
                idlevel = ?,
                foto = ?
            WHERE id = ?
        ";

        $ps = $this->koneksi->prepare($sql);

        return $ps->execute($data);
    }


    // =========================
    // HAPUS DATA
    // =========================
    public function hapus($id)
    {
        $sql = "DELETE FROM studi WHERE id = ?";

        $ps = $this->koneksi->prepare($sql);

        return $ps->execute([$id]);
    }


    // =========================
    // CARI DATA
    // =========================
    public function cari($keyword)
    {
        $sql = "
            SELECT
                studi.*,
                level.nama AS jenjang
            FROM studi
            INNER JOIN level
            ON level.id = studi.idlevel
            WHERE
                studi.nama_sekolah LIKE ?
                OR studi.thn LIKE ?
                OR studi.ket LIKE ?
                OR level.nama LIKE ?
            ORDER BY studi.id DESC
        ";

        $ps = $this->koneksi->prepare($sql);

        $cari = "%$keyword%";

        $ps->execute([
            $cari,
            $cari,
            $cari,
            $cari
        ]);

        return $ps;
    }
}
?>