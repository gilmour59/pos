<?php

require_once '../../../controllers/sales.controller.php';
require_once '../../../models/sales.model.php';

require_once '../../../controllers/users.controller.php';
require_once '../../../models/users.model.php';

require_once '../../../controllers/clients.controller.php';
require_once '../../../models/clients.model.php';

require_once '../../../controllers/products.controller.php';
require_once '../../../models/products.model.php';

class PrintBills{

    public $sale_code;    

    public function printBill(){
        
        $item_sale = "code";
        $value_sale = $this->sale_code;

        $result_sale = SaleController::ctrShowSales($item_sale, $value_sale);

        $date = substr($result_sale['sale_date'], 0, -8);
        $products = json_decode($result_sale['products'], true);
        $net_price = number_format($result_sale['net_price'], 2);
        $tax = number_format($result_sale['tax'], 2);
        $total_price = number_format($result_sale['total_price'], 2);

        //Seller Info
        $item_seller = "id";
        $value_seller = $result_sale['seller_id'];

        $result_seller = UserController::ctrShowUsers($item_seller, $value_seller);

        //Client Info
        $item_client = "id";
        $value_client = $result_sale['client_id'];

        $result_client = ClientController::ctrShowClients($item_client, $value_client);

//TCPPDF Needs to have no spaces for it to work

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//To work with pages
$pdf->startPageGroup();
//Portrait and A4 Size
$pdf->AddPage('P', 'A4');

//------------------------------------------------------------------------------------------------
//FIRST BLOCK
//EOF is like a tag
$block_1 = <<<EOF

    <table>
        <tr>
            <td style="width:150px">
                <img src="images/logo-negro-bloque.png">
            </td>
            <td style="width:140px;">
                <div style="font-size:8.5px; text-align:right; line-height:13px;">
                    Test:1231023
                    <br>
                    Tesssst:123124                    
                </div>
            </td>
            <td style="width:140px;">
                <div style="font-size:8.5px; text-align:right; line-height:13px;">
                    Telephone: 123123
                    <br>
                    asdasda@gmail.com                 
                </div>
            </td>
            <td style="width:110px; text-align:center; color:red">
                <br>                
                <br>
                $this->sale_code
            </td>
        </tr>
    </table>

EOF;

$pdf->writeHTML($block_1, false, false, false, false, '');

//------------------------------------------------------------------------------------------------
//SECOND BLOCK
$block_2 = <<<EOF

    <table>
        <tr>
            <td style="width:540px">
                <img src="images/back.jpg">
            </td>
        </tr>
    </table>

    <table style="font-size:10px; padding:5px 10px;">
        <tr>
            <td style="border:1px solid #666; background-color:white; width:390px">
                Client: $result_client[name]
            </td>
            <td style="border:1px solid #666; background-color:white; width:150px text-align:right">
                Date: $date
            </td>
        </tr>
        <tr>
            <td style="border:1px solid #666; background-color:white; width:540px">
                Seller: $result_seller[name]
            </td>            
        </tr>
    </table>

EOF;

$pdf->writeHTML($block_2, false, false, false, false, '');

//------------------------------------------------------------------------------------------------
//THIRD BLOCK

//for the pdf to be seen
$pdf->Output('bill.pdf');

    }
}

//Getting the sale code
$print_bill = new PrintBills();
$print_bill->sale_code = $_GET['code'];
$print_bill->printBill();

?>