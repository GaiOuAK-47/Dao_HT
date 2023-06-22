<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(array('status' => '0', 'message' => 'Session not found.'));
    die;
}
try {
    include('../../conn.php');
    $socode = $_GET["socode"];
    //$emcode = $_GET["e"];

    // var_dump($_GET); 
    // exit;

    $sql = "SELECT a.socode,a.cuscode,c.cusname,sodate,deldate,a.remark,b.sono,b.stcode,d.stname1,b.amount,b.price,b.unit,supstatus,b.unit,b.discount";
    $sql .= ",c.idno,c.road,c.subdistrict,c.district,c.province,c.zipcode,c.tel ";
    $sql .= " from somaster as a inner join sodetail as b on (a.socode=b.socode) ";
    $sql .= " inner join customer as c on (a.cuscode=c.cuscode) ";
    $sql .= " inner join product as d on (b.stcode=d.stcode) ";
    $sql .= " where a.socode = '".$socode."' ";    
    
    // echo $sql;

    $query = mysqli_query($conn,$sql);

    $data = array(       
        "socode" => array(),
        "cuscode" => array(),
        "cusname" => array(),
        "sodate" => array(),
        "address" => array(),
        "tel" => array(),
        "deldate" => array(),
        "remark" => array(),
        "sono" => array(),                
        "stcode" => array(),
        "stname1" => array(),
        "unit" => array(),
        "discount" => array(),                
        "amount" => array(),
        "price" => array()
        );
		
        while($row = $query->fetch_assoc()) 
        {            
            $address = ($row["idno"] == '' ? '': 'เลขที่ '.$row["idno"].' ').($row["road"] == '' ? '': 'ถนน'.$row["road"].' ');
			$address .= ($row["subdistrict"] == '' ? '': 'ต.'.$row["subdistrict"].'  ').($row["district"] == '' ? '': 'อ.'.$row["district"].'  ');
			$address .= ($row["province"] == '' ? '': 'จ.'.$row["province"].' ').($row["zipcode"] == '' ? '': ' '.$row["zipcode"]);

            array_push($data['socode'],$row['socode']);
            array_push($data['cuscode'],$row['cuscode']); 
            array_push($data['cusname'],$row['cusname']);            
            array_push($data['sodate'],$row['sodate']);
            array_push($data['address'],$address);
            array_push($data['tel'],$row['tel']);
            array_push($data['deldate'],$row['deldate']);
            array_push($data['remark'],$row['remark']);
            array_push($data['sono'],$row['sono']);
            array_push($data['stcode'],$row['stcode']);  
            array_push($data['stname1'],$row['stname1']);  
            array_push($data['unit'],$row['unit']);              
            array_push($data['discount'],$row['discount']);            
            array_push($data['amount'],$row['amount']);
            array_push($data['price'],$row['price']);         
        }


} catch (mysqli_sql_exception $e) {
    http_response_code(400);
    echo json_encode(array('status' => '0', 'message' => "Sql fail."));
} finally {
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en" id="printJS-form">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- เลขที่ 111/41 หมู่5 ต.ศรีสุนทร อ.ถลาง จ.ภูเก็ต 83110 -->
    <title>ใบขายสินค้า</title>
    <?php include_once('../../../config.php'); ?>

    <link rel="stylesheet" href="<?php echo PATH; ?>/font/Sarabun/font-sarabun.css">
    <script src="<?php echo PATH; ?>/addon/src/sweetalert2@11.js"></script>

    <style>
    html,
    body {
        font-family: 'Sarabun', 'THSarabunNew', 'THNiramitAS', sans-serif !important;
        font-weight: 400;
        margin: 0;
        padding: 0;
        padding-top: 8px;
    }

    .label-section {
        position: absolute;
        width: 100%;
        display: flex;
        justify-content: space-around;
        box-sizing: border-box;
    }

    .label-box {
        width: 43.2vw;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding: 8px 2px;
    }

    .label-box button {
        outline: 1px #0000001a solid;
        border: 0px white solid;
        border-radius: 2px;
        padding: 3px 8px;
        box-shadow: 1px 2px 3px 0px #3333336e;
        cursor: pointer;
    }

    .label-box button:first-child {
        background-color: #68bc68;
    }

    .label-box button:last-child {
        background-color: #a3c7fe;
    }
    </style>
    <style>
    .header {
        display: block;
    }

    @page {
        counter-increment: page
    }

    .bu-title {
        font-size: 18pt;
        font-weight: 300;
        padding-bottom: 8px;
    }

    .bu-address {
        font-size: 12pt;
        font-weight: 300;
        padding-bottom: 8px;
        text-align: left;
    }

    .doc-title {
        font-size: 14pt;
        font-weight: 300;
        padding-top: 6px;
        padding-bottom: 14px;
        /* text-align: cente; */
    }

    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        padding: 4px;
    }

    page[size="A4"] {
        width: 21cm;
        min-height: 29.7cm;
        padding: 1cm;
    }

    .header-title {
        margin-bottom: 24px;
    }

    .customer-detail {
        padding: 2px;
        font-size: 9pt;
    }

    .customer-detail table {
        width: 100%;
    }

    /* .customer-detail table>tbody>tr {} */

    .customer-detail table>tbody>tr>td,
    .order-detail table>tbody>tr>td {
        padding-top: 4px;
        padding-bottom: 4px;
        padding-left: 12px;
        padding-right: 8px;
    }

    .customer-detail table>tbody>tr td:first-child,
    .order-detail table>tbody>tr td:first-child {
        width: 84px;
    }

    .order-detail {
        padding: 2px;
        font-size: 9pt;
    }

    .order-detail table {
        width: 100%;
    }

    /* .order-detail table>tbody>tr {} */

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .list-header th {
        padding: 8px 8px;
        font-weight: 300;
        font-size: 11pt;
        border: 1px solid #000;
        box-sizing: border-box;
    }

    .list-detail {
        /* padding-top: 24px; */
        padding-left: 4px;
        padding-right: 4px;
    }

    .list-detail td {
        /* background-color: #d5dbe38c; */
        padding: 6px 8px;
        font-weight: 300;
        font-size: 9pt;
        box-sizing: border-box;
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: 1px dotted #c6bebe;
        overflow-wrap: break-word;
        vertical-align: top;
        line-height: 1.3rem;
    }

    .list-detail thead tr {
        background-color: #c6c5c5;
    }

    .list-detail table>tbody tr td:nth-child(1) {
        padding-left: 14px;
    }

    .list-detail table>tbody tr td:nth-child(2) {
        max-width: 220px;
    }

    .list-detail table>tbody tr td:nth-child(3) {
        max-width: 120px;
    }

    .list-detail table>tbody tr td:nth-child(4) {
        max-width: 160px;
    }

    .list-detail table>tbody tr td:nth-child(5) {
        max-width: 160px;
    }

    /* .list-summary {} */

    .list-summary td {
        padding: 14px 8px 14px 8px;
        font-weight: 500;
        font-size: 10pt;
        border: 1pt solid #000;
        box-sizing: border-box;
    }

    .list-summary td:nth-child(2),
    .list-detail td:nth-child(5) {
        text-align: right;
        padding-right: 12px;
    }

    .list-summary td:nth-child(3) {
        text-align: center;
        vertical-align: middle;
    }

    /* .sign-detail {
            border: 1px solid #000; 
        } */

    .sign-detail table {
        border-collapse: separate;
        border-spacing: 4px 0px;
        page-break-inside: avoid;
    }

    .sign-detail table>tbody tr td {
        width: 25% !important;
        font-size: 11pt;
        border: 1pt solid #000;
        box-sizing: border-box;
    }

    .sign-detail table>tbody tr:first-child td {
        text-align: center;
        padding: 4px;
        border-bottom: none;
    }

    .sign-detail table>tbody tr:nth-child(2) td {
        text-align: center;
        padding: 24px 4px;
        border-bottom: none;
    }

    .sign-detail table>tbody tr:nth-child(3) td {
        text-align: left;
        padding: 8px 4px;
    }

    /* #main-sign tfoot>tr{
            page-break-after: always;
        } */
    .message-next {
        border: none !important;
        text-align: right !important;
        font-size: 9pt !important;
    }

    @media print {
        @page {
            size: A4;
            margin: 1cm;
        }

        page[size="A4"] {
            min-height: 29.7cm;
            padding: 0px;
        }

        body,
        page {
            margin: 0;
            box-shadow: none;
            /* -webkit-print-color-adjust: exact; */
        }

        .header {
            display: none;
        }

        .label-section {
            display: none;
        }
    }

    .all-detail {
        position: relative;
        width: 100%;
        border: 2px solid #dedede;
        padding: 14px 8px;
        margin-bottom: 24px;
    }

    /* :before{
        content: attr(title);
        position: absolute;
        top: -15px;
        left: 24px;
        background-color: white;
        padding: 3px 4px;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.7px;
    } */
    </style>
</head>

<body onload="window.print()">
    <div class="label-section">
        <div class="label-box">
            <button onclick="window.print();">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="18pt">
                    <path
                        d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                </svg>
            </button>
        </div>
    </div>
    <page size="A4">
        <table style="width: 100%;" id="main-doc">
            <thead>
                <tr>
                    <td>
                        <div class="header-title">
                            <table>
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="bu-title">
                                            ใบขายสินค้า
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="doc-title">
                                            บริษัท โอซี มันนี่กรุ๊ป จำกัด<br>
                                            OC MONEYGROUP CO.,LTD.
                                        </th>
                                    </tr>
                                    <!-- <tr>
                                        <th colspan="2" class="bu-title">
                                        ที่อยู่ 341/7 หมู่6 ตำบลรั้วใหญ่อำเภอเมือง จังหวัดสุพรรณบุรี 72000 <br>โทร
                                            0994629464
                                            เลขจดทะเบียนนิติบุคคล0725565000746
                                        </th>
                                    </tr> -->
                                    
                                    <tr>
                                        <th colspan="2" class="bu-address">
                                            ที่อยู่ 341/7 หมู่6 ตำบลรั้วใหญ่อำเภอเมือง จังหวัดสุพรรณบุรี 72000 <br>
                                            โทร 099-4629464 หมายเลขผู้เสียภาษี 0725565000746
                                        </th>
                                    </tr>
                                    <tr class="all-detail">
                                        <td style="padding: 1.5px;">
                                            <div class="customer-detail">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td>รหัสผู้ขาย</td>
                                                            <td><?=$data["cuscode"][0];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ชื่อผู้ขาย</td>
                                                            <td>
                                                                <?=$data["cusname"][0];?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>ที่อยู่</td>
                                                            <td>
                                                                <?=$data["address"][0];?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>โทร</td>
                                                            <td><?=$data["tel"][0];?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                        <td style="padding: 1.5px;">
                                            <div class="order-detail">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td>เลขที่ใบสั่งซื้อ</td>
                                                            <td><?=$data["socode"][0];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>วันที่</td>
                                                            <td><?=$data["sodate"][0];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>หน้า</td>
                                                            <td><span class="page" id="page-doc">-/-</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>อ้างอิง</td>
                                                            <td>-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>

            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="list-detail">
                            <table>
                                <thead>
                                    <tr class="list-header">
                                        <th style="width: 60px;">ลำดับ</th>
                                        <th style="width: 100px;">รหัสสินค้า</th>
                                        <th style="width: 220px;">รายการ</th>
                                        <th style="width: 120px;">จำนวน</th>
                                        <th style="width: 160px;">หน่วย</th>
                                        <th style="width: 110px;">ราคา/หน่วย</th>
                                        <th style="width: 120px;">ส่วนลด</th>
                                        <th style="width: 120px;text-align:center;">จำนวนเงิน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                     $texttotal='';
                                     $totalprice=0;
                                     $total=0;
                                    //  for($count2=0;$count2<30;$count2++)  {
                                    for($count=0;$count<count($data["socode"]);$count++)  {

                                    $total = ($data["amount"][$count] * $data["price"][$count]) - ((($data["amount"][$count] *$data["price"][$count]) * $data["discount"][$count]) / 100);
                                    if($total==0)
                                    $texttotal='แถมฟรี';
                                    else 
                                    $texttotal=number_format($total,2);
                                        ?>
                                    <tr>
                                        <td><?= ($count + 1) ?></td>
                                        <td><?=$data["stcode"][$count];?></td>
                                        <td><?=$data["stname1"][$count];?></td>
                                        <td style="text-align:center;"><?=$data["amount"][$count];?></td>
                                        <td style="text-align:center;"><?=$data["unit"][$count];?></td>
                                        <td><?=number_format($data["price"][$count], 2);?></td>
                                        <td><?=$data["discount"][$count];?> %</td>
                                        <td style="text-align:right;"><?=$texttotal;?></td>
                                    </tr>
                                    <?php 
                                    $totalprice+=$total;
                                // }
                            } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="list-summary">
                                        <td colspan="5" rowspan="3">หมายเหตุ / Remark<br><?=$data["remark"][0];?></td>
                                        <td colspan="2" style="text-align:left;">รวมเงินทั้งสิ้น</td>
                                        <td style="text-align:right;"><?= number_format($totalprice, 2) ?></td>
                                    </tr>                                    
                                    <tr class="list-summary">
                                    <?php
                                    $vat=0;
                                    if($data["vat"][0]=='Y')
                                    {
                                        $vat=$totalprice*7/100;
                                    ?>
                                        <td colspan="2">ภาษีมูลค่าเพิ่ม(7%)</td>
                                        <td style="text-align:right;"><?= number_format($totalprice*7/100, 2) ?></td>
                                        <?php
                                    }
                                    else{
                                    ?>
                                    <td colspan="2">ภาษีมูลค่าเพิ่ม(0%)</td>
                                        <td style="text-align:right;"><?= number_format($vat, 2) ?></td>
                                        <?php                                    }
                                    
                                    ?>
                                    </tr>
                                    <tr class="list-summary">
                                        <td colspan="2">รวมมูลค่าสินค้า</td>
                                        <td style="text-align:right;"><?= number_format($totalprice+$vat, 2) ?></td>
                                    </tr>
                                    <tr class="list-summary">
                                        <td colspan="2" rowspan="1">ตัวอักษร</td>
                                        <td colspan="6" rowspan="1" id="num_string">-</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot></tfoot>
        </table>
        <table id="main-sign">
            <thead></thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <div class="sign-detail" style=" margin-top: 20px;">
                            <table>
                                <tbody>
                                    <tr>
                                        <td colspan="3">ผู้ขอซื้อ</td>
                                        <td colspan="3">ผู้ตรวจสอบ</td>
                                        <td colspan="3">ผู้อนุมัติ</td>                                        
                                    </tr>
                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                        <td colspan="3">&nbsp;</td>
                                        <td colspan="3">&nbsp;</td>                                        
                                    </tr>
                                    <tr>
                                        <td colspan="3">วันที่: </td>
                                        <td colspan="3">วันที่: </td>
                                        <td colspan="3">วันที่: </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </page>
    <script src="<?= PATH ?>/backend/addon/thai-bath/thai-bath.js"></script>
    <!-- <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script> -->
    <script>
    window.addEventListener('load', (event) => {
        let n = ArabicNumberToText(Number(<?= $totalprice+$totalprice*7/100 ?>));

        document.getElementById("num_string").textContent = `( ${n} )`;

        const button_secction = document.querySelector(".label-section");

        const tbody = document.querySelector(".list-detail table tbody");
        const lists = document.querySelectorAll(".list-detail table tbody tr");
        let pages = [];
        let rows = [];
        let trHeigth = 0;
        let tbodyHeight = tbody.offsetHeight;
        let trLangth = lists.length;
        lists.forEach((elm, ind) => {
            //let rowNum = elm.querySelector("td:nth-child(1)");
            //rowNum.textContent = `${ind + 1}`;
            //rowNum.style.textAlign = "center"; 
            //console.log(elm, " row => ", ind, " row-heigth => ", elm.offsetHeight ," row count => ", trHeigth);
            let isNextPage = tbodyHeight >= 545 && (tbodyHeight - trHeigth <= elm.offsetHeight * 1) &&
                trLangth - ind <= 1;
            if (isNextPage || trHeigth >= 545) { //trHeigth >= 530
                //elm.style.pageBreakAfter = "always";
                trHeigth = 0;
                pages.push(rows);
                rows = [];
            }

            rows.push(elm);
            trHeigth += elm.offsetHeight;
        });
        pages.push(rows);
        console.log(pages)
        let page = document.querySelector("page[size=A4]");

        document.body.innerHTML = "";
        document.body.append(button_secction);
        const totalPage = pages.length;
        pages.forEach((elm, ind) => {
            const pageClone = page.cloneNode(true);
            const tableParrent = pageClone.querySelector("table#main-doc");
            const tableSign = pageClone.querySelector("table#main-sign");
            const tableList = pageClone.querySelector(".list-detail table");
            const bodyLists = pageClone.querySelector(".list-detail table tbody");
            const pageNumber = pageClone.querySelector("#page-doc").textContent =
                `${ind+1} / ${pages.length}`;

            bodyLists.innerHTML = ""
            if (ind + 1 < totalPage) {
                let mesNextpage =
                    `<tr><td class="message-next" > * มีรายการทั้งหมด ${trLangth} รายการ มีต่อหน้า ${ind+2} </td></tr>`;
                tableSign.querySelector("tfoot .sign-detail tbody").innerHTML = mesNextpage;
                tableList.querySelector("tfoot").remove();
            }
            elm?.forEach((v, i) => {
                bodyLists.append(v);
            });

            document.body.append(pageClone);
        });
    });
    window.addEventListener('afterprint', (event) => {
        const button_secction = document.querySelector(".label-section");
        button_secction.style.display = "flex";
        //window.close();
    });
    window.addEventListener("beforeprint", (event) => {
        const button_secction = document.querySelector(".label-section");

        button_secction.style.display = "none";
    })

    async function approve(socode) {
        const {
            value: text
        } = await Swal.fire({
            icon: 'info',
            input: 'textarea',
            inputLabel: 'เหตุผลการ ปิดใบงาน',
            inputPlaceholder: 'กรุณาใส่เหตุผลการปิดใบงาน...',
            inputAttributes: {
                'aria-label': 'Type your message here'
            },
            customClass: {
                validationMessage: 'my-validation-message'
            },
            allowOutsideClick: false,
            showCancelButton: true,
            reverseButtons: true,
            preConfirm: (value) => {
                if (!value) {
                    Swal.showValidationMessage("กรุณาใส่เหตุผล")
                }
            }
        });

        if (text) {
            try {
                let form = new FormData()
                form.append("socode", socode);
                form.append("remark", text);
                const response = await fetch("approve.php", {
                    method: "POST",
                    body: form,
                });
                //const result = await response.json();
                //console.log("Success:", result);
                Swal.fire('เสร็จสิ้น!', 'ปิดใบงานเสร็จสิ้น', 'success').then(() => {
                    window.location.reload();
                });

            } catch (error) {
                console.error("Error:", error);
                Swal.fire('เกิดข้อผิดพลาด', "เกิดปัญหาในการปิดใบงานกรุณาลองใหม่อีกครั้ง", 'error');
            }
        }
    }
    </script>

</body>

</html>