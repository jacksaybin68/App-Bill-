<?php
header('Content-Type: application/json');

class Stats 
{
    private $file = '/public/cache/stats.json';

    public function __construct() 
    {
        $this->file = $_SERVER['DOCUMENT_ROOT'].$this->file;
    }
    
    /**
     * Method load
     *
     * @return string
     */
    public function load() 
    {
        if (file_exists($this->file)) 
        {
            $data = file_get_contents($this->file);
            return json_decode($data, true);
        }
        return null;
    }
    
    /**
     * Method save
     *
     * @param $data $data 
     *
     * @return void
     */
    public function save($data) 
    {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }
    public function updateData($data) 
    {
        if ($data['last_update'] != date('Y-m-d')) 
        {
            $data['mbbank'] += rand(100, 300);
            $data['vietcombank'] += rand(80, 300);
            $data['techcombank'] += rand(100, 300);
            $data['acb'] += rand(50, 200);
            $data['vietinbank'] += rand(50, 120);
            $data['msbbank'] += rand(10, 70);
            $data['tpbank'] += rand(10, 70);
            $data['zalopay'] += rand(10, 70);
            $data['agribank'] += rand(10, 70);
            $data['last_update'] = date('Y-m-d');
            $this->save($data);
        }
        return $data;
    }
    
    /**
     * Method update
     *
     * @return mixed
     */
    public function update() 
    {
        $data = $this->load();
        if ($data === null) 
        {
            $data = 
            [
                'mbbank' => 21623,
                'vietcombank' => 15351,
                'techcombank' => 16000,
                'acb' => 12351,
                'vietinbank' => 17021,
                'msbbank' => 10300,
                'tpbank' => 5500,
                'zalopay' => 1300,
                'agribank' => 3300,
                'last_update' => date('Y-m-d')
            ];
            $this->save($data);
        }
        return $this->updateData($data);
    }
}
$Stats = new Stats();
$stats = $Stats->update();
echo json_encode([
    'r' => [
    'mb' => $stats['mbbank'],
    'vcb' => $stats['vietcombank'],
    'tcb' => $stats['techcombank'],
    'acb' => $stats['acb'],
    'ctg' => $stats['vietinbank'],
    'msb' => $stats['msbbank'],
    'tp' => $stats['tpbank'],
    'zalopay' => $stats['zalopay'],
    'agribank' => $stats['agribank'],
]]);
