<?php
require('fpdf.php');
require('db_connect.php'); // Includes the database connection

// Function to calculate total HT and TTC
function calculateTotal($productPrice, $quantity) {
    $total_ht = $productPrice * $quantity;
    $total_ttc = $total_ht * 1.20; // Assuming a 20% tax rate
    return array('total_ht' => $total_ht, 'total_ttc' => $total_ttc);
}

// Function to generate a PDF
function generatePDF($factureId, $cartItems, $total_ht, $total_ttc) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Facture', 0, 1, 'C');
    $pdf->Ln(10);

    // Print Facture ID
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Facture ID: ' . $factureId, 0, 1);
    $pdf->Cell(0, 10, 'Total HT: ' . $total_ht . ' DH', 0, 1);
    $pdf->Cell(0, 10, 'Total TTC: ' . $total_ttc . ' DH', 0, 1);
    $pdf->Ln(10);

    foreach ($cartItems as $item) {
        // Product details
        $pdf->Cell(0, 10, 'Nom du produit: ' . $item['name'], 0, 1);
        $pdf->Cell(0, 10, 'Prix unitaire: ' . $item['price'] . ' DH', 0, 1);
        $pdf->Cell(0, 10, 'Quantite: ' . $item['quantity'], 0, 1);
        // If image exists, display it
        if (!empty($item['image'])) {
            $pdf->Image($item['image'], 10, $pdf->GetY() + 5, 33);
            $pdf->Ln(50);
        } else {
            $pdf->Ln(10);
        }
    }

    $pdf->Output('I', 'Facture_' . $factureId . '.pdf'); // Display the PDF in the browser
}

// Decode the cart items from the query string
$cart = isset($_GET['cart']) ? json_decode(urldecode($_GET['cart']), true) : array();

// Consolidate cart items by product ID
$consolidatedCart = [];
foreach ($cart as $item) {
    if (isset($consolidatedCart[$item['id']])) {
        $consolidatedCart[$item['id']]['quantity'] = $item['quantity'];
    } else {
        $consolidatedCart[$item['id']] = $item;
    }
}

// Convert consolidated cart back to array format
$consolidatedCart = array_values($consolidatedCart);

// Check if the cart is not empty
if (!empty($consolidatedCart)) {
    // Calculate totals
    $total_ht = 0;
    $total_ttc = 0;
    foreach ($consolidatedCart as $item) {
        $totals = calculateTotal($item['price'], $item['quantity']);
        $total_ht += $totals['total_ht'];
        $total_ttc += $totals['total_ttc'];
    }

    // Generate a unique facture ID
    $uniqueFactureId = uniqid('FACTURE_');
    $nomClient = 'Saad'; // Example client name, replace with actual data if available
    $adresseClient = 'Oujda'; // Example address, replace with actual data if available

    // Prepare the query and bind parameters
    $stmt = $conn->prepare("INSERT INTO factures (numero_facture, nom_client, adresse_client, total_ht, total_ttc) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdd", $uniqueFactureId, $nomClient, $adresseClient, $total_ht, $total_ttc);
    $stmt->execute();
    $factureId = $conn->insert_id;

    // Insert each product in the consolidated cart into the `details_facture` table
    foreach ($consolidatedCart as $item) {
        $stmt = $conn->prepare("INSERT INTO details_facture (id_facture, id_produit, quantite, prix_unitaire) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $factureId, $item['id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }

    // Generate and display the PDF
    generatePDF($factureId, $consolidatedCart, $total_ht, $total_ttc);
} else {
    echo 'Votre panier est vide.';
}

?>
