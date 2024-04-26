<?php

if (isset($_POST['player'])) {
    $playerToSearch = $_POST['player'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://www.tibia.com/community/?name=Cheff%2BRodolph',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    die("ta aqui");

    $response = file_get_contents($url);

    $dom = new DOMDocument();
    @$dom->loadHTML($response);
    $xpath = new DOMXPath($dom);

    // Encontrando a última morte
    $deathTable = $xpath->query("//div[@class='TableContainer']//table[@class='TableContent']")->item(0);
    $lastDeathRow = $xpath->query(".//tr", $deathTable)->item(1); // Primeira linha é o cabeçalho
    $lastDeathDate = $xpath->query(".//td", $lastDeathRow)->item(0)->nodeValue;

    // Extraindo informações dos assassinos
    $assassinsInfo = [];
    $lastDeathDetails = $xpath->query(".//td", $lastDeathRow)->item(1)->nodeValue;
    $assassins = explode(', ', explode(' by ', $lastDeathDetails)[1]);

    foreach ($assassins as $assassin) {
        $assassinUrl = 'https://www.tibia.com/community/?name=' . urlencode($assassin);
        $assassinResponse = file_get_contents($assassinUrl);
        $assassinDom = new DOMDocument();
        @$assassinDom->loadHTML($assassinResponse);
        $assassinXpath = new DOMXPath($assassinDom);

        $level = $assassinXpath->query("//td[text()='Level:']/following-sibling::td")->item(0)->nodeValue;
        $vocation = $assassinXpath->query("//td[text()='Vocation:']/following-sibling::td")->item(0)->nodeValue;

        $assassinsInfo[] = [
            'name' => $assassin,
            'level' => $level,
            'vocation' => $vocation
        ];
    }

    // Ordenando os assassinos pelo nível
    usort($assassinsInfo, function ($a, $b) {
        return $b['level'] - $a['level'];
    });

    // Retornando as informações em formato JSON
    echo json_encode([
        'lastDeathDate' => $lastDeathDate,
        'assassins' => $assassinsInfo
    ]);
}

?>