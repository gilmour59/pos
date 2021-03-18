<?php

require_once '../../../controllers/sales.controller.php';
require_once '../../../models/sales.model.php';


class PrintBills{

    public $sale_code;

    public function printBill(){
        
        $item = "code";
        $value = $this->sale_code;

        $result_sale = SaleController::ctrShowSales($item, $value);

        $date = substr($result_sale['sale_date'], 0, -8);
        $products = json_decode($result_sale['products'], true);
        $net_price = number_format($result_sale['net_price'], 2);
        $tax = number_format($result_sale['tax'], 2);
        $total_price = number_format($result_sale['total_price'], 2);

//TCPPDF Needs to have no spaces for it to work

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//To work with pages
$pdf->startPageGroup();
//Portrait and A4 Size
$pdf->AddPage('P', 'A4');

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

//for the pdf to be seen
$pdf->Output('bill.pdf');

    }
}

//Getting the sale code
$print_bill = new PrintBills();
$print_bill->sale_code = $_GET['code'];
$print_bill->printBill();

?>