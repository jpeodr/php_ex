<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Processa textos
    $text1 = htmlspecialchars(string: $_POST['text1']);
    $text2 = htmlspecialchars(string: $_POST['text2']);
    $text3 = htmlspecialchars(string: $_POST['text3']);

    //Processa checkbox
    $checkbox1 = isset($_POST['checkbox1']) ? 'true' : 'false';
    $checkbox2 = isset($_POST['checkbox2']) ? 'true' : 'false';

    //Processa textarea
    $textarea = htmlspecialchars(string: $_POST['textarea']);

    //Processa imagens
    $uploadDir = 'uploads/';
    $image1Path = $uploadDir . basename(path: $_FILES['image1']['name']);
    $image2Path = $uploadDir . basename(path: $_FILES['image2']['name']);
    move_uploaded_file(from:$_FILES['image1']['tmp_name'], to: $image1Path);
    move_uploaded_file(from:$_FILES['image2']['tmp_name'], to: $image2Path);

    //Cria ou abre o arquivo XML
    $xmlFile = 'data.xml';
    $xml = new SimpleXMLElement(data: '<root/>');

    //Adiciona dados ao XML
    $entry = $xml->addChild(qualifiedName: 'entry');
    $entry->addChild(qualifiedName: 'text1', value: $text1);
    $entry->addChild(qualifiedName: 'text2', value: $text2);
    $entry->addChild(qualifiedName: 'text3', value: $text3);
    $entry->addChild(qualifiedName: 'image1', value: $image1Path);
    $entry->addChild(qualifiedName: 'image2', value: $image2Path);
    $entry->addChild(qualifiedName: 'checkbox1', value: $checkbox1);
    $entry->addChild(qualifiedName: 'checkbox2', value: $checkbox2);
    $entry->addChild(qualifiedName: 'textarea', value: $textarea);

    //Salva o XML

    $xml->asXML(filename: $xmlFile);

    echo "Dados salvos com sucesso <a href= 'view.php'>Ver dados</a>";
}
?>