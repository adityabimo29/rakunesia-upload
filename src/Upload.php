<?php 

namespace rakunesia\FileUpload;

class Upload
{

    /**
     * @var string directory path file location
     */

    protected $directory;

    /**
     * @var string 
     */

    protected $file;

     /**
     * @var string name attriibute input file
     */

    protected $fileName;

    /**
     * @var int count file to be uploaded 
     */

     protected $totalFile;

    /**
     * @var string error alert
     */
    protected $error = '';

    /**
     * @var array list of known image types
     */
    protected $acceptedMimes = array(
        1 => 'gif', 'jpeg', 'png', 'swf', 'psd',
        'bmp', 'tiff', 'tiff', 'jpc', 'jp2', 'jpx',
        'jb2', 'swc', 'iff', 'wbmp', 'xbm', 'ico',
      );

    /**
     * @param string $directory file upload location.
     * @param string $file file to upload.
     */
    public function __construct($file, $directory, $fileName = 'rakunesia')
    {
        $this->file = $file;
        $this->directory = $directory;
        $this->fileName = $fileName;
        $this->totalFile = count($this->$file[$this->fileName]['name']);

        if (!is_dir($directory)) {
            $this->error = 'Path Directory not found or exist.';
        }
        
    }

    public function multiUpload()
    {
        for ($i = 0; $i < $this->totalFile; $i++) {
            $namaFile  =  $this->file[$this->fileName]['name'][$i];
            $lokasiTmp =  $this->file[$this->fileName]['tmp_name'][$i];
        
            # kita tambahkan uniqid() agar nama gambar bersifat unik
            $namaBaru = uniqid() . '-' . $namaFile;
            $lokasiBaru = "{$this->directory}/{$namaBaru}";
            $prosesUpload = move_uploaded_file($lokasiTmp, $lokasiBaru);
        
            # jika proses berhasil
            if ($prosesUpload) {
                echo "Upload file <a href='{$lokasiBaru}' target='_blank'>{$namaBaru}</a> berhasil. <br>";
            } else {
                echo "<span style='color: red'>Upload file {$namaFile} gagal</span> <br>";
            }
        }
    }

}