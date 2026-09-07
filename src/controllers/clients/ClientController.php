<?php

require_once __DIR__ . '/../../models/clients/Client.php';
require_once __DIR__ . '/../../dao/clients/ClientDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client = new Client();
    $client->setName($_POST['name']);
    $client->setEmail($_POST['email']);
    $client->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
    $client->setCpf($_POST['cpf']);
    $client->setPhone($_POST['phone']);
    $client->setAddress($_POST['address']);
    $client->setNumber($_POST['number']);
    $client->setComplement($_POST['complement']);
    $client->setNeighborhood($_POST['neighborhood']);
    $client->setCity($_POST['city']);
    $client->setState($_POST['state']);
    $client->setCep($_POST['cep']);

    $clientDAO = new ClientDAO();
    $result = $clientDAO->insert($client);

    echo $result;
    exit;
}

?>